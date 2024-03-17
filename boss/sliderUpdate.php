<?php
ob_start();
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("../connect.php");
//include_once("fckeditor/fckeditor.php");
include_once("../navigationfun.php");
include_once("../sitemap.php");
include_once("image_lib_rname.php"); 
$con=new connect();
$con->connectdb();
$cn=new connect();
$cn->connectdb();

$pageID= 'page4';

$slider_id=$_GET['slider_id'];

  
if(isset($_POST['updateSlider']))
{
		
		 $slider_name = $_POST['slider_name'];
			//$code = $_POST['code'];
			$description = $_POST['description'];
			
			$meta_tag_title = $_POST['meta_tag_title'];
			$slug = $_POST['slug'];
			//$image = $_POST['image'];
			$urllink = $_POST['urllink'];
					  		
				$oldimg=$_POST['frontimg2'];
				$frontimg2=$_FILES["image_title"]['name'];
				
				if($_FILES["image_title"]['error']>0)
				
				{
				
				$con->insertdb("UPDATE `tbl_slider` SET `image_title` = '".$slider_name."', `desc_slider` = '".$description."', `meta_tag_title` = '".$meta_tag_title."' , `slug` = '".$slug."',`link_url` = '".$urllink."' WHERE `tbl_slider`.`slider_id` = '".$slider_id."'");
				}
				else
				{
				@unlink("../slider/big_img/". $oldimg);
				@unlink("../slider/". $oldimg);
				

				$sliderImage = createImage('image_title',"../slider/");
				
				$con->insertdb("UPDATE `tbl_slider` SET `image_title` = '".$slider_name."', `desc_slider` = '".$description."', `meta_tag_title` = '".$meta_tag_title."' , `slug` = '".$slug."',`image_name` = '".$sliderImage."', `link_url` = '".$urllink."' WHERE `tbl_slider`.`slider_id` = '".$slider_id."'");
				}
// $sliderImage = createImage('image_title',"../slider/");
/*$file = $_FILES['image_title'];
			$fileName = $_FILES['image_title']['name'];
			$fileTmpName = $_FILES['image_title']['tmp_name'];
			$fileSize = $_FILES['image_title']['size'];
			$fileError = $_FILES['image_title']['error'];
			$fileType = $_FILES['image_title']['type'];
		
			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));
		
			$allowed = array('jpg', 'jpeg', 'png');
		
			if (in_array($fileActualExt, $allowed)) {
				// if ($fileError === 0) {
					if ($fileSize < 900000000) {
						$fileNameNew = $fileExt[0].rand(100, 999).".".$fileActualExt;
						$fileDestination = '../slider/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						// header("Location: a1.php?uploadSuccess");
					}

					// else{
					//     echo "your file is too big";
					// }
				// }
				// else{
				//     echo "there was problem in uploading file";
				// }
			}

			// else{
			//     echo "you can not upload file of this type";
			// }
					//   ----------------------------
					// --------audio---------------
					// -----------------------------------
				
				$con->insertdb("UPDATE `tbl_slider` SET `image_title` = '".$slider_name."', `desc_slider` = '".$description."', `meta_tag_title` = '".$meta_tag_title."' , `slug` = '".$slug."',`image_name` = '".$fileNameNew."', `link_url` = '".$urllink."' WHERE `tbl_slider`.`slider_id` = '".$slider_id."'");
				}*/
				


	echo "<script>alert('Slider is updated...');</script>;";
	
	header("location: sliderView.php?page=$page");
}


