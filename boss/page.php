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
$pageID= 'page6';

if(isset($_GET['parentid']))
{
	$parentid=$_GET['parentid'];
}
else
{
	$parentid=0;
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
                                <h4 class="mt-0 header-title">Information Form</h4>
                                <?
                                    if(isset($_GET['page_id']))
                                    {
                                        $page_id=$_GET['page_id'];
                                        //echo "select * from tbl_image where image_id='".$image_id."'";die;
                                        $records=$con->selectdb("select * from tbl_page where page_id='".$page_id."'");
                                        $row=mysqli_fetch_array($records);
                                        /*$title=array_filter(explode("NEWTITLE",$row[5]));
                                        $cnt_title= count($title);
                                        
                                        $desc=explode("NEWDESC",$row[6]);
                                        $cnt_desc= count($desc);
                                        
                                        $iconImg = $row[7];
                
                                        $image_list = explode(',',$iconImg);
                                        */
                                    }
                                    //print_r($row);
								?>
                                <form class="form-horizontal" method="post" action="page_upload.php" id="myform" name="myform" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-sm-12">

                                            									
									<input type="hidden" name="page" id="page" value="<?  if (isset($_GET['page']) && !empty($_GET['page'])) echo $_GET['page'];?>">
 									<input type="hidden" id="page_id" name="page_id" value="<?php if(isset($_GET['page_id'])) echo $row[0] ?>" />
                        			<input type="hidden" id="page_parent_id" name="page_parent_id" value="<?php echo $parentid ?>" /> 
                                    
                                    <!-- slug -->
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Slug</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="<?php if(isset($_GET['page_id'])) echo $row[9]; ?>">
                                        </div>
                                    </div>
                                    <!-- slug -->

                                    <!-- page name -->
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Page Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Page Name" value="<?php if(isset($_GET['page_id'])) echo $row[1] ?>">
                                        </div>
                                    </div>
                                    <!-- page name -->
                                        
                                    <!-- description -->
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-12">
                                            <textarea cols="80" id="page_desc" class="ckeditor" name="page_desc" rows="10"><?php if(isset($_GET['page_id'])) echo $row[2] ?></textarea>
                                        </div>
                                    </div>
                                    <!-- description -->
                                        
                                    <!-- image -->
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                                        <div class="col-sm-4">
                                            <input type="file" id="frontimg" class="dropify" name="frontimg" data-default-file="<?if(isset($_GET['page_id'])){ if($row[4]!=''){echo '../page/'. $row[4];}}?>"  />
                                            <? if(isset($_GET['page_id']))
                                            {
                                                if($row[4]!=''){
                                            ?>
                                                <input type="hidden" id="frontimg2" name="frontimg2" value="<?php echo $row[4]?>" >
                                                <a class="btn btn-lighten-danger" href="page_upload.php?id=<?php echo $row[0]; ?>&ProImage=Del" onClick="return confirm('Are you sure want to delete?');">Delete</a>
                                            <?php }} ?> 
                                        </div>
                                    </div>
                                    <!-- image -->
										
										<!-- multi images -->
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Multiple Images:</label>
											
											<input type="hidden" class="form-control" id="frontimg1" name="frontimg1" placeholder="Multiple Images" value="<?php if(isset($_GET['page_id'])) echo $row['multi_images']; ?>">
                                            <div class="col-sm-4">
                                            <input type="file" class="dropify" name="image_title[]" multiple/>
                                            <div class="attached-files mt-4">
                                                <ul class="list-inline files-list">
                                                
											<?
											if(isset($_GET["page_id"]))
                                            {
                                                $image = $row['multi_images'];
                                                
                                                if($image!="" || $image!=NULL)
                                                {
                                                    $image_list = explode(',',$image);
                                                    echo '<table>';
                                                        $cnt = 1;
                                                        
                                                    for($i=0;$i<count($image_list)-1;$i++)
                                                    {
                                                        if($cnt==1)
                                                        {
                                                            echo '<tr>';
                                                        }
                                            ?>
                                            <?php //echo "image name=".$image_list[$i]; ?>
                                                            
                                                            <!-- <input type="checkbox" name="imageEdit[]" value="<?php ///echo $image_list[$i]; ?>"> -->
                                                            
                                                            <!-- <img src="../pageF/<?php //echo $image_list[$i]; ?>" height="50" width="75"/> -->
                                                            
                                                                <li class="list-inline-item file-box">
                                                                    <div class=" custom-control custom-switch">
                                                                        <input class="custom-control-input" type="checkbox" name="imageEdit[]" id="<?php echo $image_list[$i]; ?>" value="<?php echo $image_list[$i]; ?>">
                                                                        <label class="custom-control-label" for="<?php echo $image_list[$i]; ?>">
                                                                            <img src="../pageF/<?php echo $image_list[$i]; ?>" class="img-fluid img-thumbnail" alt="attached-img" width="80">
                                                                        </label>
                                                                    </div>
                                                                </li>
									
                                                <?php
                                                        if ($i==count($image_list)-1 || $cnt%4==0)
                                                        {
                                                            echo '</tr>';
                                                            $cnt = 1;
                                                        }
                                                        $cnt++;
                                                    }
							  	                    echo '<tr><td><input type="submit" class="btn btn-lighten-danger mb-3" name="btnDeleteImages" value="Delete Selected Images"</td></tr></table>';
                                                }
                                            }
                                            ?>
                                                </ul>
                                            </div>

						
                                                            <!-- <input type="file" name="image_title[]" multiple/>	 -->
                                                             										
                                            </div>
                                        </div>
										<!-- meta tag title -->
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label"><span style="color:#F00; font-weight:bold;">*</span> Meta Tag Title</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="meta_tag_title" name="meta_tag_title" placeholder="Meta Tag Title" value="<?php if(isset($_GET['page_id'])) echo $row[5] ?>">
                                            </div>
                                        </div>
                                        <!-- meta tag title -->
										
                                        <!-- meta tag description -->
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Description</label>
                                            <div class="col-sm-12">
                                                <textarea cols="5" rows="5" class="form-control" id="meta_tag_description" name="meta_tag_description" placeholder="Meta Tag Description" ><?php if(isset($_GET['page_id'])) echo $row[6] ?></textarea>
                                            </div>
                                        </div>
                                        <!-- meta tag description -->
										
                                        <!-- meta tag keywords -->
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Keywords</label>
                                            <div class="col-sm-12">
                                                <textarea cols="5" rows="5" class="form-control" id="meta_tag_keywords" name="meta_tag_keywords" placeholder="Meta Tag Keywords"><?php if(isset($_GET['page_id'])) echo $row[7] ?></textarea>
                                            </div>
                                        </div>
                                        <!-- meta tag keywords -->
										
										
										<input type="hidden" id="hiddeniconIMG" name="hiddeniconIMG" value="<?php echo isset($row[7]);?>">
                                        
										<? 
										if(isset($_GET['page_id']))
										{
                                        $record_addmore=$con->selectdb("select * from tbl_addmore where page_id='".$page_id."' order by addmore_id asc" );
                                        $j=0;
                                        $cnt_title = mysqli_num_rows($record_addmore);
                                        while($row_addmore=mysqli_fetch_array($record_addmore))
                                        {
                                        //print_r($row_addmore);
									
										?>
										<input type="hidden" id="hiddeen_addmore_id" name="hiddeen_addmore_id[]" value="<?php echo $row_addmore['addmore_id'];?>">
                                        <!-- title -->
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Title <? echo $j+1;?></label>
                                            <div class="col-sm-5 mb-2">
                                               <a class="btn btn-lighten-danger" href="page_upload.php?id=<?php echo $row_addmore['addmore_id']; ?>&ExtraContent=Del&page_id=<?php echo $row[0];?>" onClick="return confirm('Are you sure want to delete?');">Delete Content <? echo $j+1;?></a>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="title" name="title[]" placeholder="Title <? echo $j+1;?>" value="<?php echo $row_addmore['title']?>">
                                            </div>
                                        </div>
                                        <!-- title -->

                                        <!-- icon -->
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Icon</label>
                                            <div class="col-sm-4">
											    <input type="hidden" id="delete_icon<? echo $j;?>" name="delete_icon<? echo $j;?>" value="<?php echo $row_addmore['extra_icon']; ?>">
                                                <input type="file" id="iconimg" name="iconimg<? echo $j;?>" class="dropify"  data-default-file="<? if($row_addmore['extra_icon']!=''){echo '../icon/'. $row_addmore['extra_icon'];}?>" />			
                                                <? if($row_addmore['extra_icon']!=''){?>
                                                <div class="btn btn-group">
    												<a class="btn btn-danger" href="page_upload.php?id=<?php echo $row_addmore['addmore_id']; ?>&IconImage=Del&page_id=<?php echo $row[0];?>" onClick="return confirm('Are you sure want to delete?');">Delete</a>
                                                    <a class="btn btn-light" href='pageImage.php?page_id=<?php echo $page_id; ?>&page=<? echo $_GET['page'];?>&icon_id=<?php echo $row_addmore['addmore_id']; ?>&name=<?php echo $row_addmore['extra_icon']; ?>'>Edit Image</a>
                                                    <input type="hidden" id="set_icon<? echo $j;?>" name="set_icon<? echo $j;?>" value="<?php echo $row_addmore['extra_icon']; ?>">
                                                </div>        
												<? } ?>
                                            </div>
                                        </div>
                                        <!-- icon -->
                                        
										<div class="form-group">
                                            <div class="row">
                                                <!-- short description -->
                                                <div class="col-lg-6">
                                                    <label for="inputEmail3" class="col-sm-12 control-label">Short Desc</label>
                                                    <div class="col-lg-12">
                                                        <textarea  class="ckeditor" id="desc_sd<? echo $j+1;?>" name="descsd[]" cols="40" rows="8" ><?php echo $row_addmore['small_desc']?></textarea>
                                                    </div>
                                                </div>
                                                <!-- short description -->
                                                <!-- Extra description -->
                                                <div class="col-lg-6">
                                                    <label for="inputEmail3" class="col-sm-12 control-label">Extra Desc</label>
                                                    <div class="col-lg-12">
                                                        <textarea  class="ckeditor" id="desc_ed<? echo $j+1;?>" name="desc[]" cols="40" rows="8" ><?php echo $row_addmore['extra_desc']?></textarea>
                                                    </div>
                                                </div>
                                                <!-- Extra description -->
                                            </div>
                                        </div>

										<? $j++ ;}}?>
										
										<!-- add-->
                                        <?php if(!isset($_GET['page_id'])) { ?>
                                        <!-- title -->
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                                            <div class="col-sm-5">
                                                
                                                <input type="text" class="form-control" id="title" name="title[]" placeholder="Title" >
												
                                            </div>
                                        </div>
                                        <!-- title -->
                                        <!-- icon -->
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Icon</label>
                                            <div class="col-sm-4">
                                                <input type="file" id="iconimg" name="iconimg[]" class="dropify" />
                                            </div>
                                        </div>
                                        <!-- icon -->
										
										<div class="form-group">
										    <div class="row">
                                                <!-- short description -->
                                                <div class="col-lg-6">
                                                    <label for="inputEmail3" class="col-sm-12 control-label">Short Desc</label>
                                                    <div class="col-lg-12">
                                                    
                                                        <textarea class="ckeditor" id="desc_sd" name="descsd[]" cols="40" rows="8" ></textarea>
                                                    </div>
                                                </div>
                                                <!-- short description -->
                                                <!-- extra description -->
                                                <div class="col-lg-6">
                                                    <label for="inputEmail3" class="col-sm-12 control-label">Extra Desc</label>
                                                    <div class="col-lg-12">
                                                    
                                                        <textarea class="ckeditor" id="desc_ed" name="desc[]" cols="40" rows="8" ></textarea>
                                                    </div>
                                                </div>
                                                <!-- extra description -->
                                            </div>
                                        </div>

                                        <input type="hidden" id="addSectionCount" value="1" name="addSectionCount">
                                       <div id="nameBoxWrap"></div>
                                       <!-- add more button -->
										<div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-12">
                                                <button type="button" onClick="addNameSection()" class="btn btn-success">ADD MORE</button>
                                            </div>
                                        </div>
										<? }
										else
										 {
										 ?>
										<div id="nameBoxWrap"></div>
                                        <!-- add more button -->
										<div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="button" onClick="addNameSection()" class="btn btn-success">ADD MORE</button>
                                            </div>
                                        </div>
										<input type="hidden" id="addSectionCount" value="  <?php if(isset($_GET['page_id'])) {  echo $cnt_title; } ?>" name="addSectionCount">
										<? } ?>
										<!-- end add-->
										
                                        <!-- button -->
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <?php 
												if(isset($_GET['page_id']))
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
												<button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='pageView.php'; return false;" >Cancel</button>
                                            </div>
                                        </div>
                                        <!-- button -->
										
										

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

    <!-- dropify js -->
    <script src="assets/libs/dropify/dropify.min.js"></script>

    <!-- form-upload init -->
    <script src="assets/js/pages/form-fileupload.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    
    <!-- ckeditor -->
    <script src="assets/libs/ckeditor/ckeditor.js"></script>
    <!-- <script src="boss-asset/js/modern.min.js"></script>
    <script src="boss-asset/js/pages/form-elements.js"></script> -->
    <script>                           

function addNameSection(){
            var addSectionCount=$("#addSectionCount").val();
            addSectionCount++;
            $("#addSectionCount").val(addSectionCount);
            $("#nameBoxWrap").append('<div id="nameBox'+addSectionCount+'"><div class="form-group" ><label for="inputEmail3" class="col-sm-2 control-label">Title'+addSectionCount+'</label><div class="col-sm-10"><input type="text" class="form-control" id="title'+addSectionCount+'" name="title[]" placeholder="Title'+addSectionCount+'"></div><div class="form-group"><label for="inputEmail3" class="col-sm-2 control-label">Icon</label><div class="col-sm-4"><input type="file" id="iconimg'+addSectionCount+'" name="iconimg[]" class="dropify" data-height="200" data-max-file-size="5M" image-type="gallery" /></div></div></div><div class="form-group"><div class="row"><div class="col-sm-6"><label for="inputEmail3" class="col-sm-12 control-label">Short Desc</label><div class="col-sm-12"><textarea cols="40" id="sdesc'+addSectionCount+'" name="descsd[]" rows="8"></textarea></div></div><div class="col-sm-6"><label for="inputEmail3" class="col-sm-12 control-label">Extra Desc</label><div class="col-sm-12"><textarea cols="40" id="desc'+addSectionCount+'" name="desc[]" rows="8"></textarea></div></div></div></div><div class="form-group"><div class="col-sm-offset-2 col-sm-10"><input type="button" class="button btn btn-danger" value="REMOVE" onclick=removeNameSection("'+addSectionCount+'")></div></div></div>');

            $(".dropify").dropify({messages:{default:"Drag and drop a file here or click",replace:"Drag and drop or click to replace",remove:"Remove",error:"Ooops, something wrong appended."},error:{fileSize:"The file size is too big (5M max)."}});

            CKEDITOR.replace( 'sdesc'+addSectionCount, {
               

            });
                
            CKEDITOR.replace( 'desc'+addSectionCount, {
               

            });
            
            
        // <!-- end of editor-->
        }
        function removeNameSection(removeId){
            var addSectionCount=$("#addSectionCount").val();
            if(addSectionCount > 1){
                addSectionCount--;
                $("#addSectionCount").val(addSectionCount);
                $("#nameBox"+removeId).remove();
            }
        }
    </script>

</body>

</html>