
DROP PROCEDURE IF EXISTS insert_crm_account;

DELIMITER $$

CREATE PROCEDURE insert_crm_account(p_first_name VARCHAR(50),
                                    p_last_name VARCHAR(50),
                                    p_middle_name VARCHAR(50),
                                    p_email_address VARCHAR(200),
                                    p_phone_number VARCHAR(20),
                                    p_gender ENUM('male','female'),
                                    p_birthday DATE
)
BEGIN

  DECLARE accountId INT;

  INSERT INTO crm_account (add_time)
  VALUES (NOW());

  SET accountId = (SELECT LAST_INSERT_ID());

  INSERT INTO crm_person (crm_account_id,first_name,last_name,middle_name,birthday,gender,phone_number)
  VALUES (accountId,p_first_name,p_last_name,p_middle_name,p_birthday,p_gender,p_phone_number);

  INSERT INTO crm_email (crm_account_id,email_address) VALUES (accountId,p_email_address);

  SELECT accountId;

END

$$

DELIMITER ;

DROP PROCEDURE IF EXISTS get_account_by;

DELIMITER $$

CREATE PROCEDURE get_account_by
(
  p_by ENUM('email','accountId'),
  p_data VARCHAR(250)
)

BEGIN

  IF (p_by = 'email') THEN

    #get account by email
    SELECT
      ce.crm_account_id,cp.first_name,cp.last_name,cp.middle_name,cp.birthday,cp.gender,cp.phone_number,ce.email_address,ce.verified,a.add_time AS 'account_creation_datetime'
    FROM crm_account a
           INNER JOIN crm_person cp on a.crm_account_id = cp.crm_account_id
           INNER JOIN crm_email ce on a.crm_account_id = ce.crm_account_id
    WHERE ce.email_address = p_data AND ce.start_date < NOW() AND (ce.end_date > NOW() OR ce.end_date IS NULL)
    LIMIT 1
    ;

  ELSEIF (p_by = 'accountId') THEN

    #get account by account id
    SELECT
      ce.crm_account_id,cp.first_name,cp.last_name,cp.middle_name,cp.birthday,cp.gender,cp.phone_number,ce.email_address,ce.verified,a.add_time AS 'account_creation_datetime'
    FROM crm_account a
           INNER JOIN crm_person cp on a.crm_account_id = cp.crm_account_id
           INNER JOIN crm_email ce on a.crm_account_id = ce.crm_account_id
    WHERE ce.crm_account_id = CAST(p_data AS UNSIGNED) AND ce.start_date < NOW() AND (ce.end_date > NOW() OR ce.end_date IS NULL)
    LIMIT 1
    ;
  END IF;

END $$


DELIMITER ;

DROP PROCEDURE IF EXISTS update_crm_account;

DELIMITER $$


CREATE PROCEDURE update_crm_account(
  p_first_name VARCHAR(50),
  p_last_name VARCHAR(50),
  p_middle_name VARCHAR(50),
  p_email_address VARCHAR(200),
  p_phone_number VARCHAR(20),
  p_gender ENUM('male','female'),
  p_birthday DATE,
  p_crm_account_id INT(11)
)
BEGIN

  DECLARE currentEmail VARCHAR(250);

  SET currentEmail = (SELECT email_address FROM crm_email WHERE crm_account_id = p_crm_account_id
                                                            AND start_date < NOW() AND
                                                                (end_date > NOW() OR end_date IS NULL) LIMIT 1);

  UPDATE crm_person p
  INNER JOIN crm_email e ON p.crm_account_id = e.crm_account_id
  INNER JOIN crm_account a ON e.crm_account_id = a.crm_account_id
  SET
      p.first_name = p_first_name,
      p.last_name = p_last_name,
      p.middle_name = p_middle_name,
      p.phone_number = p_phone_number,
      p.gender = p_gender,
      p.birthday = p_birthday
  WHERE a.crm_account_id = p_crm_account_id;

  IF (currentEmail != p_email_address) THEN

    #end old email
    UPDATE crm_email
      SET end_date = NOW()
    WHERE crm_account_id = p_crm_account_id;

    #create new email
    INSERT INTO crm_email (crm_account_id, email_address) VALUES (p_crm_account_id, p_email_address);

  end if;

END $$


DELIMITER ;


