<?php
require_once('functions.php');
if(isset($_POST['username'])){
    $username =/*sanitizeString(*/$_POST['username']/*)*/;
    $result =queryMysql("SELECT * FROM users WHERE username REGEXP '^$username$'");
    if ($result->num_rows)
    
        echo "<span  class = 'taken'>&nbsp;&#x2718; "."Username $username is already taken</span>";
    else
    
        echo "<span class = 'available'>&nbsp;&#x2714; "."Username $username is available</span>";
    }
    ?>
