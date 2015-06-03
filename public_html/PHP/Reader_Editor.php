<?php
    require_once('dbConnect.php');
      
        $data=$_SESSION["POSTData"];
     
        class DataHandler{

            public $conn;

            public function __construct($conn) {
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
                $sql="SELECT * FROM `accounts` ORDER BY expireddate DESC";
                $result = mysqli_query($this->conn, $sql);
                
               return $result; 
           }
        
         function databaseUpdate(){
            if(isset($_GET['accountid'])){
                 $formeddate=strtotime($_POST['startdate']);
                 $sql="UPDATE `accounts` SET  `expireddate`='".$formeddate."' where `username`='".$_GET['accountid']."'";
                 echo $sql;
              }else if($_GET['lgnupdate']=='1'){
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
            header("location:../userprofile.php?update=1");
             
         }
        }
        }
     $run= new DataHandler($conn); 
//     if($_GET['sort']<='1'){
//         $run->databaseSelect();
//         
//     }
    //if($_GET["attempt"]=="1"){
   //  $run->login();
    // $run->databaseSelect();
   // }else if($_GET["current"]=="1"){
   //  $run->databaseSelect();
 //  }else if($_GET["accountinsert"]=="1"){
   // $run->databaseInsert($data,$lgnuser);
    
 //   }
    if($_GET["lgnupdate"]=="1"){
    $run->databaseUpdate();}
 //       $run->databaseSelect();
 //   }else if($_GET['updatedate']==1){
    //    $run->databaseUpdate();
        
   // }
    $run->databaseSelect();
    if(isset($_GET['accountid'])){
    $run->databaseUpdate();}
?>
