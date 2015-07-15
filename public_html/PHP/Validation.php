<?php

require_once("dbConnect.php");

class FormValidationCheck {

    public $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    function CheckAccountFormFields() {

        global $accounterrors;
        if (!preg_match("/^[a-z ,.'-]+$/i", $_POST["F_Name"])) {
            $accounterrors['FName'] = "First Name";
        }
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["L_Name"])) {
            $accounterrors['LName'] = "Last Name";
        }
        if (!preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $_POST["E_Mail"])) {
            $accounterrors['EMail'] = "Email";
        }
        if (empty($_POST["Street"])) {
            $accounterrors['S_treet'] = "Street";
        }
        if (empty($_POST["City"])) {
            $accounterrors['C_ity'] = "City";
        }
        if (!preg_match("/^\d{5}([\-]?\d{4})?$/", $_POST["Zip_Code"])) {
            $accounterrors['Zip'] = "ZipCode";
        }
        if (empty($_POST["ID_Type"])) {
            $accounterrors['ID'] = "ID Type";
        }
        if (empty($_POST["ID_Number"])) {
            $accounterrors['IDN'] = "ID Number";
        }
        if (strcasecmp($_POST["Password"], $_POST["confirmpassword"])) {
            $accounterrors['Pass'] = "Passwords do NOT match";
        }
        return $accounterrors;
    }

    function CheckUserFormFields() {
        global $usererrors;
        if (!preg_match("/^[a-z ,.'-]+$/i", $_POST["F_Name"])) {
            $usererrors['FName'] = "First Name";
        }
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["L_Name"])) {
            $usererrors['LName'] = "Last Name";
        }
        if (!preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $_POST["E_Mail"])) {
            $usererrors['EMail'] = "Email";
        }
        if (strcasecmp($_POST["Password"], $_POST["confirmpassword"])) {
            $usererrors['Pass'] = "Passwords do NOT match";
        }
        return $usererrors;
    }

    function CheckProfileFields($data) {
        global $profileerrors;
        if (!preg_match("/^[a-z ,.'-]+$/i", $data['firstname'])) {
            $profileerrors['FName'] = "First Name";
        }
        if (!preg_match("/^[a-z ,.'-]+$/i", $data['lastname'])) {
            $profileerrors['LName'] = "Last Name";
        }
        if (!preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $data["email"])) {
            $profileerrors['Email'] = "Email";
        }
        if (strcasecmp($data["password"], $data["confirmpassword"])) {
            $profileerrors['Passwords'] = "Passwords do NOT Match";
        }
        return $profileerrors;
    }
    function CheckUserUpdateFields($data) {
        global $profileerrors;
        if (!preg_match("/^[a-z ,.'-]+$/i", $data['firstname'])) {
            $profileerrors['FName'] = "First Name";
        }
        if (!preg_match("/^[a-z ,.'-]+$/i", $data['lastname'])) {
            $profileerrors['LName'] = "Last Name";
        }
        if (!preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $data["email"])) {
            $profileerrors['Email'] = "Email";
        }
        if($data['admin']){
            
        } 
        return $profileerrors;
    }


}

?>
