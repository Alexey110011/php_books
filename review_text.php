<?php
$available= '';
if(isset($_POST['available'])) $available = $_POST['available'];

if($available!=500)
    echo "<div class = 'white'>Available $available caracters</div>";
?>