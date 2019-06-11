<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php   
//Copy and pasting all the needed code for this section into here e.g. fetching the data, creating 'Account' class
//validating the data, adding the data to the database, taking user into main page once all data is sorted etc.

//1 - Connecting to the relevant database, thus account registration information can be added to the database.
include("includes/database/config.php");

//2 - Creates account class with methods validating the data and sending error messages to the screen if requirement not met.
include("includes/classes/Account.php");

//Account instance is initialised as soon as this web page is loaded by a user. Enables to check the 
$account = new Account($connectionToDatabase);

//3 - Fetches & cleans the data, then uses the 'Account' class instance's methods to check the data & add it to the 
//database as well as sorting out the error messages.
include("includes/Handlers/register-handler.php");
//4 - Comparing typed data to the existing username and passwords in the database and confirming if user can log in.
include("includes/Handlers/login-handler.php");
//5 - creating a session, so the username of the logged in/registered person can be saved throughout the web pages,
//thus making it seem as if the user is constantly logged in to their account. 

//6 - User will be re-directed to this page if the session variable hasn't been initialised = user hasn't logged in or
//created an account. Thus, users are forced to register/login to go the main page and interact with the website.

//7 - creating the books database and adding data to it manually.

//8 - creating a book searching function in the main page (index.php).

//9 - creating an HTML/PHP page to return the results of the search e.g. like in RoyalRoad.
       
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
        <title>World of Knowledge</title>
    </head>
    <body>
        <div>
            <form action="register.php" method="POST">
                <h2>Login to your account</h2>
                <p>
                    <?php echo $account->checkIfErrorInsideArray("Please enter a valid username and password.")  ?>
                    <label for="loginUsername">Username</label>
                    <input id="loginUsername" name="loginUsername" type="text" placeholder="Enter your username">
                </p>
                <p>
                    <label for="loginPassword">Password</label>
                    <input id="loginPassword" name="loginPassword" type="password">
                </p>
                <button type="submit" name="login">Login</button>
            </form>    
                
                
            <form action="register.php" method="POST">    
                <h2>Register</h2>
                <p>
                    <?php echo $account->checkIfErrorInsideArray("This username already exists.")  ?>
                    <?php echo $account->checkIfErrorInsideArray("Your username should be greater than 3 characters.")  ?>
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" placeholder="Enter a username" value="<?php getInputValue('username'); ?>" required>
                </p>
                <p>
                    <?php echo $account->checkIfErrorInsideArray("Your 'First Name' field should contain more than 2 characters.")  ?>
                    <label for="firstName">First Name</label>
                    <input id="firstName" name="firstName" type="text" placeholder="Enter your first name" value="<?php getInputValue('firstName'); ?>" required>
                </p>
                <p>
                    <?php echo $account->checkIfErrorInsideArray("Your 'Last Name' field should contain more than 2 characters.")  ?>
                    <label for="lastName">Last Name</label>
                    <input id="lastName" name="lastName" type="text" placeholder="Enter your surname" value="<?php getInputValue('lastName'); ?>" required>
                </p>
                <p>
                    <?php echo $account->checkIfErrorInsideArray("Please enter a matching email.")  ?>
                    <?php echo $account->checkIfErrorInsideArray("Please enter a valid email.")  ?>
                    <?php echo $account->checkIfErrorInsideArray("This email already exists.")  ?>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="<?php getInputValue('email'); ?>" required>
                </p>
                <p>
                    <label for="email2">Confirm Email</label>
                    <input id="email2" name="email2" type="email" value="<?php getInputValue('email2'); ?>" required>
                </p>
                <p>
                    <?php echo $account->checkIfErrorInsideArray("Please enter a matching password.")  ?>
                    <?php echo $account->checkIfErrorInsideArray("Please enter a password with more than 6 characters.")  ?>
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password">
                </p>
                <p>
                    <label for="password2">Confirm Password</label>
                    <input id="password2" name="password2" type="password">
                </p>
                <button type="submit" name="signup">Sign Up</button>
            </form>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
