<?php
    require_once("dbConnect.php");
     $data = ($_POST);
     
    //This class is created to keep everything grouped for the checking of the Form
    class FormValidationCheck {
                
        public $conn;
        
        function __construct($conn) {
            $this->conn = $conn;
        }
        
        function CheckFormFields($data) {
             
            $FormResults = array();
             //the following checks use rejex to check to make sure their valid before they go to databaseInjection function
            if (!preg_match("/^[a-zA-Z ]*$/",$data["F_Name"])) {
                $FormResults['FName'] = "First Name Must Contain only Letters";
            }
            if (!preg_match("/^[a-zA-Z ]*$/",$data["L_Name"])) {
                $FormResults['LName'] = "Last Name Must Contain only Letters";
            }
            if (!filter_var($data["E_Mail"],FILTER_VALIDATE_EMAIL)) {
                $FormResults['EMail'] = "Invalid email format";
            }
            if (!preg_match("/\d{1,5}\s\w.\s(\b\w*\b\s){1,2}\w*\.(-?)/",$data["Street"])) {
                $FormResults['S_treet'] = "Street is Required";
            }
            if (empty($data["City"])){
                $FormResults['C_ity'] = "City is Required";
            }
            if (!preg_match("/^\d{5}([\-]?\d{4})?$/",$data["Zip_Code"])) {
                $FormResults['Zip'] = "Zipcode must contain 5 digits and no Letters";
            }
             if (empty($data["ID_Type,ID_Number"])) {
                $FormResults['ID'] = "ID Type and ID Number are Required";
            }
             if (empty($data["Password"])) {
                $FormResults['Zip'] = "Password is Required";
            }
            
               return $FormResults;
            
          //  return $data;
        }   
        
    }
    
        
    $check= new FormValidationCheck($conn);
    $check->CheckFormFields($data);
    
   //header('location:Reader_Editor.php');
?>
