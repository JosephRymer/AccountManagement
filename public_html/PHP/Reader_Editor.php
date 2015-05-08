<?php
    require_once('dbConnect.php');
    
    $data = $_POST;
    
    //This class is created to keep everything grouped for the checking of the Form
    class DataHandler{
                
        public $conn;
        
        function __construct($conn) {
            $this->conn = $conn;
        }
        
        public function generateUsername($data){
              $username=substr($data['F_Name'],0,1).$data['L_Name'].rand(1000,9999);          
            }
            
        public function generateExpirationDate($data){
          $startDate=time();
          if($data ['numdays']=='30'){
              $expirationdate = strtotime('+1 month',$startDate); 
          }else if($data['numdays']=='60'){
              $expirationdate = strtotime('+2 month',$startDate); 
          }else{
              $expirationdate = strtotime('+3 month',$startDate); 
          }
        }
        
       function databaseInsert($data){
           include('Validation.php');
        $check->CheckFormFields($data);
        global $FormResults;
        print_r ($FormResults);
            if(empty($FormResults)){
                $username=$this->generateUsername($data);
                $expirationdate=$this->generateExpirationDate($data);
                    $sql="INSERT INTO `accounts`(`firstname`,`lastname`,`email`,`idnumber`,`idtype`,`username`,`password`,`street`,`city`,`state`,`zipcode`,`creationdate`,`expireddate`,`createdby`,`comments`)
                     values('".$data["F_Name"]."','".$data["L_Name"]."','".$data["E_Mail"]."','".$data["ID_Number"]."','".$data["ID_Type"]."','".$username."',PASSWORD('".$data["Password"]."'),'".$data["Street"]."','".$data["City"]."','".$data["State"]."','".$data["Zip_Code"]."',(UNIX_TIMESTAMP(NOW()))
                      '".$expirationdate."')";
                    echo $sql;

            }else{
                echo $FormResults;

            }

        }

       
        
      
        
    
        function login($data){

            $sql="SELECT * FROM users where `username`='".$data['username']."' and `password`=PASSWORD('".$data['password']."')";
            $result = $this->conn->query($sql);
            
           if(empty($result)){
               
             header('location:../useraccount.html');
            

        }
      }
    }
    
   
    $check= new DataHandler($conn);
    $check->databaseInsert($data);


?>
