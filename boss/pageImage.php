<?php
ob_start();
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("../connect.php");
include_once("../navigationfun.php");
// include_once("../sitemap.php");
include_once("image_lib.php"); 

$con=new connect();
$con->connectdb();
$cn=new connect();
$cn->connectdb();

$pageID= 'page6';

$oldimage_id= $_GET['icon_id'];
$oldimage= $_GET['name'];

$page_id = $_GET['page_id'];
$page= $_GET['page'];

?>
<?


if(isset($_POST['editbtn']))
{
$records=$con->selectdb("select * from tbl_addmore where page_id='".$page_id."' and addmore_id='".$oldimage_id."' ");
			$row=mysqli_fetch_row($records);
			
			//$final= explode(",",$row[4]);
			//print_r( $final);die;
			
			// single image
			if($_FILES["frontimg"]['error'] > 0)// it means no new image selected insert previous one......
				{
				
					//$con->insertdb("UPDATE `tbl_product` SET product_name='".$product_name."',description='".$description."',cat_id='".$catID."',product_image='".$frontimg2."',multi_images='".$frontimg1."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."'  where product_id='".$product_id."'");
				}
				else
				{
				
				@unlink("../icon/big_img/". $oldimage);
			    @unlink("../icon/". $oldimage);
				$single_image = createImage('frontimg',"../icon/");

			    $con->insertdb("update tbl_addmore set extra_icon='".$single_image."' where page_id='".$page_id."' and addmore_id='".$oldimage_id."' ");

				}

			// end of image
			
				
				
				
				
	 		header("location:page.php?page_id=".$page_id."&page=$page");
			}


?>
<!DOCTYPE html>
<html>
    
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
                    <h4 class="page-title-main">Information</h4>
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
                                <h4 class="mt-0 header-title">Icon Image Form</h4>
                                <form class="form-horizontal" method="post"  id="myform" name="myform" enctype="multipart/form-data">
									
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                                        <div class="col-sm-4">
                                            <input type="file" id="frontimg" name="frontimg" class="dropify" data-default-file="<?echo "../icon/".$oldimage;?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="editbtn" id="editbtn" class="btn btn-success">Update</button>
                                            <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='pageView.php'; return false;" >Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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