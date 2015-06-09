<!DOCTYPE html>
<?php if(empty($_SESSION['lgnuser'])){ ?>
<html>
  <title>
   Create Accounts
  </title>
  <head>
      <?php require 'PHP/Reader_Editor.php';
            require_once('PHP/dbConnect.php');
            session_start();?>
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
              <a href="http://library.tamu.edu/">
                University Libraries
              </a>
              >
              <a href="userprofile.php">
                Dashboard
              </a>>
              <a href="CurrentAccounts.php">
                Current Accounts
              </a>
              <form action="CurrentAccounts.php" method="GET" class="control form-inline" style="float:right;">
                 <input type="text" class="form-control" name="search" placeholder="Search">
                 <input type="submit"  class="btn btn-default">
             </form>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div id="wrapper">
      <div id="sidebar-wrapper">
       <h1>Welcome <?php echo $_SESSION['lgnuser']; ?></h1>
        <ul class="sidebar-nav">
         <li class="sidebar-brand">
          <a href="userprofile.php">User Profile</a>
          <a href="AccountCreation.php">Create Account</a>
          <?php if($_SESSION['isadmin']=='1'){ ?>
          <a href="CurrentAccounts.php">Current Accounts</a></li>
          <?php } ?> 
        </ul>
       </div>
      <div id="page-content-wrapper">
        <div class="page-content">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                  <h1 style='text-align: center;'>Current Accounts</h1>
          <table class="table table-bordered">
            <thead>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>ID Number</th>
              <th>ID Type</th>
              <th>Username</th>
              <th>Street</th>
              <th>City</th>
              <th>State</th>
              <th>ZIP Code</th>
              <th>Created On</th>
              <th>Expire's On<span class="glyphicon glyphicon-arrow-down"></span></th>
              <th>Creator</th>
            </thead>
              
            <tbody id="accountstable">
                  <?php 
                  $_SESSION['searchresult'] = $_GET['search'];
                 $db= new DataHandler($conn);
                 $response = $db->databaseSelect();
                 while($row=mysqli_fetch_array($response,MYSQLI_ASSOC)){
                     ?><tr>
                <td id="rowi"><?php echo $row['firstname']; ?></td>
                <td><?php echo $row['lastname']; ?></td>
                <td id="rowi"><?php echo $row['email']; ?></td>
                <td><?php echo $row['idnumber']; ?></td>
                <td id="rowi"><?php echo $row['idtype']; ?></td>
                <td><?php echo $row['username'];?></td>
                <td id="rowi"><?php echo $row['street']; ?></td>
                <td><?php echo $row['city']; ?></td>
                <td id="rowi"><?php echo $row['state']; ?></td>
                <td><?php echo $row['zipcode']; ?></td>
                <td id="rowi"><?php $timestamp = $row['creationdate']; echo gmdate( "F j, Y, g:i a" , $timestamp); ?></td>
                 <td><?php $timestamp = $row['expireddate']; echo gmdate( "F j, Y, g:i a" , $timestamp);  ?>
               <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#<?php echo $row['username']; ?>"> Launch demo modal </button>
                <div class="modal fade" id="<?php echo $row['username'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Change Expiration Date</h4>
                      </div>
                      <div class="modal-body">
                          <form action="PHP/Reader_Editor.php?accountid=<?php echo $row['username']; ?>" method="POST">
                        <input  name="startdate" min="2015-01-01" max="2015-12-31" type="date">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" name="login-submit"  tabindex="4" class="btn btn-primary btn-lg">
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                </td>
                 <td id="rowi"><?php echo $row['createdby']; }?></td></tr>
            </tbody>
          </table>
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
      <?php }else{
header("location:/AccountManagement/public_html/index.php?badlogin=1");   
} ?>
  