DROP PROCEDURE IF EXISTS upsert_crm_address;


DELIMITER $$

CREATE PROCEDURE upsert_crm_address
(
  p_which_type ENUM('billing','shipping','primary'),
  p_crm_account_id INT(11),
  p_address_line1 VARCHAR(200),
  p_address_line2 VARCHAR(200),
  p_city VARCHAR(100),
  p_state VARCHAR(100),
  p_zip VARCHAR(100),
  p_country VARCHAR(10),
  p_first_name VARCHAR(40),
  p_last_name VARCHAR(40)
)
BEGIN

  IF (p_which_type = 'billing') THEN
    IF NOT EXISTS (SELECT * FROM crm_address WHERE crm_account_id = p_crm_account_id AND
                                                   start_date < NOW() AND
      (end_date > NOW() OR end_date IS NULL) AND is_billing = TRUE) THEN
      INSERT INTO crm_address (crm_account_id, street1, street2, city, state, zip, country, billing_first_name,
                               billing_last_name,is_billing, shipping_first_name, shipping_last_name, is_shipping)
      VALUES
      (
        p_crm_account_id,
        p_address_line1,
        p_address_line2,
        p_city,
        p_state,
        p_zip,
        p_country,
        p_first_name,
        p_last_name,
        TRUE,
        NULL,
        NULL,
        FALSE
      );

      ELSE
      UPDATE crm_address
        SET
            street1 = p_address_line1,
            street2 = p_address_line2,
            city = p_city,
            state = p_state,
            country = p_country,
            zip = p_zip,
            billing_first_name = p_first_name,
            billing_last_name = p_last_name
      WHERE crm_account_id = p_crm_account_id
      AND is_billing = TRUE AND start_date < NOW() AND
        (end_date > NOW() OR end_date IS NULL);
    end if;

    ELSEIF (p_which_type = 'shipping') THEN
      IF NOT EXISTS (SELECT * FROM crm_address WHERE crm_account_id = p_crm_account_id AND
          start_date < NOW() AND
        (end_date > NOW() OR end_date IS NULL) AND is_shipping = TRUE) THEN
        INSERT INTO crm_address (crm_account_id, street1, street2, city, state, zip, country, billing_first_name,
                                 billing_last_name,is_billing, shipping_first_name, shipping_last_name, is_shipping)
        VALUES
        (
          p_crm_account_id,
          p_address_line1,
          p_address_line2,
          p_city,
          p_state,
          p_zip,
          p_country,
          NULL,
          NULL,
          FALSE,
          p_first_name,
          p_last_name,
          TRUE
        );

      ELSE
        UPDATE crm_address
        SET
          street1 = p_address_line1,
          street2 = p_address_line2,
          city = p_city,
          state = p_state,
          country = p_country,
          zip = p_zip,
          shipping_first_name = p_first_name,
          shipping_last_name = p_last_name
        WHERE crm_account_id = p_crm_account_id
          AND is_shipping = TRUE AND start_date < NOW() AND
          (end_date > NOW() OR end_date IS NULL);
      end if;

    ELSEIF (p_which_type = 'primary') THEN
      IF NOT EXISTS (SELECT * FROM crm_address WHERE crm_account_id = p_crm_account_id AND
          start_date < NOW() AND
        (end_date > NOW() OR end_date IS NULL) AND is_billing = FALSE AND is_shipping = FALSE) THEN
        INSERT INTO crm_address (crm_account_id, street1, street2, city, state, zip, country, billing_first_name,
                                 billing_last_name,is_billing, shipping_first_name, shipping_last_name, is_shipping)
        VALUES
        (
          p_crm_account_id,
          p_address_line1,
          p_address_line2,
          p_city,
          p_state,
          p_zip,
          p_country,
          NULL,
          NULL,
          FALSE,
          NULL,
          NULL,
          FALSE
        );

      ELSE
        UPDATE crm_address
        SET
          street1 = p_address_line1,
          street2 = p_address_line2,
          city = p_city,
          state = p_state,
          country = p_country,
          zip = p_zip
        WHERE crm_account_id = p_crm_account_id
          AND is_billing = FALSE AND is_shipping = FALSE AND start_date < NOW() AND
          (end_date > NOW() OR end_date IS NULL);
      end if;

  end if;

end $$

