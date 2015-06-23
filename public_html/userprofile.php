<!DOCTYPE html>
<html>
    <?php session_start(); 
      if(!empty($_SESSION['lgnuser'])){ 
      $values=$_SESSION['lgnuserinfo'];
    ?>

    <title>Dashboard</title>
    <head>
      <link href="css/bootstrap.css" rel="stylesheet">
      <link href="css/bootstrap-theme.css" rel="stylesheet">
      <link href="css/stylesheet.css" rel="stylesheet" >
    </head>
  <body>
     <!-- Header -->
     <div class="navbar navbar fixed top">
         
        <div class="navbar-inner"> 
             <div class="hidden-xs">
            <ul id="tab-group" class="nav nav-pills" >
             <li  role="presentation" class="active" ><a id="active-tab" href="userprofile.php">Profile</a></li>
             <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown"  role="button" aria-expanded="false">
               Accounts <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="AccountCreation.php">Create Account</a></li>
                <li><a href="CurrentAccounts.php">Current Accounts</a></li> 
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
                      <!-- <li><a href="userprofile.php">Profile</a></li> -->
                      <li><a href="AccountCreation.php">Create Account</a></li>
                      <li><a href="CurrentAccounts.php">Current Accounts</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="PHP/Reader_Editor.php?logout=1">Logout</a></li>
                     </ul>
                   </div>  
                 </div>
                    <ul class="breadcrumb">
                     <a href="http://library.tamu.edu/">University Libraries</a>
                     >
                     <a href="userprofile.php">Profile</a>
                    </ul>  
                </div>
            </div>
        </div>
    </div>
            <!-- Page Content -->
            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3 col-md-6  col-sm-offset-3 col-sm-12 col-xs-offset-3 col-xs-6">
                            <h1 class="col-lg-7 col-lg-offset-3 col-md-8 col-md-offset-3 col-sm-12 col-xs-12">Current User Data</h1>
                          <?php if(!empty($_GET["success"])){?>
                            <div class="alert alert-success col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-3 col-sm-8 col-xs-12" role="alert" >
                             <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
                             <span class="sr-only"></span>Account Created Username:<?php echo $_GET['success']; ?>
                            </div>
                          <?php } ?>
                            <?php if(isset($_GET["update"])){?>
                            <div class="alert alert-success col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-3 col-sm-8 col-xs-12" role="alert">
                             <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
                             <span class="sr-only"></span>Data Updated Successfully
                            </div>
                          <?php } ?>
                            <?php if(isset($_GET["failupdate"])){?>
                            <div class="alert alert-danger col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-3  col-sm-8 col-xs-12" role="alert" >
                             <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                             <span class="sr-only"></span>Passwords Do Not Match
                            </div>
                          <?php } ?>
                         
                           <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-1 col-sm-4 col-xs-12">
                               <div class="form-group">
                             <form role="form" data-toggle="validator" action="PHP/Reader_Editor.php?lgnupdate=1" method="POST"> 
                                 
                            
                                      <label  for="textinput">First Name: </label>
                                    <input type="text" value="<?php echo $values["firstname"]; ?>" class="form-control" name="firstname" required>                        
                                      <label  for="textinput">Last Name: </label>
                                    <input type="text" value="<?php echo $values["lastname"]; ?>" class="form-control" name="lastname" required>
                                      <label for="textinput">Email: </label>
                                      <input type="email" value="<?php echo $values["email"]; ?>" class="form-control" name="email" required>
                                      <label  form="textinput" >password: </label>
                                    <input type="password"  class="form-control" name="password" placeholder="Password" >
                                    <input type="password" class="form-control" id="inputPasswordConfirm" name="confirmpassword" placeholder="Confirm Password">
                                     <button type="reset" class="btn btn-danger">Reset</button>
                                     <button type="submit" class="btn btn-primary">Save</button>
                             </form>  </div></div>
                            </div>
                          </div>
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
<?php }else{
header("location:/AccountManagement/public_html/index.php?badlogin=1");   
} ?>