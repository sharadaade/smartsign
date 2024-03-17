<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("../connect.php");
$con=new connect();
$con->connectdb();
$cn=new connect();
$cn->connectdb();

$dmenu_id=$_GET['dmenu_id'];
$pageID= 'page12';

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
                <?php include 'admin_logo.php' ?>

                
            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <h4 class="page-title-main">Menu</h4>
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
                                <h4 class="mt-0 mb-2 header-title">Menu Form</h4>
                                <form class="form-horizontal" method="post" action="dmenu_upload.php" id="myform" name="myform" enctype="multipart/form-data">
									<?php
					
									$records=$con->selectdb("SELECT * FROM tbl_dmenu  where menu_id=".$dmenu_id."");
					
									while($row=mysqli_fetch_assoc($records))
									{
									?>
									<input type="hidden" name="page" id="page" value="<? echo $_GET['page'];?>">
									<input type="hidden" name="menu_id" id="menu_id" value="<?php echo $row["menu_id"]; ?>" />
                        			<input type="hidden" id="menu_parent_id" name="menu_parent_id" value="<?php echo $row["menu_parent_id"]; ?>" />
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Menu Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="menu_name" name="menu_name" placeholder="Menu Name" value="<?php echo $row['menu_name']; ?>">
                                            </div>
                                        </div>

										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Menu Fa Icon</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="menu_fa" name="menu_fa" placeholder="Fa Name" value="<?php echo $row['menu_fa']; ?>">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Menu Class</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="menu_class" name="menu_class" placeholder="Class Name" value="<?php echo $row['menu_class']; ?>">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Menu Link</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="menu_link" name="menu_link" placeholder="Link" value="<?php echo $row['menu_link']; ?>">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Menu Page Id</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="menu_page_id" name="menu_page_id" placeholder="Page Id" value="<?php echo $row['menu_page_id']; ?>">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Image</label>
                                            <div class="col-sm-4">
                                                <input type="file" id="frontimg" name="frontimg" class="dropify" data-default-file="<? if($row['menu_image']!=''){echo "../menu/".$row['menu_image'];}?>"/>
                                            </div>
											<div class="col-sm-4">
											    <input type="hidden" id="frontimg2" name="frontimg2" value="<?php echo $row['menu_image']?>" />
                                                <?php if($row['menu_image']!=''){?>
												  <a href="dmenu_upload.php?id=<?php echo $row['menu_id']; ?>&Image=Del" class="btn btn-lighten-danger" onClick="return confirm('Are you sure want to delete?');">Delete</a>
											    <?php }?>  
                                            </div>
                                        </div>
										
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="updateMenu" id="updateMenu" class="btn btn-success">Update</button>
												<button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='dmenuView.php'; return false;" >Cancel</button>
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

    <!-- dropify js -->
    <script src="assets/libs/dropify/dropify.min.js"></script>

    <!-- form-upload init -->
    <script src="assets/js/pages/form-fileupload.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    
    <!-- ckeditor -->
    <script src="assets/libs/ckeditor/ckeditor.js"></script>

    </body>

</html>