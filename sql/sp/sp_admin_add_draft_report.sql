DELIMITER //
CREATE PROCEDURE insert_draft_report(
  IN id varchar(20),
  IN customerid varchar(20),
  IN rtype varchar(5),
  IN gweight decimal(4,2),
  IN shapecut varchar(30),
  IN color varchar(30),
  IN qr_token varchar(20),
  IN rstatus varchar(15)
  )

  BEGIN
    DECLARE last_insert_id int;

    INSERT INTO tbl_lab_report(customerid, type, weight, shapecut, color, status, qrtoken) 
    VALUES(customerid, rtype, gweight, shapecut, color, rstatus, qr_token);
    SET last_insert_id = LAST_INSERT_ID();

    IF
      rtype = "memo"
    THEN
    	INSERT INTO tbl_gem_memocard(id, reportid) VALUES(id, last_insert_id);
    ELSEIF
      rtype = "repo"
    THEN
    	INSERT INTO tbl_gemstone_report(id, reportid) VALUES(id, last_insert_id);
    ELSEIF
      rtype = "verb"
    THEN
      INSERT INTO tbl_gem_verbal(id, reportid) VALUES(id, last_insert_id);
    END IF;

      INSERT INTO tbl_gem_image(reportid) VALUES(last_insert_id);
	END //
DELIMITER ;
