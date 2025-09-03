💼 Auth-App (User Authentication System)
========================================

A simple yet powerful User Authentication System built with PHP, MySQL, and XAMPP.  
It allows users to register, log in, and manage sessions securely.  

----------------------------------------
🌐 Live Usage (Localhost)
----------------------------------------
After setup, open in your browser:
http://localhost/auth-app/register.php

----------------------------------------
✨ Features
----------------------------------------
🔐 User registration with hashed passwords  
🔑 User login & logout functionality  
🛡️ Session-based authentication  
🗄️ MySQL database integration  
⚡ Built for learning + fast development  

----------------------------------------
🚀 Technologies Used
----------------------------------------
- PHP 8.x
- MySQL (MariaDB)
- XAMPP (Apache + MariaDB + PHP)

----------------------------------------
🛠️ Setup Guide
----------------------------------------
1. Install XAMPP from: https://www.apachefriends.org/  
2. Place this project inside the htdocs folder, e.g.
   D:/xampp/htdocs/auth-app/
3. Start Apache & MySQL from the XAMPP Control Panel.  
4. Create a database named auth_demo in phpMyAdmin and run this SQL:

   CREATE TABLE IF NOT EXISTS users (
     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(80) NOT NULL,
     email VARCHAR(120) NOT NULL UNIQUE,
     password_hash VARCHAR(255) NOT NULL,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

5. Open in your browser:
   http://localhost/auth-app/register.php

----------------------------------------
📂 Folder Structure
----------------------------------------
auth-app/
│── db.php          (Database connection & session handler)
│── register.php    (User registration page)
│── login.php       (User login page)
│── logout.php      (User logout page)
│── README.txt

----------------------------------------
📝 Procedure (How Auth-App Works)
----------------------------------------

1. Open the project in your browser:
   http://localhost/auth-app/

2. Register a new account:
   - Go to register.php
   - Enter your name, email, and password
   - Data is saved into the MySQL database with a hashed password

3. Login:
   - Go to login.php
   - Enter your registered email and password
   - If credentials are correct, a session starts and you are logged in

4. Access protected pages:
   - After login, you can visit restricted pages that check if a session exists
   - If not logged in, you will be redirected back to login.php

5. Logout:
   - Go to logout.php
   - Session is destroyed and you are logged out safely
   - Redirected back to the login page

----------------------------------------
⚙️ Behind the Scenes
----------------------------------------
- db.php connects the app to MySQL and manages sessions
- register.php handles new user creation
- login.php verifies user credentials against the database
- logout.php clears the session and ends the login
- Passwords are never stored as plain text (only secure hashes)
----------------------------------------
📬 Contact
----------------------------------------
👨‍💻 Author: Mesum Mukhtar  
🐱 GitHub: https://github.com/codewithMeesum  

📧 Email: mesummukhtar3@gmail.com  
----------------------------------------
