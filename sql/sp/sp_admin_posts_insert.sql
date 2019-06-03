DELIMITER //
CREATE PROCEDURE insert_post(
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
    DECLARE postid int;

    INSERT INTO tbl_posts(title, author, tags, body, url, status) 
    VALUES(ptitle, pauthor, ptags, pbody, purl, pstatus);

    SET postid = LAST_INSERT_ID();

    INSERT INTO tbl_gem_image(reportid, gemstone, path) VALUES(postid, imgname, imgpath);

	END //
DELIMITER ;
