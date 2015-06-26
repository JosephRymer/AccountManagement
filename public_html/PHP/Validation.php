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
            if (!preg_match("/^[a-zA-Z ]*$/",$data["F_Name"])) {
                $FormResults['FName'] = "First Name";
            }
            if (!preg_match("/^[a-zA-Z ]*$/",$data["L_Name"])) {
                $FormResults['LName'] = "Last Name";
            }
            if (!preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/",$data["E_Mail"])) {
                $FormResults['EMail'] = "Email";
            }
            if (empty($data["Street"])) {
                $FormResults['S_treet'] = "Street";
            }
            if (empty($data["City"])){
                $FormResults['C_ity'] = "City";
            }
            if (!preg_match("/^\d{5}([\-]?\d{4})?$/",$data["Zip_Code"])) {
                $FormResults['Zip'] = "ZipCode";
            }
             if (empty($data["ID_Type"])) {
                $FormResults['ID'] = "ID Type";
            }
            if (empty($data["ID_Number"])) {
                $FormResults['IDN'] = "ID Number";
            }
             if ($data["Password"] !== $data["confirmpassword"]) {
                $FormResults['Pass'] = "Passwords do NOT match";
            }
              return $FormResults;
            
        
        } 
         function CheckUserFormFields($data){
            if (!preg_match("/^[a-zA-Z ]*$/",$data["F_Name"])) {
                $UserFormResults['FName'] = "First Name";
            }
            if (!preg_match("/^[a-zA-Z ]*$/",$data["L_Name"])) {
                $UserFormResults['LName'] = "Last Name";
            }
            if (!preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/",$data["E_Mail"])) {
                $UserFormResults['EMail'] = "Email";
            }
            if ($data["Password"] !== $data["confirmpassword"]) {
                $UserFormResults['Pass'] = "Passwords do NOT match";
            }
             return $UserFormResults;
         }
         
    }
    
        
    $check= new FormValidationCheck($conn);
    if(isset($_GET['userform'])){
    $check->CheckUserFormFields($data);

$UserFormResults=$check->CheckUserFormFields($data);
if(empty($UserFormResults)){
     $_SESSION["ValidUserData"]=$data;
     unset($_SESSION['formerrors']);
     unset($_SESSION['formdata']);
     unset($_SESSION['userformdata']);
     unset($_SESSION['userformerrors']);        
     header("location:Reader_Editor.php");
    }else{ 
        unset($_SESSION['formerrors']);
        unset($_SESSION['formdata']);
        $_SESSION['userformdata']=$data;
        $_SESSION['userformerrors']=$UserFormResults;
        
     header("location:../UserCreation.php");
    }
    }else{
$check->CheckFormFields($data);
    $FormResults=$check->CheckFormFields($data);
    

    
    
    //If the data is all ok adn there was no errors in the array then it is passed to  Reader_Editor.php for insert else it will send back with a variable which AccountCreation interprets
    if(empty($FormResults)){
     $_SESSION["ValidData"]=$data;
     unset($_SESSION['formerrors']);
     unset($_SESSION['formdata']);
     header("location:Reader_Editor.php");
    }else{ 
        $_SESSION['formdata']=$data;
        $_SESSION['formerrors']=$FormResults;
        
     header("location:../AccountCreation.php?baddata=1");
    }
    }
?>
