--
-- Database: `gemology_central_db`
--

-- --------------------------------------------------------

--
-- Table structure for Blog Post
--
CREATE TABLE IF NOT EXISTS `tbl_posts` (
  `postid` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(150) NOT NULL,
  `post_date` date NOT NULL,
  `post_author` varchar(100) NOT NULL,
  `post_tag` varchar(50) NOT NULL,
  `post_image` text NOT NULL,
  `post_body` varchar(20000) NOT NULL,
  `post_url` varchar(1000) NOT NULL,
  `post_topArticle` tinyint(1) NOT NULL,
  `post_published` tinyint(1) NOT NULL,
  `post_publish_date` datetime DEFAULT NULL,
  `post_modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`postid`)
) Engine InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for blog post metadata | SEO
--
CREATE TABLE IF NOT EXISTS `tbl_postMetaData` (
  `metid` int(11) NOT NULL AUTO_INCREMENT,
  `meta_keywords` varchar(1000) NOT NULL,
  `meta_description` varchar(2000) NOT NULL,
  `post_id` int(11),
  PRIMARY KEY (`metid`),
  CONSTRAINT FK_PostMetaData FOREIGN KEY (post_id)
  REFERENCES `tbl_posts`(`postid`)
  ON DELETE CASCADE
  ON UPDATE CASCADE
) Engine InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for Blog Post comments from enduser
--
CREATE TABLE IF NOT EXISTS `tbl_postComments` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `cmnt_author` varchar(50) NOT NULL,
  `cmnt_email` varchar(100) NOT NULL,
  `cmnt_date` datetime DEFAULT NULL,
  `cmnt_author_ip` varchar(50) NOT NULL,
  `cmnt_content` varchar(1000) NOT NULL,
  `cmnt_status` tinyint(1) DEFAULT 0 NOT NULL,
  `post_id` int(11),
  PRIMARY KEY (`commentid`),
  CONSTRAINT FK_PostComments FOREIGN KEY (post_id)
  REFERENCES `tbl_posts`(`postid`)
  ON DELETE CASCADE
  ON UPDATE CASCADE
) Engine InnoDB DEFAULT CHARSET=utf8;