DELIMITER ;

DROP PROCEDURE IF EXISTS get_address_by;

DELIMITER $$


CREATE PROCEDURE get_address_by (
p_get_by ENUM('email','accountId'),
p_which ENUM('primary','billing','shipping'),
p_data VARCHAR(250)
)
BEGIN

  IF (p_get_by = 'email') THEN

    IF (p_which = 'primary') THEN

      SELECT a.crm_account_id,a.street1,a.street2,a.city,a.state,a.zip,a.country FROM crm_address a
        INNER JOIN crm_account ca on a.crm_account_id = ca.crm_account_id
        INNER JOIN crm_email ce on ca.crm_account_id = ce.crm_account_id
      WHERE ce.email_address = p_data AND ce.start_date < NOW() AND (ce.end_date > NOW() OR ce.end_date IS NULL)
        AND a.is_shipping = FALSE AND a.is_billing = FALSE
      ;

      ELSEIF (p_which = 'shipping') THEN

        SELECT a.crm_account_id,a.street1,a.street2,a.city,a.state,a.zip,a.country,a.shipping_first_name,a.shipping_last_name
        FROM crm_address a
          INNER JOIN crm_account ca on a.crm_account_id = ca.crm_account_id
          INNER JOIN crm_email ce on ca.crm_account_id = ce.crm_account_id
        WHERE ce.email_address = p_data AND ce.start_date < NOW() AND (ce.end_date > NOW() OR ce.end_date IS NULL)
          AND a.is_shipping = TRUE
        ;

      ELSEIF (p_which = 'billing') THEN

        SELECT a.crm_account_id,a.street1,a.street2,a.city,a.state,a.zip,a.country,a.billing_first_name,a.billing_last_name
        FROM crm_address a
               INNER JOIN crm_account ca on a.crm_account_id = ca.crm_account_id
               INNER JOIN crm_email ce on ca.crm_account_id = ce.crm_account_id
        WHERE ce.email_address = p_data AND ce.start_date < NOW() AND (ce.end_date > NOW() OR ce.end_date IS NULL)
          AND a.is_billing = TRUE
        ;

    end if;

    ELSEIF (p_get_by = 'accountId') THEN

      IF (p_which = 'primary') THEN

        SELECT a.crm_account_id,a.street1,a.street2,a.city,a.state,a.zip,a.country FROM crm_address a
          INNER JOIN crm_account ca on a.crm_account_id = ca.crm_account_id
          INNER JOIN crm_email ce on ca.crm_account_id = ce.crm_account_id
        WHERE ce.crm_account_id = CAST(p_data AS UNSIGNED) AND ce.start_date < NOW() AND (ce.end_date > NOW() OR ce.end_date IS NULL)
          AND a.is_shipping = FALSE AND a.is_billing = FALSE
        ;

      ELSEIF (p_which = 'shipping') THEN

        SELECT a.crm_account_id,a.street1,a.street2,a.city,a.state,a.zip,a.country,a.shipping_first_name,a.shipping_last_name
        FROM crm_address a
          INNER JOIN crm_account ca on a.crm_account_id = ca.crm_account_id
          INNER JOIN crm_email ce on ca.crm_account_id = ce.crm_account_id
        WHERE ce.crm_account_id = CAST(p_data AS UNSIGNED) AND ce.start_date < NOW() AND (ce.end_date > NOW() OR ce.end_date IS NULL)
          AND a.is_shipping = TRUE
        ;

      ELSEIF (p_which = 'billing') THEN

        SELECT a.crm_account_id,a.street1,a.street2,a.city,a.state,a.zip,a.country,a.billing_first_name,a.billing_last_name
        FROM crm_address a
          INNER JOIN crm_account ca on a.crm_account_id = ca.crm_account_id
          INNER JOIN crm_email ce on ca.crm_account_id = ce.crm_account_id
        WHERE ce.crm_account_id = CAST(p_data AS UNSIGNED) AND ce.start_date < NOW() AND (ce.end_date > NOW() OR ce.end_date IS NULL)
          AND a.is_billing = TRUE
        ;

  end if;
    END IF;

end $$

DELIMITER ;


DROP PROCEDURE IF EXISTS upsert_login_credentials;


DELIMITER $$


