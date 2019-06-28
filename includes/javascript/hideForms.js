//Checking if everything for the page is loaded e.g. all PHP code, HTML, CSS etc.
//Below code is run, once everything has been loaded.
$(document).ready(function() {
    //Creating a jQuery object to manipulate the front-end HTML display.
    //Checking if user has clicked onto the 'span' with 'id="hideLogin"'.
    $("#hideLogin").click(function() {
        //Hiding the login form and showing the register form.
        $("#loginContainer").hide();
        $("#registerContainer").show();
    });
    
    $("#hideRegister").click(function() {
        $("#loginContainer").show();
        $("#registerContainer").hide();
    });
});