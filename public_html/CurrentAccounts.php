<!DOCTYPE html>
<?php session_start(); 
if(!empty($_SESSION['lgnuser'])){ ?>
    <html>
        <title> Create Accounts </title>
        <head>
            <?php require 'PHP/Reader_Editor.php';
                  require 'PHP/Validation.php';
                  $db= new DataHandler($conn);
                  if(isset($_GET['accountid'])){
                     $db->updateAccount($_POST,$_GET['accountid']); 
                  }else{
                     $db->updateAccount($_POST,$_GET['accountid']);
                  }
                  if(isset($_GET['accountsearch'])){
                     $repsonse = $db->searchAccount($_POST);
                  }else{
                     $response = $db->getAccount();
                  }
                  if(isset($_GET['accountsearch'])){
                     $repsonse = $db->searchAccount($_POST);
                  }else{
                     $response = $db->getAccount();
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
                            <form action="CurrentAccounts.php?accountsearch" method="POST" class="control form-inline" style="float:right;">
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
                             <a href="CurrentAccounts.php">
                              Current Accounts
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
                             <h1 style='text-align: center;'>Current Accounts</h1>
                             <table class="table table-bordered table table-striped">
                              <thead>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Created On</th>
                                <th>Expire's On<span class="glyphicon glyphicon-arrow-down"></span></th>
                                <th>Creator</th>
                              </thead>
                              <tbody>
                                <?php   
                                 while($row=mysqli_fetch_array($response,MYSQLI_ASSOC)){
                                ?><tr>
                                   <td><?php echo $row['firstname']; ?></td>
                                   <td><?php echo $row['lastname']; ?></td>
                                   <td><?php echo $row['email']; ?></td>
                                   <td><?php echo $row['username'];?>
                                    <button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#<?php echo $row['username']; ?>"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <div class="modal fade" id="<?php echo $row['username'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" style=" margin: 300px auto;">
                                            <div class="modal-content" style="color:#000">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Change UserName</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="CurrentAccounts.php?accountid=<?php echo $row['username']; ?>" method="POST">
                                                    <input type="text"class="form-control" name="username" required>
                                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                                    <input type="submit" class="btn btn-primary btn-sm">
                                                 </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   </td>
                                    <td><?php $timestamp = $row['creationdate']; echo gmdate( "F j, Y, g:i a" , $timestamp); ?></td>
                                    <td><?php $timestamp = $row['expireddate']; echo gmdate( "F j, Y, g:i a" , $timestamp);  ?>
                                     <button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#E<?php echo $row['username']; ?>"><span class="glyphicon glyphicon-pencil"></span></button>
                                     <div class="modal fade" id="E<?php echo $row['username'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" style=" margin: 300px auto;">
                                            <div class="modal-content" style="color:#000">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Change Expiration Date</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="CurrentAccounts.php?accountid=<?php echo $row['username']; ?>" method="POST">
                                                   <input  name="startdate" min="2015-01-01" max="2015-12-31" type="date">
                                                   <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                                   <input type="submit" class="btn btn-primary btn-sm">
                                                 </form>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                    </td>
                                    <td><?php echo $row['createdby']; }?></td></tr>
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
<?php }else{
header("location:/AccountManagement/public_html/index.php?badlogin=1");   
} ?>
