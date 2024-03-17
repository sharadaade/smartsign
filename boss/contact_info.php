<?php
ob_start();
session_start();

if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("../connect.php");
include_once("../navigationfun.php");
$con=new connect();
$con->connectdb();
$cn=new connect();
$cn->connectdb();

$pageID= 'page8';
$contact_id = $_GET['contact_id'];

?>

<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <title>Master Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
                <?$sqlF = $cn->selectdb("select * from tbl_favicon where fav_id= 1 ");
            $rowF = mysqli_fetch_assoc($sqlF);
        ?>
        <link rel="<?echo $rowF['relation'];?>" href="../favicon/big_img/<?echo $rowF['image_name'];?>" />


        <!--Morris Chart-->
        <link rel="stylesheet" href="assets/libs/morris-js/morris.css" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css?v=<?echo time();?>" rel="stylesheet" type="text/css" />

        <!-- dropify -->
        <link href="assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />



</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        <div class="navbar-custom">

                <!-- LOGO -->
                <?php include 'adminLogo.php'; ?>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <h4 class="page-title-main">Contact Information</h4>
                </li>
    
            </ul>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?include_once("menu.php");?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="mt-0 header-title">Contact Information Form</h4>
                                <form class="form-horizontal" method="post" action="#" id="myform" name="myform" enctype="multipart/form-data">
									 <input type="hidden" name="page" id="page" value="<? echo $_GET['page'];?>">
									 
									 <?php
										$records=$con->selectdb("SELECT * FROM tbl_contactdetails where contact_id=".$contact_id."");
										while($row=mysqli_fetch_assoc($records))
										{
										?>
															
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Contact Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="contact_name" name="contact_name" readonly  value="<? echo $row['contact_name']; ?>">
                                            </div>
                                        </div>										
															
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Email</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="email" name="email" readonly  value="<? echo $row['email']; ?>">
                                            </div>
                                        </div>										
															
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Phone</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="phone" name="phone" readonly  value="<? echo $row['phone']; ?>">
                                            </div>
                                        </div>										
															
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Subject</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="subject" name="subject" readonly  value="<? echo $row['subject']; ?>">
                                            </div>
                                        </div>										
															
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Message</label>
                                            <div class="col-sm-12">
                                                <textarea rows="5" name="message" class="form-control"><? echo $row['message'] ?></textarea>
                                            </div>
                                        </div>										
										
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-12">
                                                <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='contact_infoView.php'; return false;" >Cancel</button>	
                                            </div>
                                        </div>
										
										<? } ?>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- End page -->

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- dropify js -->
    <script src="assets/libs/dropify/dropify.min.js"></script>

    <!-- form-upload init -->
    <script src="assets/js/pages/form-fileupload.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>