<?php
include('dbConnect.php');


    class DataHandler{

    public $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    function login(){
         $sql="SELECT * FROM `users` where `username`='".$_POST['username']."' and `password`=PASSWORD('".$_POST['password']."')";
         $result = $this->conn->query($sql);  
         $count=mysqli_num_rows($result);
         $row= mysqli_fetch_assoc($result);
         if($count == 1){ 
            $_SESSION['lgnuser']=$_POST['username'];
            $_SESSION['lgnuserinfo']=$row;
            header('location:../profile.php');
         }else{
            header("location:../index.php?badlogin=1");
         }
        }
    private function generateUsername(){
        $username=substr($_POST['F_Name'],0,1).$_POST['L_Name'].rand(1000,9999);          
        return $username;
    }   
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
    function createUser($data){
        $username=$this->generateUsername($data);
        $sql="INSERT INTO `users`(`firstname`,`lastname`,`email`,`username`,`password`,`creator`,`lastupdate`)values('".$data["F_Name"]."','".$data["L_Name"]."','".$data["E_Mail"]."','".$username."',PASSWORD('".$data["Password"]."'),'".$_SESSION['lgnuser']."',(UNIX_TIMESTAMP(NOW())))";
        $result= mysqli_query($this->conn, $sql);
        header("location:profile.php?usersuccess=".$username."");
    }
    function createAccount($data){
        $username=$this->generateUsername($data);
        $expirationdate=$this->generateExpirationDate($data);
        $sql="INSERT INTO `accounts`(`firstname`,`lastname`,`email`,`idnumber`,`idtype`,`username`,`password`,`street`,`city`,`state`,`zipcode`,`creationdate`,`expireddate`,`createdby`,`comments`)
        values('".$data["F_Name"]."','".$data["L_Name"]."','".$data["E_Mail"]."','".$data["ID_Number"]."','".$data["ID_Type"]."','".$username."',PASSWORD('".$data["Password"]."'),'".$data["Street"]."'"
        . ",'".$data["City"]."','".$data["State"]."','".$data["Zip_Code"]."',(UNIX_TIMESTAMP(NOW())),'".$expirationdate."','".$_SESSION['lgnuser']."','".$data["comments"]."')";
        $result=  mysqli_query($this->conn, $sql);
        header("location:profile.php?accountsuccess=".$username."");
    }
    function getAccount(){
            $sql="SELECT * FROM `accounts` ORDER BY `expireddate` DESC";
            $result = mysqli_query($this->conn, $sql);
        return $result;
        }
    function searchAccount($accountsearch){
         $sql="SELECT * FROM `accounts` where `username`='". $accountsearch['searchresult']."' or `firstname`='". $accountsearch['searchresult']."' or `lastname`='". $accountsearch['searchresult']."' or `createdby`='". $accountsearch['searchresult']."'";
            $result = mysqli_query($this->conn, $sql);
             return $result;
       }
    function getUser(){
            $sql="SELECT * FROM `users` ORDER BY `lastupdate` DESC";
            $result = mysqli_query($this->conn, $sql);
            return $result; 
        }  
    function searchUser($usersearchdata){
        $sql="SELECT * FROM `users` where `username`='". $usersearchdata['searchresult']."' or `firstname`='". $usersearchdata['searchresult']."' or `lastname`='". $usersearchdata['searchresult']."'";
            $result = mysqli_query($this->conn, $sql);
            return $result;
    }
    function updateUser($data){
         if(isset($_GET['user'])){
            $sql="UPDATE `users` SET  `firstname`='".$data['firstname']."',`lastname`='".$data['lastname']."',`email`='".$data['email']."',`username`='".$data['username']."' ,`isadmin`='".$data['admin']."' ,`lastupdate`= UNIX_TIMESTAMP(NOW()) ,  WHERE `username`='".$_GET['username']."'";        
            $result=mysqli_query($this->conn,$sql); 
            echo $sql;
     }
     }
    function updateAccount($data,$accountid){
         if(isset($accountid)){
            $formeddate=strtotime($data['startdate']);
            $sql="UPDATE `accounts` SET  `expireddate`='".$formeddate."' where `username`='".$accountid."'";
            $result=mysqli_query($this->conn,$sql);
         }else{
            $sql="UPDATE `accounts` SET  `username`='".$_POST['username']."' where `username`='".$_GET['username']."'";
            $result=mysqli_query($this->conn,$sql);
          //  header("location:../CurrentAccounts.php");
           // header("location:../CurrentAccounts.php");
        } 
     }
    function updateProfile(){
        
       
        
             
           // if($_POST['password']===$_POST['confirmpassword']){
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
                header("location:../profile.php?update");
           // }else{ 
                header("location:../profile.php?failupdate");
            }
    function logout(){
        session_unset();
        header('location:../index.php');
    }
}
    
$run= new DataHandler($conn); 
if(($_GET['lgnupdate'])){
$run->updateProfile();    
}
if($_GET["attempt"]=="1"){
$run->login();
}
if($_GET['logout']=='1'){
$run->logout();    
}



?>
