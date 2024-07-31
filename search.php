<?php
require_once 'header.php';
if (isset($_POST['criteria'])) $_SESSION['criteria'] = $_POST['criteria'];
if (isset($_POST['search'])) $_SESSION['search'] =  $_POST['search'];
        
    if(isset($_SESSION['search'])&&$_SESSION['search']!=''){
        $criteria = $_SESSION['criteria'];
        $search = $_SESSION['search'];
        echo "CRITERIA".$criteria."SEARCH".$search."VAR_DUMP".var_dump($search);
        $query = "SELECT * FROM books WHERE $criteria REGEXP '$search'";
    }else
    {
        $query = "SELECT * FROM books";
    }
    
        $result = $connection->query($query);
        if(!$result) die ('Alar');
                
        $rows= $result->num_rows;
        $_SESSION['rows'] = $rows;
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

            echo <<<_END
            <pre>
                    Author(s) $authors
                    Title <a href = details.php?bookId='$bookId'>$title</a>
                    Year $year
                    Category $category
                    PictureURL $pictureURL
                    Price $price
            </pre>
        _END;
    }
    echo "<div>$rows books found</div>";
?>
    
    