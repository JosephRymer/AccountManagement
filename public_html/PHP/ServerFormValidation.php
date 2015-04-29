<html>
    
<?php
print_r($_POST);
//sets Error array for injection of errors to array
  $FormError = array();
//CheckFirstName cheks using rgex to determine ifts a proper First Name
function CheckFirstName($FirstName) {
    //Checks to see if the space is empty thats its recieving from POST
    if (empty($_POST["F_Name"])) {
    $FormError['FName'] = " First Name is required";
  } else {
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["F_Name"])) {
      $FormError['FName'] = "Only letters"; 
    }
  }
}

//CheckLastName cheks using rgex to determine ifts a proper First Name
function CheckLastName($LastName) {
       //Checks to see if the space is empty thats its recieving from POST
    if (empty($_POST["L_Name"])) {
    $FormError['LName'] = "Last Name is required";
  } else {
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["L_Name"])) {
      $FormError['LName'] = "Only letters"; 
    }
    }
  }


// CheckEmail checks using regex to determine that the Email is in the correct form
function CheckEmail($Email) {
     if (empty($_POST["E_Mail"])) {
    $FormError['Email'] = "Email is required";
  } else {
    // check if e-mail address is well-formed
    if (!filter_var($_POST["E_Mail"],FILTER_VALIDATE_EMAIL)) {
      $FormError['Email'] = "Invalid email format"; 
    }
    }
  }


//CheckStreet checks to ensure that the street is a proper and right street not some wrong address with symboles in it
function CheckStreet($Street) {
    if (empty($_POST["Street"])) {
    $FormError['Street'] = "Street is Required";
  } else {
    // check if street only contains letters and certain symboles
    if (!preg_match("\d{1,5}\s\w.\s(\b\w*\b\s){1,2}\w*\.(-?)",$_POST["Street"])) {
      $FormError['Street'] = "Incorrect Street Address Format"; 
    }
    }
  }
 

//CheckCity will check the city name frokm POST to ensure it does not contain any symboles other than proper ones
function CheckCity($City) {
    //Checks to see if the space is empty thats its recieving from POST
    if (empty($_POST["City"])) {
    $FormError['City'] = "City is Required";
  } else {
    // check if City only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*(-?)$/",$_POST["City"])) {
      $FormError['City'] = "Only letters and dashes"; 
        
    }
  }
}

//CheckState checks to makre sure a state is selected in case javascipt is hacked or disabled in the Client
function CheckState($State) {
    if(!empty($_POST["State"])){
        //Since state is a dropdown all validation that is done on server side is making sure an option was selected and 
    } else {
     $FormError['State'] = "State required";    
  }
}

//CheckZipCode will check to make sure that the data it reciveves form POST is only numbers and not dashes
function CheckZipCode($ZipCode) {
    //Checks to see if the space is empty thats its recieving from POST
    if (empty($_POST["Zip_Code"])) {
    $FormError['Zip'] = "Zip Code is Required";
  } else {
    $ZipCode = test_input($_POST["Zip_Code"]);
    // check if name only contains letters and whitespace
    if (!preg_match("^\d{5}([\-]?\d{4})?$",$ZipCode)) {
      $FormError['Zip'] = "Only a 5 digit zip code or postal code please"; 
    }
  }
}
//CheckID will do a check for the data sent form $_POST to ensure that it is not empty and if it is to sned out an error
function CheckID($ID_Check){
    if(empty($_POST["ID_Type,ID_Number"])){
        $FormError['ID'] = "ID Typer and ID Number are required";
      }
}
//Check Password will make sure that the password field recieved from $_POST is not empty and if it is it sends back a error 
function CheckPass($Password){
    if(empty($_POST["Password"])){
        $FormError['P_assword'] = "Password is required";
      }
}
CheckFirstName();
print_r($FormError);
?>
</html>