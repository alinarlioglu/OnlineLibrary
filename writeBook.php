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
//Class containing methods to validate the data.
include("includes/classes/Book.php");
//An instance of book is initialised whenever a user accesses this page.
$book = new Book($connectionToDatabase, "z");

//Handling all the data fetching and cleaning. Then, passing the data to the validation methods in '$book' object.
include("includes/Handlers/writeBook-handler.php");



//Function to remember the entered input values for each field when 'Sign Up' is clicked.
function getInputValue($name) {
    //Checks if any data is typed into the given input field when 'Sign up' button is pressed. If data is set 
    //to the field, then the data is simply re-written to the field again, thus field 'remembers' entered previous text.
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>World of Knowledge | Write</title>
        <link rel="stylesheet" type="text/css" href="includes/styles/navigation-bar.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/logoContainerStyle.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/writeBook.css">
        <link rel="stylesheet" type="text/css" href="includes/styles/dropdown.css">
        
        
        
    </head>
    <body>
        
        
        <!--Copying and pasting the HTML code for the navigationBar to here.-->
        <?php include("includes/navigationBar.php") ?>
            
        <div class="writeBook">
            <form id="submitFiction" action="writeBook.php" method="POST">
                <p>
                    <?php echo $book->checkForErrors("Your book title must be greater than 5 characters and less than 40 characters."); ?>
                    <label for="bookName">Book Title</label>
                    <input id="bookName" type="text" name="bookName" placeholder="Enter book title" value="<?php getInputValue('bookName'); ?>" required>
                </p>
                <p>
                    <?php echo $book->checkForErrors("Please select a genre."); ?>
                    <select id="genre" name="genre">
                        <option value="" disabled selected>Genre</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Adventure">Adventure</option>
                    </select>
                </p>
                <p>
                    <label for="blurb">Description</label>
                    <textarea id="blurb" rows="4" cols="50" type="text" name="blurb" placeholder="Enter story details..." value="<?php getInputValue('blurb'); ?>"></textarea>
                </p>
                <button type="submit" name="submitBook">Submit</button>
            </form>
        </div>
    </body>
</html>
