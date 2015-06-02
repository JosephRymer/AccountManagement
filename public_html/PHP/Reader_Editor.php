<?php
    require_once('dbConnect.php');
       echo "begin CRUD";
        $data=$_SESSION["POSTData"];
     
        class DataHandler{

            public $conn;

            function __construct($conn) {
                $this->conn = $conn;
            }
            function login(){
                  $sql="SELECT * FROM `users` where `username`='".$_POST['username']."' and `password`=PASSWORD('".$_POST['password']."')";
                  $result = $this->conn->query($sql);  
                  $count=mysqli_num_rows($result);
                  $_SESSION['lgnuser']=$_POST['username'];
                  if($count == 1){
                       $sql="SELECT * FROM `users` WHERE `username`='".$_SESSION['lgnuser']."'";
                         $result=  mysqli_query($this->conn,$sql);
                         $row= mysqli_fetch_assoc($result);
                          $_SESSION['lgnuserinfo']=$row;
                    header('location:../userprofile.php');
                }else{
                    header("location:../login.php?badlogin=1");
                    
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
                 header("location:../userprofile.php");
              
            }
            function databaseSelect() {
                
                if($_GET["current"] == "1"){
                $sql="SELECT * FROM `accounts`";
              // $results = mysqli_query($this->conn,$sql);
              // $row = mysqli_fetch_array($results , MYSQLI_ASSOC);
              // $_SESSION['currentinfo'] = $row;
             //  print_r($_SESSION['currentinfo']);
             //  print_r($results);
               header('location:../CurrentAccounts.php');
               return $sql; 
            }else if($search=="1"){
                $sql="SELECT * FROM `accounts` WHERE username=".$_POST['usersearch']."";
                $results=mysqli_query($this->conn,$sql);
                return $results;
            }}
        
         function databaseUpdate(){
             if($_GET['updatedate']=='1'){
                 $formeddate=strtotime($_POST['startdate']);
                 
                 $sql="UPDATE `accounts` SET  `expireddate`='".$formeddate."' where `id`='".$_SESSION['user']."'";
                 echo $sql;
             }else{
             $sql="UPDATE `users` SET
              firstname = '".$_POST['firstname']."',
              lastname = '".$_POST['lastname']."',
              email = '".$_POST['email']."',
              password = PASSWORD('".$_POST['password']."') WHERE username='".$_SESSION[lgnuser]."'";
             $result= mysqli_query($this->conn, $sql);
              $sql="SELECT * FROM `users` WHERE `username`='".$_SESSION['lgnuser']."'";
                         $results=  mysqli_query($this->conn,$sql);
                         $row= mysqli_fetch_assoc($results);
                          $_SESSION['lgnuserinfo']=$row;
             header("location:../userprofile.php?update=1");
             
         }
        }
        }
     $run= new DataHandler($conn); 
    if($_GET["attempt"]=="1"){
     $run->login();
     $run->databaseSelect();
    }else if($_GET["current"]=="1"){
     $run->databaseSelect();
    }else if($_GET["accountinsert"]=="1"){
    $run->databaseInsert($data,$lgnuser);
    
    }
    if($_GET["lgnupdate"]=="1"){
        $run->databaseUpdate();
        $run->databaseSelect();
    }else if($_GET['updatedate']==1){
        $run->databaseUpdate();
        
    }
    $run->databaseSelect();
?>
