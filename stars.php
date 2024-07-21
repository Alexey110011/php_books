<?php
require_once("header.php");
require_once('login.php');

$username = $user_rating = $bookId = $review='';
if (isset($_SESSION['user'])) $username = $_SESSION['user'];
    
if (isset($_POST['criteria'])) {$criteria = $_POST['criteria'];
    echo $criteria;}
    
if(isset($_POST['user_rating'],$_POST['bookId'], $_POST['review'])){
   $user_rating =  $_POST['user_rating'];
   $bookId = $_POST['bookId'];
   $review = $_POST['review'];
}

$connection = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
if ($connection->connect_error) echo "Fatal Error".$connection->connect_error;
$query_set_reviews = "INSERT INTO reviews (bookId, username, review, user_rating) VALUES ('$bookId', '$username', 
'$review', '$user_rating')";
$result_set_reviews = $connection->query($query_set_reviews);
if(!$result_set_reviews) die ('AlarINSERT');

$query_get_reviews = "SELECT user_rating FROM reviews WHERE bookId = '$bookId'";
$result_get_reviews = $connection->query($query_get_reviews);
if(!$result_get_reviews) die ('AlarSELECT');
$rows= $result_get_reviews->num_rows;
echo "Rows".var_dump($rows);
//if($rows==0){
    /*$query = "UPDATE books SET rating ='$user_rating' WHERE bookId = $bookId";
    $result = $connection->query($query);*/
    /*if(!$result) *//*echo "Somthing wrong 0";*/
/*} else {*/
    function sum($carry,$item){
        $carry += $item;
        return $carry;
    }
    $current_rating = array();

    /*$query0 = "SELECT rating FROM books WHERE bookId = $bookId";
    $result0 = $connection->query($query0);
    $rows = $result0->num_rows;*/
    while($row = $result_get_reviews->fetch_assoc()){
    $current_rating[] = $row['user_rating'];
    //echo "Current rating".$current_rating;
    };
    echo "Current".var_dump($current_rating);//if(!$current_rating) echo "Somthing wrong";
    $rating = array_reduce($current_rating, "sum",0);
    echo "Rating".$rating; 
    $new_rating =intval(($user_rating + $rating)/($rows + 1));
    echo "New rating".$new_rating;
    //$new_rating = (int)(($user_rating + $ratin)/2);
    $query_get = "UPDATE books SET rating = '$new_rating' WHERE bookId = '$bookId'";
    $result_get = $connection->query($query_get);
    if(!$result_get) echo "Somthing wrong setting";
    //}
 ?>
 
 <?php 
 for ($i =0;$i<5; $i++){
 if ($i<$user_rating){
     echo <<<_STAR
    <span style = "color:red">R rat</span>
    _STAR;
    } else {
     echo <<<_STAR
     <span style = color:black">R rat</span>
     _STAR;
    }
 }
 ?>
 