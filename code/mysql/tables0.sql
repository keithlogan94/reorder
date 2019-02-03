

DROP TABLE IF EXISTS request_payload_validation;
CREATE TABLE request_payload_validation
(
  request_index VARCHAR(50),
  validation_method ENUM('number','regex','string','bool'),
  regex VARCHAR(500)
);

INSERT INTO request_payload_validation (request_index, validation_method, regex) VALUES
('accountId','number',NULL),
('email','regex','(?:[a-z0-9!#$%&''*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&''*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])'),
('phone','string',NULL),
('firstName','regex','^[a-zA-Z]{2,25}$'),
('lastName','regex','^[a-zA-Z]{2,25}$'),
('middleName','regex','^[a-zA-Z]{2,25}$'),
('birthday','regex','^\d\d\d\d-\d\d-\d\d$'),
('gender','regex','^(male|female)$'),
('street1','string',NULL),
('street2','string',NULL),
('city','string',NULL),
('state','string',NULL),
('zip','string',NULL),
('country','string',NULL),
('isBilling','bool',NULL),
('isShipping','bool',NULL),
('billingFirstName','regex','^[a-zA-Z]{2,25}$'),
('billingLastName','regex','^[a-zA-Z]{2,25}$'),
('shippingFirstName','regex','^[a-zA-Z]{2,25}$'),
('shippingLastName','regex','^[a-zA-Z]{2,25}$')
;
