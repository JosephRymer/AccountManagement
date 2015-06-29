<!DOCTYPE html>
<?php if(empty($_SESSION['lgnuser'])){
     if($_SESSION['admin']=='1'){ 
    session_start(); ?>
<html>
  <title>
    Create Account
  </title>
  <head>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/stylesheet.css" rel="stylesheet" >
  </head>
  <body>
    <div class="navbar navbar fixed top">
         
        <div class="navbar-inner"> 
             <div class="hidden-xs">
            <ul id="tab-group" class="nav nav-pills" >
             <li  role="presentation"><a href="profile.php">Profile</a></li>
             <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown"  role="button" aria-expanded="false">
               Accounts <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="AccountCreation.php">Create Account</a></li>
                <li><a href="CurrentAccounts.php">Current Accounts</a></li> 
              </ul>
             </li>
             <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown"  role="button" aria-expanded="false">
               Users <span class="caret"></span>
              </a>
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
                     <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="glyphicon glyphicon-align-justify"></span>
                     </button>
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
                    <ul class="breadcrumb">
                     <a href="http://library.tamu.edu/">University Libraries</a>
                     >
                     <a href="profile.php">Profile</a>
                     >
                     <a href="AccountCreation.php">Create Account</a>
                    </ul>  
                </div>
            </div>
        </div>
    </div>
        <div class="page-content">
          <div class="container">
            <div class="row">
               
                <div id="accountcreateform" class="col-lg-6"> 
                    <h1 style="text-align: center;"> Create User </h1>
                  <?php if(isset($_SESSION['userformerrors'])){ $errorresults=implode(",",$_SESSION['userformerrors']); ?>
                  <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon glyphicon-alert" aria-hidden="true"></span>
                    <span class="sr-only"></span>The following Fields where incorrect or missing <?php  print_r($errorresults);?>
                  </div><?php } ?>
                  
                  <!-- Instead of passing data straight to Reader_Editor to be inserted it is passed to Validation.php for validation to insure that the data is correct and passes all rejex tests and php tests-->
                 
                    <form data-toggle="validator" role="form" action="PHP/Validation.php?userform" method="POST">
                        <?php $data=$_SESSION['userformdata']; ?>
                            <label   class="control-label" >
                             First Name
                             <input type="text" class="form-control" id="inputName" name="F_Name" value="<?php echo $data['F_Name']; ?>" required>       
                            </label>  
                            <label class="control-label">
                             Last Name
                             <input type="text" class="form-control" name="L_Name" value="<?php echo $data['L_Name']; ?>" required>
                            </label>   
                            <label  class="control-label">
                             Email 
                             <input type="email" class="form-control" name="E_Mail" value="<?php echo $data['E_Mail']; ?>" required>
                            </label>
                            <label  class="control-label">
                             Password
                             <input type="password" name="Password" class="form-control" placeholder="Password" required>
                             <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                            </label>
                        
                        <button type="submit" class="btn btn-primary"> Submit </button>
                        <button class="btn btn-danger" type="reset"> Reset </button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <!-- Javascript References -->
          <script src='js/jquery-2.1.4.min.js'></script>
           <script src='js/bootstrap.js'></script>
      </body> 
      <div class="container text-center"> 
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
<?php  }else if($_SESSION['admin']!='1'){
         header("location:/AccountManagement/public_html/profile.php");   
      }else{
header("location:/AccountManagement/public_html/index.php?badlogin=1");   
} } ?>