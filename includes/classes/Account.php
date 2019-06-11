<?php

/**
 * Description of Account
 *
 * @author Ali
 */
class Account {
    //Array to hold all the confirmed errors which will be displayed to the user.
    private $errorArray;
    //Variable to hold the connection to the database.
    private $connToDatabase;
    
    public function __construct($connToDatabase) {
        //Initialising the errorArray
        $this->errorArray = array();
        $this->connToDatabase = $connToDatabase;
    }
    
    //Checks if the username and password exists in the database. Uses password_verify to confirm the entered password is correct.
    public function loginCheck($user, $pass){
        //Checks if the username has the same corresponding password - AND defines a single row, so one user must have both information - not two separate users.
        $checkIfUserExists = mysqli_query($this->connToDatabase, "SELECT * FROM account WHERE username='$user'");
        //Executes the query and see's if any rows show up with the corresponding data.
        if(mysqli_num_rows($checkIfUserExists) == 0) {
            $userDetailsIncorrect = "Please enter a valid username and password.";
            array_push($this->errorArray, $userDetailsIncorrect);
            return;
        }
        
        //First 'if' statement has failed, thus there is an existing matching user.
        //Fetches the actual hashed password data from the database, then uses password_verify to 
        //see if the combined hash password and typed password match.
        $statement = mysqli_query($this->connToDatabase, "SELECT password FROM account WHERE username='$user'");mysqli_fetch_row();
        if(mysqli_num_rows($checkIfUserExists) == 1){
            //Returns the data as an array e.g. SELECT username, password FROM.....
            //would return 'array(usernameData, passwordData)' thus allowing access to the data e.g. array[0].
            $result = mysqli_fetch_row($statement);
            //Typed password and the combined string hashed password match.
            if(password_verify($pass, $result[0]) == true){
                return true;
            }
        }
    }
    
    public function dataCheck($un, $fn, $ln, $em, $em2, $pw, $pw2) {
        //Checking that the registration requirements are met e.g. length, matching emails/passwords etc.
        $this->checkUsername($un);
        $this->checkFirstName($fn);
        $this->checkLastName($ln);
        $this->checkEmail($em, $em2);
        $this->checkPassword($pw, $pw2);
        
        //Counts number of error messages in the array. If none, then the checks were a success.
        if(count($this->errorArray) == 0){
            //Adds the information to the database.
            return $this->addToDatabase($un, $fn, $ln, $em, $pw);
        }
        else {
            //Meaning that the array contains error messages.
            return false;
        }
    }
    
    private function addToDatabase($un, $fn, $ln, $em, $pw) {
        //Creates a random hash function and inputs it with the password, then enters the combined string to the database.
        //Requires password_verify to decrypt the combined string hashed password -> excellent secure way as user cannot
        //login until the password is verified even if combined string is written correctly.
        $pw_hash = password_hash($pw, PASSWORD_BCRYPT);
        $date = date("Y-m-d");
        
        $query = mysqli_query($this->connToDatabase, "INSERT INTO account VALUES ('', '$un', '$fn', '$ln', '$em', '$pw_hash', '$date')");
    
        return $query;
    }
    
    public function checkIfErrorInsideArray($error){
        //If message isn't found inside the array, then an empty string is displayed - AKA no error message is displayed.
        if(!in_array($error, $this->errorArray)){
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }
    
    public function checkUsername($un){
        //Length of username should be greater than 2.
        if(strlen($un)<3){
            $usernameCharacterRequirement = "Your username should be greater than 3 characters.";
            //Adding the error message to the errorArray.
            array_push($this->errorArray, $usernameCharacterRequirement);
            return;
        }
        
        //Creating a query to check if any same email exists in the database.
        $query = mysqli_query($this->connToDatabase, "SELECT * FROM account WHERE username='$un'");
        //Executing the query and seeing the number of rows returned AKA users.
        if(mysqli_num_rows($query) != 0){
            $emailAlreadyExists = "This username already exists.";
            array_push($this->errorArray, $emailAlreadyExists);
            return;
        }
    }
    
    public function checkFirstName($fn) {
        if(strlen($fn)<2){
            $firstNameCharacterRequirement = "Your 'First Name' field should contain more than 2 characters.";
            array_push($this->errorArray, $firstNameCharacterRequirement);
            return;
        }
    }
    
    public function checkLastName($ln){
        if(strlen($ln)<2){
            $lastNameCharacterRequirement = "Your 'Last Name' field should contain more than 2 characters.";
            array_push($this->errorArray, $lastNameCharacterRequirement);
            return;
        }
    }
    
    public function checkEmail($em, $em2) {
        //Checking that emails match together.
        if($em != $em2){
            $emailsNotMatch = "Please enter a matching email.";
            array_push($this->errorArray, $emailsNotMatch);
            return;
        }
        
        //Checking that the email is in the correct format e.g. myEmail@today.com instead of myEmail@asdasd.
        if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
            $invalidEmail = "Please enter a valid email.";
            array_push($this->errorArray, $invalidEmail);
            return;
        }
        
        //Creating a query to check if any same email exists in the database.
        $query = mysqli_query($this->connToDatabase, "SELECT * FROM account WHERE email='$em'");
        //Executing the query and seeing the number of rows returned AKA users.
        if(mysqli_num_rows($query) != 0){
            $emailAlreadyExists = "This email already exists.";
            array_push($this->errorArray, $emailAlreadyExists);
            return;
        }
    }
    
    public function checkPassword($pw, $pw2) {
        //Checking that password and confirmed password match.
        if($pw != $pw2) {
            $passwordsDoNotMatch = "Please enter a matching password.";
            array_push($this->errorArray, $passwordsDoNotMatch);
            return;
        }
        
        //Checking to make sure that the password has more than 8 characters.
        if(strlen($pw)<6) {
            $passwordLengthIssue = "Please enter a password with more than 6 characters.";
            array_push($this->errorArray, $passwordLengthIssue);
            return;
        }
    }
}
