<?php
//Turns on the buffering, so data can be sent to the server which can be added to the database once all the data is received.
ob_start();
//Making a variable global across all web pages by creating a session.
session_start();
//Sets the timezone for the program which is used to set the user's signUpDate and add it to the database.
$timezone = date_default_timezone_set("Europe/London");
//Connecting to the relevant database - server name, username (server), password (for database entry), database name.
$connectionToDatabase = mysqli_connect("localhost", "root", "", "onlinelibrary");

//Testing if the connection works or not.
if(mysqli_connect_errno()){
    echo "Failed to connect " . mysqli_connect_errno();
}

?>