<?php
    
    $result=($_POST);
    //This class is created to keep everything grouped for the checking of the Form
    class FormValidationCheck {
      
        function CheckFormFields($result) {
            
            $FormResults = array();
             //this checks to make sure that the nemae is correct using regex
            if (!preg_match("/^[a-zA-Z ]*$/",$_POST["F_Name"])) {
                $FormResults['FName'] = "First Name Must Contain only Letters";
            }
            if (!preg_match("/^[a-zA-Z ]*$/",$_POST["L_Name"])) {
                $FormResults['LName'] = "Last Name Must Contain only Letters";
            }
            if (!preg_match($_POST["E_Mail"],FILTER_VALIDATE_EMAIL)) {
                $FormResults['EMail'] = "Invalid email format";
            }
            if (!preg_match("\d{1,5}\s\w.\s(\b\w*\b\s){1,2}\w*\.(-?)",$_POST["Street"])) {
                $FormResults['S_treet'] = "Street is Required";
            }
            if (empty($_POST["City"])){
                $FormResults['C_ity'] = "City is Required";
            }
            if (!preg_match("^\d{5}([\-]?\d{4})?$",$_POST["Zip_Code"])) {
                $FormResults['Zip'] = "Zipcode must contain 5 digits and no Letters";
            }
             if (empty($_POST["ID_Type,ID_Number"])) {
                $FormResults['ID'] = "ID Type and ID Number are Required";
            }
             if (empty($_POST["Password"])) {
                $FormResults['Zip'] = "Password is Required";
            }
             
             return $FormResults;
        }
    }
$check= new FormValidationCheck;

        
$FormValidation = $check->CheckFirstName("Test");



echo $FormValidation['FName'];
echo $FormValidation['LName'];
?>
