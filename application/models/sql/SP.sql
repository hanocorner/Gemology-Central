DELIMITER //
CREATE PROCEDURE insertReport (memoid  VARCHAR(20),  reportid int(11), type VARCHAR(5) )
    BEGIN
    	DECLARE sub Varchar(10);

    IF     type = "memo" THEN
    	INSERT INTO tbl_gem_memocard(memoid, reportid, mem_created_date, mem_paymentStatus, mem_amount) VALUES('GCL-100001', 101, '', '', '');
    ELSEIF type = "repo" THEN
    	INSERT INTO tbl_gemstone_report(gsrid, reportid, gsr_created_date, gsr_paymentStatus, gsr_amount) VALUES('GCL201-110001', 102, '', '', '');
    END IF;
	END // 
DELIMITER ;