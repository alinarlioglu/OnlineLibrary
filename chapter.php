<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
//Pasting the code for the database connection & username etc...
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
        <link rel="stylesheet" type="text/css" href="includes/styles/chapter.css">
        
        
    </head>
    <body>
        <?php
        //Pasting the HTML code for the navigation bar.
        include("includes/navigationBar.php");
        
        
        //Checking if the page is set to an chapter ID specifically, so the book chapter can be specifically opened up in this page.
        if($_GET['id']){
            $chapterId = $_GET['id'];
            
            //Fetching the chapter description.
            $chapterDesc = mysqli_query($connectionToDatabase, "SELECT description FROM chapters WHERE id='$chapterId'");
            //Putting the fetched chapter description into an associative array.
            $data = mysqli_fetch_array($chapterDesc);
            
            echo $data['description'];
        }
        ?>
    </body>
</html>
