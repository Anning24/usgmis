/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.8-MariaDB : Database - db_usgmis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_usgmis` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `db_usgmis`;

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `CATEGORY_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CNAME` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CATEGORY_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `category` */

insert  into `category`(`CATEGORY_ID`,`CNAME`) values (0,'Keyboard'),(1,'Mouse'),(2,'Monitor'),(3,'Motherboard'),(4,'Processor'),(5,'Power Supply'),(6,'Headset'),(7,'CPU'),(9,'Others');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `middle_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `birth_date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customer` */

insert  into `customer`(`cust_id`,`first_name`,`middle_name`,`last_name`,`birth_date`,`sex`,`status`,`street`,`city`,`province`,`type`,`phone_number`,`date_added`) values (1,'Juan','Dela','Cruz','1995-09-26','Male','Single','096 Ilaya Street Habay 1','Bacoor','Cavite','Regular','09156540385','2021-01-23 15:06:45');

/*Table structure for table `emergency_contact` */

DROP TABLE IF EXISTS `emergency_contact`;

CREATE TABLE `emergency_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relationship` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `emergency_contact` */

insert  into `emergency_contact`(`id`,`cust_id`,`full_name`,`relationship`,`phone_number`,`address`) values (1,1,'Juan Dela Cruz111','Fathersszz','09123123','096 Ilaya Street Habay 1');

