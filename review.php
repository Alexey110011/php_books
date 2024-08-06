<?php
require_once 'header.php';
$bookId = $title = '';
//Set bookid for returning on page after login
if(isset($_SESSION['bookId'])) $bookId = $_SESSION['bookId'];
if(isset($_POST['title'])) $title = $_POST['title'];
if(isset($_POST['available'])) $available = $_POST['available'];

if(isset($_SESSION['user'])){
//Displaying form for user's review
    echo <<<_REVIEW1
        <!--Create stars for rating-->
        <div class = "stars1" id ="stars">
    _REVIEW1;
    echo "<div class = 'white'>Leave review for <b>$title</b></div>";

    for ($i=0;$i<5;$i++){
    echo <<< _STARS
        <span class = "bi bi-star orange"></span>
    _STARS;
    }

    echo <<<_BOTTOM
        </div>
        <textarea id = "review_text" rows = '10' maxlength = "500" oninput = "calculateLength()"></textarea>
        <div id = "desc_info"></div>
        <button  class = "btn btn-success" id = "show" onclick = "showSelected()">Add a review</button>
        <div onclick = "closeReview()" id = "close_button" class = "bi bi-x-square-fill"></div>
    _BOTTOM;
}
?>
 
<script type = "text/javascript" >
//Creating JavaScript function onclick for rating
/*let*/selected = 0;
/*let*/ stars = document.querySelector('.stars1')
for (let i=0;i<5;i++){
    let star = document.querySelector(".stars1").getElementsByTagName('span')[i]
    star.onclick = function(){
        selected = i+1;
        console.log(selected,i)
        console.log(selected)
        for (let j=0;j<document.querySelector('.stars1').getElementsByTagName('span').length;j++){
            if (j<selected){
                document.querySelector('.stars1').getElementsByTagName('span')[j].setAttribute('class',"bi bi-star-fill orange")
            } else {
                document.querySelector('.stars1').getElementsByTagName('span')[j].setAttribute('class',"bi bi-star orange")
                document.querySelector('.stars1').getElementsByTagName('span')[j].setAttribute('style',"color:orange")
            }
        }
    } 
}
//Sending user's review data to server
function showSelected(){
        console.log("Selected",selected)
        let bookIdFromPHP = <?php echo $_SESSION['bookId'];?>;
        let bookId = bookIdFromPHP.replaceAll("\'", "") //normalzing query string
        $.post('stars.php', {
        user_rating: selected,
        bookId: bookId,
        review: $('#review_text').val()
        },
        function(data){
            $('#reviews').html(data)
            $('#review_form').html('')
        }) 
        selected = null
} 

//Hiding review form 
function closeReview(){
    $("#review_form").html('')
}

function calculateLength(){
    busy = $('#review_text').val().length;
    let available = 500-busy;
    $.post('review_text.php',
    {available:available},
    function(data){
        $('#desc_info').html(data) 
        console.log(available)
    })
}
</script>