if(isset($_POST['saveasSlider']))
{
  $slider_name = $_POST['slider_name'];
			//$code = $_POST['code'];
			$description = $_POST['description'];
			$meta_tag_title = $_POST['meta_tag_title'];
			$slug = $_POST['slug'];
			//$image = $_POST['image'];
			$urllink = $_POST['urllink'];
					  		
				
				$frontimg2=$_POST['frontimg2'];
				
				if($_FILES["image_title"]['name']!="")
				
				{
					//echo 'if';die;
					if ((($_FILES["image_title"]["type"] == "image/gif")
						|| ($_FILES["image_title"]["type"] == "image/jpeg")
						|| ($_FILES["image_title"]["type"] == "image/jpg")
						|| ($_FILES["image_title"]["type"] == "image/JPG")
						|| ($_FILES["image_title"]["type"] == "image/pjpeg"))
						&& ($_FILES["image_title"]["size"] < 10000000))
	  
						{
					     // echo 'if if';die;
							@unlink("../slider/big_img/". $frontimg2);
							@unlink("../slider/". $frontimg2);
							//$sliderImage = uploadImage('frontimg','../slider/');
							if($_FILES["image_title"]["type"] == "image/gif")
									$extension=".gif";
					   else if($_FILES["image_title"]["type"] == "image/jpeg")
							$extension=".jpeg";
					   else if($_FILES["image_title"]["type"] == "image/jpg")
							$extension=".jpg";
						else if($_FILES["image_title"]["type"] == "image/pjpeg")
							$extension=".pjpeg";	
						else if($_FILES["image_title"]["type"] == "image/png")
						$extension=".png";
			
					   $name=rand();
							  
						//$sliderImage = uploadImage('image_title','../slider/');
						move_uploaded_file($_FILES["image_title"]["tmp_name"],"../slider/big_img/" . md5($name).$extension);
						//echo "insert into tbl_slider values(NULL,'".md5($name).$extension."','".$_REQUEST["img_name"]."')";
						$sliderImage = 	md5($name).$extension ;		
						make_thumb("../slider/big_img/".md5($name).$extension,"../slider/".md5($name).$extension,200);
						
						}
					else
						{
						//echo 'else';die;
						  echo '<script> alert ("Image size is large"); </script>';
	
						}
						
						$con->insertdb("INSERT INTO `tbl_slider` (`image_title`, `desc_slider`, `image_name`, `link_url`) VALUES ('".$slider_name."', '".$description."', '".$sliderImage."', '".$urllink."');");
				}
				else
				{
				$con->insertdb("INSERT INTO `tbl_slider` (`image_title`, `desc_slider`, `image_name`,`meta_tag_title`,`slug`, `link_url`) VALUES ('".$slider_name."', '".$description."','".$frontimg2."', '".$meta_tag_title."', '".$slug."', '".$urllink."');");
				}
		
				
	echo "<script>alert('New Slider is created...');</script>;";	
			
			header("location:sliderView.php");
			
			}
		
	if(isset($_GET["Image"]))
	{
	//print_r($_GET);die;
	$page=$_GET['page'];
	$slider_id= $_GET['slider_id'];
	$records=$con->selectdb("SELECT * FROM tbl_slider where slider_id=".$slider_id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../slider/'.$row[0]);
	  unlink('../slider/big_img/'.$row[0]);

	}
	$con->selectdb("update tbl_slider set image_name='' where slider_id = '".$slider_id."'");
	header("location: sliderUpdate.php?slider_id=".$slider_id."&page=".$page);


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
                            <img src="<?if($rowL['image_name']!=''){echo "../logo/big_img/".$rowL['image_name'];}?>" alt="" style="height:50px;">
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
									    <input type="hidden" name="page" id="page" value="<? echo $_GET['page'];?>">
									 
                                        <?php
                                            $records=$con->selectdb("SELECT * FROM tbl_slider where slider_id=".$slider_id."");
                                            while($row=mysqli_fetch_assoc($records))
                                            {
                                        ?>
                                        										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Slug</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" value="<? echo $row['slug']; ?>">
                                            </div>
                                        </div>
                                        
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Sliders Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="slider_name" name="slider_name" placeholder="Slider Name" value="<? echo $row['image_title']; ?>">
                                            </div>
                                        </div>										
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Description</label>
                                            <div class="col-sm-12">
                                                <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><? echo $row['desc_slider']; ?></textarea>
                                            </div>
                                        </div>
										
										<!-- <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Meta Tag Title</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="meta_tag_title" name="meta_tag_title" placeholder="meta_tag_title" value="<? echo $row['meta_tag_title']; ?>">
                                            </div>
                                        </div> -->
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Image:</label>
                                            <div class="col-sm-4">
                                                <input type="file" id="image_title" name="image_title" class="dropify" data-default-file="<? if($row['image_name']!=''){echo "../slider/".$row['image_name'];}?>"/>
                                                <? if($row['image_name']!=''){?>
                                                    <a href="sliderUpdate.php?slider_id=<?php echo $row['slider_id']; ?>&Image=Del" class="btn btn-lighten-danger" onClick="return confirm('Are you sure want to delete?');">Delete</a>
                                                <? } ?>
											    <input type="hidden" id="frontimg2" name="frontimg2" value="<?php echo $row['image_name']?>"  />
                                            </div>
                                        </div>
										
										<div class="form-group" style="display:none;">
                                            <label for="inputEmail3" class="col-sm-12 control-label">URL Link</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="urllink" name="urllink" placeholder="URL Link" value="<? echo $row['link_url']; ?>">
                                            </div>
                                        </div>	                              
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="updateSlider" id="updateSlider" class="btn btn-success">Update</button>
												<button type="submit" name="saveasSlider" id="saveasSlider" class="btn btn-success">Save As</button>
                                                <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='sliderView.php'; return false;" >Cancel</button>	
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