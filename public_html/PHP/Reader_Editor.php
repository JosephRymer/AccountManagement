<?php
include('dbConnect.php');


    class DataHandler{

    public $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    //Function for logging in 
    function login(){
        $sql="SELECT * FROM `users` where `username`='".$_POST['username']."' and `password`=PASSWORD('".$_POST['password']."')";
        $result = $this->conn->query($sql);  
        $count=mysqli_num_rows($result);
        $_SESSION['lgnuser']=$_POST['username'];
        if($count == 1){
            $sql="SELECT * FROM `users` WHERE `username`='".$_SESSION['lgnuser']."'";
            $result=  mysqli_query($this->conn,$sql);
            $row= mysqli_fetch_assoc($result);
            $_SESSION['admin']=$row['isadmin'];
            $_SESSION['lgnuserinfo']=$row;
            header('location:../profile.php');
            }else{
            header("location:../index.php?badlogin=1");
            }
        }
    // function is for building the username
    private function generateUsername(){
        $username=substr($_POST['F_Name'],0,1).$_POST['L_Name'].rand(1000,9999);          
        return $username;
    }   
    //function is fordetermining expiration data then that data is passed to a mysql query in DatabaseInsert
    private function generateExpirationDate($data){
        $startDate=time();
        if($_POST ['numdays']=='30'){
            $expirationdate = strtotime('+1 month',$startDate); 
        }else if($_POST['numdays']=='60'){
            $expirationdate = strtotime('+2 month',$startDate); 
        }else{
            $expirationdate = strtotime('+3 month',$startDate); 
        }
        return $expirationdate;
    }
    //User Insert for Creation of User
    function databaseUserInsert($data){
        $username=$this->generateUsername($data);
        $sql="INSERT INTO `users`(`firstname`,`lastname`,`email`,`username`,`password`,`creator`,`lastupdate`)values('".$data["F_Name"]."','".$data["L_Name"]."','".$data["E_Mail"]."','".$username."',PASSWORD('".$data["Password"]."'),'".$_SESSION['lgnuser']."',(UNIX_TIMESTAMP(NOW())))";
        $result= mysqli_query($this->conn, $sql);
        header("location:profile.php?usersuccess=".$username."");
    }
    //Account Request Insert for Creating account request
    function databaseAccountInsert($data){
        $username=$this->generateUsername($data);
        $expirationdate=$this->generateExpirationDate($data);
        $sql="INSERT INTO `accounts`(`firstname`,`lastname`,`email`,`idnumber`,`idtype`,`username`,`password`,`street`,`city`,`state`,`zipcode`,`creationdate`,`expireddate`,`createdby`,`comments`)
        values('".$data["F_Name"]."','".$data["L_Name"]."','".$data["E_Mail"]."','".$data["ID_Number"]."','".$data["ID_Type"]."','".$username."',PASSWORD('".$data["Password"]."'),'".$data["Street"]."'"
        . ",'".$data["City"]."','".$data["State"]."','".$data["Zip_Code"]."',(UNIX_TIMESTAMP(NOW())),'".$expirationdate."','".$_SESSION['lgnuser']."','".$data["comments"]."')";
        $result=  mysqli_query($this->conn, $sql);
        header("location:profile.php?accountsuccess=".$username."");
    }
    //Select for Current Account Requests
    function databaseSelect(){
        if(isset( $_SESSION['searchresult'])){
            $sql="SELECT * FROM `accounts` where `username`='". $_SESSION['searchresult']."' or `firstname`='". $_SESSION['searchresult']."' or `lastname`='". $_SESSION['searchresult']."' or `createdby`='". $_SESSION['searchresult']."'";
            $result = mysqli_query($this->conn, $sql);
            $_SESSION['searchresults']=$result;
            return $result;
        }else{
            $sql="SELECT * FROM `accounts` ORDER BY `expireddate` DESC";
            $result = mysqli_query($this->conn, $sql);
        return $result;
        }
    }
    //Select for User Accounts
    function databaseUserselect(){
        if(isset($_SESSION['usersearchresult'])){
            $sql="SELECT * FROM `users` where `username`='". $_SESSION['usersearchresult']."' or `firstname`='". $_SESSION['usersearchresult']."' or `lastname`='". $_SESSION['usersearchresult']."'";
            $result = mysqli_query($this->conn, $sql);
            $_SESSION['usersearchresults']=$result;
            return $result;
        }else{
            $sql="SELECT * FROM `users` ORDER BY `lastupdate` DESC";
            $result = mysqli_query($this->conn, $sql);
            return $result; 
        }   
    }

    //Update for users and account requests 
    function databaseUpdate(){
        if(isset($_GET['user'])){
            $sql="UPDATE `users` SET  `username`='".$_POST['username']."' ,`lastupdate`=(UNIX_TIMESTAMP(NOW())) , `isadmin`='".$_GET['Admin']."' where `username`='".$_GET['username']."'";
             echo $sql;
            $result=mysqli_query($this->conn,$sql);  
            //header("location:../CurrentUsers.php");
        }else if(isset($_GET['accountid'])){
            $formeddate=strtotime($_POST['startdate']);
            $sql="UPDATE `accounts` SET  `expireddate`='".$formeddate."' where `username`='".$_GET['accountid']."'";
            $result=mysqli_query($this->conn,$sql);
            echo $sql;
           // header("location:../CurrentAccounts.php");
        } 
        if(isset($_GET['username'])){
            $sql="UPDATE `accounts` SET  `username`='".$_POST['username']."' where `username`='".$_GET['username']."'";
            $result=mysqli_query($this->conn,$sql);
          //  header("location:../CurrentAccounts.php");
        }if($_GET['lgnupdate']=='1'){
            if($_POST['password']===$_POST['confirmpassword']){
                $sql="UPDATE `users` SET
                firstname = '".$_POST['firstname']."',
                lastname = '".$_POST['lastname']."',
                email = '".$_POST['email']."',
                password = PASSWORD('".$_POST['password']."') , lastupdate=(UNIX_TIMESTAMP(NOW())) WHERE username='".$_SESSION['lgnuser']."'";
                $result= mysqli_query($this->conn, $sql);
                $sql="SELECT * FROM `users` WHERE `username`='".$_SESSION['lgnuser']."'";
                $results=  mysqli_query($this->conn,$sql);
                $row= mysqli_fetch_assoc($results);
                $_SESSION['lgnuserinfo']=$row;
               // header("location:../profile.php?update");
            }else{
              //  header("location:../profile.php?failupdate");
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
}else if($_GET["lgnupdate"]=="1"){
$run->databaseUpdate();
}else if(isset($_GET['user'])){
$run->databaseupdate();
}
$run->databaseSelect();

$run->databaseUserSelect(); 

if(isset($_GET['accountid'])){
$run->databaseUpdate();
}else if(isset($_GET['username'])){
$run->databaseUpdate(); }
if($_GET['logout']=='1'){
$run->logout();    
}



?>
