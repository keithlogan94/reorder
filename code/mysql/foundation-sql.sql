
DROP PROCEDURE IF EXISTS insert_crm_account;

DELIMITER $$

CREATE PROCEDURE insert_crm_account(p_first_name VARCHAR(50),
                                    p_last_name VARCHAR(50),
                                    p_middle_name VARCHAR(50),
                                    p_email_address VARCHAR(200),
                                    p_phone_number VARCHAR(20),
                                    p_gender ENUM('male','female'),
                                    p_birthday DATE)
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



CALL get_account_by('accountId','5');



# CALL insert_crm_account('Keith','Becker','Logan','keithloganbecker94@gmail.com','8082258615','male',NULL);
# CALL get_account_by('accountId','5');
#
#
# SELECT * FROM crm_account a
#                 INNER JOIN crm_person cp on a.crm_account_id = cp.crm_account_id
#                 INNER JOIN crm_email ce on a.crm_account_id = ce.crm_account_id
# WHERE ce.email_address = 'keithloganbecker94@gmail.com' AND ce.start_date < NOW() AND (ce.end_date > NOW() OR ce.end_date IS NULL)
# ;