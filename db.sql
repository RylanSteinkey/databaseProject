# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.21)
# Database: dms_db
# Generation Time: 2018-04-07 08:17:47 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table car_purchase
# ------------------------------------------------------------

DROP TABLE IF EXISTS `car_purchase`;

CREATE TABLE `car_purchase` (
  `purch_order_no` int(11) NOT NULL AUTO_INCREMENT,
  `dealer_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `price_paid` float NOT NULL,
  `purch_date` date NOT NULL,
  `purch_location` varchar(50) NOT NULL,
  `auction` char(1) NOT NULL,
  `notes` text,
  PRIMARY KEY (`purch_order_no`),
  KEY `vehicle_id` (`vehicle_id`),
  KEY `dealer_id` (`dealer_id`),
  CONSTRAINT `car_purchase_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`),
  CONSTRAINT `car_purchase_ibfk_2` FOREIGN KEY (`dealer_id`) REFERENCES `dealer` (`dealer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table car_sale
# ------------------------------------------------------------

DROP TABLE IF EXISTS `car_sale`;

CREATE TABLE `car_sale` (
  `sale_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `date_sold` date NOT NULL,
  `total_due` float NOT NULL,
  `down_payment` float NOT NULL,
  `finance_amount` float NOT NULL,
  `balance_remaining` float NOT NULL,
  `rep_commission` int(2) NOT NULL,
  `number_payments` int(5) NOT NULL,
  `notes` text,
  PRIMARY KEY (`sale_id`),
  KEY `customer_id` (`customer_id`),
  KEY `emp_id` (`emp_id`),
  KEY `vehicle_id` (`vehicle_id`),
  CONSTRAINT `car_sale_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  CONSTRAINT `car_sale_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  CONSTRAINT `car_sale_ibfk_3` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` char(1) NOT NULL,
  `DOB` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tax_id` varchar(11) NOT NULL,
  `num_late_payments` int(5) NOT NULL,
  `avg_days_late` int(5) NOT NULL,
  `street_name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `notes` text,
  `address` varchar(170) GENERATED ALWAYS AS (concat_ws(' ',`street_name`,`city`,`province`,`postal_code`)) VIRTUAL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `gender`, `DOB`, `phone`, `email`, `tax_id`, `num_late_payments`, `avg_days_late`, `street_name`, `city`, `province`, `postal_code`, `notes`, `address`)
VALUES
	(4,'Bender','Rodriguez','0','2017-11-30','(780)862-4012','a@b.c','123456789',0,0,'1 Ave St','Calgary','Ontario','T1K8A2','','1 Ave St Calgary Ontario T1K8A2'),
	(5,'Yao','Hoa','1','2018-04-01','(123)512-2301','a@b.c','123091234',0,0,'123 Fake St','Aurora','Ontario','M3A2Z9','','123 Fake St Aurora Ontario M3A2Z9');

/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customer_employment_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_employment_history`;

CREATE TABLE `customer_employment_history` (
  `employment_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `employer` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `supervisor` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `street_name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `address` varchar(170) GENERATED ALWAYS AS (concat_ws(' ',`street_name`,`city`,`province`,`postal_code`)) VIRTUAL,
  PRIMARY KEY (`employment_history_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `customer_employment_history_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `customer_employment_history` WRITE;
/*!40000 ALTER TABLE `customer_employment_history` DISABLE KEYS */;

INSERT INTO `customer_employment_history` (`employment_history_id`, `customer_id`, `employer`, `title`, `supervisor`, `start_date`, `end_date`, `phone`, `street_name`, `city`, `province`, `postal_code`, `address`)
VALUES
	(2,4,'Best','empoo','mcgee','2017-07-29','2015-11-30','(123)456-7890','2 Ave S','Lethbridge','Alberta','T1K4T6','2 Ave S Lethbridge Alberta T1K4T6'),
	(3,5,'Harliett','Manager','Gumbee','2018-04-01','2018-04-10','1239024012','1 ft st','Lethbridge','Alberta','T1K8A2','1 ft st Lethbridge Alberta T1K8A2');

/*!40000 ALTER TABLE `customer_employment_history` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dealer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dealer`;

CREATE TABLE `dealer` (
  `dealer_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) NOT NULL,
  `company_phone` varchar(50) NOT NULL,
  `contact_first` varchar(50) NOT NULL,
  `contact_last` varchar(50) NOT NULL,
  `contact_phone` varchar(15) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `notes` text,
  `street_name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `address` varchar(170) GENERATED ALWAYS AS (concat_ws(' ',`street_name`,`city`,`province`,`postal_code`)) VIRTUAL,
  PRIMARY KEY (`dealer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



# Dump of table employee
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_type` varchar(25) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `street_name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `address` varchar(170) GENERATED ALWAYS AS (concat_ws(' ',`street_name`,`city`,`province`,`postal_code`)) VIRTUAL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;

INSERT INTO `employee` (`emp_id`, `employee_type`, `first_name`, `last_name`, `phone`, `street_name`, `city`, `province`, `postal_code`, `address`)
VALUES
	(2,'Manager','Bender','Rodriguez','(780)872-4012','4 Ave S','Lethbridge','Alberta','T1K8A2','4 Ave S Lethbridge Alberta T1K8A2');

/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table payments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `associated_product_id` int(11) NOT NULL,
  `date_due` date NOT NULL,
  `amount_due` float NOT NULL,
  `amount_paid` float NOT NULL,
  `date_paid` date NOT NULL,
  `bank_account` varchar(50) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sold_warranty
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sold_warranty`;

CREATE TABLE `sold_warranty` (
  `sold_warranty_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sale_date` date NOT NULL,
  `total_cost` float NOT NULL,
  `monthly_cost` float NOT NULL,
  PRIMARY KEY (`sold_warranty_id`),
  KEY `emp_id` (`emp_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `sold_warranty_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  CONSTRAINT `sold_warranty_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table vehicle
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vehicle`;

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `v_year` int(11) NOT NULL,
  `color` varchar(25) NOT NULL,
  `style` varchar(25) NOT NULL,
  `interior_color` varchar(25) NOT NULL,
  `miles` int(5) NOT NULL,
  `v_condition` varchar(50) NOT NULL DEFAULT '',
  `repair_cost` float NOT NULL,
  `book_price` float NOT NULL,
  `sale_price` float NOT NULL,
  `issue_log` text,
  PRIMARY KEY (`vehicle_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



# Dump of table warranty_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `warranty_type`;

CREATE TABLE `warranty_type` (
  `warranty_code` int(11) NOT NULL AUTO_INCREMENT,
  `warranty_name` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `length` int(5) NOT NULL,
  `cost` float NOT NULL,
  `deductible` float NOT NULL,
  `covered_items` text NOT NULL,
  PRIMARY KEY (`warranty_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
