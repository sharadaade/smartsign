<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}
include_once("../connect.php");

$cn=new connect();
$cn->connectdb();
$pageID= 'page29';

$auto_code = 0;

include_once("../connect.php");
include_once("image_lib_rname.php");
$con=new connect();
$con->connectdb();

	  if(isset($_POST['addSlider']))
	  {	    
	  //print_r($_POST);
            $catID = '';
            if(isset($_POST['mulradio'])){
                //get multiple value of radio (multiple categories)
                foreach ($_POST['mulradio'] as $attributeKey => $attributes){
                    // echo $attributeKey.' '.$_POST['mulradio'][$attributeKey].'<br>';
                    $catID.= $_POST['mulradio'][$attributeKey].",";
                } //foreach
            }
	  		$service_title=$_POST['service_title'];
			$Image = createImage('image_name',"../team/");
            $Image1 = createImage('image_name1',"../team/");
			$description = $_POST['description'];
			$slug = $_POST['slug'];
			$meta_tag_title=$_POST['meta_tag_title'];
			$meta_tag_description=$_POST['meta_tag_description'];
			$meta_tag_keywords=$_POST['meta_tag_keywords'];
	        $cpost = $_POST['cpost'];
            // $contact_no = $_POST['contact_no'];
            // $email = $_POST['email'];
            // $facebook = $_POST['facebook'];
            // $instagram = $_POST['instagram'];
            // $twitter = $_POST['twitter'];
            // $linkedin = $_POST['linkedin'];
			
		$con->insertdb("INSERT INTO `tbl_team` (`team_title`, `description`, `image_name`,`meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `slug`) VALUES ('".$service_title."', '".$description."', '".$Image."', '".$meta_tag_title."', '".$meta_tag_description."', '".$meta_tag_keywords."', '".$slug."');");
        header("location:teamView.php");
		}
?>
<?php
$query = $cn->selectdb('SELECT * FROM tbl_teamcategory');
if(mysqli_num_rows($query)>0)
{
    while ($row = mysqli_fetch_assoc($query))
    {
        $menu_items[$row['cat_id']] = array('cat_name' => $row['cat_name'],'cat_parent_id' => $row['cat_parent_id']);
    }
}
else{
    $menu_items = array();
}

                global $menuItems;
                global $parentMenuIds;
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
                                
                                if($value['cat_parent_id'] == 0 && in_array($key, $parentMenuIds))
                                {
                                    echo '<li data-jstree='.'{"opened":true}'.'><a href="teamcategory.php?id=' . $key . '">' . $value['cat_name'] . '</a>';
                                }
                                else if($value['cat_parent_id'] != 0 && in_array($key, $parentMenuIds))
                                {
                                    echo '<li data-jstree='.'{"opened":true}'.'><a href="teamcategory.php?id=' . $key . '">' . $value['cat_name'] . '</a>';
                                }
                                else
                                {
                                    echo '<li data-jstree='.'{"opened":true,"type":"file"}'.'>'.
                                    '<div style="display: inline!important;" class="custom-control custom-switch">'.
                                        '<input type="checkbox" class="custom-control-input" id="customSwitch'.$key.'" name="mulradio[]" value="'.$key.'"  />'.
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
                    <h4 class="page-title-main">Team</h4>
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
                                <h4 class="mt-0 mb-2 header-title">Team Form</h4>
                                <form class="form-horizontal" method="post" action="#" id="myform" name="myform" enctype="multipart/form-data">				
									<div class="form-group" style="display: none;">
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
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Slug</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug">
                                        </div>
                                    </div>
                                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="service_title" name="service_title" placeholder="Name">
                                        </div>
                                    </div>										
                                    <div class="form-group" style="display:none;">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Company Post</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="cpost" name="cpost" placeholder="Company Post">
                                        </div>
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-12">
                                            <textarea type="text" class="ckeditor" id="description" name="description" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Image : (Size:270X270)</label>
                                        <div class="col-sm-4">
                                            <input type="file" id="image_name" name="image_name" class="dropify" />
                                        </div>
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Big Image : (Size:270X358)</label>
                                        <div class="col-sm-4">
                                            <input type="file" id="image_name1" name="image_name1" class="dropify" />
                                        </div>
                                        
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <label for="inputEmail3" class="col-sm-2 control-label"><span style="color:#F00; font-weight:bold;">*</span> Meta Tag Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="meta_tag_title" name="meta_tag_title" placeholder="Meta Tag Title" >
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="display:none;">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Description</label>
                                        <div class="col-sm-12">
                                            <textarea cols="5" rows="5" class="form-control" id="meta_tag_description" name="meta_tag_description" placeholder="Meta Tag Description" ></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="display:none;">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Keywords</label>
                                        <div class="col-sm-12">
                                            <textarea cols="5" rows="5" class="form-control" id="meta_tag_keywords" name="meta_tag_keywords" placeholder="Meta Tag Keywords"></textarea>
                                        </div>
                                    </div>
                                                
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="addSlider" id="addSlider" class="btn btn-success">Add</button>
                                            <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='teamView.php'; return false;" >Cancel</button>
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