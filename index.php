<?php
//session_start();
require_once "header.php";
require_once "setup.php";
require_once "login.php";
require_once "styles.css";
require_once "login.php";
if (isset($_SESSION['user']))
echo "SESSIONuser".$_SESSION['user'];

$search = '';
$query = "";
$connection = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
if ($connection->connect_error) echo "Fatal Error".$connection->connect_error;
//$search_window = true;
//$criter = '';
/*if (isset($_POST['criteria'])) {$criteria = $_POST['criteria'];
    print_r($_POST);*/
/*echo $criteria;}*/
//$search_author = $search_title = $search_category = '';
//if(isset($_POST['search_title'])) $search_title = $_POST['search_title'];
//if(isset($_POST['search_category'])) $search_category = $_POST['search_category'];
$authors = $title = $description = $year = $category  = $pictureURL = $price='';
//require_once "add.php";
//require_once "add.php"
//require_once "login.php";
/*echo "<h1>Hello, PHP</h1>";
$author = "Fred Smith";
echo "hello, $author";
$team = array ('bob', 'joe', 'garvey');
$team2 = array (7,9,20);
foreach ($team as $item){
    echo "$item<br>";
}
foreach ($team2 as $item){
    echo "$item<br>";
}
/*for ($count = 1;$count<3;++$count){
    echo $count;
}*/
/*$new_array = array('first'=>"FIRST",
'second'=>"SECOND");
foreach($new_array as $list=>$desc){
    echo "$list:$desc<br>";
}
$rand = array("ert", "qwe", "tyu", "iop");
$random = shuffle($rand);//changing firdt array
//$sorted = sort($rand); 
foreach ($rand as $neww){
    echo "$neww<br>";
}
echo count($rand);
$skaz = "Too long sentence";
$tempp = explode(' ',$skaz);
foreach($tempp as $word){
    echo "$word <br>";
}
//print($rand);
printf ("MY age is %b",45);
class User{
    /*static*/ /*public $name="Guess"/*", $password*/;
    /*function get_user(){
        return $this->name; 
    }
}
$object = new User();
//$object->name = "Jeremy";
echo $object->get_user();
//echo User::$name/*get_user()*/
/*class Test {
    /*static*/ /*public $static_property = "This is static property";
    function get_sp(){
        //return self::$static_property
        return $this->static_property;
    }
}
$temp = new Test();
//echo Test::$static_property;
echo $temp->get_sp();
echo $temp->static_property
*/
/*$conn= new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error){
    die("Connection failed".$conn->connect_error);
}
$sql = "CREATE TABLE My (id int(6) unsigned primary key,
first VARCHAR(30))";
if ($conn->query($sql) === TRUE){
    echo "TAble success";
}else {echo "Nada".$conn->error;
    }
$conn->close()*/
/*if(isset($_SESSION['criteria'])&&($_SESSION['search'])){
    $criteria = $_SESSION['criteria'];
    $search = $_SESSION['search'];
    $query = "SELECT * FROM books WHERE $criteria = `^${$search}$`";
    $result = $connection->query($query);
    print_r($result);
} else {*/
    function filtering($result,$criteria,$search){
        return ;
    }
//$query = "SELECT * FROM books";}
//$result = $connection->query($query);
//if(!$result) die ('Alar');
//var_dump($result);
/*if(isset($_SESSION['criteria'])&&($_SESSION['search'])){
    $criteria = $_SESSION['criteria'];
    $search = $_SESSION['search'];
    $query = "SELECT * FROM books WHERE $criteria REGEXP '^$search$'";//^{$search}$'";
    $result = $connection->query($query);
    var_dump($result);
}
else */
 $query = "SELECT * FROM books";
 $result = $connection->query($query);
if(!$result) die ('Alar');
//{if(isset($_SESSION['search']))}
    
   
?>
<div id = "sh">
<?php
$rows= $result->num_rows;
for ($j=0;$j<$rows;$j++){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $bookId = htmlspecialchars($row['bookId']);
    $authors = htmlspecialchars($row['authors']);
    $title = htmlspecialchars($row['title']);
    //$description = htmlspecialchars($row['description']);
    $year = htmlspecialchars($row['year']);
    $category = htmlspecialchars($row['category']);
    $pictureURL = htmlspecialchars($row['pictureURL']);
    $price = htmlspecialchars($row['price']);
    //$rating = 10;
    //$stars = array_fill(0,$rating,true);

    echo <<<_END
    <pre>
            Author(s) $authors
            Title <a href = details.php?bookId='$bookId'>$title</a>
            Year $year
            Category $category
            PictureURL $pictureURL
            Price $price
            Rating 
            <div class="stars" id = "stars1">Pp<div>
    </pre>
    
_END;
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
    $('#criteria').html(data)
    console.log(criteria.value)
    })
}
function searchBook(book){
    let search = $('#search').val()
    if (search!=''){
    $.post('news.php',  
    {search: search},
    function(data){
    $('#sh').html(data)
    console.log(search)
    })
}
}
</script>
_ENDI;
echo <<<_SEARCH_BOX
<input type = "radio" value = "authors" name = "criteria" onchange = "chooseCriteria(this)">Authors<br>
<input type = "radio" value ="title" name = "criteria" onchange = "chooseCriteria(this)">Titl <br>
<input type = "radio" value = "category" name = "criteria" onchange = "chooseCriteria(this)">Category<br>
<input type  = text" id ="search" name  = "search" onchange = "searchBook(this)">
<span id = "criteria">ww</span>
<span id = "searching">hh</span>


_SEARCH_BOX;

?>



   

