<?php
require_once 'header.php';

$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
echo "Current_page is".$_SESSION['current_page'];
if(!isset($_SESSION['user']))
header("Location: llogin.php");
$bookId = $_POST['bookId'];
if(isset($_POST['review']))
?>
<div>
<!--Create stars for rating-->
    <div class = "stars1" id ="stars">
        <?php 
        for ($i=0;$i<5;$i++){
            echo <<< _STARS
            <span>R</span>
            _STARS;
        }
        ?>
    </div>
    <textarea id = "review_text"></textarea>
    <button id = "show" onclick = "showSelected()">Add a review</button>
</div>



<script type = "text/javascript" >
/*let*/selected = 0;
//Creating JavaScript function onclick for rating
/*let*/ stars = document.querySelector('.stars1')
for (let i=0;i<5;i++){
    let star = document.querySelector(".stars1").getElementsByTagName('span')[i]
    star.onclick = function(){
        selected = i+1;
        console.log(selected,i)
        console.log(selected)
        for (let j=0;j<document.querySelector('.stars1').getElementsByTagName('span').length;j++){
            if (j<selected){
                document.querySelector('.stars1').getElementsByTagName('span')[j].style.color="red"
            } else {
                document.querySelector('.stars1').getElementsByTagName('span')[j].style.color="black"
            }
        }
    } 
}

function showSelected(){
        console.log("Selected",selected)
        let bookId = <?php echo $bookId?>;
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
</script>