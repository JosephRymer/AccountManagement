<?php
    include_once("dbConnect.php");
    $result=($_POST);
    //This class is created to keep everything grouped for the checking of the Form
    class FormValidationCheck {
        
        public $connection;
        function  __construct($connection){
            
            $connection = $this->connection;
            
        }
        
        function CheckFormFields($result) {
            
            
            $FormResults = array();
             //the following checks use rejex to check to make sure their valid before they go to SQL query
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
            //this returns the array so it can print the errors in a js box for users notifacation of what fields wheir incorrect
             return $FormResults;
        }
        
        function saveuserdata($result){
            
            if(empty($FormResults)){
                $username=$this->generateUsername($result);
                $expirationdate=$this->generateExpirationDate($reult);
                //echo $username."<br>";
               // echo $expirationdate."<br>";                
                
                $sql="INSERT INTO `users`(`firstname`,`lastname`,`email`,`idnumber`,`idtype`,`username`,`password`,`street`,`city`,`state`,`zipcode`,`creationdate`,`expireddate`,`createdby`,`comments`)
                     values('".$F_Name."','".$L_Name."','".$E_Mail."','".$ID_Number."','".$ID_Type."','".$username."',PASSWORD('".$Password."'),'".$Street."','".$City."','".$State."','".$Zip_Code."',(UNIX_TIMESTAMP(NOW()))
                         '".$expirationdate."')";
            }else{
                echo $formResults;
            }
           
        }
        
        public function generateUsername($result){
          $username=substr($result['F_Name'],0,1).$result['L_Name'].rand(1000,9999);          
        }
        
        public function generateExpirationDate($result){
            $startDate=time();
            if($result['numdays']=='30'){
                $expirationdate = strtotime('+1 month',$startDate); 
                }else if($result['numdays']=='60'){
                    $expirationdate = strtotime('+2 month',$startDate); 
                    }else{
                        $expirationdate = strtotime('+3 month',$startDate); 
                         }
                    echo $expirationdate;     
                    }
        
    }
$check= new FormValidationCheck;
$user=new FormValidationCheck($conn);
        
$FormValidation = $check->CheckFormFields("Test");
echo $user->generateUsername($result)."<br>";

echo $user->generateExpirationDate($result);

?>
