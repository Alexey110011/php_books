<?php
require_once "functions.php";
require_once "login.php";

createTable('users',
'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(20),
 hash VARCHAR(70)'
);

createTable('books',
'bookId INT AUTO_INCREMENT PRIMARY KEY,
 authors VARCHAR(100),
 title VARCHAR(100), 
 description VARCHAR(500),
 year CHAR(4),
 category VARCHAR(9),
 pictureURL VARCHAR(60),
 price  VARCHAR(10)');

createTable('reviews',
'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 bookId VARCHAR(16),
 username VARCHAR(20), 
 review VARCHAR(500),
 user_rating CHAR (1)'
);

echo "Good!"
?>