CREATE TABLE `vsms_account`
(
`id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
`username` VARCHAR(128),
`password` VARCHAR(128),
`first_name` VARCHAR(128),
`last_name` VARCHAR(128),
`org_name` VARCHAR(255),
`gender_id` INTEGER,
`race` VARCHAR(128),
`nationality` VARCHAR(128),
`address_line1` VARCHAR(128),
`address_line2` VARCHAR(128),
`address_line3` VARCHAR(128),
`address_line4` VARCHAR(128),
`postal` VARCHAR(16),
`country_id` INTEGER,
`province` VARCHAR(128),
`email1` VARCHAR(128),
`email2` VARCHAR(128),
`country_code1` VARCHAR(4),
`country_code2` VARCHAR(4),
`area_code1` VARCHAR(4),
`area_code2` VARCHAR(4),
`phone1` VARCHAR(128),
`phone2` VARCHAR(128),
`create_time` DATETIME,
`update_time` DATETIME,
`last_login_time` DATETIME,
`description` TEXT,
`int_field1` INTEGER,
`int_field2` INTEGER,
`dbl_field1` DOUBLE,
`dbl_field2` DOUBLE,
`varc_field1` VARCHAR(255),
`varc_field2` VARCHAR(255),
`txt_field1` TEXT,
`txt_field2` TEXT,
`dat_field1` DATETIME,
`dat_field2` DATETIME
) ENGINE = InnoDB;

CREATE TABLE `vsms_contact`
(
`id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
`username` VARCHAR(128),
`account_id` INTEGER,
`first_name` VARCHAR(128),
`last_name` VARCHAR(128),
`gender_id` INTEGER,
`race` VARCHAR(128),
`nationality` VARCHAR(128),
`address_line1` VARCHAR(128),
`address_line2` VARCHAR(128),
`address_line3` VARCHAR(128),
`address_line4` VARCHAR(128),
`postal` VARCHAR(16),
`country_id` INTEGER,
`province` VARCHAR(128),
`email1` VARCHAR(128),
`email2` VARCHAR(128),
`country_code1` VARCHAR(4),
`country_code2` VARCHAR(4),
`area_code1` VARCHAR(4),
`area_code2` VARCHAR(4),
`phone1` VARCHAR(128),
`phone2` VARCHAR(128),
`create_time` DATETIME,
`update_time` DATETIME,
`last_login_time` DATETIME,
`description` TEXT,
`int_field1` INTEGER,
`int_field2` INTEGER,
`dbl_field1` DOUBLE,
`dbl_field2` DOUBLE,
`varc_field1` VARCHAR(255),
`varc_field2` VARCHAR(255),
`txt_field1` TEXT,
`txt_field2` TEXT,
`dat_field1` DATETIME,
`dat_field2` DATETIME
) ENGINE = InnoDB;

CREATE TABLE `vsms_group`
(
`id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
`groupname` VARCHAR(255),
`description` TEXT,
`account_id` INTEGER,
`org_name` VARCHAR(255),
`int_field1` INTEGER,
`int_field2` INTEGER,
`dbl_field1` DOUBLE,
`dbl_field2` DOUBLE,
`varc_field1` VARCHAR(255),
`varc_field2` VARCHAR(255),
`txt_field1` TEXT,
`txt_field2` TEXT,
`dat_field1` DATETIME,
`dat_field2` DATETIME
) ENGINE = InnoDB;

CREATE TABLE `vsms_group_contact`
(
`id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
`group_id` INTEGER,
`contact_id` INTEGER,
`account_id` INTEGER,
`description` TEXT,
`org_name` VARCHAR(255),
`int_field1` INTEGER,
`int_field2` INTEGER,
`dbl_field1` DOUBLE,
`dbl_field2` DOUBLE,
`varc_field1` VARCHAR(255),
`varc_field2` VARCHAR(255),
`txt_field1` TEXT,
`txt_field2` TEXT,
`dat_field1` DATETIME,
`dat_field2` DATETIME
) ENGINE = InnoDB;

CREATE TABLE `vsms_mail_sms`
(
`id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
`group_id` INTEGER,
`status` INTEGER,
`account_id` INTEGER,
`to_group_id` INTEGER,
`to_contact_id` INTEGER,
`to_type` INTEGER,
`sms_type` INTEGER,
`message_body` TEXT,
`parent_sms_id` INTEGER,
`org_name` VARCHAR(255),
`int_field1` INTEGER,
`int_field2` INTEGER,
`dbl_field1` DOUBLE,
`dbl_field2` DOUBLE,
`varc_field1` VARCHAR(255),
`varc_field2` VARCHAR(255),
`txt_field1` TEXT,
`txt_field2` TEXT,
`dat_field1` DATETIME,
`dat_field2` DATETIME,
`dat_field3` DATETIME,
`dat_field4` DATETIME,
`dat_field5` DATETIME
) ENGINE = InnoDB;

CREATE TABLE `vsms_country`
(
`id` INTEGER NOT NULL PRIMARY KEY,
`country_name` VARCHAR(128)
) ENGINE = InnoDB;

CREATE TABLE `vsms_gender`
(
`id` INTEGER NOT NULL PRIMARY KEY,
`gender_name` VARCHAR(16)
) ENGINE = InnoDB;
