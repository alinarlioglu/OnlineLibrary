<?php
/**
 * Description of Book
 *
 * @author Ali
 */
class Book {
    //To put any errors inside the array which will be displayed to the user.
    private $errorArray;
    //Variable to hold the connection to the database.
    private $connectToDatabase;
    //Variable to hold the string answer of whether the isbn value is changed or not, thus the loop will be re-run 
    //checking for duplicates.
    private $result;
    
    public function __construct($connectToDatabase, $result) {
        $this->errorArray = array();
        $this->connectToDatabase = $connectToDatabase;
        $this->result = $result;
    }
    
    public function setResult($result){
        $this->result = $result;
    }
    
    public function bookValidation($isbn , $author, $date, $bookName, $blurb, $genre) {
        $isbn = $this->checkIsbn($isbn);
        //If the inputted 'isbn' number is modified as it's the same as another, then the modified value is re-checked
        //through the loop for uniqueness e.g. 'isbn' modified at row 5, so need to re-check rows 1-4 that 'isbn' isn't
        //same as those values.
        if($this->result == "modified"){
            $isbn = $this->checkIsbn($isbn);
        }
        //Once re-checked and answer is unique, then all the other data's validation checks is proceeded.
        if($this->result == "unique") {
            $this->checkBookName($bookName);
        }
        
        //Checking if there's errors from the submission not meeting the requirements standard.
        if(count($this->errorArray) == 0){
            //Adding the book information into the database.
            return $this->addBookToDatabase($isbn, $author, $date, $bookName, $blurb, $genre);
        }
        else {
            //Meaning that the array contains error messages.
            return false;
        }
    }
    
    
    public function checkForErrors($error) {
        //If message isn't found inside the array, then an empty string is displayed - AKA no error message is displayed.
        if(!in_array($error, $this->errorArray)){
            $error = "";
        }
        return "<p><span class='errorMessage'>$error</span><p>";
    }
    
    
    //Validation check for isbn - making sure it isn't the same as other isbn values inside the database.
    public function checkIsbn($isbn) {
        //Query to fetch all the isbn numbers from the 'books' database.
        $isbnQuery = mysqli_query($this->connectToDatabase, "SELECT isbn FROM books");
        //Puts all the fetched isbn numbers into an array, then all the values are compared to the inputted
        //'$isbn' number for uniqueness.
        while ($isbnRow = mysqli_fetch_array($isbnQuery)) {
            if (!in_array($isbn, $isbnRow)) {
                $this->setResult("unique");
            } else {
                $isbn = mt_rand(100000, 999999);
                $this->setResult("modified");
            }
        }
        return $isbn;
    }
    
    
    //Validation check of the book title.
    public function checkBookName($bn) {
        //Checking if the book title meets the character requirement.
        if(strlen($bn) < 5 || strlen($bn) > 40){
            $bookNameLength = "Your book title must be greater than 5 characters and less than 40 characters.";
            array_push($this->errorArray, $bookNameLength);
            return;
        }
    }
    
    
    public function addErrorArray($error) {
        array_push($this->errorArray, $error);
    }
    
    
    //Inserting the book information into the database.
    public function addBookToDatabase($isbnNum, $auth, $date, $bn, $blurb, $genre) {
        //Query to insert the book information into the database.
        $insertBookQuery = mysqli_query($this->connectToDatabase, "INSERT INTO books VALUES ('$isbnNum', '$bn', '$auth', '$date', '$blurb', '$genre')");
        
        return $insertBookQuery;
    }
}

