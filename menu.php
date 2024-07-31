
<?php 
        echo <<<_MENU
        <nav class = "navbar-wrapper" role = "navigation">
            <div class ="logo">Book Shelf</div>
            <div onclick="toggleSearchVisible()">
                <span id = "search_menu" class ="bi-search">Search</span>
            </div>
                <ul class = menu_large">
                    <li><a href = "add.php">Add book</a></li>
                    <li><a href = "signup.php">Sign up</a></li>
                    <li><a href = "llogin.php">Log in</a></li>
                </ul>
                <div class="short pull-right pad" onclick="toggleFunc()">
                    <span class = "bi-list" style="font-size:18px; padding-top:5px"></span>
                </div>
        </nav>
        <div> 
            <ul id ="toggled" class = "isCollapsed" style = "visibility:hidden">
                <li><a href = "add.php">Add book</a></li>
                <li><a href = "signup.php">Sign up</a></li>
                <li><a href = "llogin.php">Log in</a></li>
            </ul>
        </div>
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
isToggledMenu=!isToggledMenu
console.log(isToggledMenu)
document.getElementById('toggled').style.visibility=(isToggledMenu)?"visible":"hidden"
}
</script>