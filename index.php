<?php
require_once "header.php";
require_once "setup.php";
require_once "login.php";
require_once "login.php";
require_once 'menu.php';
if (isset($_SESSION['user']))
echo "SESSIONuser".$_SESSION['user'];

$search = '';
$query = "";
$connection = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
if ($connection->connect_error) echo "Fatal Error".$connection->connect_error;

$authors = $title = $description = $year = $category  = $pictureURL = $price='';

function filtering($irem,$criteria,$search){
    return $item["$criteria"]=$search;
}

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
    //$connection->close();
}

function get_post($connection, $var){
     echo $connection->real_escape_string($_POST[$var]);
    return $connection->real_escape_string($_POST[$var]);
}

$query = "SELECT * FROM books";
 $result = $connection->query($query);
if(!$result) die ('Alar');
?>
<div id = "sh">
<?php
$rows= $result->num_rows;
if ($rows==0){echo "0 books found";}
else {
    echo "$rows books found";
};

for ($j=0;$j<$rows;$j++){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $bookId = htmlspecialchars($row['bookId']);
    $authors = htmlspecialchars($row['authors']);
    $title = htmlspecialchars($row['title']);
    $year = htmlspecialchars($row['year']);
    $category = htmlspecialchars($row['category']);
    $pictureURL = htmlspecialchars($row['pictureURL']);
    $price = htmlspecialchars($row['price']);
    $rating = htmlspecialchars($row['rating']);
    
    echo <<<_END
    <pre>
            Author(s) $authors
            Title <a href = details.php?bookId='$bookId'>$title</a>
            Year $year
            Category $category
            PictureURL $pictureURL
            Price $price
            Rating             
            <div class="stars1" id  = "$bookId"><div>
    </pre>
    _END;
    for ($i=0;$i<5;$i++){
       
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
}
?>
</div>
<?php
echo <<<_END
<a href = "add.php">Add a book</a>
<a href = "signup.php">Sign Up</a>
<a href = "llogin.php">Log in</a>
_END;
echo<<< _ENDI
<script>
function chooseCriteria(criteria){
    
    $.post('news.php',
    {criteria:criteria.value},
    function(data){
    console.log(criteria.value)
    })
}
function searchBook(book){
    let search = $('#search').val()
    $.post('search.php',  
    {search: search},
    function(data){
    $('#sh').html(data)
    console.log(search)
    })

}
</script>
_ENDI;
echo <<<_SEARCH_BOX
<input type = "radio" value = "authors" name = "criteria" onchange = "chooseCriteria(this)">Authors<br>
<input type = "radio" value ="title" name = "criteria" onchange = "chooseCriteria(this)">Title <br>
<input type = "radio" value = "category" name = "criteria" onchange = "chooseCriteria(this)">Category<br>
<input type  = text" id ="search" name  = "search" oninput = "searchBook(this)">
<span id = "criteria">ww</span>
<span id = "searching">hh</span>
_SEARCH_BOX;
?>



   

