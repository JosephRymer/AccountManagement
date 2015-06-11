<!DOCTYPE html>
<html>
 <?php session_start(); 
       if(!empty($_SESSION['lgnuser'])){ 
 ?> 
    <title> Create Account </title>
    <head>
     <link href="css/bootstrap.css" rel="stylesheet">
     <link href="css/bootstrap-theme.css" rel="stylesheet">
     <link href="css/stylesheet.css" rel="stylesheet" >
    </head>
    <body>
        <!-- Header -->
        <div class="navbar navbar fixed top">
            <div class="navbar-inner">
             <a class="brand" href="http://library.tamu.edu/">
              <img src="img/logo.png" alt="Library Logo">
             </a>
            </div>
            <div class="color-field">
                <div class="row-fluid">
                    <div class="span12 pull left breadcrumb">
                     <ul class="breadcrumb">
                      <a href="http://library.tamu.edu/"> University Libraries </a>
                      >
                      <a href="userprofile.php"> Dashboard </a>
                      >
                      <a href="AccountCreation.php"> Create Account </a>
                     </ul>
                    </div>
                </div>
            </div>
        </div>
         <!-- Side Bar -->
            <div id="sidebar-wrapper">
             <h1 style="text-align: center;">Welcome <?php echo $_SESSION['lgnuser']; ?></h1>
             <ul class="sidebar-nav">
              <li class="sidebar-brand">
               <a href="userprofile.php">User Profile</a>
               <a href="AccountCreation.php">Create Account</a>
                <?php if($_SESSION['isadmin']=='1'){ ?>
                 <a href="CurrentAccounts.php">Current Accounts</a>
                <?php } ?>
                <a href="PHP/Reader_Editor.php?logout=1">Logout</a></li>
             </ul>
            </div>
             <!-- Page Content -->
            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <div id="accountcreateform" class="col-md-6">
                         <?php if($_GET["baddata"]=="1"){?>
                          <div class="alert alert-danger" role="alert">
                           <span class="glyphicon glyphicon glyphicon-alert" aria-hidden="true"></span>
                           <span class="sr-only"></span>Missing field or data was incorrect
                          </div>
                         <?php } ?> <!-- Instead of passing data straight to Reader_Editor to be inserted it is passed to Validation.php -->
                         <form data-toggle="validator" role="form" action="PHP/Validation.php" method="POST">
                           <label  form="inputName" class="control-label" > First Name </label>
                             <input type="text" class="form-control" id="inputName" name="F_Name" required>
                           <label class="control-label"> Last Name </label>
                             <input type="text" class="form-control" name="L_Name"  required>
                           <label form="inputEmail" class="control-label"> Email </label>
                             <input type="email" class="form-control" name="E_Mail" required>
                           <label form="inputStreet" class="control-label"> Street </label>
                             <input type="text" class="form-control" name="Street" required>
                           <label form="inputCity" class="control-label"> City </label>
                             <input type="text" class="form-control" name="City" required>
                           <label>State</label>
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
                          <label form="inputEmail" class="control-label"> Zip Code </label>
                             <input type="text" class="form-control" data-minlength="5" name="Zip_Code" required>
                          <label class="control-label"> ID type </label>
                             <input type="text" name="ID_Type" class="form-control" >
                          <label class="control-label"> ID Number </label>
                             <input type="text" name="ID_Number" class="form-control">
                          <label class="control-label"> Comments </label>
                             <input type="text" name="comments" class="form-control">                                              
                          <label form="inputPassword" class="control-label"> Password </label>
                             <input type="password" name="Password" class="form-control" required>
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