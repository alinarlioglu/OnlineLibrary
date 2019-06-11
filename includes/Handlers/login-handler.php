<?php

//Detects when login has been pressed -> need to fetch data from the database and see if data exists.
if (isset($_POST['loginUsername'])) {
    //Fetching the typed username and password.
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];
    
    $result = $account->loginCheck($username, $password);
    
    if($result == true) {
        //Creating a global session variable. Overwrites the same name variable either if user logs in or creates an account - only one action can be taken at a time.
        $_SESSION['userLoggedIn'] = $username;
        //Transferring user to the main page.
        header("Location: index.php");
    }
}
        