<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php 
//'Copying' and 'pasting' the code inside config.php as data will be added to the database and the session_start is required
//to use the global username variable.
include("includes/database/config.php");



?>



<html>
    <head>
        <meta charset="UTF-8">
        <title>World of Knowledge | My Fictions</title>
        <link rel="stylesheet" type="text/css" href="includes/styles/navigation-bar.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/logoContainerStyle.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/myFictions.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/dropdown.css">
        
        
        
    </head>
    <body>
        
        
        
        <!--Copying and pasting the HTML code for the navigationBar to here.-->
        <?php include("includes/navigationBar.php") ?>
        
        
        
        <div class="myFictionsContainer">
            <?php
            //Fetching all the fictions from the database.
            //Checking if the global 'userLoggedIn' variable has been initialised to a value.
            if (isset($_SESSION['userLoggedIn'])) {
                $auth = $_SESSION['userLoggedIn'];
                //Query to fetch all fictions written by the user.
                $userFictionsQuery = mysqli_query($connectionToDatabase, "SELECT bookName,author,blurb,genre FROM books WHERE author='$auth'");
                
                //Checking if the user has written any fictions and if none are written, then the method outer 'if' is exitted.
                if(mysqli_num_rows($userFictionsQuery) == 0) {
                    echo "No fictions written.";
                    return;
                }
                
                
                //Putting all the data from the query into an associative array e.g. hash table with a key and value.
                while ($row = mysqli_fetch_array($userFictionsQuery)) {
                    echo "<div class='myFictionContainer'><h3>{$row['bookName']}</h3><p class='userAuthorPosition'><strong>By</strong> {$row['author']}<p><strong>Genre: </strong>{$row['genre']}</p></p><p class='myFictionBlurbPosition'>{$row['blurb']}</p></div>";
                }
            }
            else {
                header("Location: register.php");
            }
            ?>
        </div>
    </body>
</html>
