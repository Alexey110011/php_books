<?php
require_once "header.php";
require_once "setup.php";
require_once 'menu.php';

$authors = $title = $description = $year = $category  = $pictureURL = $price =  $search= $query = '';

$connection = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
if ($connection->connect_error) echo "Fatal Error".$connection->connect_error;

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
            <img src = "$pictureURL" alt = "kartinka" width = "150px" height = "200px"/>
            Price $price
            Rating             
            <div class="stars1" id  = "$bookId"><div>
    </pre>
    _END;
    for ($i=0;$i<5;$i++){
       
        if ($i<$rating){
            echo <<<_STAR
           <span class  = "bi bi-star-fill" style = "color:yellow"></span>
           _STAR;
           } else {
            echo <<<_STAR
            <span class = "bi bi-star" style = "color:yellow"></span>
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
    $.post('search.php',
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
?>

<?php 
echo <<<_SEARCH_BOX
<div class = "row">
<div id = "show_search" style = "position:absolute; top:70px;left:200px;visibility:hidden; background-color:rgb(69, 214, 69);
display:flex;flex-direction:column;justify-content:center;box-shadow: 5px 5px gray;max-width:320px;"">
<!--<div id = "show_search" class = "search">-->
    <div style = "display: flex;justify-content: space-between;width:100%"> 
        <input type = "radio" value = "authors" name = "criteria" onchange = "chooseCriteria(this)">Authors<br>
        <input type = "radio" value ="title" name = "criteria" onchange = "chooseCriteria(this)">Title <br>
        <input type = "radio" value = "category" name = "criteria" onchange = "chooseCriteria(this)">Category<br>
    </div>
    <div style="align-content: center">
    <input type  = text" id ="search" name  = "search" class = "form-control" oninput = "searchBook(this)">
    </div>
    <span id = "criteria">ww</span>
    <span id = "searching">hh</span>
</div>
</div>
_SEARCH_BOX;
?>