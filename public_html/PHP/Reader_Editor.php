<?php
    require_once('dbConnect.php');

        $data=$_SESSION["POSTData"];
     
        class DataHandler{

            public $conn;

            function __construct($conn) {
                $this->conn = $conn;
            }
            function login(){
               
                if(!empty($_POST['username']) && !empty($_POST['password'])){
                  $sql="SELECT * FROM users where `username`='".$_POST['username']."' and `password`=PASSWORD('".$_POST['password']."')";
                  $result = $this->conn->query($sql);  
                  $_SESSION['lgnuser']=$_POST['username'];
                  if(!empty($result)){
                      $info=$this->UserSelect();
                      print_r($info);
                     //header('location:../userprofile.php');
                }}else{
                     header("location:../index.php?login=1&badlogin=1");
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
              return $expirationdate;
            }
               
            function databaseInsert($data){
              
             $username=$this->generateUsername($data);
             $expirationdate=$this->generateExpirationDate($data);
              $sql="INSERT INTO `accounts`(`firstname`,`lastname`,`email`,`idnumber`,`idtype`,`username`,`password`,`street`,`city`,`state`,`zipcode`,`creationdate`,`expireddate`,`createdby`,`comments`)
                values('".$data["F_Name"]."','".$data["L_Name"]."','".$data["E_Mail"]."','".$data["ID_Number"]."','".$data["ID_Type"]."','".$username."',PASSWORD('".$data["Password"]."'),'".$data["Street"]."'"
                . ",'".$data["City"]."','".$data["State"]."','".$data["Zip_Code"]."',(UNIX_TIMESTAMP(NOW())),'".$expirationdate."','".$_SESSION['lgnuser']."','".$data["comments"]."')";
                 $result=  mysqli_query($this->conn, $sql);
                 header("location:../userprofile.php?bad");
              
            }
            function databaseSelect() {
                
                if($current===1){
                $sql="SELECT * FROM `accounts`";
               $results = mysqli_query($this->conn, $sql);
                print_r($result);
               return $result; 
            }else if($search===1){
                $sql="SELECT * FROM `accounts` WHERE username=".$_POST['usersearch']."";
                $results=mysqli_query($this->conn,$sql);
                return $results;
            }
        }
        function UserSelect(){
            $sql="SELECT FROM users where `username`='".$_POST['username']."'";
            $result=  mysqli_query($this->conn,$sql);
            return $result;
        }
        }
        

     $run= new DataHandler($conn); 
    if($_GET["loginattempt"]==1){
     $run->login();
    }else if($_GET["accountinsert"]==1){
     $run->databaseInsert($data,$lgnuser);
    }else if($_GET["current"]==1){    
     $run->databaseInsert();
    }
?>
