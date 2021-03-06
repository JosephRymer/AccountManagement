<!DOCTYPE html>
<?php session_start();
if(!empty($_SESSION['lgnuser'])){
   if($_SESSION['admin']==='1'){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include('PHP/Validation.php');
        include('PHP/Reader_Editor.php');
        $check = new FormValidationCheck($conn);
        $check->CheckUserFormFields($_POST);
            if(empty($usererrors)){
                $run = new DataHandler($conn);
                $run->createUser($_POST);
            }
        }
?>
<html>
    <title> Create Account </title>
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
                   <a class="dropdown-toggle" data-toggle="dropdown"  role="button" aria-expanded="false"> Accounts <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                     <li><a href="AccountCreation.php">Create Account</a></li>
                     <li><a href="CurrentAccounts.php">Current Accounts</a></li>
                    </ul>
                  </li>
                  <?php   if($_SESSION['admin']==='1'){ ?>
                  <li role="presentation" class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown"  role="button" aria-expanded="false"> Users <span class="caret"></span></a>
                       <ul class="dropdown-menu" role="menu">
                        <li><a href="UserCreation.php">Create User</a></li>
                        <li><a href="CurrentUsers.php">Current Users</a></li>
                       </ul>
                  </li><?php } ?>
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
                              <?php   if($_SESSION['admin']==='1'){ ?>
                              <li role="separator" class="divider"></li>
                              <li><a href="UserCreation.php">Create User</a></li>
                              <li><a href="CurrentUsers.php">Current Users</a></li>
                              <?php } ?>
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
                        <?php if(isset($usererrors)){ ?>
                        <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon glyphicon-alert" aria-hidden="true"></span>
                            <span class="sr-only"></span>The following Fields where incorrect or missing <?php  print_r(implode(",",$usererrors));?>
                        </div><?php } ?>
                        <form data-toggle="validator" role="form" action="UserCreation.php" method="POST">
                            <label   class="control-label" >
                                First Name
                                <input type="text" class="form-control" id="inputName" name="F_Name" value="<?php echo $_POST['F_Name']; ?>" required>
                            </label>
                            <label class="control-label">
                                Last Name
                                <input type="text" class="form-control" name="L_Name" value="<?php echo $_POST['L_Name']; ?>" required>
                            </label>
                            <label  class="control-label">
                                Email
                                <input type="email" class="form-control" name="E_Mail" value="<?php echo $_POST['E_Mail']; ?>" required>
                            </label>
                            <label  class="control-label">
                                Username
                                <input type="text" class="form-control" name="username" value="<?php echo $_POST['username']; ?>" required>
                            </label>
                            <label  class="control-label">
                                Password
                                <input type="password" name="Password" class="form-control" placeholder="Password" required>
                                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                            </label>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary"> Submit </button>
                                <button class="btn btn-danger" type="reset"> Reset </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
<?php
}else{
    header("location:/AccountManagement/public_html/profile.php?falseadmin");
}

}else{
header("location:/AccountManagement/public_html/index.php?badlogin=1");
}
 ?>
