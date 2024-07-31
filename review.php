<?php
require_once 'header.php';
$bookId = '';
//set bookid for returning on page after login
if(isset($_SESSION['bookId'])) $bookId = $_SESSION['bookId'];
//echo "SESSION BookId:".$bookId;

if(isset($_SESSION['user'])){
//Displaying form for user's review
    echo <<<_REVIEW1
    <div style= "visibility:visible">
        <!--Create stars for rating-->
        <div class = "stars1" id ="stars">
    _REVIEW1;
    for ($i=0;$i<5;$i++){
    echo <<< _STARS
    <span class = "bi bi-star" style = "color:yellow"></span>
    _STARS;
    }
    echo <<<_BOTTOM
        </div>
        <textarea style = "width:80%; margin:10px 10%" id = "review_text" rows = '10' ></textarea>
        <button class = "btn btn-primary submit_btn" id = "show" onclick = "showSelected()">Add a review</button>
        <div onclick = "closeReview()" class = "bi bi-x-square-fill" style =" color:red; position:absolute; top:0; right:0;height:35px; width:35px"></div>
    </div> 
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
                document.querySelector('.stars1').getElementsByTagName('span')[j].setAttribute('class',"bi bi-star-fill")
            } else {
                document.querySelector('.stars1').getElementsByTagName('span')[j].setAttribute('class',"bi bi-star")
                document.querySelector('.stars1').getElementsByTagName('span')[j].setAttribute('style',"color:yellow")
            }
        }
    } 
}
//Sending user's review data to server
function showSelected(){
        console.log("Selected",selected)
        let bookIdFromPHP = <?php echo $_SESSION['bookId'];?>;
        let bookId = bookIdFromPHP.replaceAll("\'", "")//normalzing query string
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
//Removing review form 
function closeReview(){
    $("#review_form").html('')
}
</script>
