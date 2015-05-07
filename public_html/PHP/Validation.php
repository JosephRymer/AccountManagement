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
            if (!preg_match($data["E_Mail"],FILTER_VALIDATE_EMAIL)) {
                $FormResults['EMail'] = "Invalid email format";
            }
            if (!preg_match("\d{1,5}\s\w.\s(\b\w*\b\s){1,2}\w*\.(-?)",$data["Street"])) {
                $FormResults['S_treet'] = "Street is Required";
            }
            if (empty($data["City"])){
                $FormResults['C_ity'] = "City is Required";
            }
            if (!preg_match("^\d{5}([\-]?\d{4})?$",$data["Zip_Code"])) {
                $FormResults['Zip'] = "Zipcode must contain 5 digits and no Letters";
            }
             if (empty($data["ID_Type,ID_Number"])) {
                $FormResults['ID'] = "ID Type and ID Number are Required";
            }
             if (empty($data["Password"])) {
                $FormResults['Zip'] = "Password is Required";
            }
            //this returns the array so it can print the errors in a js box for users notifacation of what fields wheir incorrect
             return $FormResults;
        }
        
        function databaseInjection($data){
            
            if(empty($FormResults)){
                $username=$this->generateUsername($data);
                $expirationdate=$this->generateExpirationDate($data);
         
                    $sql="INSERT INTO `accounts`(`firstname`,`lastname`,`email`,`idnumber`,`idtype`,`username`,`password`,`street`,`city`,`state`,`zipcode`,`creationdate`,`expireddate`,`createdby`,`comments`)
                     values('".$F_Name."','".$L_Name."','".$E_Mail."','".$ID_Number."','".$ID_Type."','".$username."',PASSWORD('".$Password."'),'".$Street."','".$City."','".$State."','".$Zip_Code."',(UNIX_TIMESTAMP(NOW()))
                         '".$expirationdate."','".$creator."')";
            }else{
                echo $FormResults;
              
            }
           
        }

        public function generateUsername($data){
          $username=substr($data['F_Name'],0,1).$result['L_Name'].rand(1000,9999);          
        }
        
        public function generateExpirationDate($data){
            $startDate=time();
            if($data ['numdays']=='30'){
                $expirationdate = strtotime('+1 month',$startDate); 
            }else if($result['numdays']=='60'){
                $expirationdate = strtotime('+2 month',$startDate); 
            }else{
                $expirationdate = strtotime('+3 month',$startDate); 
            }
        }
        
    
        function login($data){

            $sql="SELECT * FROM users where `username`='".$data['username']."' and `password`=PASSWORD('".$data['password']."')";
            $result = $this->conn->query($sql);
            
           if($result==1){
               
             header('location:../useraccount.html');
            

        }
      }
    }
    
   
    $check= new FormValidationCheck($conn);
    
    $login= $check->login($data);


?>
