CREATE VIEW admin_populate_edit
AS 
SELECT t2.reportid AS reportno, CONCAT(t1.firstname, " ", t1.lastname) AS customer, t2.object, t2.type, t2.weight, t2.color, t2.shapecut, t2.spgroup, t2.gemWidth, t2.gemHeight, t2.gemLength, t2.comment, t2.web_comment, t2.other, t2.gemid, t2.customerid, t3.name AS variety, COALESCE(t4.id, t5.id, t6.id) AS reportid,
COALESCE(t4.payment_status, t5.payment_status, t6.payment_status) AS payment, COALESCE(t4.amount, t5.amount, t6.amount) AS amount, t7.gemstone, t7.path
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
LEFT JOIN tbl_gem_image AS t7
ON t7.reportid = t2.reportid