<?php
    $query1 = "SELECT * FROM reviews WHERE bookId = $bookId ORDER BY review_date ASC";
    $result = $connection->query($query1);
    if(!$result) die ('AlarSELECT');
        $rows= $result->num_rows;
    
    //Displaying reviews
    for ($j=0;$j<$rows;$j++){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $username = htmlspecialchars($row['username']);
        $review = htmlspecialchars($row['review']);
        $user_rating = htmlspecialchars($row['user_rating']);
        $review_timestamp = htmlspecialchars($row['review_date']);
        $temp = explode('-',date('Y-m-d',strtotime($review_timestamp)));
        $temp2 = array_reverse($temp);
        $review_date = implode('-',$temp2);
             
        
        echo '<div class ="review_wrapper">';
        for ($i = 0;$i<5;$i++){
            if ($i<$user_rating){
            echo <<<_STAR1
                <span class = "bi bi-star-fill orange"></span>
                _STAR1;
            } else {
            echo <<<_STAR1
                <span class = "bi bi-star orange"></span>
                _STAR1;
            }
        }
        echo <<<_REVIEWS
            <div style = "font-size:14px;padding-left:0">$review</div>
            <div class = "date">
            <span style = "font-size:13px; padding-left:0">$username</span>
            <span class = "pull-right" style = "font-size:13px;padding-left:0">$review_date</span>
            </div>
            _REVIEWS;
        echo '<hr>';
        echo '</div>';
    }
    
?>