<?php
require_once 'login.php';
require_once 'header.php';
require_once 'menu.php';

$username = $user_rating = $bookId = $review='';
$bookId = $_GET['bookId'];
if (isset($_SESSION['user'])) $username = $_SESSION['user'];
    
if(isset($_POST['user_rating'], $_POST['review'])){
   $user_rating =  $_POST['user_rating'];
   $review = $_POST['review'];
}

$connection = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
if ($connection->connect_error) echo "Fatal Error".$connection->connect_error;
$query = "SELECT * FROM books WHERE bookId = $bookId";
$result = $connection->query($query);
if(!$result) die ('Alar');
echo "Var".var_dump($result);
$rows= $result->num_rows;
for ($j=0;$j<$rows;$j++){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $bookId = htmlspecialchars($row['bookId']);
    $authors = htmlspecialchars($row['authors']);
    $title = htmlspecialchars($row['title']);
    $description = htmlspecialchars($row['description']);
    $year = htmlspecialchars($row['year']);
    $category = htmlspecialchars($row['category']);
    $pictureURL = htmlspecialchars($row['pictureURL']);
    $price = htmlspecialchars($row['price']);
    $rating =  htmlspecialchars($row['rating']);

    echo <<<_END
    <div>
            Author(s) $authors
            Title $title
            Description $description
            Year $year
            Category $category
            PictureURL $pictureURL
            Price $price
     </div>
   _END;
}
?>
<button onclick  = "sendReview()">ADD review</button>
<div id = "review_form"></div>
<div id = "reviews">
<?PHP 
$query1 = "SELECT * FROM reviews WHERE bookId = '$bookId'";
$result = $connection->query($query1);
if(!$result) echo ('AlarSELECT');
else{
$rows= $result->num_rows;
echo "Rows_get".$rows;
for ($i =0;$i<5; $i++){
    if ($i<$rating){
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
?> <div>
<script type = "text/javascript" >
let queryString = window.location.search;
let urlParams = new URLSearchParams(queryString);
let bookId = urlParams.get('bookId').replaceAll("\'", "");
console.log("BookId", bookId)
        function sendReview(){
        $.post("review.php",{
        review:true,
        bookId:bookId
        },
        function(data){
            $('#review_form').html(data)
        })
    }
</script>
