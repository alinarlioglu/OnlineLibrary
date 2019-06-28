<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
//Required to access the database and the session variables via 'session_start'.
include("includes/database/config.php");

//Checking if the user has logged in or an account has been registered - thus, the user has officially 'logged' to their account.
if(isset($_SESSION['userLoggedIn'])){
    $userHasLogged = $_SESSION['userLoggedIn'];
}
//User hasn't 'logged' in - might have directly accessed this page through URL, thus directing user to register page.
else {
    //Directs the user's browser into the register page.
    header("Location: register.php");
}

?>



<html>
    <head>
        <meta charset="UTF-8">
        <title>World of Knowledge | Favourites</title>
        <link rel="stylesheet" type="text/css" href="includes/styles/navigation-bar.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/logoContainerStyle.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/dropdown.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/favourites.css">
        
        
        
    </head>
    <body>
        
        <!--Bringing the navigation bar HTML code to here.-->
        <?php include("includes/navigationBar.php"); ?>
        
        
        <?php 
        //Fetching the user's playlist.
        $userPlaylist = mysqli_query($connectionToDatabase, "SELECT playlist FROM account WHERE username='$userHasLogged'");
        //Putting the playlist into an associative array, BUT data is in the format of a JSON string object.
        $playlistQueryResult = mysqli_fetch_array($userPlaylist);
        
        
        
        //'playlist' data is a JSON string represented object, so it helps to obtain isbn numbers from the whole string
        //by simply using regex to fetch numbers from the JSON string only.
        $playlist = $playlistQueryResult['playlist'];
        
        
        
        //Finds all digits contained within the string '$playlist' and inserts the found digits into an array called '$allNumbersArray'.
        $isbn = preg_match_all('!\d+!', $playlist, $allNumbersArray);
        
        
        
        //Due to saving the array as an JSON object, an inner array is created within the '$allNumbersArray' in position 0.
        //So, '$isbnArray' simply fetches the inner array containing the isbn data.
        //'array_values' turns the array into an non-associative array as JSON encoded data turns array into associative array AND to a string.
        $isbnArray = array_values($allNumbersArray[0]);
        //Removing any duplicate values.
        array_unique($isbnArray);
        
        //Checking how many books are in favourties, if there's none, then this will remain at '0'. Thus, I can display
        //'No books added to favourites'.
        $isAnyBooksAddedToFavourites = 0;
        
        
        //Loop to find any isbn numbers in the array and print out the relevant information about the found books.
        for($i = 0; $i < count($isbnArray); ++$i){
            //Obtaining the number.
            $bookIsbnNum = $isbnArray[$i];
            //Query to fetch the data using the 'isbn' number.
            $bookQuery = mysqli_query($connectionToDatabase, "SELECT * FROM books WHERE isbn='$bookIsbnNum'");
            
            
            //Checking if the obtained number is an isbn number - 'mysqli_num_rows' returns number of the rows found matching the query context.
            if(mysqli_num_rows($bookQuery) == 1) {
                //Method to check if there's any books in favourites e.g. no books added to favourites, so number will remain at '0'.
                ++$isAnyBooksAddedToFavourites;
                //Fetches the query data and puts it an associative array with the database column names as the key.
                $row = mysqli_fetch_array($bookQuery);
                echo "<div class='favouriteBookContainer'>
                        <a href='bookInfo.php?isbn={$row['isbn']}' role='link' tabindex='0'><h3>{$row['bookName']}</h3></a>
                        <p class='authPosition'><strong>By</strong> {$row['author']}
                            <p><strong>Genre: </strong>{$row['genre']}
                            </p>
                        </p>
                        <p class='favouriteBookBlurbPosition'>{$row['blurb']}</p>
                    </div>";
                }
                //Checks if we're at the last element and if there's no isbn numbers found, then there's no favourite books added by the user.
                if(($isAnyBooksAddedToFavourites == 0) && ($i == (count($isbnArray) - 1))) {
                    echo "<p class='noFavouritedBooks'>No favourite books found.</p>";
                }
            
        }
      
        //Clearing the array after-use - helps prevent 
        $isbnArray = array();
        
        ?>
        
    </body>
</html>
