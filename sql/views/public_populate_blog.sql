CREATE VIEW public_populate_blog
AS 
SELECT t1.title, t1.author, t1.tags, t1.body, t1.url, t1.location, t1.status, DATE_FORMAT(t1.published_date, "%M %e, %Y") as newdate, t2.gemstone, t2.path
FROM tbl_posts AS t1 
LEFT JOIN tbl_gem_image AS t2 
ON t1.id = t2.reportid
WHERE t1.status = TRUE
ORDER BY t1.published_date DESC;