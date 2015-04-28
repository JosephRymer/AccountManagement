<?php 
//CheckFirstName cheks using rgex to determine ifts a proper First Name
function CheckFirstName($FirstName) {
    //Checks to see if the space is empty thats its recieving from POST
    if (empty($_POST["F_Name"])) {
    $nameError = " First Name is required";
  } else {
    $name = test_input($_POST["F_Name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameError = "Only letters"; 
    }
  }
}

//CheckLastName cheks using rgex to determine ifts a proper First Name
function CheckLastName($LastName) {
       //Checks to see if the space is empty thats its recieving from POST
    if (empty($_POST["L_Name"])) {
    $nameError = "Last Name is required";
  } else {
    $Lname = test_input($_POST["L_Name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$LName)) {
      $nameError = "Only letters"; 
    }
  }
}

// CheckEmail checks using regex to determine that the Email is in the correct form
function CheckEmail($Email) {
     if (empty($_POST["E_Mail"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["E_Mail"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
}

//CheckStreet checks to ensure that the street is a proper and right street not some wrong address with symboles in it
function CheckStreet($Street) {
    if (empty($_POST["Street"])) {
    $nameError = "Street is Required";
  } else {
    $Street = test_input($_POST["Street"]);
    // check if name only contains letters and certain symboles
    if (!preg_match("\d{1,5}\s\w.\s(\b\w*\b\s){1,2}\w*\.(-?)",$Street)) {
      $nameError = "Incorrect Street Address Format"; 
    }
  }
}   

//CheckCity will check the city name frokm POST to ensure it does not contain any symboles other than proper ones
function CheckCity($City) {
    //Checks to see if the space is empty thats its recieving from POST
    if (empty($_POST["City"])) {
    $nameError = " City is Required";
  } else {
    $PCity = test_input($_POST["City"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*(-?)$/",$PCity)) {
      $nameError = "Only letters and dashes no "; 
    }
  }
}

//CheckState checks to makre sure a state is selected in case javascipt is hacked or disabled in the Client
function CheckState($State) {
    
    
}

//CheckZipCode will check to make sure that the data it reciveves form POST is only numbers and not dashes
function CheckZipCode($ZipCode) {
    
    
}

?>