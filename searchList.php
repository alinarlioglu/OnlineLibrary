<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
//Required for the session_start in order to utilise the global session variables on this web page.
include("includes/database/config.php");

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Search Books or Authors</title>
        <link rel="stylesheet" type="text/css" href="includes/styles/searchList.css">
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
        
        
        
        <div class="searchListContainer">
            <?php 
            //Checking if any values is assigned to this global variable, if it is, then a search result has been displayed.
            if (isset($_SESSION['searchedText'])) {
                $searchedText = $_SESSION['searchedText'];
                //Fetching book details via a query.
                $bookDetailsQuery = mysqli_query($connectionToDatabase, "SELECT bookName,author,genre,blurb FROM books WHERE bookName='$searchedText' OR author='$searchedText'");
                //Checking if only one book is fetched.
                if (mysqli_num_rows($bookDetailsQuery) == 1) {
                    //Executing the query and returning the data as an array e.g. array(bookName,author,blurb) etc.
                    //Only fetching a row if there's only one book to fetch. Outside this scope causes a row to not be fetched in the 'while' loop as it has been fetched by this earlier.
                    $result = mysqli_fetch_row($bookDetailsQuery);
                    //Displaying the data in HTML format.
                    echo "<div class='bookContainer'><h3>{$result[0]}</h3><p class='authorPosition'><strong>by</strong> {$result[1]}<p><strong>Genre: </strong>{$result[2]}</p></p><p class='blurbPosition'>{$result[3]}</p></div>";
                }
                
                
                //Checking if more than one book is fetched. Same name books etc.
                else if(mysqli_num_rows($bookDetailsQuery) > 1) {
                    //For loop to display all the data of all the books fetched in subsequent order.
                    while($row = mysqli_fetch_array($bookDetailsQuery)) {
                        echo "<div class='bookContainer'><h3>{$row['bookName']}</h3><p class='authorPosition'><strong>By</strong> {$row['author']}<p><strong>Genre: </strong>{$row['genre']}</p></p><p class='blurbPosition'>{$row['blurb']}</p></div>";
                    }
                }
            }
            ?>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
