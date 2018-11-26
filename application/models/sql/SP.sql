DELIMITER //
CREATE PROCEDURE insertReport(
  IN id  varchar(20),
  IN customerid varchar(20),
  IN gemid int(11),
  IN cdate date,
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
  IN qrcode text,
  IN amount decimal(8,2),
  IN pstatus tinyint(1),
  IN reportStatus tinyint(1)
  )

  BEGIN
    DECLARE last_insert_id int;

    INSERT INTO tbl_lab_report(customerid, gemid, createdDate, object, variety, type, weight, gemWidth, gemHeight, gemLength, spgroup, shapecut, color, comment, other, reportStatus) VALUES(
      customerid, gemid, cdate, object, variety, type, weight, gemWidth, gemHeight, gemLength, spgroup, shapecut, color, comment, other, reportStatus);
      SET last_insert_id = LAST_INSERT_ID();
    IF
      type = "memo"
    THEN
    	INSERT INTO tbl_gem_memocard(id, reportid, payment_status, amount) VALUES(id, last_insert_id, pstatus, amount);
    ELSEIF
      type = "repo"
    THEN
    	INSERT INTO tbl_gemstone_report(id, reportid, payment_status, amount) VALUES(id, last_insert_id, pstatus, amount);
    ELSEIF
      type = "verb"
    THEN
      INSERT INTO tbl_gem_verbal(id, reportid) VALUES(id, last_insert_id);
    END IF;
    INSERT INTO tbl_gem_image(reportid, gemstone, qrcode) VALUES(last_insert_id, imgname, qrcode);

	END //
DELIMITER ;
