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

$pageID= 'page19';

$event_id=$_GET['event_id'];

if(isset($_POST['updateSlider']))
{
    $event_name = $_POST['event_name'];
    $desc_event = $_POST['desc_event'];
    $meta_tag_title=$_POST['meta_tag_title'];
    $meta_tag_description=$_POST['meta_tag_description'];
    $meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
	$event_date=$_POST['event_date'];
	$event_place=$_POST['event_place'];
	$companies=$_POST['companies'];
	$attendees=$_POST['attendees'];
	$highlights=$_POST['highlights'];
	$speakers=$_POST['speakers'];
    $slug=$_POST['slug'];
    
    $con->insertdb("UPDATE `tbl_event` SET `event_name` = '".$event_name."', `desc_event` = '".$desc_event."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."', banner_image='".$banner_image."', event_date='".$event_date."', event_place='".$event_place."', companies='".$companies."', attendees='".$attendees."', highlights='".$highlights."', speakers='".$speakers."', slug='".$slug."' WHERE `tbl_event`.`event_id` = '".$event_id."'");
    
    $frontimg1=$_POST['frontimg1'];
    $frontimg2=$_POST['frontimg2'];
    $frontimg21=$_POST['frontimg21'];
        
    if($_FILES["image_title"]['error']>0){
        $con->insertdb("UPDATE `tbl_event` SET `image_title` = '".$frontimg2."' WHERE `tbl_event`.`event_id` = '".$event_id."'");
    }
    else{
        @unlink("../event/big_img/". $frontimg2);
        @unlink("../event/". $frontimg2);
        $sliderImage = createImage('image_title',"../event/");
        
        $con->insertdb("UPDATE `tbl_event` SET `image_title` = '".$sliderImage."' WHERE `tbl_event`.`event_id` = '".$event_id."'");
    }
    if($_FILES["banner_image"]['error']>0){
        $con->insertdb("UPDATE `tbl_event` SET `banner_image` = '".$frontimg21."' WHERE `tbl_event`.`event_id` = '".$event_id."'");
    }
    else{
        @unlink("../eventB/big_img/". $frontimg21);
        @unlink("../eventB/". $frontimg21);
        $sliderImage1 = createImage('banner_image',"../eventB/");
        
        $con->insertdb("UPDATE `tbl_event` SET `banner_image` = '".$sliderImage1."' WHERE `tbl_event`.`event_id` = '".$event_id."'");
    }
    $size_sum = array_sum($_FILES['multi_images']['size']);
    if ($size_sum > 0) {
        $multi_images = createMultiImage('multi_images', "../eventF/");	
        $final= $frontimg1.$multi_images;
        $con->insertdb("UPDATE `tbl_event` SET multi_images='".$final."' where event_id='".$event_id."'");
    }
    else{
        $con->insertdb("UPDATE `tbl_event` SET multi_images='".$frontimg1."' where event_id='".$event_id."'");	
    }
	header("location: eventView.php?page=$page");
}

if(isset($_GET["Image"])){
	//print_r($_GET);die;
	$page=$_GET['page'];
	$event_id= $_GET['event_id'];
	$records=$con->selectdb("SELECT * FROM tbl_event where event_id=".$event_id."");
	while($row=mysqli_fetch_row($records)){
	  @unlink('../event/'.$row[2]);
	  @unlink('../event/big_img/'.$row[2]);
	}
	$con->selectdb("update tbl_event set image_title='' where event_id = '".$event_id."'");
	header("location: eventUpdate.php?event_id=".$event_id."&page=".$page);
}	
if(isset($_GET["ImageB"])){
	//print_r($_GET);die;
	$page=$_GET['page'];
	$event_id= $_GET['event_id'];
	$records=$con->selectdb("SELECT banner_image FROM tbl_event where event_id=".$event_id."");
	while($row=mysqli_fetch_row($records)){
	  @unlink('../eventB/'.$row[0]);
	  @unlink('../eventB/big_img/'.$row[0]);
	}
	$con->selectdb("update tbl_event set banner_image='' where event_id = '".$event_id."'");
	header("location: eventUpdate.php?event_id=".$event_id."&page=".$page);
}	
if(isset($_REQUEST["btnDeleteImages"])){
	$event_id = $_GET['event_id'];
	$page = $_POST['page'];
	$image = $_POST['frontimg1'];
	$image_list = explode(',',$image);
	$new_image_list = '';
	
	if(isset($_REQUEST["imageEdit"])){
		foreach($_REQUEST['imageEdit'] as $row){
			 $image = str_replace($row.',' , '' ,$image);
			 @unlink('../eventF/big_img/'.$row);
			 @unlink('../eventF/'.$row);
		}
		
		$con->selectdb("update tbl_event set multi_images='".$image."' where event_id = '".$event_id."'");
		header("location: eventUpdate.php?event_id=".$event_id."&page=".$page);
	}
	else{
		echo '<script?>alert("No Image selected");</script>';
	}	
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

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="mt-0 mb-2 header-title">Event Form</h4>
                                <form class="form-horizontal" method="post" action="#" id="myform" name="myform" enctype="multipart/form-data">
									 <input type="hidden" name="page" id="page" value="<? echo $_GET['page'];?>">
                                    <?php
										$records=$con->selectdb("SELECT * FROM tbl_event where event_id=".$event_id."");
										while($row=mysqli_fetch_assoc($records))
										{
										?>
															
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Event Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Event Name" value="<? echo $row['event_name']; ?>">
                                            </div>
                                        </div>										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Slug</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="slug" name="slug" value="<? echo $row['slug']; ?>" placeholder="Slug">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Event Date</label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control" id="event_date" name="event_date" placeholder="Event Date" value="<? echo $row['event_date']; ?>">
                                            </div>
                                        </div>										
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Event Place</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="event_place" name="event_place" placeholder="Event Place" value="<? echo $row['event_place']; ?>">
                                            </div>
                                        </div>										
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Companies</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="companies" name="companies" placeholder="Companies" value="<? echo $row['companies']; ?>">
                                            </div>
                                        </div>										
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Attendees</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="attendees" name="attendees" placeholder="Attendees" value="<? echo $row['attendees']; ?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                                            <div class="col-sm-12">
                                                <textarea type="text" class="ckeditor" id="desc_event" name="desc_event" placeholder="Description"><? echo $row['desc_event']; ?></textarea>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Highlights</label>
                                            <div class="col-sm-12">
                                                <textarea type="text" class="ckeditor" id="highlights" name="highlights" placeholder="Highlights"><? echo $row['highlights']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Speakers</label>
                                            <div class="col-sm-12">
                                                <textarea type="text" class="ckeditor" id="speakers" name="speakers" placeholder="Speakers"><? echo $row['speakers']; ?></textarea>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                                            <div class="col-sm-4">
                                                <input type="file" id="image_title" name="image_title" class="dropify" data-default-file="<?if($row['image_title']!=""){echo "../event/".$row['image_title'];}?>" />
												
											<? if($row['image_title']!=''){?>
											<!-- <br><img src="../event/<? //echo $row['image_title'];?>" width="100"> -->
											<a href="eventUpdate.php?event_id=<?php echo $row['event_id']; ?>&Image=Del" class="btn btn-lighten-danger" onClick="return confirm('Are you sure want to delete?');">Delete</a>

											<? } ?>
											<input type="hidden" id="frontimg2" name="frontimg2" value="<?php echo $row['image_title']?>"  />
                                            </div>
                                        </div>

										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Banner Image</label>
                                            <div class="col-sm-4">
                                                <input type="file" id="banner_image" name="banner_image" class="dropify" data-default-file="<?if($row['banner_image']!=""){echo "../eventB/".$row['banner_image'];}?>" />
												
											<? if($row['banner_image']!=''){?>
											<!-- <br><img src="../event/<? //echo $row['banner_image'];?>" width="100"> -->
											<a href="eventUpdate.php?event_id=<?php echo $row['event_id'];?>&ImageB=Del" class="btn btn-lighten-danger" onClick="return confirm('Are you sure want to delete?');">Delete</a>

											<? } ?>
											<input type="hidden" id="frontimg21" name="frontimg21" value="<?php echo $row['banner_image']?>"  />
                                            </div>
                                        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Event Images:</label>
            <input type="hidden" class="form-control" id="frontimg1" name="frontimg1" placeholder="Multiple Images" value="<? echo $row['multi_images']; ?>">

            <div class="col-sm-4">
                <input type="file" name="multi_images[]" class="dropify" multiple/>											
                <div class="attached-files mt-4">
                    <ul class="list-inline files-list">
                        <?
                        if(isset($_GET["event_id"]))
                        {
                            $image = $row['multi_images'];
                            
                            if($image!="" || $image!=NULL)
                            {
                                $image_list = explode(',',$image);
                                $cnt = 1;
                                
                                for($i=0;$i<count($image_list)-1;$i++)
                                {
                        ?>
                                    <?php //echo "image name=".$image_list[$i]; ?>
                                    <li class="list-inline-item file-box">
                                        <div class=" custom-control custom-switch">
                                            <input class="custom-control-input" type="checkbox" name="imageEdit[]" id="<?php echo $image_list[$i]; ?>" value="<?php echo $image_list[$i]; ?>">
                                            <label class="custom-control-label" for="<?php echo $image_list[$i]; ?>">
                                                <img src="../eventF/<?php echo $image_list[$i]; ?>" class="img-fluid img-thumbnail" alt="attached-img" width="80">
                                            </label>
                                        </div>
                                    </li>
                        <?php
                                }
                            // echo '<tr><td><input type="submit" class="btn btn-lighten-danger" name="btnDeleteImages" value="Delete Selected Images"</td></tr></table>';
                            echo '<div class="row mt-2 mb-2"><div class="col-12"><input type="submit" class="btn btn-lighten-danger" name="btnDeleteImages" value="Delete Selected Images"></div></div>';

                            }
                        }
                        ?>
                    </ul>
                </div>
            
            </div>
            
        </div>
											
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label"><span style="color:#F00; font-weight:bold;">*</span> Meta Tag Title</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="meta_tag_title" name="meta_tag_title" placeholder="Meta Tag Title"  value="<?php echo $row['meta_tag_title']?>">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Description</label>
                                            <div class="col-sm-12">
                                                <textarea cols="5" rows="5" class="form-control" id="meta_tag_description" name="meta_tag_description" placeholder="Meta Tag Description" ><?php echo $row['meta_tag_description']?></textarea>
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Keywords</label>
                                            <div class="col-sm-12">
                                                <textarea cols="5" rows="5" class="form-control" id="meta_tag_keywords" name="meta_tag_keywords" placeholder="Meta Tag Keywords"><?php echo $row['meta_tag_keywords']?></textarea>
                                            </div>
                                        </div>
									                            
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="updateSlider" id="updateSlider" class="btn btn-success">Update</button>
                                                <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='eventView.php'; return false;" >Cancel</button>	
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