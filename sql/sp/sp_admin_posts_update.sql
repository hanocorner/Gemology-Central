DELIMITER //
CREATE PROCEDURE update_post(
  IN pid int(11),
  IN ptitle varchar(150),
  IN pauthor varchar(40),
  IN ptags varchar(20),
  IN pbody varchar(20000),
  IN purl varchar(200),
  IN pstatus tinyint(1),
  IN imgname varchar(20),
  IN imgpath varchar(10)
  )

  BEGIN
    UPDATE tbl_posts SET title = ptitle, author = pauthor, tags = ptags, body = pbody, url = purl, status = pstatus, modified_date = CURRENT_TIMESTAMP() WHERE id = pid;

    UPDATE tbl_gem_image SET gemstone = imgname, path = imgpath WHERE reportid = pid;

	END //
DELIMITER ;