CREATE PROCEDURE upsert_login_credentials (
p_crm_account_id INT(11),
p_email VARCHAR(250),
p_password VARCHAR(250)
)
BEGIN

  IF EXISTS (SELECT * FROM crm_login_credentials WHERE crm_account_id = p_crm_account_id) THEN

    UPDATE crm_login_credentials
    SET
        username = p_email,
        password = p_password
    WHERE crm_account_id = p_crm_account_id
    ;

    ELSE

    INSERT INTO crm_login_credentials (crm_account_id, username, password)
    VALUES (p_crm_account_id, p_email, p_password)
    ;

  end if;

end $$

DELIMITER ;

DROP PROCEDURE IF EXISTS get_login_credentials;

DELIMITER $$

CREATE PROCEDURE get_login_credentials (
p_email VARCHAR(250),
p_password VARCHAR(100)
)
BEGIN

  SELECT
         c.crm_account_id,c.username,c.password
  FROM crm_login_credentials c WHERE username = p_email AND password = p_password;

end $$

DELIMITER ;

SHOW TABLES;

DROP PROCEDURE IF EXISTS get_config_by;

DELIMITER $$


CREATE PROCEDURE get_config_by (
p_get_by ENUM('config_key','description'),
p_data VARCHAR(50)
)
BEGIN

  IF (p_get_by = 'config_key') THEN


    SELECT
           s.config_key,s.description,s.value
    FROM sys_config s WHERE config_key = p_data;


    ELSEIF (p_get_by = 'description') THEN


    SELECT
      s.config_key,s.description,s.value
    FROM sys_config s WHERE description = p_data
    ;

  end if;


end $$


DELIMITER ;


DROP PROCEDURE IF EXISTS upsert_credit_card;


DELIMITER $$


CREATE PROCEDURE upsert_credit_card (
p_crm_account_id INT(11),
p_name_on_card VARCHAR(150),
p_number VARCHAR(30),
p_security_code VARCHAR(10),
p_expiration_month TINYINT,
p_expiration_year SMALLINT
)
BEGIN

  IF EXISTS (SELECT * FROM fin_credit_card WHERE start_date < NOW() AND (end_date > NOW() OR end_date IS NULL)
                                             AND crm_account_id = p_crm_account_id) THEN
    #credit card does exist already for this account
    UPDATE fin_credit_card
    SET end_date = NOW()
    WHERE crm_account_id = p_crm_account_id
      AND end_date IS NULL
      ;

    INSERT INTO fin_credit_card (crm_account_id, name_on_card, number, security_code, expiration_month, expiration_year)
    VALUES
    (p_crm_account_id, p_name_on_card,p_number,p_security_code,p_expiration_month,p_expiration_year)
    ;

    ELSE
    #credit card does not exist yet for this account

      INSERT INTO fin_credit_card (crm_account_id, name_on_card, number, security_code, expiration_month, expiration_year)
      VALUES
      (p_crm_account_id, p_name_on_card,p_number,p_security_code,p_expiration_month,p_expiration_year)
      ;

  end if;

end $$


DELIMITER ;


DROP PROCEDURE IF EXISTS get_credit_card_by;


DELIMITER $$


CREATE PROCEDURE get_credit_card_by (
p_get_by ENUM('accountId','email'),
p_data VARCHAR(250)
)
BEGIN

  IF (p_get_by = 'accountId') THEN

    SELECT
      c.crm_account_id,c.name_on_card,c.number,c.security_code,c.expiration_month,c.expiration_year,c.start_date
    FROM fin_credit_card c
    WHERE crm_account_id = CAST(p_data AS UNSIGNED)
      AND start_date < NOW() AND (end_date > NOW() OR end_date IS NULL)
    ;

    ELSEIF (p_get_by = 'email') THEN

      SELECT
        c.crm_account_id,c.name_on_card,c.number,c.security_code,c.expiration_month,c.expiration_year,c.start_date
      FROM fin_credit_card c
      INNER JOIN crm_email e ON c.crm_account_id = e.crm_account_id AND e.start_date < NOW() AND
                                (e.end_date > NOW() OR e.end_date IS NULL)
      WHERE e.email_address = p_data
        AND c.start_date < NOW() AND (c.end_date > NOW() OR c.end_date IS NULL)
      ;

  end if;


end $$


DELIMITER ;

