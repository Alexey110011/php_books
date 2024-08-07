<?php
require_once 'header.php';

        echo <<<_MENU
         <div class = "navbar_wrapper">
            <div class ="logo">Book Shelf</div>
            <ul class = "nav-menu">
                    <li><a href = "add.php">Add book</a></li>
                    <li><a href = "signup.php">Sign up</a></li>
                    <li><a href = "login.php">Log in</a></li>
                </ul>
            <div onclick = "toggleSearchVisible()">
                <span id = "search_menu"  class ="bi-search">Search</span>
            </div>  
            <div id = "toggle-short" onclick="toggleFunc()">
                <span id = "hamburger" class =  "bi-list"></span>
            </div>
            </div> 
            <ul id ="toggled" class = "isCollapsed">
                <li><a href = "add.php">Add book</a></li>
                <li><a href = "signup.php">Sign up</a></li>
                <li><a href = "login.php">Log in</a></li>
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
        document.getElementById('search_menu').innerHTML= (!show_search)?"Search":"Close"
        }
    }

    function toggleFunc(){
        document.getElementById('toggled').classList.toggle("vis")
        isToggledMenu=!isToggledMenu
        document.getElementById('hamburger').className = (isToggledMenu)?'bi-list':'bi-x'
        console.log(isToggledMenu)
    }
</script>