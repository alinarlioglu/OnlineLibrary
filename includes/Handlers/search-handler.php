<?php


//Detects if search button has been pressed.
if(isset($_POST['search'])){
    //Fetching the searched text - will be just compared to the book information. Thus, no need for 'strip_tags' or
    //'str_replace' since this information won't be added to the database - no security breach.
    $searchedInfo = $_POST['searchText'];
    //Writes a query for searching for the particular book title within the database.
    $query = mysqli_query($connectionToDatabase, "SELECT author,bookName FROM books WHERE bookName='$searchedInfo' OR author='$searchedInfo'");
    //Checking if any rows are successfully found with the corresponding book title.
    if(mysqli_num_rows($query) != 0){
        //Creating a global session variable to use in searchList.php page.
        $_SESSION['searchedText'] = $searchedInfo;
        //Rows are found, so transferring user to the searchList.php page where the book information will be displayed.
        header("Location: searchList.php");
    }
    else {
        echo "<p class='bookNotFoundMessage'>No results matching these criteria were found.</p>";
    }
}

?>