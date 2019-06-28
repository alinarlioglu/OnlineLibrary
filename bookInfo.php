<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
//Pasting the required code to here e.g. database, username session (global) variable etc.
include("includes/database/config.php");

//Checking if the global username variable is set i.e. is user logged in...
if(isset($_SESSION['userLoggedIn'])){
    $username = $_SESSION['userLoggedIn'];
}
else {
    //If the user hasn't logged in or registered an account, then the session variable wouldn't have been initialised,
    //thus the user is taken back to the register web page.
    header("Location: register.php");
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>World of Knowledge | Read</title>
        <link rel="stylesheet" type="text/css" href="includes/styles/navigation-bar.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/logoContainerStyle.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/dropdown.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/bookInfo.css">
        
        <!--Inserting jQuery to use JavaScript and jQuery as well as AJAX here. Simplifies JavaScript.-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
        
    </head>
    <body>
     
        
        <?php  
        include("includes/navigationBar.php");
        
        
        //Checking if the page is set to an isbn specifically, so the information about that book is specifically opened up for the page.
        if(isset($_GET['isbn'])){
            $isbn = $_GET['isbn'];
                
            //Query to obtain the book details.
            $query = mysqli_query($connectionToDatabase, "SELECT * FROM books WHERE isbn='$isbn'");
            //Fetching the data into an associative array.
            $row = mysqli_fetch_array($query);
                
            $title = $row['bookName'];
            $blurb = $row['blurb'];
            $author = $row['author'];
            $artworkPath = $row['artworkPath'];
            
            echo "<div class='bookInfoContainer'> 
                
                    <div class='artworkContainer'>
                        <img src='{$artworkPath}' alt='Artwork'>
                        <span><strong>{$title}</strong></span>
                    </div>
                    <div class='authorContainer'>
                        <span><strong>By </strong>{$author}</span>
                    </div>
                    <div class='blurbContainer'>
                        <span>{$blurb}</span>
                    </div>

                 </div>";
                        
            //Converting the book isbn (primary key) to an JSON object which will be used to add the book to the user's playlist.
            $isbnJson = json_encode($isbn);
                        
        }
        
        ?>
        
        
        <div class="chaptersContainer">
            <h3>Chapter</h3>
            <?php
            if(isset($_GET['isbn'])){
                $bookIsbn = $_GET['isbn'];
            
                //Query to obtain all the written chapters for the story.
                $chaptersQuery = mysqli_query($connectionToDatabase, "SELECT * FROM chapters WHERE isbn='$bookIsbn'");
                //Fetching all the chapters into an associative array.
                $i = 1;
                while($row = mysqli_fetch_array($chaptersQuery)){
                    echo "<a href='chapter.php?id={$row['id']}' role='link' tabindex='0'>Chapter {$i}</a><br>";
                    ++$i;
                }
            }
            ?>
        </div>
        
        
        <div class="favouriteContainer">
            <span role="button" tabindex="0">Add to Bookmarks</span>
            <script>
                $(".favouriteContainer span").click(function() {
                    //The book's isbn has been printed to the console - '$isbn' successfully converted to an json object.
                    //console.log(<?php echo $isbnJson ?>);
                
                    //Holds the book's isbn.
                    var bookIsbn = <?php echo $isbnJson; ?>
                
                    //Making an AJAX call to add this book to the user's playlist in the database - re-runs PHP code (useful for database access).
                    //post(URL-to-make-AJAX-call-to, {variable-hold-data : data-to-send-to-url}, what-to-do-with-result)
                    $.post("includes/ajax/updateBookmarks.php", { isbn : bookIsbn }, function(isIsbnAddedToPlaylist) {
                        //'isIsbnAddedToPlaylist' simply obtains the 'echo' value from the AJAX URL page.
                        console.log(isIsbnAddedToPlaylist);
                        alert("The following book has been added to your favourites.");
                    });
                });
                
                
            </script>
        </div>
        
        
    </body>
</html>
