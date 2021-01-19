DELIMITER //
DROP PROCEDURE IF EXISTS `findallcustomers` //
CREATE PROCEDURE findallcustomers()
BEGIN
SELECT * FROM customers;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS `findallcustomers` //
CREATE PROCEDURE findallcustomers()
BEGIN
SELECT * FROM customers WHERE customerNumber=175;
END//
DELIMITER ;

call findallcustomers();