/*Table structure for table `employee` */

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `EMPLOYEE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `FIRST_NAME` varchar(50) DEFAULT NULL,
  `LAST_NAME` varchar(50) DEFAULT NULL,
  `GENDER` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PHONE_NUMBER` varchar(11) DEFAULT NULL,
  `JOB_ID` int(11) DEFAULT NULL,
  `HIRED_DATE` varchar(50) NOT NULL,
  `LOCATION_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`EMPLOYEE_ID`),
  UNIQUE KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`),
  UNIQUE KEY `PHONE_NUMBER` (`PHONE_NUMBER`),
  KEY `LOCATION_ID` (`LOCATION_ID`),
  KEY `JOB_ID` (`JOB_ID`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`LOCATION_ID`) REFERENCES `location` (`LOCATION_ID`),
  CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`JOB_ID`) REFERENCES `job` (`JOB_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `employee` */

insert  into `employee`(`EMPLOYEE_ID`,`FIRST_NAME`,`LAST_NAME`,`GENDER`,`EMAIL`,`PHONE_NUMBER`,`JOB_ID`,`HIRED_DATE`,`LOCATION_ID`) values (1,'Admin','Admin','Male','princelycesar23@gmail.com','09124033805',1,'0000-00-00',113),(2,'Josuey','Mag-asos','Male','jmagaso@yahoo.com','09091245761',2,'2019-01-28',156),(4,'Monica','Empinado','Female','monicapadernal@gmail.com','09123357105',1,'2019-03-06',158);

/*Table structure for table `job` */

DROP TABLE IF EXISTS `job`;

CREATE TABLE `job` (
  `JOB_ID` int(11) NOT NULL,
  `JOB_TITLE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`JOB_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `job` */

insert  into `job`(`JOB_ID`,`JOB_TITLE`) values (1,'Manager'),(2,'Cashier');

/*Table structure for table `location` */

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `LOCATION_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PROVINCE` varchar(100) DEFAULT NULL,
  `CITY` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`LOCATION_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;

/*Data for the table `location` */

insert  into `location`(`LOCATION_ID`,`PROVINCE`,`CITY`) values (111,'Negros Occidental','Bacolod City'),(112,'Negros Occidental','Bacolod City'),(113,'Negros Occidental','Binalbagan'),(114,'Negros Occidental','Himamaylan'),(115,'Negros Oriental','Dumaguette City'),(116,'Negros Occidental','Isabella'),(126,'Negros Occidental','Binalbagan'),(130,'Cebu','Bogo City'),(131,'Negros Occidental','Himamaylan'),(132,'Negros','Jupiter'),(133,'Aincrad','Floor 91'),(134,'negros','binalbagan'),(135,'hehe','tehee'),(136,'PLANET YEKOK','KOKEY'),(137,'Camiguin','Catarman'),(138,'Camiguin','Catarman'),(139,'Negros Occidental','Binalbagan'),(140,'Batangas','Lemery'),(141,'Capiz','Panay'),(142,'Camarines Norte','Labo'),(143,'Camarines Norte','Labo'),(144,'Camarines Norte','Labo'),(145,'Camarines Norte','Labo'),(146,'Capiz','Pilar'),(147,'Negros Occidental','Moises Padilla'),(148,'a','a'),(149,'1','1'),(150,'Negros Occidental','Himamaylan'),(151,'Masbate','Mandaon'),(152,'Aklanas','Madalagsasa'),(153,'Batangas','Mabini'),(154,'Bataan','Morong'),(155,'Capiz','Pillar'),(156,'Negros Occidental','Bacolod'),(157,'Camarines Norte','Labo'),(158,'Negros Occidental','Binalbagan');

/*Table structure for table `manager` */

DROP TABLE IF EXISTS `manager`;

CREATE TABLE `manager` (
  `FIRST_NAME` varchar(50) DEFAULT NULL,
  `LAST_NAME` varchar(50) DEFAULT NULL,
  `LOCATION_ID` int(11) NOT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PHONE_NUMBER` varchar(11) DEFAULT NULL,
  UNIQUE KEY `PHONE_NUMBER` (`PHONE_NUMBER`),
  KEY `LOCATION_ID` (`LOCATION_ID`),
  CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`LOCATION_ID`) REFERENCES `location` (`LOCATION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `manager` */

insert  into `manager`(`FIRST_NAME`,`LAST_NAME`,`LOCATION_ID`,`EMAIL`,`PHONE_NUMBER`) values ('Prince Ly','Cesar',113,'PC@00','09124033805'),('Emman','Adventures',116,'emman@','09123346576'),('Bruce','Willis',113,'bruce@',NULL),('Regine','Santos',111,'regine@','09123456789');

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `PRODUCT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_CODE` varchar(20) NOT NULL,
  `NAME` varchar(50) DEFAULT NULL,
  `DESCRIPTION` varchar(250) NOT NULL,
  `QTY_STOCK` int(50) DEFAULT NULL,
  `ON_HAND` int(250) NOT NULL,
  `PRICE` int(50) DEFAULT NULL,
  `CATEGORY_ID` int(11) DEFAULT NULL,
  `SUPPLIER_ID` int(11) DEFAULT NULL,
  `DATE_STOCK_IN` varchar(50) NOT NULL,
  PRIMARY KEY (`PRODUCT_ID`),
  KEY `CATEGORY_ID` (`CATEGORY_ID`),
  KEY `SUPPLIER_ID` (`SUPPLIER_ID`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CATEGORY_ID`) REFERENCES `category` (`CATEGORY_ID`),
  CONSTRAINT `product_ibfk_2` FOREIGN KEY (`SUPPLIER_ID`) REFERENCES `supplier` (`SUPPLIER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `product` */

insert  into `product`(`PRODUCT_ID`,`PRODUCT_CODE`,`NAME`,`DESCRIPTION`,`QTY_STOCK`,`ON_HAND`,`PRICE`,`CATEGORY_ID`,`SUPPLIER_ID`,`DATE_STOCK_IN`) values (1,'201210549','Gatorade','Drinks',1,1,10,7,16,'2021-01-23'),(2,'201210550','Pills','Gamot',1,1,5,0,12,'2021-01-23'),(3,'201210551','Weigh Protein','Pampalakas',1,1,100,0,16,'2021-01-29');

/*Table structure for table `session_logs` */

DROP TABLE IF EXISTS `session_logs`;

CREATE TABLE `session_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) DEFAULT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `session_logs` */

insert  into `session_logs`(`id`,`cust_id`,`time_in`,`time_out`) values (1,1,'2021-01-23 19:09:00','2021-01-23 19:09:00'),(5,1,'2021-01-23 19:37:00','2021-01-23 19:37:00'),(6,1,'2021-01-23 19:38:00','2021-01-23 19:39:00'),(7,1,'2021-01-24 01:49:00','2021-01-24 01:50:00'),(8,1,'2021-01-24 01:50:00','2021-01-24 01:50:00');

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `SUPPLIER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMPANY_NAME` varchar(50) DEFAULT NULL,
  `LOCATION_ID` int(11) NOT NULL,
  `PHONE_NUMBER` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`SUPPLIER_ID`),
  KEY `LOCATION_ID` (`LOCATION_ID`),
  CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`LOCATION_ID`) REFERENCES `location` (`LOCATION_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `supplier` */

insert  into `supplier`(`SUPPLIER_ID`,`COMPANY_NAME`,`LOCATION_ID`,`PHONE_NUMBER`) values (11,'InGame Tech',114,'09457488521'),(12,'Asus',115,'09635877412'),(13,'Razer Co.',111,'09587855685'),(15,'Strategic Technology Co.',116,'09124033805'),(16,'A4tech',155,'09775673257');

/*Table structure for table `transaction` */

DROP TABLE IF EXISTS `transaction`;

CREATE TABLE `transaction` (
  `TRANS_ID` int(50) NOT NULL AUTO_INCREMENT,
  `CUST_ID` int(11) DEFAULT NULL,
  `NUMOFITEMS` varchar(250) NOT NULL,
  `SUBTOTAL` varchar(50) NOT NULL,
  `LESSVAT` varchar(50) NOT NULL,
  `NETVAT` varchar(50) NOT NULL,
  `ADDVAT` varchar(50) NOT NULL,
  `GRANDTOTAL` varchar(250) NOT NULL,
  `CASH` varchar(250) NOT NULL,
  `DATE` varchar(50) NOT NULL,
  `TRANS_D_ID` varchar(250) NOT NULL,
  PRIMARY KEY (`TRANS_ID`),
  KEY `TRANS_DETAIL_ID` (`TRANS_D_ID`),
  KEY `CUST_ID` (`CUST_ID`),
  CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`CUST_ID`) REFERENCES `customer` (`CUST_ID`),
  CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`TRANS_D_ID`) REFERENCES `transaction_details` (`TRANS_D_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaction` */

/*Table structure for table `transaction_details` */

DROP TABLE IF EXISTS `transaction_details`;

CREATE TABLE `transaction_details` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TRANS_D_ID` varchar(250) NOT NULL,
  `PRODUCTS` varchar(250) NOT NULL,
  `QTY` varchar(250) NOT NULL,
  `PRICE` varchar(250) NOT NULL,
  `EMPLOYEE` varchar(250) NOT NULL,
  `ROLE` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `TRANS_D_ID` (`TRANS_D_ID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaction_details` */

/*Table structure for table `type` */

DROP TABLE IF EXISTS `type`;

CREATE TABLE `type` (
  `TYPE_ID` int(11) NOT NULL,
  `TYPE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`TYPE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `type` */

insert  into `type`(`TYPE_ID`,`TYPE`) values (1,'Admin'),(2,'User');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMPLOYEE_ID` int(11) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  `TYPE_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `TYPE_ID` (`TYPE_ID`),
  KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`),
  CONSTRAINT `users_ibfk_3` FOREIGN KEY (`TYPE_ID`) REFERENCES `type` (`TYPE_ID`),
  CONSTRAINT `users_ibfk_4` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`ID`,`EMPLOYEE_ID`,`USERNAME`,`PASSWORD`,`TYPE_ID`) values (1,1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997',1),(7,2,'test','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',2),(9,4,'mncpdrnl','8cb2237d0679ca88db6464eac60da96345513964',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
