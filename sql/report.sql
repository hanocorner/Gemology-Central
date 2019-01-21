--
-- Database: `gemology_central_db`
--

-- --------------------------------------------------------

--
-- Table structure for `Lab Report`
--
CREATE TABLE IF NOT EXISTS `tbl_lab_report` (
  `reportid` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` varchar(11) DEFAULT NULL,
  `gemid` int(11) DEFAULT NULL,
  `created_date` date NOT NULL,
  `object` varchar(100) NOT NULL,
  `variety` varchar(100) NOT NULL,
  `type` varchar(04) NOT NULL,
  `weight` decimal(4,2) NOT NULL,
  `gemWidth` decimal(4,2) NOT NULL,
  `gemHeight` decimal(4,2) NOT NULL,
  `gemLength` decimal(4,2) NOT NULL,
  `spgroup` varchar(100) NOT NULL,
  `shapecut` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `other` varchar(200) NOT NULL,
  PRIMARY KEY (`reportid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Let reportid starts with 100
--
ALTER TABLE tbl_lab_report AUTO_INCREMENT = 100;

--
-- Renaming all the column names
--
ALTER TABLE `tbl_lab_report` CHANGE `rep_customerid` `customerid` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `tbl_lab_report` CHANGE `rep_gemID` TO `gemid` int(11) NULL NOT NULL;
ALTER TABLE `tbl_lab_report` CHANGE `rep_object` `object` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `tbl_lab_report` CHANGE `rep_variety` `variety` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `tbl_lab_report` CHANGE `rep_type` `type` VARCHAR(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `tbl_lab_report` CHANGE `rep_weight` `weight` DECIMAL(4,2) NOT NULL;
ALTER TABLE `tbl_lab_report` CHANGE `rep_gemWidth` `gemWidth` DECIMAL(4,2) NOT NULL;
ALTER TABLE `tbl_lab_report` CHANGE `rep_gemHeight` `gemHeight` DECIMAL(4,2) NOT NULL;
ALTER TABLE tbl_lab_report CHANGE `rep_gemLength` TO `gemLength` decimal(4,2) NOT NULL;
ALTER TABLE `tbl_lab_report` CHANGE `rep_spgroup` `spgroup` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `tbl_lab_report` CHANGE `rep_shapecut` `shapecut` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE tbl_lab_report CHANGE `rep_color` TO `color` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci  NOT NULL;
ALTER TABLE tbl_lab_report CHANGE `rep_comment` TO `comment` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `tbl_lab_report` CHANGE `rep_other` `other` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `tbl_lab_report` ADD `created_date` DATE NOT NULL AFTER `gemid`;
ALTER TABLE `tbl_lab_report` ADD `reportStatus` tinyint(1) NOT NULL AFTER `other`;
ALTER TABLE `tbl_lab_report` ADD `qrtoken` varchar(20) NOT NULL AFTER `reportStatus`;
ALTER TABLE `tbl_lab_report` ADD `image_gem` text NOT NULL AFTER `qrtoken`;

-- Table structure for `Memo Card`
--
CREATE TABLE IF NOT EXISTS `tbl_gem_memocard` (
  `id`  varchar(20) NOT NULL,
  `reportid` int(11) DEFAULT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `amount` decimal(8,2) NOT NULL,
  PRIMARY KEY (`memoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for `Gemstone Report`
--
CREATE TABLE IF NOT EXISTS `tbl_gemstone_report` (
  `id` varchar(20) NOT NULL,
  `reportid` int(11) DEFAULT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `amount` decimal(8,2) NOT NULL,
  PRIMARY KEY (`gsrid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for `Verbal Gemstone Report`
--
CREATE TABLE IF NOT EXISTS `tbl_gem_verbal` (
  `verbid` varchar(20) NOT NULL,
  `reportid` int(11) DEFAULT NULL,
  PRIMARY KEY (`verbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for `Gemstone Image`
--
CREATE TABLE IF NOT EXISTS `tbl_gem_image` (
  `imgid` int(11) NOT NULL AUTO_INCREMENT,
  `reportid` int(11) DEFAULT NULL,
  `gemstone` text NOT NULL
  PRIMARY KEY (`imgid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
