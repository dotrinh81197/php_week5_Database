use classicmodels;

drop procedure getCusById;
DELIMITER //

CREATE PROCEDURE getCusById

(IN cusNum INT(11))

BEGIN

  SELECT * FROM customers WHERE customerNumber = cusNum;

END //

DELIMITER ;

call getCusById(175);

DELIMITER //

CREATE PROCEDURE GetCustomersCountByCity(

    IN  in_city VARCHAR(50),

    OUT total INT

)

BEGIN

    SELECT COUNT(customerNumber)

    INTO total

    FROM customers

    WHERE city = in_city;

END//

DELIMITER ;

call GetCustomersCountByCity('Lyon', @total);
SELECT @total;

INOUT là sự kết hợp giữa IN và OUT, ví dụ:

DELIMITER //

CREATE PROCEDURE SetCounter(

    INOUT counter INT,

    IN inc INT

)

BEGIN

    SET counter = counter + inc;

END//

DELIMITER ;


DROP PROCEDURE IF EXISTS `SetCounter`//
DELIMITER //
CREATE PROCEDURE SetCounter(
   INOUT counter INT,

    IN inc INT
)
BEGIN

    SET counter = counter + inc;

END//

DELIMITER ;

set @counter = 1 ;
call SetCounter(@counter,1);
call SetCounter(@counter,1);
call SetCounter(@counter,5);
select	@counter;