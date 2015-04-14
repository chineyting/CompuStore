-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2015 at 07:44 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `customertest`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `serial_num` varchar(50) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_brand` varchar(50) DEFAULT NULL,
  `product_model` varchar(50) DEFAULT NULL,
  `product_price` int(11) DEFAULT NULL,
  PRIMARY KEY (`serial_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`serial_num`, `product_name`, `product_brand`, `product_model`, `product_price`) VALUES
('ARBV2245EL554', 'Pavilion231 ', 'Carebook', 'Laptop', 230),
('BKLB2757HY292', 'LG4', 'PH', 'Laptop', 1000),
('BRAF3132CP478', 'Pavilion231 ', 'Bell', 'Laptop', 455),
('BTXD3873AY115', 'Wipro4', 'Bell', 'Laptop', 350),
('CFZR1535IH771', 'Touchsmart1 ', 'Carebook', 'Laptop', 800),
('EWOP9090KW101', 'Studio', 'Yons', 'Laptop', 250),
('EZSG5741SE249', 'Aspire S7', 'Orange', 'Laptop', 700),
('FQMP2336VJ252', 'Aspire Switch 11', 'PH', 'Laptop', 1000),
('FXMM8609LZ549', 'Inspiron 1764', 'Orange', 'Laptop', 700),
('GAWF2564OD307', 'Aspire Switch 11', 'Yons', 'Laptop', 600),
('GSSD5762CB573', 'Aspire E 11', 'PH', 'Laptop', 1030),
('IBUO3258DU520', 'Inspiron', 'Orange', 'Laptop', 250),
('IOTG7002WW766', 'LG4', 'Orange', 'Laptop', 900),
('KUFS6147JB767', 'Inspiron 1764', 'Orange', 'Laptop', 200),
('LDQD4793EK307', 'Aspire R 13', 'BookChrome', 'Laptop', 400),
('LQFS9915YB137', 'Touchsmart1 ', 'Bell', 'Laptop', 230),
('MUQU5009PI746', 'Apacer1', 'Orange', 'Laptop', 670),
('PAWD4809PU243', 'Wespro9', 'Yons', 'Laptop', 900),
('PDGK2528ZS821', 'Ace224', 'PH', 'Laptop', 600),
('PGKS1375VE891', 'Aspire Switch 11', 'PH', 'Laptop', 1000),
('PMVX4206BI768', 'Zing', 'Bell', 'Laptop', 500),
('PSUD7434QI395', 'Latitude ON', 'Bell', 'Laptop', 1000),
('PUXT3831PG138', 'Apple62', 'BookChrome', 'Laptop', 1030),
('QBZY4369TV928', 'ENVY73 ', 'Bell', 'Laptop', 300),
('QJAU3329UP427', 'Nuclear1', 'Bell', 'Laptop', 200),
('RCQJ8847UT307', 'Aspire R 14', 'Bell', 'Laptop', 800),
('RGXL5590GH353', 'Ace224', 'Yons', 'Laptop', 600),
('SEST7083MV336', 'Latitude', 'Orange', 'Laptop', 250),
('SXWX4452PP360', 'Aspire S7 Professional Edition', 'Yons', 'Laptop', 670),
('SYOH2923CG822', 'Aspire Switch 11', 'Yons', 'Laptop', 800),
('TIVI9876OA419', 'Rainbow1', 'BookChrome', 'Laptop', 500),
('TKRH5000PV252', 'Zing', 'Orange', 'Laptop', 400),
('TMTF2550AK542', 'Ace224', 'Carebook', 'Laptop', 200),
('TOOQ1743RV426', 'Aspire Switch 11', 'Yons', 'Laptop', 1000),
('TPZE2894YK946', 'Aspire Switch 12', 'Carebook', 'Laptop', 455),
('UEJO6149WD402', 'Aspire E 11', 'PH', 'Laptop', 400),
('UMGT3936IW805', 'XPS', 'BookChrome', 'Laptop', 200),
('UUFX6768LL808', 'Aspire V3', 'Yons', 'Laptop', 800),
('WQVP7526FS814', 'Latitude', 'Yons', 'Laptop', 1000),
('XFBD5664AH391', 'Ace224', 'Yons', 'Laptop', 890),
('XHHQ4768OG103', 'Aspire V Nitro', 'BookChrome', 'Laptop', 350),
('XRKO5782AI192', 'Latitude', 'Carebook', 'Laptop', 400),
('YAZU8230CP440', 'Inspiron 1764', 'Orange', 'Laptop', 400),
('YCUR6282TO413', 'Aspire R 13', 'Orange', 'Laptop', 1000),
('YVZU1811LH372', 'Studio', 'PH', 'Laptop', 400),
('ZGQV5617SJ159', 'Chromebook 15 C910', 'Carebook', 'Laptop', 200),
('ZJWA5995CF300', 'TCL1', 'Orange', 'Laptop', 350),
('ZJYK6556GM685', 'Aspire E 11', 'Bell', 'Laptop', 400),
('ZSVQ2195JZ632', 'Aspire E1', 'Carebook', 'Laptop', 700),
('ZWLK2270TG452', 'HCL20', 'Bell', 'Laptop', 500);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
