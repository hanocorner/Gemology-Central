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

CREATE UNIQUE INDEX idx_customer ON tbl_customer(custid, cus_firstname, cus_lastname);

CREATE UNIQUE INDEX idx_gem ON tbl_gem(gemid, gem_name);

CREATE INDEX idx_spgroup ON tbl_lab_report(spgroup);

CREATE INDEX idx_shapecut ON tbl_lab_report(shapecut);

CREATE INDEX idx_color ON tbl_lab_report(color);