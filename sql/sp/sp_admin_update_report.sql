DELIMITER //
CREATE PROCEDURE update_report(
  IN report_id int(11),
  IN gemid int(11),
  IN type varchar(5),
  IN object varchar(100),
  IN variety varchar(100),
  IN weight decimal(4,2),
  IN gemWidth decimal(4,2),
  IN gemHeight decimal(4,2),
  IN gemLength decimal(4,2),
  IN spgroup varchar(100),
  IN shapecut varchar(30),
  IN color varchar(30),
  IN comment varchar(200),
  IN other varchar(200),
  IN imgname text,
  IN amount decimal(8,2),
  IN pstatus tinyint(1)
  )

  BEGIN

    UPDATE tbl_lab_report 
    SET gemid = gemid, object = object, variety = variety, weight = weight, gemWidth = gemWidth, gemHeight = gemHeight, gemLength = gemLength,
        spgroup = spgroup, shapecut = shapecut, color = color, comment = comment, other = other 
    WHERE reportid = report_id;

    IF
      type = "memo"
    THEN
    	UPDATE tbl_gem_memocard
        SET  payment_status = pstatus, amount = amount
        WHERE reportid = report_id;
    ELSEIF
      type = "repo"
    THEN
        UPDATE tbl_gemstone_report
        SET  payment_status = pstatus, amount = amount
        WHERE reportid = report_id;
    ELSEIF
      type = "verb"
    THEN
        UPDATE tbl_gem_report
        SET  payment_status = pstatus, amount = amount
        WHERE reportid = report_id;
    END IF;
        UPDATE tbl_gem_image
        SET  gemstone = imgname
        WHERE reportid = report_id;
	END //
DELIMITER ;
