--
-- Database: `gemology_central_db`
--

-- --------------------------------------------------------

--
-- Table structure for `Customer`
--
CREATE TABLE `tbl_customer` (
  `custid` varchar(11) NOT NULL,
  `cus_firstname` varchar(30) NOT NULL,
  `cus_lastname` varchar(30) NOT NULL,
  `cus_email` varchar(50) NOT NULL,
  `cus_number` varchar(30) NOT NULL,
  PRIMARY KEY (`custid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
