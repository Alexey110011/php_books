<?php
require_once "header.php";
require_once 'db.php';
if(isset($_POST['user_rating']))
$username = $user_rating = $bookId = $review='';

if (isset($_SESSION['user'])) $username = $_SESSION['user'];
        
if(isset($_POST['user_rating'],$_POST['bookId'], $_POST['review'])){
    $user_rating =  sanitizeString($_POST['user_rating']);
    $bookId = sanitizeString($_POST['bookId']);
    $review = sanitizeString($_POST['review']);
    
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
            function sum($carry,$item){
                $carry += intval($item);
                return $carry;
            }

            $current_rating = array();
            while($row = $result_get_reviews->fetch_assoc()){
                $current_rating[] = $row['user_rating'];
            };
            $all_ratings = array_reduce($current_rating, "sum",0);
            $rating = $all_ratings/$rows;
            $rating = round($rating);
            
                //Updating rating in db
            $query_get = "UPDATE books SET rating = '$rating' WHERE bookId = '$bookId'";
            $result_get = $connection->query($query_get);
            if(!$result_get) echo "Somthing wrong setting";
            else{
            //Retrieving all reviews from db to perform on page
                echo '<div>';
                     include 'list.php';
                echo'</div>'
                ?>
                <script>
                    function getRating(){
                        let rating = <?php echo $rating;?>;
                        //console.log(rating)
                        $.post('rating.php',
                        {rating:rating},
                        function(data){
                            $('#rating').html(data)
                        })
                    }
                    getRating()
                </script>
                <?php
            }
        }
    }   
} 
?>
 