CREATE VIEW admin_all_reports
AS 
SELECT t2.reportid, CONCAT(t1.cus_firstname, " ", t1.cus_lastname) AS customer, t2.type, t2.weight, t2.color, t2.shapecut, t2.gemWidth, t2.reportStatus
FROM tbl_customer AS t1 
RIGHT JOIN tbl_lab_report AS t2 
ON t1.custid = t2.customerid
ORDER BY t2.reportid DESC;