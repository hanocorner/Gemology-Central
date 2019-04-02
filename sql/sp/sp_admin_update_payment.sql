DELIMITER //
CREATE PROCEDURE update_payment(
  IN id int(11),
  IN rtype varchar(5),
  IN pstatus varchar(25),
  IN price decimal,
  IN padvance decimal
  )

  BEGIN
    IF pstatus = 'paid-full'
    THEN
    INSERT IGNORE INTO receipts(reportid) VALUES(id);
    END IF;

    IF
      rtype = "memo"
    THEN
    	UPDATE tbl_gem_memocard SET  payment_status = pstatus, amount = price, advance = padvance WHERE reportid = id;
    ELSEIF
      rtype = "repo"
    THEN
        UPDATE tbl_gemstone_report SET payment_status = pstatus, amount = price, advance = padvance WHERE reportid = id;

    ELSEIF
      rtype = "verb"
    THEN
        UPDATE tbl_gem_verbal SET payment_status = pstatus, amount = price, advance = padvance WHERE reportid = id;
    END IF;

	END //
DELIMITER ;
