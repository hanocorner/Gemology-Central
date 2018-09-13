--
-- Database: `gemology_central_db`
--

-- --------------------------------------------------------

--
-- Table structure for `Gem Details`
--
CREATE TABLE IF NOT EXISTS `tbl_gem` (
  `gemid` int(11) NOT NULL AUTO_INCREMENT,
  `gem_name` varchar(30) NOT NULL,
  `gem_description` varchar(30) NOT NULL,
  PRIMARY KEY (`gemid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
