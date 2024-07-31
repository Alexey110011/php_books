<?php
require_once 'header.php';
//Check if user logged to allow him to make reviews
echo isset($_SESSION['user']);
$isUser = '';
if (isset($_SESSION['user'])) $isUser = $_SESSION['user']; 

$_SESSION['current_page']= $_SERVER['REQUEST_URI'];
//echo "Current_page". $_SESSION['current_page'];

$username = $user_rating = $bookId = $review='';

$bookId = $_GET['bookId'];
$_SESSION['bookId'] = $bookId;
echo "SESSION BookId =".$bookId; 

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
    console.log("BookId", bookId)

    function sendReview1(){
        if(!isUser){
            window.location.href = "llogin.php"
        } else {
            $('#review_form').css('display','block')
            $.post(`review.php`,{
            review:true,
            bookId:bookId
            },
            function(data){
                $('#review_form').html(data)
                console.log("answer",bookId)
            })
        }
    }
</script>

<?php
$connection = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
if ($connection->connect_error) echo "Fatal Error".$connection->connect_error;
$query = "SELECT * FROM books WHERE bookId = $bookId";
$result = $connection->query($query);
if(!$result) die ('Alar');

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
    <div>
        <pre>
            Author(s) $authors
            Title $title
            Description $description
            Year $year
            Category $category
            <img src = "$pictureURL" alt = "kartinka" width = "150px" height = "200px"/>
            Price $price
        </pre>
     </div>
   _END;
}
?>

<button onclick  = "sendReview1()">ADD review</button>
<div id = "review_form" style= "display:none;position: fixed; top:100px; left:10%;background-color:blue" class  = "col-xs-10 col-sm-8 col-lg-2">
    <!--Review form from server-->
    <?php include 'review.php'?>
</div>

<div id = "reviews">
    <!--Review's list from server-->
    <?php
        $bookId = $_GET['bookId'];
        include 'list.php';
    ?> 
</div>


