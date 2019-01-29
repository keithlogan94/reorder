

DROP PROCEDURE IF EXISTS insert_crm_account;
CREATE PROCEDURE insert_crm_account(
  p_account_type ENUM('business','personal'),
  p_first_name VARCHAR(50),
  p_last_name VARCHAR(50),
  p_middle_name VARCHAR(50),
  p_email_address VARCHAR(200),
  p_phone_number VARCHAR(20),
  p_street1 VARCHAR(200),
  p_stree2 VARCHAR(50),
  p_city VARCHAR(120),
  p_state VARCHAR(10),
  p_zip_code VARCHAR(10),
  p_country VARCHAR(10)
)
BEGIN

  INSERT INTO crm_account (account_type, first_name, last_name, middle_name, email_address, phone_number, street1, street2, city, state, zip_code, country)
  VALUES (p_account_type, p_first_name,p_last_name,p_middle_name,p_email_address,p_phone_number,p_street1,p_stree2,p_city,p_state,p_zip_code,p_country)
  ;

END;

DROP PROCEDURE IF EXISTS update_crm_account;
CREATE PROCEDURE update_crm_account(
  p_account_type ENUM('business','personal'),
  p_first_name VARCHAR(50),
  p_last_name VARCHAR(50),
  p_middle_name VARCHAR(50),
  p_email_address VARCHAR(200),
  p_phone_number VARCHAR(20),
  p_street1 VARCHAR(200),
  p_stree2 VARCHAR(50),
  p_city VARCHAR(120),
  p_state VARCHAR(10),
  p_zip_code VARCHAR(10),
  p_country VARCHAR(10),
  p_crm_account_id INT(11)
)
BEGIN
  UPDATE crm_account SET
                         account_type = p_account_type,
                         first_name = p_first_name,
                         last_name = p_last_name,
                         middle_name = p_middle_name,
                         email_address = p_email_address,
                         phone_number = p_phone_number,
                         street1 = p_street1,
                         street2 = p_stree2,
                         city = p_city,
                         state = p_state,
                         zip_code = p_zip_code,
                         country = p_country
    WHERE crm_account_id = p_crm_account_id;
END;

DROP PROCEDURE IF EXISTS find_crm_account_by_crm_account_id;
CREATE PROCEDURE find_crm_account_by_crm_account_id(p_crm_account_id INT(11))
BEGIN 
  SELECT * FROM crm_account WHERE crm_account_id = p_crm_account_id;
END
;


DROP PROCEDURE IF EXISTS find_crm_account_by_email;
CREATE PROCEDURE find_crm_account_by_email(p_email_address VARCHAR(200))
BEGIN 
  
  SELECT * FROM crm_account WHERE email_address = p_email_address LIMIT 1;
  
END;

