CREATE VIEW public_fetch_report
AS 
SELECT t1.qrtoken, t1.created_date, t1.object, t1.variety, t1.spgroup, t1.weight, CONCAT(t1.gemWidth, ' X ', t1.gemHeight, ' X ', t1.gemLength) AS dimensions,
t1.shapecut, t1.color, t1.comment, t2.gemstone, t3.id AS repoid, t4.id AS memoid 
FROM tbl_lab_report AS t1 
LEFT JOIN tbl_gem_image AS t2 
ON t1.reportid = t2.reportid
LEFT JOIN tbl_gemstone_report AS t3
ON t1.reportid = t3.reportid
LEFT JOIN tbl_gem_memocard AS t4
ON t1.reportid = t4.reportid;
