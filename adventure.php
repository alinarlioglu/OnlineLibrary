<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
//fetch all fantasy books -> then display them.

//Types 'session_start' in here, thus the global session variables can be utilised here as well. Also, the database
//can be used here as well.
include("includes/database/config.php");
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Browse Adventure Books!</title>
        <link rel="stylesheet" type="text/css" href="includes/styles/navigation-bar.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/logoContainerStyle.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/dropdown.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/myFictions.css">
        
        
        
        
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
        
        
        <div class="fantasyBooksContainer">
            <?php
            //Detecting if a value has been set to the 'userLoggedIn' variable - if it has, then the user has logged.
            if(isset($_SESSION['userLoggedIn'])){
                //Obtainin
                $username = $_SESSION['userLoggedIn'];
                //Fetching all book rows where the genre is 'Fantasy'.
                $fantasyBooksQuery = mysqli_query($connectionToDatabase, "SELECT bookName,author,genre,blurb FROM books WHERE genre='Adventure'");
            
                if(mysqli_num_rows($fantasyBooksQuery) == 0){
                    echo "No fantasy books available.";
                }
                
                //Turns all the data per book row into an associative array e.g. hash table with key and value.
                while($row = mysqli_fetch_array($fantasyBooksQuery)) {
                    echo "<div class='myFictionContainer'><h3>{$row['bookName']}</h3><p class='userAuthorPosition'><strong>By</strong> {$row['author']}<p><strong>Genre: </strong>{$row['genre']}</p></p><p class='myFictionBlurbPosition'>{$row['blurb']}</p></div>";
                }
            }
            //Not value set, so user hasn't logged.
            else {
                //Directs the user to the register page by loading the register page automatically.
                header("Location: register.php");
            }
            ?>
        </div>
        
        
    </body>
</html>
