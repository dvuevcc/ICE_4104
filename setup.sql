-- Create the database
CREATE DATABASE IF NOT EXISTS crud_system;
USE crud_system;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Create the products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert dummy data into users
INSERT INTO users (username, email, password) VALUES
('admin', 'admin@example.com', '$2y$10$eImKkI/7Oo3vLs.x1zHq5OKJrDpIejRDAj2VZzt29Yp0x5i4OKdHq'), -- password: admin123
('user1', 'user1@example.com', '$2y$10$8BII6s8G8p/a2Fk1e5OQEu5wZT4FS4g/QYrhFnd8vfgX/7k2KbYyK');  -- password: user123

-- Insert dummy data into products
INSERT INTO products (name, price, description, image) VALUES
('Laptop', 1200.00, 'A high-performance laptop with 16GB RAM and 512GB SSD.', 'uploads/laptop.jpg'),
('Smartphone', 800.00, 'A latest model smartphone with excellent camera quality.', 'uploads/smartphone.jpg'),
('Headphones', 150.00, 'Noise-cancelling over-ear headphones with high sound quality.', 'uploads/headphones.jpg');
