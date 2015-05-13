<?php
    require_once("dbConnect.php");
     $data = ($_POST);
     
    //This class is created to keep everything grouped for the checking of the Form
    class FormValidationCheck {
                
        public $conn;
        public $FormResults = array();
        function __construct($conn) {
            $this->conn = $conn;
        }
        
        function CheckFormFields($data) {
             
            
             //the following checks use rejex to check to make sure their valid before they go to databaseInjection function
            if (!preg_match("/^[a-zA-Z ]*$/",$data["F_Name"])) {
                $this->FormResults['FName'] = "First Name Must Contain only Letters";
            }
            if (!preg_match("/^[a-zA-Z ]*$/",$data["L_Name"])) {
                $this->FormResults['LName'] = "Last Name Must Contain only Letters";
            }
            if (!filter_var($data["E_Mail"],FILTER_VALIDATE_EMAIL)) {
                $this->FormResults['EMail'] = "Invalid email format";
            }
            if (!preg_match("/^\s*\S+(?:\s+\S+){2}$/",$data["Street"])) {
                $this->FormResults['S_treet'] = "Street is Required";
            }
            if (empty($data["City"])){
                $this->FormResults['C_ity'] = "City is Required";
            }
            if (!preg_match("/^\d{5}([\-]?\d{4})?$/",$data["Zip_Code"])) {
                $this->FormResults['Zip'] = "Zipcode must contain 5 digits and no Letters";
            }
             if (empty($data["ID_Type"])) {
                $this->FormResults['ID'] = "ID Type is Required";
            }
            if (empty($data["ID_Number"])) {
                $this->FormResults['IDN'] = "ID Number is Required";
            }
             if (empty($data["Password"])) {
                $this->FormResults['Pass'] = "Password is Required";
            }
            print_r($this->FormResults);
               return $this->FormResults;
            
        
        }   
        
    }
    
        
    $check= new FormValidationCheck($conn);
    
    $check->CheckFormFields($data);
    if(empty($check->FormResults)){
        $_SESSION["POSTData"]=$data;
     header("location:Reader_Editor.php");
    }else{
        $former=$check->FormResults;
        $_SESSION["FormErrors"]=$former;
        header("location:../AccountCreation.html?BadData=1");
    }
?>
