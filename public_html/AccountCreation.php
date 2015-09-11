<!DOCTYPE html>
<?php session_start(); 
if(!empty($_SESSION['lgnuser'])){
    if($_SERVER['REQUEST_METHOD']=='POST'){ 
        include('PHP/Validation.php');
        include('PHP/Reader_Editor.php');
            $check = new FormValidationCheck($conn);
            $check->CheckAccountFormFields($_POST);
            if(empty($accounterrors)){
             $run = new DataHandler($conn);
             $run->createAccount($_POST);            
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
                     <h1 style="text-align: center;"> Create Account Request </h1>
                     <?php if(isset($accounterrors)){?>
                        <div class="alert alert-danger" role="alert">
                         <span class="glyphicon glyphicon glyphicon-alert" aria-hidden="true"></span>
                         <span class="sr-only"></span>The following Fields where incorrect or missing <?php  print_r(implode(",",$accounterrors));?>
                        </div><?php } ?>
                        <form data-toggle="validator" role="form" action="AccountCreation.php" method="POST">
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
                          Street
                          <input type="text" class="form-control" name="Street" value="<?php echo $_POST['Street']; ?>" required>
                         </label>
                         <label  class="control-label">
                          City
                          <input type="text" class="form-control" name="City" value="<?php echo $_POST['City']; ?>" required>
                         </label>
                         <div class="col-lg-4">
                           <label> State </label>
                            <select name="State" class="form-control" required>
                                <option value="AL">AL</option>
                                <option value="AK">AK</option>
                                <option value="AZ">AZ</option>
                                <option value="AR">AR</option>
                                <option value="CA">CA</option>
                                <option value="CO">CO</option>
                                <option value="CT">CT</option>
                                <option value="DE">DE</option>
                                <option value="DC">DC</option>
                                <option value="FL">FL</option>
                                <option value="GA">GA</option>
                                <option value="HI">HI</option>
                                <option value="ID">ID</option>
                                <option value="IL">IL</option>
                                <option value="IN">IN</option>
                                <option value="IA">IA</option>
                                <option value="KS">KS</option>
                                <option value="KY">KY</option>
                                <option value="LA">LA</option>
                                <option value="ME">ME</option>
                                <option value="MD">MD</option>
                                <option value="MA">MA</option>
                                <option value="MI">MI</option>
                                <option value="MN">MN</option>
                                <option value="MS">MS</option>
                                <option value="MO">MO</option>
                                <option value="MT">MT</option>
                                <option value="NE">NE</option>
                                <option value="NV">NV</option>
                                <option value="NH">NH</option>
                                <option value="NJ">NJ</option>
                                <option value="NM">NM</option>
                                <option value="NY">NY</option>
                                <option value="NC">NC</option>
                                <option value="ND">ND</option>
                                <option value="OH">OH</option>
                                <option value="OK">OK</option>
                                <option value="OR">OR</option>
                                <option value="PA">PA</option>
                                <option value="RI">RI</option>
                                <option value="SC">SC</option>
                                <option value="SD">SD</option>
                                <option value="TN">TN</option>
                                <option value="TX">TX</option>
                                <option value="UT">UT</option>
                                <option value="VT">VT</option>
                                <option value="VA">VA</option>
                                <option value="WA">WA</option>
                                <option value="WV">WV</option>
                                <option value="WI">WI</option>
                                <option value="WY">WY</option>
                            </select>
                         </div>  
                         <label  class="control-label">
                          Zip Code
                          <input type="text" class="form-control" data-minlength="5" name="Zip_Code" value="<?php echo $_POST['Zip_Code']; ?>" required>
                         </label>
                         <label class="control-label">
                          ID type
                          <input type="text" name="ID_Type" class="form-control" value="<?php echo $_POST['ID_Type']; ?>" >
                         </label>
                         <label class="control-label">
                          ID Number 
                          <input type="text" name="ID_Number" class="form-control" value="<?php echo $_POST['ID_Number']; ?>">
                         </label>
                         <label class="control-label">
                          Comments
                          <input type="text" name="Comments" class="form-control" value="<?php echo $_POST['Comments']; ?>">   
                         </label> 
                         <label  class="control-label">
                          Password
                          <input type="password" name="Password" class="form-control" placeholder="Password" required>
                          <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                         </label>
                         <div class="radio">
                          <label>
                           <input type="radio" name="numdays" value="30">
                           30 Days
                          </label>
                          <label>
                           <input type="radio" name="numdays" value="60">
                           60 Days
                          </label>
                          <label>
                           <input type="radio" name="numdays" value="90">
                           90 Days
                          </label>
                         </div>
                         <button type="submit" class="btn btn-primary"> Submit </button>
                         <button class="btn btn-danger" type="reset"> Reset </button>
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
<?php }else{
header("location:/AccountManagement/public_html/index.php?badlogin=1");   
} 
?>