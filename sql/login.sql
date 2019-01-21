--
-- Database: `gemology_central_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_administrator`
--

CREATE TABLE IF NOT EXISTS `tbl_administrator` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`admid`)
) Engine InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_administrator`
--

INSERT INTO `tbl_administrator` (`adm_username`, `adm_useremail`, `adm_userpassword`) VALUES
('admin', 'user@abc.com', 'admin');
COMMIT;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_administrator_log`
--

CREATE TABLE IF NOT EXISTS `tbl_administrator_log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_agent` varchar(60) NOT NULL,
  `ip_address` varchar(60) NOT NULL,
  `platform` varchar(60) NOT NULL,
  `user_modified` datetime DEFAULT CURRENT_TIMESTAMP,
  `admin_id` int(11),
  PRIMARY KEY (`logid`)
)Engine InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tbl_developer`
--

CREATE TABLE IF NOT EXISTS `tbl_developer` (
  `devid` int(11) NOT NULL AUTO_INCREMENT,
  `dev_username` varchar(30) NOT NULL,
  `dev_useremail` varchar(50) NOT NULL,
  `dev_userpassword` char(80) NOT NULL,
  PRIMARY KEY (`devid`)
)Engine InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_developer`
--

INSERT INTO `tbl_developer` (`dev_username`, `dev_useremail`, `dev_userpassword`) VALUES
('developer', 'developer@gmail.com', 'devops');
COMMIT;

--
-- Table structure for table `tbl_administrator_log`
--

CREATE TABLE IF NOT EXISTS `tbl_developer_log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `log_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `log_userBrowser` varchar(30) NOT NULL,
  `log_lastLogin` datetime DEFAULT CURRENT_TIMESTAMP,
  `devID` int(6),
  PRIMARY KEY (`logid`),
  CONSTRAINT FK_DeveloperLog FOREIGN KEY (devID)
  REFERENCES `tbl_developer`(`devid`)
  ON DELETE CASCADE
  ON UPDATE CASCADE
)Engine InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tbl_sessions`
--

CREATE TABLE IF NOT EXISTS `tbl_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`),
  PRIMARY KEY (`id`, `ip_address`)
);
