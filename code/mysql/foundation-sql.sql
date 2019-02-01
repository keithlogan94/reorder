
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

  SET crm_account_id = (SELECT LAST_INSERT_ID());

  INSERT INTO crm_person (crm_account_id,first_name,last_name,middle_name,birthday,gender,phone_number)
  VALUES (accountId,p_first_name,p_last_name,p_middle_name,p_birthday,p_gender,p_phone_number);

  INSERT INTO crm_email (crm_account_id,email_address) VALUES (accountId,p_email_address);

  SELECT accountId;

END

$$

