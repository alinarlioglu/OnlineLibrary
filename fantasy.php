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
        <title>Browse Fantasy Books!</title>
        <link rel="stylesheet" type="text/css" href="includes/styles/navigation-bar.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/logoContainerStyle.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/dropdown.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/myFictions.css">
        
        
        
        
    </head>
    <body>
        
        
        <!--Copying and pasting the HTML code for the navigationBar to here.-->
        <?php include("includes/navigationBar.php") ?>
        
        
        <div class="fantasyBooksContainer">
            <?php
            //Detecting if a value has been set to the 'userLoggedIn' variable - if it has, then the user has logged.
            if(isset($_SESSION['userLoggedIn'])){
                //Obtainin
                $username = $_SESSION['userLoggedIn'];
                //Fetching all book rows where the genre is 'Fantasy'.
                $fantasyBooksQuery = mysqli_query($connectionToDatabase, "SELECT isbn,bookName,author,genre,blurb FROM books WHERE genre='Fantasy'");
            
                if(mysqli_num_rows($fantasyBooksQuery) == 0){
                    echo "No fantasy books available.";
                }
                
                //Turns all the data per book row into an associative array e.g. hash table with key and value.
                while($row = mysqli_fetch_array($fantasyBooksQuery)) {
                    echo "<div class='myFictionContainer'>
                            <a href='bookInfo.php?isbn={$row['isbn']}' role='link' tabindex='0'><h3>{$row['bookName']}</h3></a>
                            <p class='userAuthorPosition'><strong>By</strong> {$row['author']}
                                <p><strong>Genre: </strong>{$row['genre']}
                                </p>
                            </p>
                            <p class='myFictionBlurbPosition'>{$row['blurb']}</p>
                         </div>";
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
