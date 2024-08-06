<?php
require_once 'header.php';
if (isset($_POST['criteria'])) $_SESSION['criteria'] = $_POST['criteria'];
if (isset($_POST['search'])) $_SESSION['search'] =  $_POST['search'];
    
    if(isset($_SESSION['search'])&&$_SESSION['search']!='')
    {
        $criteria = $_SESSION['criteria'];
        $search = $_SESSION['search'];
        $query = "SELECT * FROM books WHERE $criteria REGEXP '$search'";
    }else
    {
        $query = "SELECT * FROM books";
    }

        $result = $connection->query($query);
        if(!$result) die ('Alar');
                
        $rows= $result->num_rows;
        $_SESSION['rows'] = $rows;
    ?>

    <div id = "res"> 
    <?php
    if ($rows==0) {
        echo '<div>0 books found</div>';
    }
    else {
        echo "<div>$rows books found</div>";
    };
    ?>
    </div>
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
        $rating = 10;
        $stars = array_fill(0,$rating,true);
        ?>
    <div class = "item_wrapper">
        <?php
            echo <<<_END
                <div>
                <a href = "details.php?bookId='$bookId'">
                    <img src = "$pictureURL" alt = "kartinka" width = "150px" height = "200px"/></a>
                </div>
                <h5 class = "title">$authors </h5>
                <h5>$title </h5>
                <p><b> $price </b></p>
                _END;
                for ($i=0;$i<5;$i++){
                    if ($i<$rating){
                        echo <<<_STAR
                        <span class  = "bi bi-star-fill orange"></span>
                        _STAR;
                    } else {
                        echo <<<_STAR
                        <span class = "bi bi-star orange"></span>
                        _STAR;
                    }
                } 
        ?></div>
    <?php
    }
    ?>


   

    
    