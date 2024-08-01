<?php
require_once 'header.php';

        echo <<<_MENU
         <div class = "navbar_wrapper">
            <div class ="logo">Book Shelf</div>
            <div onclick = "toggleSearchVisible()">
                <span id = "search_menu" class ="bi-search" style = "font-size:18px"></span>
            </div>  
            <div>
                <ul class = "nav-menu">
                    <li><a href = "add.php">Add book</a></li>
                    <li><a href = "signup.php">Sign up</a></li>
                    <li><a href = "llogin.php">Log in</a></li>
                </ul>
            </div>
                <div id = "toggle-short" onclick="toggleFunc()">
                <b><span    class =  "bi-list" style="font-size:18px; padding-top:5px"></span></b>>
                </div>
            </div> 
            <ul id ="toggled" class = "isCollapsed" style = "visibility:hidden">
                <li><a href = "add.php">Add book</a></li>
                <li><a href = "signup.php">Sign up</a></li>
                <li><a href = "llogin.php">Log in</a></li>
            </ul>
            <
        _MENU;
?>
<script>
//Function toggling search window
show_search = false;
let isToggledMenu = true;

function toggleSearchVisible(){
    show_search=!show_search;
    console.log(show_search);
    if(document.getElementById('show_search')){
    document.getElementById('show_search').style.visibility= (!show_search)?"hidden":"visible"
    document.getElementById('search_menu').innerHTML= (!show_search)?"":"Close"
    }
}

function toggleFunc(){
document.getElementById('toggled').style.visibility=(isToggledMenu)?"visible":"hidden"
isToggledMenu=!isToggledMenu
console.log(isToggledMenu)
}
</script>