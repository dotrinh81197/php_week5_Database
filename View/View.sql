use classicmodels;

CREATE VIEW product_view AS 
SELECT productCode,productName,productDescription
FROM products;

SELECT * FROM product_view;

CREATE OR REPLACE VIEW product_view AS
SELECT productCode,productName,productVendor,buyPrice
FROM products
WHERE productScale ='1:10';
SELECT * FROM product_view;