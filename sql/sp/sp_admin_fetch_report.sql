DELIMITER //
CREATE PROCEDURE fetch_edit(
  IN id INT,
  IN type varchar(5)
  )

    BEGIN
        IF
            type = "memo"
        THEN
            SELECT t1.*, CONCAT(t2.cus_firstname, ' ', t2.cus_lastname) AS customer, t3.id, t3.payment_status, t3.amount, t4.gemstone
            FROM tbl_lab_report AS t1
            LEFT JOIN tbl_customer AS t2 ON t1.customerid = t2.custid
            LEFT JOIN tbl_gem_memocard AS t3 ON t1.reportid = t3.reportid
            LEFT JOIN tbl_gem_image AS t4 ON t1.reportid = t4.reportid
            WHERE t1.reportid = id;
        ELSEIF
            type = "repo"
        THEN
            SELECT t1.*, CONCAT(t2.cus_firstname, ' ', t2.cus_lastname) AS customer, t3.id, t3.payment_status, t3.amount, t4.gemstone
            FROM tbl_lab_report AS t1
            LEFT JOIN tbl_customer AS t2 ON t1.customerid = t2.custid
            LEFT JOIN tbl_gemstone_report AS t3 ON t1.reportid = t3.reportid
            LEFT JOIN tbl_gem_image AS t4 ON t1.reportid = t4.reportid
            WHERE t1.reportid = id;
        ELSEIF
            type = "verb"
        THEN
            SELECT t1.*, CONCAT(t2.cus_firstname, ' ', t2.cus_lastname) AS customer, t3.id, t3.payment_status, t3.amount, t4.gemstone
            FROM tbl_lab_report AS t1
            LEFT JOIN tbl_customer AS t2 ON t1.customerid = t2.custid
            LEFT JOIN tbl_gem_verbal AS t3 ON t1.reportid = t3.reportid
            LEFT JOIN tbl_gem_image AS t4 ON t1.reportid = t4.reportid
            WHERE t1.reportid = id;
        END IF;

    END //
DELIMITER ;
