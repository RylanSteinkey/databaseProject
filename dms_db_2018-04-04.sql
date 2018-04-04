# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.21)
# Database: dms_db
# Generation Time: 2018-04-04 18:51:05 +0000
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
  `purch_order_no` varchar(11) NOT NULL,
  `price_paid` float NOT NULL,
  `purch_date` date NOT NULL,
  `purch_location` varchar(50) NOT NULL DEFAULT '',
  `dealer_id` varchar(11) NOT NULL,
  `auction` char(1) NOT NULL,
  `notes` text,
  `emp_id` varchar(11) NOT NULL,
  `vehicle_id` varchar(11) NOT NULL,
  PRIMARY KEY (`purch_order_no`),
  KEY `dealer_id` (`dealer_id`),
  KEY `vehicle_id` (`vehicle_id`),
  CONSTRAINT `car_purchase_ibfk_1` FOREIGN KEY (`dealer_id`) REFERENCES `dealer` (`dealer_id`),
  CONSTRAINT `car_purchase_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table car_sale
# ------------------------------------------------------------

DROP TABLE IF EXISTS `car_sale`;

CREATE TABLE `car_sale` (
  `sale_id` varchar(11) NOT NULL,
  `date_sold` date NOT NULL,
  `total_due` float NOT NULL,
  `down_payment` float NOT NULL,
  `finance_amount` float NOT NULL,
  `customer_id` varchar(11) NOT NULL,
  `emp_id` varchar(11) NOT NULL,
  `vehicle_id` varchar(11) NOT NULL,
  `rep_commission` float NOT NULL,
  `notes` text,
  `number_payments` int(4) NOT NULL,
  `balance_remaining` float NOT NULL,
  PRIMARY KEY (`sale_id`),
  KEY `customer_id` (`customer_id`),
  KEY `vehicle_id` (`vehicle_id`),
  KEY `emp_id` (`emp_id`),
  CONSTRAINT `car_sale_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  CONSTRAINT `car_sale_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`),
  CONSTRAINT `car_sale_ibfk_3` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `customer_id` varchar(11) NOT NULL,
  `first_name` varchar(50) NOT NULL DEFAULT '',
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `street_name` varchar(50) NOT NULL DEFAULT '',
  `postal_code` varchar(7) NOT NULL DEFAULT '',
  `province` varchar(35) NOT NULL,
  `gender` char(1) NOT NULL,
  `tax_id` varchar(9) NOT NULL DEFAULT '',
  `num_late_payments` int(4) unsigned zerofill NOT NULL,
  `avg_days_late` int(4) unsigned zerofill NOT NULL,
  `notes` text,
  `employment_history_id` varchar(11) NOT NULL,
  `address` varchar(150) GENERATED ALWAYS AS (concat_ws(' ',`street_name`,`city`,`postal_code`,`province`)) VIRTUAL,
  PRIMARY KEY (`customer_id`),
  KEY `employment_history` (`employment_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customer_employment_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_employment_history`;

CREATE TABLE `customer_employment_history` (
  `customer_id` varchar(11) NOT NULL DEFAULT '',
  `employment_history_id` varchar(11) NOT NULL,
  `employer` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `supervisor` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(15) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `street_name` varchar(50) NOT NULL DEFAULT '',
  `postal_code` varchar(7) NOT NULL DEFAULT '',
  `province` varchar(35) NOT NULL DEFAULT '',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `address` varchar(150) GENERATED ALWAYS AS (concat_ws(' ',`street_name`,`city`,`postal_code`,`province`)) VIRTUAL,
  PRIMARY KEY (`employment_history_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table dealer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dealer`;

CREATE TABLE `dealer` (
  `dealer_id` varchar(11) NOT NULL,
  `company_name` varchar(50) NOT NULL DEFAULT '',
  `contact_first` varchar(50) NOT NULL DEFAULT '',
  `contact_last` varchar(50) NOT NULL DEFAULT '',
  `contact_phone` varchar(15) NOT NULL,
  `company_phone` varchar(15) NOT NULL DEFAULT '',
  `contact_email` varchar(50) NOT NULL DEFAULT '',
  `notes` text,
  `province` varchar(35) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `street_name` varchar(50) NOT NULL,
  `postal_code` varchar(7) NOT NULL,
  `address` varchar(150) GENERATED ALWAYS AS (concat_ws(' ',`street_name`,`city`,`postal_code`,`province`)) VIRTUAL,
  PRIMARY KEY (`dealer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table employee
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `emp_id` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `employee_type` varchar(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `street_name` varchar(50) NOT NULL DEFAULT '',
  `postal_code` varchar(7) NOT NULL DEFAULT '',
  `province` varchar(35) NOT NULL,
  `address` varchar(150) GENERATED ALWAYS AS (concat_ws(' ',`street_name`,`city`,`postal_code`,`province`)) VIRTUAL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table payments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `payment_id` varchar(11) NOT NULL,
  `customer_id` varchar(11) NOT NULL,
  `date_due` date NOT NULL,
  `amount_due` float NOT NULL,
  `date_paid` date NOT NULL,
  `associated_product_id` varchar(11) NOT NULL,
  `amount_paid` float NOT NULL,
  `bank_account` varchar(20) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sold_warranty
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sold_warranty`;

CREATE TABLE `sold_warranty` (
  `sold_warranty_id` varchar(11) NOT NULL,
  `customer_id` varchar(11) NOT NULL,
  `sale_date` date NOT NULL,
  `emp_id` varchar(11) NOT NULL,
  `total_cost` float NOT NULL,
  `monthly_cost` float NOT NULL,
  PRIMARY KEY (`sold_warranty_id`),
  KEY `customer_id` (`customer_id`),
  KEY `emp_id` (`emp_id`),
  CONSTRAINT `sold_warranty_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  CONSTRAINT `sold_warranty_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table vehicle
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vehicle`;

CREATE TABLE `vehicle` (
  `vehicle_id` varchar(11) NOT NULL,
  `customer_id` varchar(11) NOT NULL,
  `make` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `v_year` year(4) NOT NULL,
  `color` varchar(25) NOT NULL,
  `miles` float NOT NULL,
  `v_condition` varchar(35) NOT NULL,
  `repair_cost` float NOT NULL,
  `book_price` float NOT NULL,
  `issue_log` text,
  `sales_price` float NOT NULL,
  `style` varchar(35) NOT NULL DEFAULT '',
  `interior_color` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`vehicle_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table warranty_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `warranty_type`;

CREATE TABLE `warranty_type` (
  `warranty_code` varchar(11) NOT NULL,
  `warranty_name` varchar(50) NOT NULL DEFAULT '',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `length` int(4) NOT NULL,
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
