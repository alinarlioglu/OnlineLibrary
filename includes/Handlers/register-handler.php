<?php

function fetchAndCleanData($input) {
    //Removing any added undetected HTML tags against hackers.
    $input = strip_tags($input);
    //Replacing any spaces with empty character - for database addition.
    $input = str_replace(" ", "", $input);
    
    return $input;
}

function cleanPassword($input) {
    //Removing any added undetected HTML tags against hackers.
    $input = strip_tags($input);
    //No need to replace empty characters in a password as passwords can contain empty characters
    //if the user desires.
    
    return $input;
}

//Detects when 'Sign Up' button has been pressed and fetches the typed text.
if (isset($_POST['signup'])) {
    //Fetching all the relevant typed text for registration.
    $un = $_POST['username'];
    $fn = $_POST['firstName'];
    $ln = $_POST['lastName'];
    $em = $_POST['email'];
    $em2 = $_POST['email2'];
    $pw = $_POST['password'];
    $pw2 = $_POST['password2'];

    //Cleaning the data against hackers and unneeded spaces.
    $username = fetchAndCleanData($un);
    $firstName = fetchAndCleanData($fn);
    $lastName = fetchAndCleanData($ln);
    $email = fetchAndCleanData($em);
    $email2 = fetchAndCleanData($em2);
    $password = cleanPassword($pw);
    $password2 = cleanPassword($pw2);

    //Checking/Validating the data and adding it to the database as well as sorting out registration requirements.
    //dataCheck validates all data & adds it to the database if requirements are met.
    $isThereAnyErrorMessages = $account->dataCheck($username, $firstName, $lastName, $email, $email2, $password, $password2);

    //User data added to the database and all data confirmed. Thus, take user into the main page.
    if($isThereAnyErrorMessages != false) {
        //Creating a global session variable. Overwrites the same name variable either if user logs in or creates an account - only one action can be taken at a time.
        $_SESSION['userLoggedIn'] = $username;
        //Transferring user to main page.
        header("Location: index.php");
    }
}
