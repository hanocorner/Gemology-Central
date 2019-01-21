DELIMITER //
CREATE PROCEDURE authenticate_admin(
  IN user_name varchar(50),
  OUT admin_exists INT,
  OUT admin_id INT,
  OUT u_pass varchar(300)
  )

  BEGIN

    SELECT 1, adminid, password INTO @admin_exists, @admin_id, @u_pass FROM tbl_administrator WHERE username = user_name LIMIT 1;

    SET admin_exists = @admin_exists;
    SET admin_id = @admin_id;
    SET u_pass = @u_pass;

    SELECT admin_exists, admin_id, u_pass;

	END //
DELIMITER ;
