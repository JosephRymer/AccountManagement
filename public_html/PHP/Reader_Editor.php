<?php
    require_once('dbConnect.php');

        $data=$_SESSION["POSTData"];
     
        class DataHandler{

            public $conn;
            public $lgnuser;

            function __construct($conn) {
                $this->conn = $conn;
            }
            function login($_POST){
                if(!empty($_POST['username']) && !empty($_POST['password'])){
                  $sql="SELECT * FROM users where `username`='".$_POST['username']."' and `password`=PASSWORD('".$_POST['password']."')";
                  $result = $this->conn->query($sql);  
                  if(!empty($result)){
                     $this->lgnuser=$_POST['username']; 
                     header('location:../useraccount.html');
                    }else{
                     header("location:../login.html?badlogin=1");
                    }
                }
            }

            public function generateUsername($data){
              $username=substr($data['F_Name'],0,1).$data['L_Name'].rand(1000,9999);          
              return $username;
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
             $creator=$this->lgnuser;
             $username=$this->generateUsername($data);
             $expirationdate=$this->generateExpirationDate($data);
              $sql="INSERT INTO `accounts`(`firstname`,`lastname`,`email`,`idnumber`,`idtype`,`username`,`password`,`street`,`city`,`state`,`zipcode`,`creationdate`,`expireddate`,`createdby`,`comments`)
                values('".$data["F_Name"]."','".$data["L_Name"]."','".$data["E_Mail"]."','".$data["ID_Number"]."','".$data["ID_Type"]."','".$username."',PASSWORD('".$data["Password"]."'),'".$data["Street"]."'"
                . ",'".$data["City"]."','".$data["State"]."','".$data["Zip_Code"]."',(UNIX_TIMESTAMP(NOW())'".$creator."')'".$expirationdate."')";
                 $result=  mysqli_query($this->conn, $sql);
                echo $sql;
                echo $creator;
            }
        }

     $check= new DataHandler($conn); 
     $check->login($_POST);
     $check->databaseInsert($data);    
?>
