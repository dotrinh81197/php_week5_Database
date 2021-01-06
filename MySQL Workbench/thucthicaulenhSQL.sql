use classicmodels;
SELECT * FROM customers;
SELECT customerNumber, customerName, phone, country FROM customers;
SELECT * FROM customers WHERE customerName = 'Atelier Graphique';
SELECT * FROM customers WHERE city in ('Nantes',' Las Vegas',' Warszawa','NYC');