Product Management System
Overview
A simple CRUD system to manage products. Features include user registration, login, and image support for products.

Requirements
Web Server: Apache or Nginx
PHP: 7.4 or higher
MySQL: Database setup

1. Configure Database

	Update config/db.php with your database details.
	Import the provided SQL file to create the database and tables.

2. Create Uploads Directory


3. Access the App

	Registration: /views/register.php
	Register a new user by providing a username, email, and password.
	Login: /views/login.php
	Log in with your registered credentials.
	View Products: /views/products.php
	Add Product: /views/create_product.php
	Update Product: Click "Edit" next to a product.
	Delete Product: Click "Delete" next to a product.

4. User Authentication
	Registration: Users must register to manage products.
	Login: Registered users can log in to access the product management features.

5. File Uploads
	Types: JPG, JPEG, PNG, GIF
	Location: uploads directory