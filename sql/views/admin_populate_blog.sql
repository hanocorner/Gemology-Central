CREATE VIEW admin_populate_blog
AS 
SELECT t1.id, t1.title, t1.author, t1.status, DATE_FORMAT(t1.published_date, "%M %e, %Y") as published_date, DATE_FORMAT(t1.modified_date, "%M %e, %Y") as modified_date
FROM tbl_posts AS t1 
LEFT JOIN tbl_gem_image AS t2 
ON t1.id = t2.reportid
ORDER BY t1.id DESC;