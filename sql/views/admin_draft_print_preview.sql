CREATE VIEW admin_draft_print_preview
AS 
SELECT t2.reportid AS reportno, CONCAT(t1.firstname, " ", t1.lastname) AS customer, t1.number, t2.type AS repotype,
COALESCE(t4.amount, t5.amount, t6.amount) AS unit_price
FROM tbl_customer AS t1 
RIGHT JOIN tbl_lab_report AS t2 
ON t1.custid = t2.customerid
LEFT JOIN tbl_gem AS t3
ON t3.gemid = t2.gemid
LEFT JOIN tbl_gem_memocard AS t4
ON t4.reportid = t2.reportid
LEFT JOIN tbl_gemstone_report AS t5
ON t5.reportid = t2.reportid
LEFT JOIN tbl_gem_verbal AS t6
ON t6.reportid = t2.reportid
WHERE t2.status = FALSE;