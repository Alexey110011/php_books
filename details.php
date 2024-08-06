<?php
require_once 'header.php';
require_once 'menu.php';
//Check if user logged to allow him to make reviews

$isUser = '';
if (isset($_SESSION['user'])) $isUser = $_SESSION['user']; 

//Storing current page for returning to it
$_SESSION['current_page']= $_SERVER['REQUEST_URI'];

$username = $user_rating = $bookId = $review='';
$bookId = $_GET['bookId'];
$_SESSION['bookId'] = $bookId;

if(isset($_SESSION['user'])) $username = $_SESSION['user'];
if(isset($_POST['user_rating'], $_POST['review'])){
   $user_rating =  $_POST['user_rating'];
   $review = $_POST['review'];
}
?>

<script  type = "text/javascript">
    let isUser= '<?php echo $isUser?>'
    console.log(isUser)
    let queryString = window.location.search;
    let urlParams = new URLSearchParams(queryString);
    let bookId = urlParams.get('bookId').replaceAll("\'", "");
    let title = urlParams.get('title').replaceAll("\'", "");
    console.log("BookId", bookId,title)

    function sendReview1(){
        if(!isUser){
            window.location.href = "login.php"
        } else {
             $('#review_form').css({'text-align':'center', 'display':'block'})
             $.post(`review.php`,{
            review:true,
            bookId:bookId,
            title:title
            },
            function(data){
                $('#review_form').html(data)
                console.log("answer",bookId)
            })
        }
    }
    function descriptionInfo(){
        let totoal = 500;
        rest = 500 - $('#desc_info').val().length
    }
</script>

<?php

$connection = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
if ($connection->connect_error) echo "Fatal Error".$connection->connect_error;
$query = "SELECT * FROM books WHERE bookId = $bookId";
$result = $connection->query($query);
if(!$result) die ('Alarm');

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
//Book's details from server-->
        echo <<<_END
            <div id = "review_form">
            <!--Review form from server-->
                <?php include 'review.php'?>
            </div>
            <div class = "inner">
                <div class = "description">
                    <div> $authors </div>
                    <div> $title </div>
                <div>
                    <img src = "$pictureURL" alt = "kartinka" width = "150px" height = "200px"/>
                </div>
        _END;
                echo '<div id = "rating">';
                    include 'rating.php';
                echo '</div>';
                echo <<< _END1
                    <div>Category 
                        <span class = "badge bg-secondary">$category</span>
                    </div>
                    <div> Year $year </div>
                    <div> Price $price </div>
                    <div class ="descript_">$description</div>
                    <button id ="leave_review" class = "btn btn-success" onclick  = "sendReview1()">
                        Leave a review
                    </button>
                </div>
        _END1;
    }
    ?>
        <div id = "reviews">
         <!--Review's list from server-->
        <?php
            $bookId = $_GET['bookId'];
            include 'list.php';
        ?>
        </div>
    </body>
</html>



