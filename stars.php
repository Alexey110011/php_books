<?php
require_once("header.php");
require_once('login.php');

$username = $user_rating = $bookId = $review='';
if (isset($_SESSION['user'])) $username = $_SESSION['user'];
        
if(isset($_POST['user_rating'],$_POST['bookId'], $_POST['review'])){
    $user_rating =  $_POST['user_rating'];
    $bookId = $_POST['bookId'];
    $review = $_POST['review'];
    echo "HOHO.".$username,$user_rating, $bookId, $review;

     $connection = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
    if ($connection->connect_error) {
    echo "Fatal Error".$connection->connect_error;
    }
    //Inserting new review into db
    $query_set_review = "INSERT INTO reviews (bookId, username, review, user_rating) VALUES ('$bookId', '$username', 
    '$review', '$user_rating')";
    $result_set_review = $connection->query($query_set_review);
    if(!$result_set_review) die ('AlarINSERT');
    else{
        //Retrieving all reviews for the book to calulate it's new rating
        $query_get_reviews = "SELECT * FROM reviews WHERE bookId = '$bookId'";
        $result_get_reviews = $connection->query($query_get_reviews);
        if(!$result_get_reviews) die ('AlarSELECT');
        else{
            $rows= $result_get_reviews->num_rows;
            echo "Rows".var_dump($rows);
            function sum($carry,$item){
                $carry += intval($item);
                return $carry;
            }
            $current_rating = array();

            while($row = $result_get_reviews->fetch_assoc()){
                $current_rating[] = $row['user_rating'];
            };
            $rating = array_reduce($current_rating, "sum",0);
            echo "Rating".$rating; 
            $new_rating = ($user_rating + $rating)/($rows + 1);
            $new_rating = round($new_rating);
            echo "New rating".$new_rating;
            //Updating rating in db
            $query_get = "UPDATE books SET rating = '$new_rating' WHERE bookId = '$bookId'";
            $result_get = $connection->query($query_get);
            if(!$result_get) echo "Somthing wrong setting";
            else{
            //Retrieving all reviews fron db to perform on page
                $query1 = "SELECT * FROM reviews WHERE bookId = '$bookId'";
                $result = $connection->query($query1);
                if(!$result) die ('AlarSELECT');
                $rows= $result->num_rows;
                echo "Rows_get".$rows;
                for ($i =0;$i<5; $i++){
                    if ($i<$new_rating){
                        echo <<<_STAR
                    <span style = "color:red">R rat</span>
                    _STAR;
                    } else {
                        echo <<<_STAR
                        <span style = color:black">R rat</span>
                        _STAR;
                    }
                }
                for ($j=0;$j<$rows;$j++){
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $username = htmlspecialchars($row['username']);
                    $review = htmlspecialchars($row['review']);
                    $user_rating = htmlspecialchars($row['user_rating']);
                    echo <<<_REVIEWS
                    <pre>
                    BookId $bookId
                    Username $username
                    Review $review
                    Rating $user_rating
                    </pre>
                    _REVIEWS;
                } 
            }
        }
    }   
} 
?>
 