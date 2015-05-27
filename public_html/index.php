  <!DOCTYPE html>
  <html>
    <title>TAMUAccounts</title>
      <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/stylesheet.css" rel="stylesheet" >
      </head>
      <body>
      <?php if(!($_GET['login']) && !($_GET['badlogin'])){?>

        <div class="navbar navbar fixed top">
          <div class="navbar-inner"> 
              
            <a class="brand" href="http://library.tamu.edu/">
             <img src="img/logo.png" alt="Library Logo">
            </a>
          </div>

          <div class="color-field">
            <div class="row-fluid">
              <div class="span12 pull left breadcrumb">
                 <a href="index.php?login=1" class="btn btn-info btn pull-right" role="button"> Login</a>
                <ul class="breadcrumb">
                  <a href="http://library.tamu.edu/">University Libraries</a>
                  >
                  <a href="">Welcome Page</a>
                </ul>
              </div>
            </div>
          </div>
        </div>
          <div class="container">
            <div class="row-fluid">
              <div class="span12 appMain">
                <img src="img/TAMU_Logo1.png" alt="Library Logo">
              </div>
            </div>
          </div>
      
      <?php }else if(($_GET['login']) || ($_GET['badlogin'])){?>
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
              <a href=index.php?login>
                Login
              </a>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row-fluid">
        <div class="span12 appMain">
            
           <?php if(isset($_GET["badlogin"])){?>
            <div class="col-md-1">
                  <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Wrong Username or Password</span>
                  </div>
               </div><?php } ?>
          <form action="PHP/Reader_Editor.php?attempt=1" method="POST" role="form" style="display: block;">
            <div class="form-group">
              <input type="text" name="username"  class="form-control" placeholder="Username" value="">
            </div>
            <div class="form-group">
              <input type="password" name="password"  class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                  <input type="submit" name="login-submit"  tabindex="4" class="form-control btn btn-login" value="Log In">
                </div>
              </div>
            </div>
          </div>
        </form>
        
      </div>
    </div>
  </div>
  <?php } ?>
  
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