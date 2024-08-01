<?php
    $query1 = "SELECT * FROM reviews WHERE bookId = $bookId";
    $result = $connection->query($query1);
    if(!$result) die ('AlarSELECT');
        $rows= $result->num_rows;
    //Displaying rating in stars
     /*for ($i =0;$i<5; $i++){
        if ($i<$rating){
        echo <<<_STAR
        <span class = "bi bi-star-fill" style = "color:yellow"></span>
        _STAR;
        } else {
        echo <<<_STAR
        <span class = "bi bi-star" style = "color:yellow"></span>
        _STAR;
        }
    }echo "<span style = 'color:red'> $rating stars</span>";*/
    //Displaying reviews
    for ($j=0;$j<$rows;$j++){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $username = htmlspecialchars($row['username']);
    $review = htmlspecialchars($row['review']);
    $user_rating = htmlspecialchars($row['user_rating']);
    echo <<<_REVIEWS
         <pre>
          BookId $bookId
          Username $username
          Review $review
          </pre>
         _REVIEWS;
    for ($i = 0;$i<5;$i++){
        if ($i<$user_rating){
            echo <<<_STAR1
            <span class = "bi bi-star-fill" style = "color:yellow"></span>
            _STAR1;
        } else {
            echo <<<_STAR1
            <span class = "bi bi-star" style = "color:yellow"></span>
            _STAR1;
            }
       }
    }
?>