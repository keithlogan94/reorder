
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


DROP PROCEDURE IF EXISTS insert_crm_address;


DELIMITER $$

CREATE PROCEDURE insert_crm_address
  (
  p_crm_account_id INT(11),
  p_address_line1 VARCHAR(200),
  p_address_line2 VARCHAR(200),
  p_city VARCHAR(100),
  p_state VARCHAR(100),
  p_zip VARCHAR(100),
  p_country VARCHAR(10),
  p_is_billing BOOLEAN,
  p_billing_first_name VARCHAR(40),
  p_billing_last_name VARCHAR(40),
  p_is_shipping BOOLEAN,
  p_shipping_first_name VARCHAR(40),
  p_shipping_last_name VARCHAR(40)
)
BEGIN


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
      p_billing_first_name,
      p_billing_last_name,
      p_is_billing,
      p_shipping_first_name,
      p_shipping_last_name,
      p_is_shipping
    );

    SELECT LAST_INSERT_ID() AS 'last_insert_id';

end $$

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




# CALL upsert_crm_address(4,'4240 Swanson Way',NULL,'Castle Rock','CO','80109','US',TRUE,'Keith','Becker',TRUE,'Keith','Becker');
# SELECT * FROM crm_address;











