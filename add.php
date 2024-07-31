<?php
require_once 'header.php';
require_once 'menu.php';

$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
echo "Current_page is".$_SESSION['current_page'];
 if (!isset($_SESSION['user']))
    {
        header('Location:llogin.php');
        exit;
    }

$connection = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
if ($connection->connect_error) echo "Fatal Error".$connection->connect_error;

$authors = $title = $description = $year = $category  = $pictureURL = $price='';

if (isset($_POST['authors'])
    &&isset($_POST['title'])    
    &&isset($_POST['description'])
    &&isset($_POST['year'])
    &&isset($_POST['category'])
    &&isset($_POST['pictureURL'])
    &&isset($_POST['price']))
{
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
header("Location:index.php");
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
    <div class = "form_wrapper">
        <form method = "post" action = "add.php">
            <div class = "form_group">
                <label>Author(s)</label>
                <input type = "text" name = "authors" maxlength = "100">
            </div>
            <div class = "form_group">
                <label>Title </label>
                <input type = "text" name = "title" maxlength = "75">
            </div>
            <div class = "form_group">
                <label>Description</label>
                <input type = "text" name = "description" maxlength = "500">
            </div>
            <div class = "form_group">
                <label>Year</label>
                <input type = "text" name = "year" maxlength = "4">
            </div>
            <div class = "form_group">
                <label>Category</label>
                <select style = "width:153px" name = "category" maxlength = "10">
                    <option value = "Frontend">Frontend</option>
                    <option value = "Backend">Backend</option>
                    <option value = "Fullstack">Fullstack</option>
                </select>
            </div>
            <div class = "form_group">
                <label>PictureURL</label>
                <input type = "text" name = "pictureURL" maxlength = "150">
            </div>
            <div class = "form_group">
                <label>Price</label>
                <input type = "text" name = "price" maxlength = "7">
            </div>
            <input type = "submit"  class = "btn btn-primary submit_btn" value= "Submit" Submit">
        </form>
    </div
    </body>
</html>
_END;
?>