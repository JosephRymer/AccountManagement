<?php
    require_once('dbConnect.php');
    
    $data=$_SESSION["POSTData"];

    class DataHandler{

        public $conn;

            public function __construct($conn) {
                $this->conn = $conn;
            }
            //Login function for cheking login and comparing results
            function login(){
              $sql="SELECT * FROM `users` where `username`='".$_POST['username']."' and `password`=PASSWORD('".$_POST['password']."')";
               $result = $this->conn->query($sql);  
                $count=mysqli_num_rows($result);
                  $_SESSION['lgnuser']=$_POST['username'];
                  if($count == 1){
                      //Data that autofills form in userprofile is pulled here form the database 
                    $sql="SELECT * FROM `users` WHERE `username`='".$_SESSION['lgnuser']."'";
                    
                     $result=  mysqli_query($this->conn,$sql);
                       $row= mysqli_fetch_assoc($result);
                       $_SESSION['isadmin']=$row['isadmin'];
                        $_SESSION['lgnuserinfo']=$row;
                        header('location:../userprofile.php');
                    }else{
                     header("location:../index.php?badlogin=1");
                    }
            }
            //this function is for building the username then passing to be sent to a mysql query in DatabaseInsert
            public function generateUsername($data){
              $username=substr($data['F_Name'],0,1).$data['L_Name'].rand(1000,9999);          
                return $username;
            }   
              //this function is fordetermining expiration data then that data is passed to a mysql query in DatabaseInsert
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
             //Runs sql query only when all data is given the ok from validation.php
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
             if(!empty( $_SESSION['searchresult'])){
               $sql="SELECT * FROM `accounts` where username='". $_SESSION['searchresult']."'";
               echo $sql;
                 $result = mysqli_query($this->conn, $sql);
                 $_SESSION['searchresults']=$result;
                 echo  $_SESSION['searchresult'];
                 return $result;
             }else
              $sql="SELECT * FROM `accounts` ORDER BY expireddate DESC";
               $result = mysqli_query($this->conn, $sql);
                return $result; 
            }

            function databaseUpdate(){
             if(isset($_GET['accountid'])){
               $formeddate=strtotime($_POST['startdate']);
               $sql="UPDATE `accounts` SET  `expireddate`='".$formeddate."' where `username`='".$_GET['accountid']."'";
                $result=mysqli_query($this->conn,$sql);
              } if($_GET['lgnupdate']=='1'){
                  if($_POST['password']===$_POST['confirmpassword']){
                $sql="UPDATE `users` SET
                firstname = '".$_POST['firstname']."',
                lastname = '".$_POST['lastname']."',
                email = '".$_POST['email']."',
                password = PASSWORD('".$_POST['password']."') , lastupdate=(UNIX_TIMESTAMP(NOW())) WHERE username='".$_SESSION[lgnuser]."'";
                    $result= mysqli_query($this->conn, $sql);
                $sql="SELECT * FROM `users` WHERE `username`='".$_SESSION['lgnuser']."'";
                    $results=  mysqli_query($this->conn,$sql);
                     $row= mysqli_fetch_assoc($results);
                      $_SESSION['lgnuserinfo']=$row;
                   header("location:../userprofile.php?update");
              }else{
                  header("location:../userprofile.php?failupdate");
              }
              }
            }
            function logout(){
                 session_unset();
                 header('location:../index.php');
            }
    }
$run= new DataHandler($conn); 

if($_GET["attempt"]=="1"){
$run->login();
}
if($_GET["accountinsert"]=="1"){
$run->databaseInsert($data,$lgnuser);
}else if($_GET["lgnupdate"]=="1"){
$run->databaseUpdate();
}
$run->databaseSelect();
if(isset($_GET['accountid'])){
$run->databaseUpdate();
}
if($_GET['logout']=='1'){
$run->logout();    
}
?>
