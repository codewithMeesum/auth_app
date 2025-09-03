PHP Authentication App
=======================

A simple user authentication system built with PHP, MySQL (MariaDB), and XAMPP.
It allows users to register, log in, and manage sessions securely.

Features:
- User registration with hashed passwords
- User login & logout
- Session management
- MySQL database integration

Requirements:
- XAMPP (Apache + MariaDB + PHP)
- PHP 8.x
- Web browser

Setup:
1. Install XAMPP from https://www.apachefriends.org/
2. Place this project inside the htdocs folder, e.g.
   D:/xampp/htdocs/auth-app/
3. Start Apache & MySQL from the XAMPP control panel.
4. Create a database named "auth_demo" in phpMyAdmin and run the users table SQL:

   CREATE TABLE IF NOT EXISTS users (
     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(80) NOT NULL,
     email VARCHAR(120) NOT NULL UNIQUE,
     password_hash VARCHAR(255) NOT NULL,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

5. Visit in your browser:
   http://localhost/auth-app/register.php

Folder Structure:
auth-app/
│── db.php          (Database connection & session)
│── register.php    (User registration)
│── login.php       (User login)
│── logout.php      (User logout)
│── README.txt

License:
Free to use for learning and development.
