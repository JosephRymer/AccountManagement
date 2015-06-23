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
                $FormResults['Pass'] = "Password is Empty";
            }else if($data["Password"]===$data["Confirm_Password"]){
                $FormResults['Pass']="Passwords do NOT match";
            }
              return $FormResults;
            
        
        }   
         
    }
    
        
    $check= new FormValidationCheck($conn);
    
    $check->CheckFormFields($data);
    $FormResults=$check->CheckFormFields($data);
    print_r($FormResults);
    //If the data is all ok adn there was no errors in the array then it is passed to  Reader_Editor.php for insert else it will send back with a variable which AccountCreation interprets
    if(empty($FormResults)){
     $_SESSION["POSTData"]=$data;
     header("location:Reader_Editor.php?accountinsert=1");
    }else{ 
        $_SESSION['data']=$data;
        $_SESSION['formerrors']=$FormResults;
        print_r ($_SESSION['data']);
     header("location:../AccountCreation.php?baddata=1");
    }
?>
