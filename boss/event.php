<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}
include_once("../connect.php");

$cn=new connect();
$cn->connectdb();
$pageID= 'page19';

$auto_code = 0;

include_once("../connect.php");
include_once("image_lib_rname.php"); 
$con=new connect();
$con->connectdb();

if(isset($_POST['addSlider']))
{	    
	$image_title=$_FILES["image_title"]['name'];
	$eventImage = createImage('image_title',"../event/");
	$event_name = $_POST['event_name'];
	$desc_event = $_POST['desc_event'];
	$meta_tag_title=$_POST['meta_tag_title'];
	$meta_tag_description=$_POST['meta_tag_description'];
	$meta_tag_keywords=$_POST['meta_tag_keywords'];
	$banner_image = createImage('banner_image',"../eventB/");
	$event_date=$_POST['event_date'];
	$event_place=$_POST['event_place'];
	$companies=$_POST['companies'];
	$attendees=$_POST['attendees'];
	$highlights=$_POST['highlights'];
	$speakers=$_POST['speakers'];
	$slug=$_POST['slug'];
	$multi_images = createMultiImage('multi_images', "../eventF/");
					  		
	$con->insertdb("INSERT INTO `tbl_event` (`image_title`, `desc_event`, `event_name`,`meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`,`banner_image`, `event_place`, `event_date`, `companies`, `attendees`, `highlights`, `speakers`,`slug`,`multi_images`) VALUES ('".$eventImage."', '".$desc_event."', '".$event_name."', '".$meta_tag_title."', '".$meta_tag_description."', '".$meta_tag_keywords."','".$banner_image."','".$event_place."','".$event_date."','".$companies."','".$attendees."','".$highlights."','".$speakers."','".$slug."','".$multi_images."');");
			
	header("location:eventView.php");
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
                <?php include 'admin_logo.php' ?>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <h4 class="page-title-main">Event</h4>
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
                                <h4 class="mt-0 mb-2 header-title">Event Form</h4>
								<form class="form-horizontal" method="post" action="#" id="myform" name="myform" enctype="multipart/form-data">				
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Event Name</label>
										<div class="col-sm-12">
											<input type="text" class="form-control" id="event_name" name="event_name" placeholder="Event Name">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Slug</label>
										<div class="col-sm-12">
											<input type="text" class="form-control" id="slug" name="slug" placeholder="Slug">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Event Date</label>
										<div class="col-sm-12">
											<input type="date" class="form-control" id="event_date" name="event_date" placeholder="Event Date">
										</div>
									</div>										
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Event Place</label>
										<div class="col-sm-12">
											<input type="text" class="form-control" id="event_place" name="event_place" placeholder="Event Place">
										</div>
									</div>										
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Companies</label>
										<div class="col-sm-12">
											<input type="text" class="form-control" id="companies" name="companies" placeholder="Companies">
										</div>
									</div>										
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Attendees</label>
										<div class="col-sm-12">
											<input type="text" class="form-control" id="attendees" name="attendees" placeholder="Attendees">
										</div>
									</div>										
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Description</label>
										<div class="col-sm-12">
											<textarea type="text" class="ckeditor" id="desc_event" name="desc_event" placeholder="Description"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Highlights</label>
										<div class="col-sm-12">
											<textarea type="text" class="ckeditor" id="highlights" name="highlights" placeholder="Highlights"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Speakers</label>
										<div class="col-sm-12">
											<textarea type="text" class="ckeditor" id="speakers" name="speakers" placeholder="Speakers"></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Image</label>
										<div class="col-sm-4">
											<input type="file" id="image_title" name="image_title" class="dropify"/>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Banner Image</label>
										<div class="col-sm-4">
											<input type="file" id="banner_image" name="banner_image" class="dropify"/>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Event Images</label>
										<div class="col-sm-4">
											<input type="file" id="multi_images" name="multi_images[]" multiple class="dropify" />
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><span style="color:#F00; font-weight:bold;">*</span> Meta Tag Title</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="meta_tag_title" name="meta_tag_title" placeholder="Meta Tag Title" >
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Description</label>
										<div class="col-sm-10">
											<textarea cols="5" rows="5" class="form-control" id="meta_tag_description" name="meta_tag_description" placeholder="Meta Tag Description" ></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Keywords</label>
										<div class="col-sm-10">
											<textarea cols="5" rows="5" class="form-control" id="meta_tag_keywords" name="meta_tag_keywords" placeholder="Meta Tag Keywords"></textarea>
										</div>
									</div>
													
									
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" name="addSlider" id="addSlider" class="btn btn-success">Add</button>
											<button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='eventView.php'; return false;" >Cancel</button>
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