<?php  
 session_start();
?>
  <html>
    <title>Validation Server</title>
      <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/stylesheet.css" rel="stylesheet" >
      </head>
      <body>

        <div class="navbar navbar fixed top">
          <div class="navbar-inner">

            <a class="brand" href="http://library.tamu.edu/">
             <img src="images/logo.png" alt="Library Logo">
            </a>
          </div>

          <div class="color-field">
            <div class="row-fluid">
              <div class="span12 pull left breadcrumb">
                 <a href="login.php?AdminLogin=1" class="btn btn-info btn pull-right" role="button"> Admin Login</a>
                <ul class="breadcrumb">
                  <a href="http://library.tamu.edu/">University Libraries</a>
                  >
                  <a href="http://library.tamu.edu/directory">Welcome Page</a>
                </ul>
              </div>
            </div>
          </div>
        </div>
          <div class="container">
            <div class="row-fluid">
              <div class="span12 appMain">
                <a href="login.php" class="btn btn-info" role="button">Login</a>
                <a href="registar.php" class="btn btn-info" role="button">Registar</a>
              </div>
            </div>
          </div>
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
        <?php //Javascript alert box for if theres is a user created echos there User Name
         if($_REQUEST['added']=='true'){
        ?>
        <script>
         alert("UserName: <?php echo  $_SESSION['name'];?>");
        </script>
        <?php } ?>
  </html>