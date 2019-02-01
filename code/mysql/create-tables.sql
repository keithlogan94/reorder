DROP TABLE IF EXISTS crm_login_credentials;
CREATE TABLE crm_login_credentials
(
  crm_login_credentials_id INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
  crm_account_id           INT(11)      NOT NULL UNIQUE KEY,
  username                 VARCHAR(100) NULL,
  password                 VARCHAR(100) NOT NULL,
  add_time                 TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
