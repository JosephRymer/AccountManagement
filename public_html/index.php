<!DOCTYPE html>
<html>
    <title> Account Management </title>
    <head>
     <link href="css/bootstrap.css" rel="stylesheet">
     <link href="css/bootstrap-theme.css" rel="stylesheet">
     <link href="css/stylesheet.css" rel="stylesheet" >
    </head>
    <body>
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
                  <a href=#>
                   University Libraries
                  </a>
                  >
                  <a href="index.php">
                   Welcome Page
                  </a>
                  >
                  <a href=index.php>
                   Login
                  </a>
                 </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row-fluid">
            <div id="loginform" class="span12  col-md-6">
                <?php if($_GET["badlogin"]=='1'){?>
                    <div class="alert alert-danger" role="alert">
                     <span class="glyphicon glyphicon glyphicon-alert" aria-hidden="true"></span><span class="sr-only"></span>Wrong Username or Password
                    </div>
                <?php } ?>
                <form  action="PHP/Reader_Editor.php?attempt=1"  method="POST" role="form" >
                    <div class="form-group">
                     <input type="text" name="username"  class="form-control" placeholder="Username" value="">
                    </div>
                    <div class="form-group">
                     <input type="password" name="password"  class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                             <input type="submit" name="login-submit"  tabindex="4" class="form-control btn-login" value="Log In">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </body>
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.js"></script>
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