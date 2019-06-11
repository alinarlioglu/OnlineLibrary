<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>World of Knowledge | About Us</title>
        <link rel="stylesheet" type="text/css" href="includes/styles/navigation-bar.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/logoContainerStyle.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/dropdown.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/aboutUs.css">
        
        
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
        
        
        <div class="aboutUsContainer">
            <h1>Mission</h1>
            <p>Our mission is to provide a free service to users all over the world in which they can access any kind of
                book for free without being forced to pay. We believe everyone including those unfortunate have a right for
                knowledge, entertainment and improving themselves in form of vocabulary and writing. This website will always
                remain free without any costs to access.</p>
            <br>
            <h1>Services</h1>
            <p>We provide a range of services - browsing adventure or fantasy genre books, searching for specific books and
                even writing your own fiction! Our database is full of a variety of adventure and fantasy books awaiting readers
                to read them. Furthermore, when you write a fiction, then your username is displayed as the author, thus allowing
                you to specifically own that fiction.</p>
            <br>
            <h1>Questions</h1>
            <p>Can a user access the website without registering? No, as registering helps to simplify the process for
                viewing fictions as well as writing fictions.</p>
            <br>
            <p>Is there a limit on the number of characters my fiction can hold? No, there isn't any limit on the number of
                characters a user can write for their fiction.</p>
            <br>
            <p>Why don't you have more genre books or more sophisticated features? Be assured, more features are in development
                and will be added in the future.</p>
        </div>
    </body>
</html>
