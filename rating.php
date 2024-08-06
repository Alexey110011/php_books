<?php
if(isset($_POST['rating'])) $rating = $_POST['rating'];

echo '<div class = "rating">';
     for ($i =0;$i<5; $i++){
        if ($i<$rating){
        echo <<<_STAR
        <span class = "bi bi-star-fill orange"></span>
        _STAR;
        } else {
        echo <<<_STAR
        <span class = "bi bi-star orange"></span>
        _STAR;
        }
    }
echo "</div>";
?>