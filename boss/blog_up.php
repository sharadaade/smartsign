<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("../connect.php");
//include_once("fckeditor/fckeditor.php");
include_once("../navigationfun.php");
include_once("../sitemap.php");

$con=new connect();
$con->connectdb();
$cn=new connect();
$cn->connectdb();
$pageID= 'page9';

$blog_id=$_GET['blog_id'];

$query = $con->selectdb('SELECT * FROM tbl_blogcategory');
if(mysqli_num_rows($query)>0)
{
    while ($row = dbFetchAssoc($query))
    {
        $menu_items[$row['cat_id']] = array('cat_name' => $row['cat_name'],'cat_parent_id' => $row['cat_parent_id']);
    }
}
else{
    $menu_items = array();
}

// reterive selected value
$sqlC=$con->selectdb("SELECT cat_id FROM tbl_blog where blog_id=".$blog_id."");
while($rowC=mysqli_fetch_assoc($sqlC))
{
  $arraycat_id= explode(",",$rowC['cat_id']);
 }
 $finalarray= array_filter($arraycat_id);

// end of selected value



			    global $menuItems;
                global $parentMenuIds;
				global $finalarray;
                //create an array of parent_menu_ids to search through and find out if the current items have an children
                foreach($menu_items as $parentId)
                {
                  $parentMenuIds[] = $parentId['cat_parent_id'];
                }
                //assign the menu items to the global array to use in the function
                $menuItems = $menu_items;
                
				
                //recursive function that prints categories as a nested html unorderd list
                function generate_menu($parent)
                {
                        $has_childs = false;
                        //this prevents printing 'ul' if we don't have subcategories for this category
                        global $menuItems;
                        global $parentMenuIds;
						global $finalarray;
                        //use global array variable instead of a local variable to lower stack memory requierment
                        foreach($menuItems as $key => $value)
                        {
                            if ($value['cat_parent_id'] == $parent) 
                            {    
                                //if this is the first child print '<ul>'
                                if ($has_childs === false)
                                {
                                  //don't print '<ul>' multiple times  
                                  $has_childs = true;
                                  
                                    echo '<ul>';
                                  
                                }
								
								  
								// checked mark in radio button
								 $sel ='';

								if(in_array($key,$finalarray))
								{
								  $sel= 'checked="checked"';
								 }
								//end of checked mark 
                                
                                if($value['cat_parent_id'] == 0 && in_array($key, $parentMenuIds))
                                {
                                    echo '<li data-jstree='.'{"opened":true}'.'><a href="category.php?id=' . $key . '">' . $value['cat_name'] . '<b class="caret"></b></a>';
                                }
                                else if($value['cat_parent_id'] != 0 && in_array($key, $parentMenuIds))
                                {
                                    echo '<li data-jstree='.'{"opened":true}'.'><a href="category.php?id=' . $key . '">' . $value['cat_name'] . '</a>';
                                }
                                else
                                {
                                    echo '<li data-jstree='.'{"opened":true,"type":"file"}'.'>'.
                                    '<div style="display: inline!important;" class="custom-control custom-switch">'.
                                        '<input type="checkbox" class="custom-control-input" id="customSwitch'.$key.'" name="mulradio[]" value="'.$key.'"  '.$sel.' />'.
                                        '<label class="custom-control-label" for="customSwitch'.$key.'">' . $value['cat_name'] .'</label>'.
                                    '</div>';
                                }
                                generate_menu($key);
                                
                                //call function again to generate nested list for subcategories belonging to this category
                                echo '</li>';
                            }
                        }
                        if ($has_childs === true) echo '</ul>';
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


        <!-- dropify -->
        <link href="assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />

        <!-- Treeview css -->
        <link href="assets/libs/treeview/style.css" rel="stylesheet" type="text/css" />

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
                    <h4 class="page-title-main">Blog</h4>
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
                                <h4 class="mt-0 header-title">New Blog Form</h4>
                                <form class="form-horizontal" method="post" action="blog_upload.php" id="myform" name="myform" enctype="multipart/form-data">
                                    <input type="hidden" name="page" id="page" value="<? echo isset($_GET['page']);?>">

                                    <?php
                                    $records=$con->selectdb("SELECT * FROM tbl_blog where blog_id=".$blog_id."");
                                    while($row=mysqli_fetch_assoc($records))
                                    {
                                    ?>
                                    <input type="hidden" name="blog_id" id="blog_id" value="<?php echo $row['blog_id']; ?>" />	
                                    <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $row['cat_id']; ?>" />

                                    <!-- <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Category List</label>
                                        <div class="col-sm-12">
                                            <div class="panel-body">
                                                <div id="basicTree">
                                                    <ul>
                                                        <li data-jstree='{"opened":true}'>Category List 
                                                            <?php generate_menu(0);?>
                                                        </li>
                                                    </ul>
                                                    <script>
                                                        menu_initiate();
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Slug</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="<?php echo $row['slug']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Blog Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="blog_name" name="blog_name" placeholder="Blog Name" value="<?php echo $row['blog_name']; ?>">
                                        </div>
                                    </div>

                                    <!-- <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Blog Tags(Separate with ,(comma) )</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="tags" name="tags" placeholder="Blog Tags">
                                        </div>
                                    </div> -->
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Overview</label>
                                        <div class="col-sm-12">
                                            <textarea class="ckeditor" id="description" name="description" rows="10"><?php echo $row['description']; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Image</label>
                                        <div class="col-sm-4">
                                            <input type="file" id="frontimg" name="frontimg" class="dropify" data-default-file="<? if($row['blog_image']!=''){echo "../blog/".$row['blog_image'];}?>"/>
                                            <? if($row['blog_image']!=''){?>
                                                <a href="blog_upload.php?id=<?php echo $row['blog_id']; ?>&ProImage=Del" class="btn btn-lighten-danger" onClick="return confirm('Are you sure want to delete?');">Delete</a>
											<? } ?>
											<input type="hidden" id="frontimg2" name="frontimg2" value="<?php echo $row['blog_image']?>"  />
                                        </div>
                                    </div>
                                    
                                    <!--div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Multiple Images</label>
                                        <input type="hidden" class="form-control" id="frontimg1" name="frontimg1" placeholder="Multiple Images" value="<? echo $row['multi_images']; ?>">
                                        <div class="col-sm-4">
                                            <input type="file" id="image_title" name="image_title[]" multiple class="dropify"/>
                                            <div class="attached-files mt-4">
                                                <ul class="list-inline files-list">
                                                    <?
                                                    if(isset($_GET["blog_id"]))
                                                    {
                                                        $image = $row['multi_images'];
                                                        
                                                        if($image!="" || $image!=NULL)
                                                        {
                                                            $image_list = explode(',',$image);
                                                            // echo '<table>';
                                                                $cnt = 1;
                                                                
                                                            for($i=0;$i<count($image_list)-1;$i++)
                                                            {
                                                    ?>
                                                                <?php //echo "image name=".$image_list[$i]; ?>
                                                                <li class="list-inline-item file-box">
                                                                    <div class=" custom-control custom-switch">
                                                                        <input class="custom-control-input" type="checkbox" name="imageEdit[]" id="<?php echo $image_list[$i]; ?>" value="<?php echo $image_list[$i]; ?>">
                                                                        <label class="custom-control-label" for="<?php echo $image_list[$i]; ?>">
                                                                            <img src="../blogF/<?php echo $image_list[$i]; ?>" class="img-fluid img-thumbnail" alt="attached-img" width="80">
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
                                    </div-->

                                    <!-- <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Home Page</label>
                                        <div class="col-sm-12">
                                            <input type="checkbox" id="home_page" name="home_page" />
                                            (Check if YES)    
                                        </div>
                                    </div> -->

           <!--                         <div class="form-group">-->
           <!--                             <label for="inputEmail3" class="col-sm-12 control-label">PDF File</label>-->
           <!--                             <div class="col-sm-4">-->
           <!--                                 <input type="file" id="download_file" name="download_file" class="dropify"/>-->
           <!--                                 <div class="bootstrap-tagsinput">-->
           <!--                                     <span class="tag label label-info bg-light">-->
           <!--                                             <label class="" ><?echo $row['pdf_file'];?></label>-->
           <!--                                     </span>-->
           <!--                                 </div>-->
           <!--                                 <? if($row['pdf_file']!=''){?>-->
           <!--                                     <a href="blog_upload.php?id=<?php echo $row['blog_id']; ?>&btnDeletepdf=Del" class="btn btn-lighten-danger" onClick="return confirm('Are you sure want to delete?');">Delete</a>-->
											<!--<? } ?>-->
           <!--                             </div>-->
											<!--<input type="hidden" id="frontimgpdf2" name="frontimgpdf2" value="<?php echo $row['pdf_file'];?>"  />-->
           <!--                         </div>-->
                                    
                                    <!--<div class="form-group">-->
                                    <!--    <label for="inputEmail3" class="col-sm-12 control-label">Video Link</label>-->
                                    <!--    <div class="col-sm-12">-->
                                    <!--        <textarea class="form-control" id="blog_video" name="blog_video" rows="10" placeholder="Embeded link from youtube."><?php echo $row['blog_video']; ?></textarea>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label"><span style="color:#F00; font-weight:bold;">*</span> Meta Tag Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="meta_tag_title" name="meta_tag_title" placeholder="Meta Tag Title" value="<?php echo $row['meta_tag_title']; ?>" >
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Meta Tag Description</label>
                                        <div class="col-sm-12">
                                            <textarea cols="5" rows="5" class="form-control" id="meta_tag_description" name="meta_tag_description" placeholder="Meta Tag Description" ><?php echo $row['meta_tag_description']; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Meta Tag Keywords</label>
                                        <div class="col-sm-12">
                                            <textarea cols="5" rows="5" class="form-control" id="meta_tag_keywords" name="meta_tag_keywords" placeholder="Meta Tag Keywords"><?php echo $row['meta_tag_keywords']; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="updateProduct" id="updateProduct" class="btn btn-success">Update</button>
                                            <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='blogView.php'; return false;" >Cancel</button>
                                        </div>
                                    </div>
                                            <?}?>
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
    
    <!-- ckeditor -->
    <script src="assets/libs/ckeditor/ckeditor.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    
    <!-- Init js-->
    <script src="assets/js/pages/form-advanced.init.js"></script>
    
    <!-- Tree view js -->
    <script src="assets/libs/treeview/jstree.min.js?v=<?echo time();?>"></script>
    <script src="assets/js/pages/treeview.init.js?v=<?echo time();?>"></script>
    

</body>

</html>
