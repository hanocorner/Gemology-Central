DELIMITER //
CREATE PROCEDURE insert_report(
  IN id  varchar(20),
  IN customerid varchar(20),
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
  IN qr_token varchar(20),
  IN price decimal,
  IN pstatus varchar(25),
  IN rstatus varchar(25)
  )

  BEGIN
    DECLARE last_insert_id int;

    INSERT INTO tbl_lab_report(customerid, gemid, object, variety, type, weight, gemWidth, gemHeight, gemLength, spgroup, shapecut, color, comment, web_comment, other, status, qrtoken) 
    VALUES(customerid, gemid, object, variety, type, weight, width, height, length, spgroup, shapecut, color, comment, webcomment, other, rstatus, qr_token);
    SET last_insert_id = LAST_INSERT_ID();

    IF
      type = "memo"
    THEN
    	INSERT INTO tbl_gem_memocard(id, reportid, payment_status, amount) VALUES(id, last_insert_id, pstatus, price);
    ELSEIF
      type = "repo"
    THEN
    	INSERT INTO tbl_gemstone_report(id, reportid, payment_status, amount) VALUES(id, last_insert_id, pstatus, price);
    ELSEIF
      type = "verb"
    THEN
      INSERT INTO tbl_gem_verbal(id, reportid, payment_status, amount) VALUES(id, last_insert_id, pstatus, price);
    END IF;
      INSERT INTO tbl_gem_image(reportid, gemstone, path) VALUES(last_insert_id, imgname, imgpath);
	END //
DELIMITER ;
