<?php
require_once "header.php";
require_once "setup.php";
require_once 'menu.php';
$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
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
$rows= $result->num_rows;
?>

<div id = "sh">
    <span id = "res">
    <?php
    if ($rows==0){echo '0 books found';}
    else {
        echo "$rows books found";
    };
    ?>
    </span>
<?php
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
    ?>
    <div class = "item_wrapper">
    <?php
    echo <<<_END
                <div>
                    <a href ="details.php?bookId='$bookId'&title='$title'">
                    <img src = "$pictureURL" alt = "kartinka" width = "150px" height = "200px"/></a>
                </div>
                <div>$authors </div>
                <div>$title </div>
                <p><b> BYN $price </b></p>
             _END;
    for ($i=0;$i<5;$i++){
        if ($i<$rating){
            echo <<<_STAR
               <span class  = "bi bi-star-fill orange"></span>
            _STAR;
        } else {
            echo <<<_STAR
            <span class = "bi bi-star orange empty"></span>
            _STAR;
        }
    } echo "<span class = 'orange'> $rating stars</span>";
    ?>
    </div>
<?php
}
?>
</div>

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
<?php 
echo <<<_SEARCH_BOX
<div class = "row">
    <div id = "show_search">
        <div id = "radio_wrapper"> 
            <input type = "radio" value = "authors" name = "criteria" onchange = "chooseCriteria(this)">Authors<br>
            <input type = "radio" value ="title" name = "criteria" onchange = "chooseCriteria(this)">Title <br>
            <input type = "radio" value = "category" name = "criteria" onchange = "chooseCriteria(this)">Category<br>
        </div>
        <div id = "search_input">
            <input type  = text" id ="search" name  = "search" class = "form-control" oninput = "searchBook(this)">
        </div> 
   </div>
_SEARCH_BOX;?>
    </body>
</html>
