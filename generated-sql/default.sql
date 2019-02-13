
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- city
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city`
(
    `ID` INTEGER DEFAULT 0 NOT NULL,
    `Name` CHAR(35) DEFAULT '' NOT NULL,
    `CountryCode` CHAR(3) DEFAULT '' NOT NULL,
    `District` CHAR(20) DEFAULT '' NOT NULL,
    `Population` INTEGER DEFAULT 0 NOT NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- countrylanguage
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `countrylanguage`;

CREATE TABLE `countrylanguage`
(
    `CountryCode` CHAR(3) DEFAULT '' NOT NULL,
    `Language` CHAR(30) DEFAULT '' NOT NULL,
    `IsOfficial` enum('T','F') DEFAULT 'F' NOT NULL,
    `Percentage` FLOAT(4,1) DEFAULT 0.0 NOT NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- crm_account
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `crm_account`;

CREATE TABLE `crm_account`
(
    `crm_account_id` INTEGER NOT NULL AUTO_INCREMENT,
    `add_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`crm_account_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- crm_address
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `crm_address`;

CREATE TABLE `crm_address`
(
    `crm_address_id` INTEGER NOT NULL AUTO_INCREMENT,
    `crm_account_id` INTEGER NOT NULL,
    `street1` VARCHAR(200) NOT NULL,
    `street2` VARCHAR(200),
    `city` VARCHAR(100) NOT NULL,
    `state` VARCHAR(10) NOT NULL,
    `zip` VARCHAR(10),
    `country` VARCHAR(10) NOT NULL,
    `is_billing` TINYINT(1) DEFAULT 0 NOT NULL,
    `billing_first_name` VARCHAR(40),
    `billing_last_name` VARCHAR(40),
    `is_shipping` TINYINT(1) DEFAULT 0 NOT NULL,
    `shipping_first_name` VARCHAR(40),
    `shipping_last_name` VARCHAR(40),
    `start_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `end_date` DATETIME,
    PRIMARY KEY (`crm_address_id`),
    INDEX `crm_account_id` (`crm_account_id`),
    INDEX `is_billing` (`is_billing`),
    INDEX `is_shipping` (`is_shipping`),
    CONSTRAINT `crm_address_ibfk_1`
        FOREIGN KEY (`crm_account_id`)
        REFERENCES `crm_account` (`crm_account_id`),
    CONSTRAINT `crm_address_ibfk_2`
        FOREIGN KEY (`crm_address_id`)
        REFERENCES `crm_account` (`crm_account_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- crm_country
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `crm_country`;

CREATE TABLE `crm_country`
(
    `name` VARCHAR(100),
    `continent` VARCHAR(100),
    `region` VARCHAR(100),
    `active` TINYINT(1)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- crm_email
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `crm_email`;

CREATE TABLE `crm_email`
(
    `crm_email_id` INTEGER NOT NULL AUTO_INCREMENT,
    `crm_account_id` INTEGER NOT NULL,
    `email_address` VARCHAR(250) NOT NULL,
    `verified` TINYINT(1) DEFAULT 0 NOT NULL,
    `start_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `end_date` DATETIME,
    PRIMARY KEY (`crm_email_id`),
    INDEX `crm_account_id` (`crm_account_id`),
    INDEX `email_address` (`email_address`),
    CONSTRAINT `crm_email_ibfk_1`
        FOREIGN KEY (`crm_account_id`)
        REFERENCES `crm_account` (`crm_account_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- crm_login_credentials
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `crm_login_credentials`;

CREATE TABLE `crm_login_credentials`
(
    `crm_login_credentials_id` INTEGER NOT NULL AUTO_INCREMENT,
    `crm_account_id` INTEGER NOT NULL,
    `username` VARCHAR(100),
    `password` VARCHAR(100) NOT NULL,
    `add_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`crm_login_credentials_id`),
    UNIQUE INDEX `crm_account_id` (`crm_account_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- crm_person
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `crm_person`;

CREATE TABLE `crm_person`
(
    `crm_person_id` INTEGER NOT NULL AUTO_INCREMENT,
    `crm_account_id` INTEGER NOT NULL,
    `first_name` VARCHAR(27) NOT NULL,
    `last_name` VARCHAR(27) NOT NULL,
    `middle_name` VARCHAR(27),
    `birthday` DATE,
    `gender` enum('male','female') NOT NULL,
    `phone_number` VARCHAR(25),
    PRIMARY KEY (`crm_person_id`),
    UNIQUE INDEX `crm_account_id` (`crm_account_id`),
    CONSTRAINT `crm_person_ibfk_1`
        FOREIGN KEY (`crm_account_id`)
        REFERENCES `crm_account` (`crm_account_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- fin_credit_card
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fin_credit_card`;

CREATE TABLE `fin_credit_card`
(
    `fin_credit_card_id` INTEGER NOT NULL AUTO_INCREMENT,
    `crm_account_id` INTEGER NOT NULL,
    `name_on_card` VARCHAR(150) NOT NULL,
    `number` VARCHAR(30) NOT NULL,
    `security_code` VARCHAR(10),
    `expiration_month` TINYINT NOT NULL,
    `expiration_year` SMALLINT NOT NULL,
    `add_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `start_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `end_date` DATETIME,
    PRIMARY KEY (`fin_credit_card_id`),
    INDEX `number` (`number`),
    INDEX `crm_account_id` (`crm_account_id`),
    CONSTRAINT `fin_credit_card_ibfk_1`
        FOREIGN KEY (`crm_account_id`)
        REFERENCES `crm_account` (`crm_account_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- fin_order
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fin_order`;

CREATE TABLE `fin_order`
(
    `fin_order_id` INTEGER NOT NULL AUTO_INCREMENT,
    `crm_account_id` INTEGER NOT NULL,
    `zinc_request_id` VARCHAR(200) NOT NULL,
    `order_json` VARCHAR(2000) NOT NULL,
    `add_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`fin_order_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- request_payload_validation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `request_payload_validation`;

CREATE TABLE `request_payload_validation`
(
    `request_index` VARCHAR(50),
    `validation_method` enum('number','regex','string','bool'),
    `regex` VARCHAR(500)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sec_retailer_login
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sec_retailer_login`;

CREATE TABLE `sec_retailer_login`
(
    `sec_retailer_login_id` INTEGER NOT NULL AUTO_INCREMENT,
    `retailer` enum('amazon','walmart') NOT NULL,
    `crm_account_id` INTEGER NOT NULL,
    `login_email` VARCHAR(250) NOT NULL,
    `login_password` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`sec_retailer_login_id`),
    INDEX `retailer` (`retailer`),
    INDEX `crm_account_id` (`crm_account_id`),
    INDEX `login_email` (`login_email`),
    CONSTRAINT `sec_retailer_login_ibfk_1`
        FOREIGN KEY (`crm_account_id`)
        REFERENCES `crm_account` (`crm_account_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sys_config
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sys_config`;

CREATE TABLE `sys_config`
(
    `sys_config_id` INTEGER NOT NULL AUTO_INCREMENT,
    `config_key` VARCHAR(40) NOT NULL,
    `description` VARCHAR(200) NOT NULL,
    `value` VARCHAR(70) NOT NULL,
    `add_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`sys_config_id`),
    INDEX `config_key` (`config_key`),
    INDEX `value` (`value`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
