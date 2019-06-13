CREATE VIEW admin_populate_customer
AS 
SELECT custid, CONCAT(firstname, ' ', lastname) AS name, number, created_date 
FROM tbl_customer 
ORDER BY custid DESC;