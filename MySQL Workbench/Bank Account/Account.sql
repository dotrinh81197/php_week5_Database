-- MySQL Script generated by MySQL Workbench
-- Fri Jan  8 09:17:09 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema vehicle_management
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema vehicle_management
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `vehicle_management` DEFAULT CHARACTER SET utf8mb4 ;
-- -----------------------------------------------------
-- Schema customersaccount
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema customersaccount
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `customersaccount` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `vehicle_management` ;

-- -----------------------------------------------------
-- Table `vehicle_management`.`offices`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vehicle_management`.`offices` ;

CREATE TABLE IF NOT EXISTS `vehicle_management`.`offices` (
  `officeCode` VARCHAR(10) NOT NULL,
  `city` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `addressLine1` VARCHAR(50) NOT NULL,
  `addressLine2` VARCHAR(50) NULL DEFAULT NULL,
  `state` VARCHAR(45) NULL DEFAULT NULL,
  `country` VARCHAR(45) NOT NULL,
  `postalCode` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`officeCode`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `vehicle_management`.`employees`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vehicle_management`.`employees` ;

CREATE TABLE IF NOT EXISTS `vehicle_management`.`employees` (
  `employeeNumber` INT(11) NOT NULL,
  `lastName` VARCHAR(50) NOT NULL,
  `firstName` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `jobTitle` VARCHAR(50) NOT NULL,
  `offices_officeCode` VARCHAR(10) NOT NULL,
  `employees_employeeNumber` INT(11) NOT NULL,
  PRIMARY KEY (`employeeNumber`, `employees_employeeNumber`),
  INDEX `fk_employees_offices` (`offices_officeCode` ASC) VISIBLE,
  INDEX `fk_employees_employees1` (`employees_employeeNumber` ASC) VISIBLE,
  CONSTRAINT `fk_employees_employees1`
    FOREIGN KEY (`employees_employeeNumber`)
    REFERENCES `vehicle_management`.`employees` (`employeeNumber`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_employees_offices`
    FOREIGN KEY (`offices_officeCode`)
    REFERENCES `vehicle_management`.`offices` (`officeCode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `vehicle_management`.`customers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vehicle_management`.`customers` ;

CREATE TABLE IF NOT EXISTS `vehicle_management`.`customers` (
  `customernumber` INT(11) NOT NULL,
  `customerName` VARCHAR(50) NOT NULL,
  `contactLastName` VARCHAR(50) NOT NULL,
  `contactFirstName` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  `addressLine1` VARCHAR(50) NOT NULL,
  `addressLine2` VARCHAR(50) NULL DEFAULT NULL,
  `city` VARCHAR(50) NOT NULL,
  `state` VARCHAR(15) NOT NULL,
  `postalCode` VARCHAR(15) NOT NULL,
  `country` VARCHAR(50) NOT NULL,
  `creditLimit` FLOAT NULL DEFAULT NULL,
  `employees_employeeNumber` INT(11) NOT NULL,
  PRIMARY KEY (`customernumber`, `employees_employeeNumber`),
  INDEX `fk_customers_employees1` (`employees_employeeNumber` ASC) VISIBLE,
  CONSTRAINT `fk_customers_employees1`
    FOREIGN KEY (`employees_employeeNumber`)
    REFERENCES `vehicle_management`.`employees` (`employeeNumber`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `vehicle_management`.`orders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vehicle_management`.`orders` ;

CREATE TABLE IF NOT EXISTS `vehicle_management`.`orders` (
  `orderNumber` INT(11) NOT NULL,
  `orderDate` DATE NOT NULL,
  `requiredDate` DATE NOT NULL,
  `shippedDate` DATE NULL DEFAULT NULL,
  `status` VARCHAR(15) NOT NULL,
  `comments` TEXT NULL DEFAULT NULL,
  `orderscol` VARCHAR(45) NULL DEFAULT NULL,
  `quantityOrdered` INT(11) NOT NULL,
  `priceEach` FLOAT NOT NULL,
  `customers_customernumber` INT(11) NOT NULL,
  PRIMARY KEY (`orderNumber`, `customers_customernumber`),
  INDEX `fk_orders_customers1` (`customers_customernumber` ASC) VISIBLE,
  CONSTRAINT `fk_orders_customers1`
    FOREIGN KEY (`customers_customernumber`)
    REFERENCES `vehicle_management`.`customers` (`customernumber`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `vehicle_management`.`productlines`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vehicle_management`.`productlines` ;

CREATE TABLE IF NOT EXISTS `vehicle_management`.`productlines` (
  `productLine` VARCHAR(50) NOT NULL,
  `textDescription` TEXT NULL DEFAULT NULL,
  `image` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`productLine`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `vehicle_management`.`products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vehicle_management`.`products` ;

CREATE TABLE IF NOT EXISTS `vehicle_management`.`products` (
  `productCode` VARCHAR(15) NOT NULL,
  `productName` VARCHAR(70) NOT NULL,
  `productScale` VARCHAR(10) NOT NULL,
  `productVendor` VARCHAR(50) NOT NULL,
  `productDescription` TEXT NOT NULL,
  `quantityInStock` INT(11) NOT NULL,
  `buyPrice` FLOAT NOT NULL,
  `MSRP` FLOAT NOT NULL,
  `productlines_productLine` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`productCode`, `productlines_productLine`),
  INDEX `fk_products_productlines1` (`productlines_productLine` ASC) VISIBLE,
  CONSTRAINT `fk_products_productlines1`
    FOREIGN KEY (`productlines_productLine`)
    REFERENCES `vehicle_management`.`productlines` (`productLine`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `vehicle_management`.`orders_has_products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vehicle_management`.`orders_has_products` ;

CREATE TABLE IF NOT EXISTS `vehicle_management`.`orders_has_products` (
  `orders_orderNumber` INT(11) NOT NULL,
  `orders_customers_customernumber` INT(11) NOT NULL,
  `products_productCode` VARCHAR(15) NOT NULL,
  `products_productlines_productLine` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`orders_orderNumber`, `orders_customers_customernumber`, `products_productCode`, `products_productlines_productLine`),
  INDEX `fk_orders_has_products_products1` (`products_productCode` ASC, `products_productlines_productLine` ASC) VISIBLE,
  CONSTRAINT `fk_orders_has_products_orders1`
    FOREIGN KEY (`orders_orderNumber` , `orders_customers_customernumber`)
    REFERENCES `vehicle_management`.`orders` (`orderNumber` , `customers_customernumber`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_has_products_products1`
    FOREIGN KEY (`products_productCode` , `products_productlines_productLine`)
    REFERENCES `vehicle_management`.`products` (`productCode` , `productlines_productLine`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `vehicle_management`.`payments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vehicle_management`.`payments` ;

CREATE TABLE IF NOT EXISTS `vehicle_management`.`payments` (
  `customerNumber` INT(11) NOT NULL,
  `checkNumber` VARCHAR(50) NOT NULL,
  `paymentDate` DATETIME NULL DEFAULT NULL,
  `amount` FLOAT NOT NULL,
  `customers_customernumber` INT(11) NOT NULL,
  PRIMARY KEY (`customerNumber`, `customers_customernumber`),
  INDEX `fk_payments_customers1` (`customers_customernumber` ASC) VISIBLE,
  CONSTRAINT `fk_payments_customers1`
    FOREIGN KEY (`customers_customernumber`)
    REFERENCES `vehicle_management`.`customers` (`customernumber`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

USE `customersaccount` ;

-- -----------------------------------------------------
-- Table `customersaccount`.`customers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `customersaccount`.`customers` ;

CREATE TABLE IF NOT EXISTS `customersaccount`.`customers` (
  `customer_number` INT(11) NOT NULL,
  `fullname` VARCHAR(45) NOT NULL,
  `address` VARCHAR(15) NOT NULL,
  `Customerscol` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`customer_number`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `customersaccount`.`accounts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `customersaccount`.`accounts` ;

CREATE TABLE IF NOT EXISTS `customersaccount`.`accounts` (
  `account_number` INT(11) NOT NULL,
  `account_type` VARCHAR(45) NOT NULL,
  `date` DATETIME NOT NULL,
  `balance` FLOAT NOT NULL,
  `customers_customer_number` INT(11) NOT NULL,
  PRIMARY KEY (`account_number`, `customers_customer_number`),
  INDEX `fk_accounts_customers_idx` (`customers_customer_number` ASC) VISIBLE,
  CONSTRAINT `fk_accounts_customers`
    FOREIGN KEY (`customers_customer_number`)
    REFERENCES `customersaccount`.`customers` (`customer_number`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `customersaccount`.`transactions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `customersaccount`.`transactions` ;

CREATE TABLE IF NOT EXISTS `customersaccount`.`transactions` (
  `tran_number` INT(11) NOT NULL,
  `account_number` VARCHAR(45) NOT NULL,
  `date` VARCHAR(45) NOT NULL,
  `transactionscol` DATETIME NOT NULL,
  `amounts` FLOAT NOT NULL,
  `descriptions` VARCHAR(45) NOT NULL,
  `accounts_account_number` INT(11) NOT NULL,
  `accounts_customers_customer_number` INT(11) NOT NULL,
  PRIMARY KEY (`tran_number`, `accounts_account_number`, `accounts_customers_customer_number`),
  INDEX `fk_transactions_accounts1_idx` (`accounts_account_number` ASC, `accounts_customers_customer_number` ASC) VISIBLE,
  CONSTRAINT `fk_transactions_accounts1`
    FOREIGN KEY (`accounts_account_number` , `accounts_customers_customer_number`)
    REFERENCES `customersaccount`.`accounts` (`account_number` , `customers_customer_number`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;