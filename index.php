<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php 
//Obtaining the session_start function as this will enable the global session variables to be available in this web page.
include("includes/database/config.php");

//Destroys the session whenever index page is reloaded or the browser is closed. Does it automatically, thus user is automatically
//'logged out'.
//session_destroy();

//Checks if the userLoggedIn variable has been initialised.
if(isset($_SESSION['userLoggedIn'])){
    $userLoggedIn = $_SESSION['userLoggedIn'];
}
else {
    //If the user hasn't logged in or registered an account, then the session variable wouldn't have been initialised,
    //thus the user is taken back to the register web page.
    header("Location: register.php");
}
//Function to search books.
include("includes/Handlers/search-handler.php");

function getPreviousInputValue($input){
    if(isset($_POST[$input])){
        echo $_POST[$input];
    }
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>World of Knowledge | Online Library</title>
        <link rel="stylesheet" type="text/css" href="includes/styles/index.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/navigation-bar.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/logoContainerStyle.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/dropdown.css">
        
        
        
    </head>
    <body>
        <a href="index.php"><img class="logoContainer" src="includes/images/logo.png" alt="Logo of Online Library"></a>
        
        <div class="navigation-bar">
            <a id="writeBook" href="writeBook.php">Write</a>
            <a id="myFictions" href="myFictions.php">My Fictions</a>
            
            <div class="dropdown">
                <button class="browseBtn">Browse</button>
                <div class="dropdown-content">
                    <a href="adventure.php">Adventure</a>
                    <a href="fantasy.php">Fantasy</a>
                </div>
            </div>
           
            <a id="aboutUs" href="aboutUs.php">About Us</a>
            <a id="contactUs" href="contactUs.php">Contact Us</a>
            <form class="searchContainer" action="index.php" method="POST">
                <input id="searchText" name="searchText" type="text" placeholder="Enter book title or author">
                <button type="submit" name="search">Search</button>
            </form>
        </div>
        
        
        <div class="home-page-information">
            <h1>Welcome to the World of Knowledge!</h1>
            <p>
                The World of Knowledge serves as an online library with variety of books to chose from. We will
                always be a free access website, so you will NEVER need to subscribe or pay monthly to access the 
                World of Knowledge.
            </p>
            <br>
            <h2>Our Mission</h2>
            <p>
                Our mission is to provide a place where anyone regardless of educational level or ability, to be
                able to access knowledge and entertaining books free-of-charge. We aim to provide the utmost
                high-quality service to enable you to access knowledge.
            </p>
            <br>
            <h2>Services</h2>
            <p>
                We have a variety of services:
            <ul>
                <li>Search books or authors.</li>
                <li>Registering an account. Keep track of account.</li>
                <li>Write books.</li>
                <li>More front-end services to be added in the future...</li>
            </ul>
            </p>
        </div>
        
    </body>
</html>
