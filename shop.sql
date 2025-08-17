CREATE DATABASE IF NOT EXISTS shop;
USE shop;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    price DECIMAL(6,2)
);

INSERT INTO products (name, price) VALUES
('TSC Pottenstein Trikot', 49.99),
('TSC Pottenstein Schal', 14.99),
('TSC Pottenstein Mütze', 9.99);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer VARCHAR(100),
    items TEXT,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
