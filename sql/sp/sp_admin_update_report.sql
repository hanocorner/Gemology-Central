DELIMITER //
CREATE PROCEDURE update_report(
  IN reportno int(11),
  IN gemid int(11),
  IN type varchar(5),
  IN object varchar(100),
  IN weight decimal(4,2),
  IN width decimal(4,2),
  IN height decimal(4,2),
  IN length decimal(4,2),
  IN spgroup varchar(100),
  IN shapecut varchar(30),
  IN color varchar(30),
  IN comment varchar(200),
  IN webcomment varchar(400),
  IN other varchar(200),
  IN imgname varchar(20),
  IN imgpath varchar(10),
  IN price decimal,
  IN pstatus varchar(25)
  )

  BEGIN

    UPDATE tbl_lab_report 
    SET gemid = gemid, object = object, variety = variety, weight = weight, gemWidth = width, gemHeight = height, gemLength = length,
        spgroup = spgroup, shapecut = shapecut, color = color, status = TRUE, comment = comment, web_comment = webcomment, other = other 
    WHERE reportid = reportno;

    IF
      type = "memo"
    THEN
    	UPDATE tbl_gem_memocard
        SET  payment_status = pstatus, amount = price
        WHERE reportid = reportno;
    ELSEIF
      type = "repo"
    THEN
        UPDATE tbl_gemstone_report
        SET  payment_status = pstatus, amount = price
        WHERE reportid = reportno;
    ELSEIF
      type = "verb"
    THEN
        UPDATE tbl_gem_verbal
        SET  payment_status = pstatus, amount = price
        WHERE reportid = reportno;
    END IF;
        UPDATE tbl_gem_image
        SET  gemstone = imgname, path = imgpath
        WHERE reportid = reportno;
	END //
DELIMITER ;
