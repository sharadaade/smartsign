<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}
include_once("../connect.php");
include_once("../navigationfun.php");
$cn=new connect();
$cn->connectdb();
$pageID= 'page8';

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
                <div class="logo-box">
                    <a href="index.php" class="logo text-center">
                        <span class="logo-lg">
                        <?$sqlL = $cn->selectdb("select * from tbl_logo where logo_id= 1 ");
                            $rowL = mysqli_fetch_assoc($sqlL);
                        ?>
                            <img src="<?if($rowL['image_name']!=''){echo "../logo/big_img/".$rowL['image_name'];}?>" alt="" height="60">
                        </span>
                    </a>
                </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <h4 class="page-title-main">Contact</h4>
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
                                <h4 class="mt-0 header-title">Contact Form</h4>
                                <?
									if(isset($_GET['con_id']))
									{
										$con_id=$_GET['con_id'];
										//echo "select * from tbl_image where image_id='".$image_id."'";die;
										$records=$con->selectdb("select * from tbl_contact where con_id='".$con_id."'");
										$row=mysqli_fetch_row($records);
									}
									?>
					
                                <form class="form-horizontal" method="post" action="contactUpdate.php" id="myform" name="myform" enctype="multipart/form-data">
									
									<input type="hidden" name="page" id="page" value="<? echo $_GET['page'];?>">
                    			    <input type="hidden" id="con_id" name="con_id" value="<?php if(isset($_GET['con_id'])) echo $row[0] ?>" />                                       
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Office Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" id="oname" name="oname" class="form-control" value="<?php if(isset($_GET['con_id'])) echo $row[9] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Map Tag</label>
                                        <div class="col-sm-12">
                                            <textarea rows="5" id="maptag" name="maptag" class="form-control"><?php if(isset($_GET['con_id'])) echo $row[1] ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-12">
                                            <textarea rows="5" id="email" name="email" class="form-control"><?php if(isset($_GET['con_id'])) echo $row[3] ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Contact No.</label>
                                        <div class="col-sm-12">
                                            <textarea rows="5" id="contact_no" name="contact_no" class="form-control"><?php if(isset($_GET['con_id'])) echo $row[4] ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Opening Hours</label>
                                        <div class="col-sm-12">
                                            <textarea rows="5" id="opening_hours" name="opening_hours" class="form-control"><?php if(isset($_GET['con_id'])) echo $row[5] ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-12">
                                            <textarea class="ckeditor" id="contact_desc" name="contact_desc" class="form-control"><?php if(isset($_GET['con_id'])) echo $row[2] ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <!--div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"><span style="color:#F00; font-weight:bold;">*</span> Meta Tag Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="meta_tag_title" name="meta_tag_title" placeholder="Meta Tag Title" value="<?php if(isset($_GET['con_id'])) echo $row[6] ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Description</label>
                                        <div class="col-sm-12">
                                            <textarea rows="5" class="form-control" id="meta_tag_description" name="meta_tag_description" placeholder="Meta Tag Description"  class="form-control"><?php if(isset($_GET['con_id'])) echo $row[7] ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Keywords</label>
                                        <div class="col-sm-12">
                                            <textarea rows="5" class="form-control" id="meta_tag_keywords" name="meta_tag_keywords" placeholder="Meta Tag Keywords" class="form-control"><?php if(isset($_GET['con_id'])) echo $row[8] ?></textarea>
                                        </div>
                                    </div-->
                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-12">
                                            <?php 
                                            if(isset($_GET['con_id']))
                                            {
                                            ?>
                                            <button type="submit" name="update" id="update" class="btn btn-success">Update</button>
                                            <?php
                                            }
                                            else
                                            {	   
                                            ?>
                                            <button type="submit" name="add" id="add" class="btn btn-success">Add</button>
                                            <? } ?>
                                            <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='contactView.php'; return false;" >Cancel</button>
                                        </div>
                                    </div>
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
    
    <!-- ckeditor -->
    <script src="assets/libs/ckeditor/ckeditor.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    
    <!-- Init js-->
    <script src="assets/js/pages/form-advanced.init.js"></script>
    

</body>

</html>