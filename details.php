<?php
require_once("login.php");
require_once('header.php');

$bookId = $_GET['bookId'];
echo "Book: $bookId";
$connection = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
if ($connection->connect_error) echo "Fatal Error".$connection->connect_error;
$query = "SELECT * FROM books WHERE bookId = $bookId";
$result = $connection->query($query);
if(!$result) die ('Alar');
var_dump($result);
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

    echo <<<_END
    <div>
            Author(s) $authors
            Title $title
            Description $description
            Year $year
            Category $category
            PictureURL $pictureURL
            Price $price
            Rating <div class="stars" id = "stars">Pp<div>
    </div>
   
_END;
}
?>
<div id = "review">
    <div class = "stars">
        <?php 
        for ($i=0;$i<5;$i++){
            echo <<< _STARS
            <span>R</span>
            _STARS;
        }
        ?>
    </div>
    <textarea id = "review_text"></textarea>
    <button id = "show" onclick = "showSelected()">Add a review </button>
</div>

<script type = "text/javascript" >
let bookId = "<?php echo $bookId?>"
let selected = 0;
//Creating rating stars with JavaScript function onclick
let stars = document.querySelector('.stars')
for (let i=0;i<5;i++){
    let star = document.querySelector(".stars").getElementsByTagName('span')[i]
    star.onclick = function(){
        selected = i+1;
        console.log(selected,i)
        console.log(selected)
        for (let j=0;j<document.querySelector('.stars').getElementsByTagName('span').length;j++){
            if (j<selected){
                document.querySelector('.stars').getElementsByTagName('span')[j].style.color="red"
            } else {
                document.querySelector('.stars').getElementsByTagName('span')[j].style.color="black"
            }
        }
    }
}
//Alternative variant  - creating stars only with Javascript
/*for (let i=0;i<5;i++){
    let star = document.createElement('span')
    star.textContent='R'
    star.onclick = function(){
        selected = i+1;
        console.log(selected,i)
        console.log(selected)
        for (let j=0;j<document.querySelector('#stars').getElementsByTagName('span').length;j++){
            if (j<=selected){
                document.querySelector('#stars').getElementsByTagName('span')[j].style.color="red"
            } else {
                document.querySelector('#stars').getElementsByTagName('span')[j].style.color="black"
            }
        }
    }
    stars.appendChild(star)
}*/

    function showSelected(){
        console.log("Selected",selected)
        console.log(bookId)
        $.post('stars.php',
        {user_rating: selected,
        bookId:bookId,
        review: $('#review_text').val()
    },
        function(data){
            $('#stars').html(data)
            $('#stars1').html(data)
        })
    }    
</script>