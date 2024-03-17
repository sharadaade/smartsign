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

$pageID= 'page10';

$fav_id=$_GET['fav_id'];

 




		
if(isset($_POST["deleteFavicon"]))
{
$records=$con->selectdb("SELECT image_name FROM tbl_favicon where fav_id=".$fav_id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../favicon/'.$row[0]);
	  unlink('../favicon/big_img/'.$row[0]);
	}
$con->selectdb("update tbl_favicon set image_name='' where fav_id = '".$fav_id."'");
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

<?
if(isset($_POST['updateFavicon']))
{
			$size=$_POST['size'];
			$relation = $_POST['relation'];
			$oldimg=$_POST['frontimg2'];
			$frontimg2=$_FILES["image_title"]['name'];
				
				if($_FILES["image_title"]['error']>0)
				{
				
					$con->insertdb("UPDATE `tbl_favicon` SET `size` = '".$size."', `relation` = '".$relation."' WHERE `fav_id` = '".$fav_id."'");
				}
				else
				{
					@unlink("../favicon/big_img/". $oldimg);
					@unlink("../favicon/". $oldimg);			
					$faviconImage = createImage('image_title',"../favicon/");
					
					$con->insertdb("UPDATE `tbl_favicon` SET `size` = '".$size."', `relation` = '".$relation."', `image_name` = '".$faviconImage."' WHERE `fav_id` = '".$fav_id."'");
				}
	// echo "<script>alert('favicon is updated...');</script>;";
	
	header("location: faviconView.php?page=$page");
}
?>


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
                                <h4 class="mt-0 header-title">Favicon Form</h4>
                                <form class="form-horizontal" method="post" action="#" id="myform" name="myform" enctype="multipart/form-data">
									 <input type="hidden" name="page" id="page" value="<? echo $_GET['page'];?>">
									 
									 <?php
										$records=$con->selectdb("SELECT * FROM tbl_favicon where fav_id=".$fav_id."");
										while($row=mysqli_fetch_assoc($records))
										{
										?>
										
															
										<!--<div class="form-group">-->
          <!--                                  <label for="inputEmail3" class="col-sm-2 control-label">Size</label>-->
          <!--                                  <div class="col-sm-10">-->
          <!--                                      <input type="text" class="form-control" id="size" name="size" placeholder="Slider Name" value="<? echo $row['size']; ?>">-->
          <!--                                  </div>-->
          <!--                              </div>										-->
										
										
										<!--<div class="form-group">-->
          <!--                                  <label for="inputEmail3" class="col-sm-2 control-label">Relation</label>-->
          <!--                                  <div class="col-sm-10">-->
          <!--                                      <input type="text" class="form-control" id="relation" name="relation" placeholder="relation" value="<? echo $row['relation']; ?>"></input>-->
          <!--                                  </div>-->
          <!--                              </div>-->
										
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Image:</label>
                                            <div class="col-sm-4">
                                                <input class="dropify" type="file" id="image_title" name="image_title" data-default-file="<?if($row['image_name']!=""){ echo "../favicon/".$row['image_name'];}?>"/> 
												
                                                <? if($row['image_name']!=''){?>
                                                <button type="submit" name="deleteFavicon" id="deleteFavicon" class="btn btn-lighten-danger" onClick="return confirm('Are you sure want to delete?');">Delete</button>
                                                
                                                <!-- <a class="btn btn-lighten-danger" href="favicon_edit.php?fav_id=<?php echo $_GET['fav_id']; ?>&Image=Del" onClick="return confirm('Are you sure want to delete?');">Delete</a> -->

                                                <? } ?>
                                                <input type="hidden" id="frontimg2" name="frontimg2" value="<?php echo $row['image_name']?>"  />
                                            </div>
                                        </div>
										
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-12">
                                                <button type="submit" name="updateFavicon" id="updateFavicon" class="btn btn-success">Update</button>
                                                <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='faviconView.php'; return false;" >Cancel</button>	
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