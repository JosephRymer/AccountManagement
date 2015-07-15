<!DOCTYPE html>
<?php session_start();
if(!empty($_SESSION['lgnuser'])){   
?>
<html>
    <title> Current Users </title>
    <head>
     <?php 
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include 'PHP/Validation.php';
        $check = new FormValidationCheck($conn);
        $check-CheckUserUpdateFields($_POST);
        }
        include 'PHP/Reader_Editor.php';
        
         
       $run= new DataHandler($conn);
          if(isset($_GET['user'])){
           $run->updateUser($_POST);   
          }
             if(isset($_GET['search'])){
               $response = $run->searchUser($_POST);  
             }else{
               $response = $run->getUser();
             }
      ?>
     <link href="css/bootstrap.css" rel="stylesheet">
     <link href="css/bootstrap-theme.css" rel="stylesheet">
     <link href="css/stylesheet.css" rel="stylesheet" >
    </head>
    <body>
        <div class="navbar navbar fixed top">
            <div class="navbar-inner">
                <div class="hidden-xs">
                 <ul id="tab-group" class="nav nav-pills" >
                  <li  role="presentation" class="active" ><a id="active-tab" href="profile.php">Profile</a></li>
                  <li role="presentation" class="dropdown">
                   <a class="dropdown-toggle" data-toggle="dropdown"  role="button" aria-expanded="false"> Accounts <span class="caret"></span></a>
                   <ul class="dropdown-menu" role="menu">
                    <li><a href="AccountCreation.php">Create Account</a></li>
                    <li><a href="CurrentAccounts.php">Current Accounts</a></li> 
                   </ul>
                  </li>
                  <li role="presentation" class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown"  role="button" aria-expanded="false"> Users <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="UserCreation.php">Create User</a></li>
                        <li><a href="CurrentUsers.php">Current Users</a></li> 
                      </ul>
                  </li>      
                  <li role="presentation"><a href="PHP/Reader_Editor.php?logout=1">Logout</a></li>
                 </ul>
                </div>
                <a class="brand" href="http://library.tamu.edu/">
                 <img src="img/logo.png" alt="Library Logo">
                </a>
            </div>
            <div class="color-field">
                <div class="row-fluid">
                    <div class="span12 pull left breadcrumb"> 
                        <div class="visible-xs">
                            <div class="btn-group" style="float:right;">
                             <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-align-justify"></span></button>
                             <ul class="dropdown-menu dropdown-menu-right">
                              <li><a href="profile.php">Profile</a></li>
                              <li><a href="AccountCreation.php">Create Account</a></li>
                              <li><a href="CurrentAccounts.php">Current Accounts</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="UserCreation.php">Create User</a></li>
                              <li><a href="CurrentUsers.php">Current Users</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="PHP/Reader_Editor.php?logout=1">Logout</a></li>
                             </ul>
                            </div>  
                        </div>
                        <form action="CurrentUsers.php?search" method="POST" class="control form-inline" style="float:right;">
                            <input type="text" class="form-control" name="searchresult" placeholder="Search">
                        </form>
                        <ul class="breadcrumb">
                         <a href="http://library.tamu.edu/">
                         University Libraries
                         </a>
                         >
                         <a href="profile.php">
                         Profile
                         </a>
                         >
                         <a href="CurrentUsers.php">
                         Current Users
                         </a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="page-content-wrapper">
            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 style='text-align: center;'>Current Users</h1>
                            <table class="table table-bordered table table-striped">
                             <thead>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Email</th>
                              <th>Username</th>
                              <th>Last Update<span class="glyphicon glyphicon-arrow-down"></span></th>
                              <th>Created By</th>
                              <th>Admin</th>
                             </thead>
                             <tbody>
                              <?php 
                                 while($row=mysqli_fetch_array($response,MYSQLI_ASSOC)){
                              ?><tr>
                             <td><?php echo $row['firstname']; ?></td>
                             <td><?php echo $row['lastname']; ?></td>
                             <td><?php echo $row['email']; ?></td>
                              <td><?php echo $row['username'];?></td>
                               <td><?php echo gmdate( "F j, Y, g:i a" , $row['lastupdate']); ?></td>
                               <td><?php echo $row['creator']; ?></td>
                               <td><?php if($row['isadmin']==='1'){
                                   echo "Yes";
                               }else{
                                   echo "No";
                               } ?>
                                 <button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#<?php echo $row['username']; ?>"><span class="glyphicon glyphicon-pencil"></span></button>
                                <div class="modal fade" id="<?php echo $row['username'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" style=" margin: 300px auto;">
                                        <div class="modal-content" style="color:#000">
                                            <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                             <h4 class="modal-title" id="myModalLabel">Change UserName</h4>
                                            </div>
                                            <div class="modal-body">                                             
                                                <form role="form" data-toggle="validator" action="CurrentUsers.php?username=<?php echo $row['username']; ?>" method="POST"> 
                                                    <label  for="textinput">First Name: </label>
                                                     <input type="text" value="<?php echo $row["firstname"]; ?>" class="form-control" name="firstname" >                        
                                                    <label  for="textinput">Last Name: </label>
                                                     <input type="text" value="<?php echo $row["lastname"]; ?>" class="form-control" name="lastname" >
                                                    <label for="textinput">Email: </label>
                                                     <input type="email" value="<?php echo $row["email"]; ?>" class="form-control" name="email" >
                                                    <label for="textinput">Admin: </label>
                                                    <input type="text" value="<?php if($row['isadmin']==='1'){
                                                                                        echo "Yes";
                                                                                    }else{
                                                                                         echo "No"; } ?>" class="form-control" name="admin" min="2" max="3" >
                                                     <button type="reset" class="btn btn-danger">Reset</button>
                                                     <button type="submit" class="btn btn-primary">Save</button>
                                                </form>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </td>
                              </tr><?php } ?>
                             </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src='js/jquery-2.1.4.min.js'></script>
        <script src='js/bootstrap.js'></script>
    </body> 
    <div class="container text-center "> 
        <footer>
            <a title="Texas A&amp;M University" href="http://www.tamu.edu">Texas A&amp;M University</a>  
            <a title="Employment" href="http://library.tamu.edu/about/employment/">Employment</a>  
            <a title="Webmaster" href="http://library.tamu.edu/services/forms/contact-info.html">Webmaster</a>  
            <a title="Legal" href="http://library.tamu.edu/about/general-information/legal-notices.html">Legal</a>  
            <a title="Comments" href="http://guides.library.tamu.edu/AskTheLibraries">Comments</a>  
            <a title="979-845-3731" href="http://library.tamu.edu/about/phone/">979-845-3731</a>
            <a title="Site Map" href="http://library.tamu.edu/sitemap.html">Site Map</a>
            <a title="Accessibility" href="http://library.tamu.edu/accessibility/">Accessibility</a>
        </footer>
    </div>
</html>
<?php 
}else{
header("location:/AccountManagement/public_html/index.php?badlogin=1");   
}?>
