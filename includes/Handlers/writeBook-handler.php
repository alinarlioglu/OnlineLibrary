<?php
//Detecting if 'Submit' button is clicked.
if(isset($_POST['submitBook'])) {
    //Fetching the data.
    $isbn = mt_rand(100000, 999999);
    //Works as it can see 'config.php' which contains the 'session_start' - can see from it's interaction in 'writeBook.php'.
    $author = $_SESSION['userLoggedIn'];
    $date = date("Y-m-d");
    $bookName = $_POST['bookName'];
    $blurb = $_POST['blurb'];
    
    
    //Cleaning the data from any HTML tags inserted - security against hackers.
    $bookName = strip_tags($bookName);
    $blurb = strip_tags($blurb);
    //Checking if a value has been selected from the dropdown list. 
    if(isset($_POST['genre'])){
        //Assigning the value selected to a variable to be inserted into the database.
        $genre = $_POST['genre'];
        //Boolean to verify for errors.
        $isThereErrorsInErrorArray = $book->bookValidation($isbn, $author, $date, $bookName, $blurb, $genre);
    }
    else {
        $errorGenre = "Please select a genre.";
        $book->addErrorArray($errorGenre);
    }
}
?>

