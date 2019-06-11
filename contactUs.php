<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>World of Knowledge | Contact Us</title>
        <link rel="stylesheet" type="text/css" href="includes/styles/navigation-bar.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/logoContainerStyle.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/dropdown.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/contactUs.css">
        
        
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
        
        
        <div class="contactUsContainer">
            <p>
                <strong>Phone: </strong>0784728571
                <br>
                <strong>Fax: </strong>07947581731
                <br>
                <strong>Email: </strong>onlinelibrary@library.ac.uk
            </p>
        </div>
    </body>
</html>
