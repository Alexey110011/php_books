<?php
require_once 'header.php';
require_once "login.php";

$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
echo "Current_page is".$_SESSION['current_page'];
 if (isset($_SESSION['user']))
 echo "SESSIONuser".$_SESSION['user'];
else {
    header('Location:llogin.php');
    exit;
}

$connection = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
if ($connection->connect_error) echo "Fatal Error".$connection->connect_error;

$authors = $title = $description = $year = $category  = $pictureURL = $price='';
/*function sanitizeString(){
    echo ("San");
};*/

/*if (isset($_POST['authors'])) $authors = sanitizeString($_POST['authors']);
if (isset($_POST['title'])) $title = sanitizeString($_POST['title']);
if (isset($_POST['description'])) $description = sanitizeString($_POST['description']);
if (isset($_POST['year'])) $year = sanitizeString($_POST['year']);
if (isset($_POST['category'])) $category = sanitizeString($_POST['category']);
if (isset($_POST['pictureURL'])) $pictureURL = sanitizeString($_POST['pictureURL']);
if (isset($_POST['price'])) $price = sanitizeString($_POST['price']);
if (isset($_POST['rating'])) $rating = sanitizeString($_POST['rating']);*/
if (isset($_POST['authors'])
    &&isset($_POST['title'])    
    &&isset($_POST['description'])
    &&isset($_POST['year'])
    &&isset($_POST['category'])
    &&isset($_POST['pictureURL'])
    &&isset($_POST['price']))
{ //$connection = new mysqli('localhost','alesh','Alexey110011','books');
$authors = get_post($connection, 'authors');
$title = get_post($connection, 'title');
$description = get_post($connection, 'description');
$year = get_post($connection, 'year');
$category = get_post($connection, 'category');
$pictureURL = get_post($connection, 'pictureURL');
$price = get_post($connection, 'price');
$query = "INSERT INTO books (authors,title,description,year,category,pictureURL,price) VALUES
('$authors','$title','$description','$year','$category','$pictureURL','$price')";
$result = $connection->query($query);
if(!$result) echo "Somthing wrong";
$connection->close();
}

function get_post($connection, $var){
    echo $connection->real_escape_string($_POST[$var]);
    return $connection->real_escape_string($_POST[$var]);
}

echo <<<_END
<html>
    <head>
        <title> adding form</title>
    </head>
    <body>
        <form method = "post" action = "add.php">
            Author(s) <input type = "text" name = "authors" maxlength = "100">
            Title <input type = "text" name = "title" maxlength = "75">
            Description <input type = "text" name = "description" maxlength = "500">
            Year <input type = "text" name = "year" maxlength = "4">
            Category<select name = "category" maxlength = "10">
                        <option value = "Frontend">Frontend</option>
                        <option value = "Backend">Backend</option>
                        <option value = "Fullstack">Fullstack</option>
                    </select>
            PictureURL<input type = "text" name = "pictureURL" maxlength = "150">
            Price <input type = "text" name = "price" maxlength = "7">
            <input type = "submit" value= "Submit" Submit">
        </form>
    </body>
</html>
_END;
