<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("../connect.php");
include_once("../navigationfun.php");
include_once("../sitemap.php");
include_once("image_lib_rname.php"); 
$con=new connect();
$con->connectdb();
$cn=new connect();
$cn->connectdb();

$pageID= 'page23';

$cid=$_GET['cid'];

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

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        <div class="navbar-custom">

                <!-- LOGO -->
                <?php include 'admin_logo.php' ?>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <h4 class="page-title-main">Career</h4>
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
                                <h4 class="mt-0 mb-2 header-title">Career Form</h4>
								<form class="form-horizontal" method="post" action="#" id="myform" name="myform" enctype="multipart/form-data">				
                                <input type="hidden" name="page" id="page" value="<? echo $_GET['page'];?>">
									 
									 <?php
										$records=$con->selectdb("SELECT * FROM tbl_career_info where cid=".$cid."");
										while($row=mysqli_fetch_assoc($records))
										{
										?>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Resume ID</label>
                                            <div class="col-sm-12">
                                                <input readonly type="text" class="form-control" value="<? echo $row['cid']; ?>">
                                            </div>
                                        </div>
															
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-12">
                                                <input readonly type="text" class="form-control" value="<? echo $row['cname']; ?>">
                                            </div>
                                        </div>										
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">email</label>
                                            <div class="col-sm-12">
                                                <input readonly type="text" class="form-control" value="<? echo $row['cemail']; ?>">
                                            </div>
                                        </div>
											
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
                                            <div class="col-sm-12">
                                                <input readonly type="text" class="form-control" value="<? echo $row['cphone']; ?>">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Experience</label>
                                            <div class="col-sm-12">
                                                <input readonly type="text" class="form-control" value="<? echo $row['cexperience']; ?>">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Post</label>
                                            <div class="col-sm-12">
                                                <input readonly type="text" class="form-control" value="<? echo $row['capply']; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='careerInfoView.php'; return false;" >Cancel</button>	
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



    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    
    <!-- ckeditor -->
    <script src="assets/libs/ckeditor/ckeditor.js"></script>

    </body>

</html>