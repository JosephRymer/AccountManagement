<?php
    require_once("dbConnect.php");
     $data = ($_POST);
     
    //This class is created to keep everything grouped for the checking of the Form
    class FormValidationCheck {
                
        public $conn;
        
        function __construct($conn) {
            $this->conn = $conn;
        }
        
       public function CheckFormFields($data) {
             
            $FormResults = array();
            if (!preg_match("/^[a-zA-Z ]*$/",$data["F_Name"])) {
                $FormResults['FName'] = "1";
            }
            if (!preg_match("/^[a-zA-Z ]*$/",$data["L_Name"])) {
                $FormResults['LName'] = "1";
            }
            if (!preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/",$data["E_Mail"])) {
                $FormResults['EMail'] = "1";
            }
            if (!preg_match("/^\s*\S+(?:\s+\S+){2}$/",$data["Street"])) {
                $FormResults['S_treet'] = "1";
            }
            if (empty($data["City"])){
                $FormResults['C_ity'] = "1";
            }
            if (!preg_match("/^\d{5}([\-]?\d{4})?$/",$data["Zip_Code"])) {
                $FormResults['Zip'] = "1";
            }
             if (empty($data["ID_Type"])) {
                $FormResults['ID'] = "1";
            }
            if (empty($data["ID_Number"])) {
                $FormResults['IDN'] = "1";
            }
             if (empty($data["Password"])) {
                $FormResults['Pass'] = "1";
            }
              return $FormResults;
            
        
        }   
         
    }
    
        
    $check= new FormValidationCheck($conn);
    
    $check->CheckFormFields($data);
    $FormResults=$check->CheckFormFields($data);
    print_r($FormResults);
    if(empty($FormResults)){
     $_SESSION["POSTData"]=$data;
     header("location:Reader_Editor.php");
    }else{  
     header("location:../AccountCreation.php?baddata=1");
    }
?>
