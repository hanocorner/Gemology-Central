CREATE VIEW receipt_data
AS 
SELECT t1.reportid, COALESCE(t2.amount, t3.amount, t4.amount) AS unit_price
FROM receipts AS t1 
LEFT JOIN tbl_gem_verbal AS t2 
ON t1.reportid = t2.reportid
LEFT JOIN tbl_gemstone_report AS t3
ON t1.reportid = t3.reportid
LEFT JOIN tbl_gem_memocard AS t4
ON t1.reportid = t4.reportid;
