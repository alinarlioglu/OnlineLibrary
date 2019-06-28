<?php
//Needed to connect to the database & username session variable - currently we're in 'ajax' folder since 'updateBookmarks' is
//located there. To reach the database connection - go back one folder, so we're in 'includes', then go to 'database' folder 
//& now we have reached the databasse connection 'config.php'.
include("../database/config.php");


//Checking if the AJAX call's variable to hold the data is set to a value. AJAX call in 'bookInfo.php'.
//'$_POST' is used because we submitted the AJAX call as a 'post' method e.g '$.post(...)'.
if(isset($_POST['isbn'])){
    //To add to the playlist.
    $bookISBN = $_POST['isbn'];
    //Obtaining username session variable as we have 'session_start' in here due to 'config.php' allowing us to use the
    //global session variables in this page. Required to identify the user & add the corresponding book to their playlist.
    $user = $_SESSION['userLoggedIn'];
    
    //Fetching the old playlist.
    $playlistQuery = mysqli_query($connectionToDatabase, "SELECT playlist FROM account WHERE username='$user'");
    //Putting the playlist's JSON string repesentation into an associative array.
    $playlistResult = mysqli_fetch_array($playlistQuery);
    //Converting the playlist JSON string object into a PHP object. Encode converts to JSON string object. Decode converts JSON string object to PHP object.
    //Preventing 'json_encode' from turning the array into an associative array when inserted to the database via 'array_values'.
    $playlist = json_encode(array_values($playlistResult));
    $playlist = json_decode($playlist);
    
    
    
    //Converting the PHP object into an array via casting - can be done using 'get_object_vars' as well.
    $array = (array) $playlist;
    //Adding the book's ISBN number to the playlist.
    array_push($array, $bookISBN);
    
    
    //Removes duplicate arrays inside the array indexes, so the user cannot add more than one same isbn and helps reduce limited space occupied by the array - more favourites space.
    $array = array_map('unserialize', array_unique(array_map('serialize', $array)));
    
    
    //Updating the playlist data in the database to the latest playlist array.
    //To add to array to a database, you have to convert it to an JSON string object.
    $playlistArrayToDatabase = json_encode(array_values($array));
    //Clearing the playlist data.
    $clearPlaylistData = mysqli_query($connectionToDatabase, "UPDATE account SET playlist='[]' WHERE username='$user'");
    //Inserting the new playlist.
    $newPlaylistQuery = mysqli_query($connectionToDatabase, "UPDATE account SET playlist='$playlistArrayToDatabase' WHERE username='$user'");
    
    
    //Return function which passes the 'playlistArray' to the 'isIsbnAddedToPlaylist' variable in the AJAX call.
    echo $playlistArrayToDatabase;
}
