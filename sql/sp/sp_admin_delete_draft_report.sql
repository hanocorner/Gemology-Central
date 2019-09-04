DELIMITER //
CREATE PROCEDURE delete_draft_report(
  IN id INT,
  IN rtype varchar(5)
  )

  BEGIN
    DELETE FROM tbl_lab_report
    WHERE reportid = id AND status = false;

    IF
      rtype = "memo"
    THEN
    	DELETE FROM tbl_gem_memocard WHERE reportid = id;
    ELSEIF
      rtype = "repo"
    THEN
        DELETE FROM tbl_gemstone_report WHERE reportid = id;
    ELSEIF
      rtype = "verb"
    THEN
        DELETE FROM tbl_gem_verbal WHERE reportid = id;
    END IF;

        DELETE FROM tbl_gem_image WHERE reportid = id;

	END //
DELIMITER ;
