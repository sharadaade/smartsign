<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("../connect.php");
$cn=new connect();
$cn->connectdb();
$pageID= 'page4';

$auto_code = 0;

include_once("../connect.php");
include_once("image_lib_rname.php"); 
$con=new connect();
$con->connectdb();

if(isset($_POST['addSlider']))
{	    
    $image_title=$_FILES["image_title"]['name'];
			
    $sliderImage = createImage('image_title',"../slider/");


    $slider_name = $_POST['slider_name'];
    //$code = $_POST['code'];
    $description = $_POST['description'];
    $meta_tag_title = $_POST['meta_tag_title'];
    $slug = $_POST['slug'];
    //$image = $_POST['image'];
    $urllink = $_POST['urllink'];
					  		
    $con->insertdb("INSERT INTO `tbl_slider` (`image_title`, `desc_slider`, `image_name`,`meta_tag_title`,`slug`,`link_url`) VALUES ('".$slider_name."', '".$description."', '".$sliderImage."', '".$meta_tag_title."', '".$slug."','".$urllink."');");
				
				
	echo "<script>alert('slider is created...');</script>;";	
			
    header("location:sliderView.php");
			
}
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
                <div class="logo-box">
                    <a href="index.php" class="logo text-center">
                        <span class="logo-lg">
                        <?$sqlL = $cn->selectdb("select * from tbl_logo where logo_id= 1 ");
                            $rowL = mysqli_fetch_assoc($sqlL);
                        ?>
                            <img src="<?if($rowL['image_name']!=''){echo "../logo/big_img/".$rowL['image_name'];}?>" alt=""  style="height:50px;">
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
                    <h4 class="page-title-main">Slider</h4>
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
                                <h4 class="mt-0 mb-2 header-title">Slider Form</h4>
                                <form class="form-horizontal" method="post" action="#" id="myform" name="myform" enctype="multipart/form-data">				
                                                                                   
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Slug</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="slug">
                                        </div>
                                    </div>
                                             
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Slider Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="slider_name" name="slider_name" placeholder="Slide Name">
                                        </div>
                                    </div>										
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Description</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Image</label>
                                        <div class="col-sm-4">
                                            <input type="file" id="image_title" name="image_title" class="dropify" />
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Meta Tag Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="meta_tag_title" name="meta_tag_title" placeholder="meta_tag_title">
                                        </div>
                                    </div>	 -->	

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">URL Link</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="urllink" name="urllink" placeholder="URL Link">
                                        </div>
                                        
                                    </div>					
                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="addSlider" id="addSlider" class="btn btn-success">Add</button>
                                            <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='sliderView.php'; return false;" >Cancel</button>
                                        </div>
                                    </div>
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