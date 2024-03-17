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

$pageID= 'page12';

$submenu_id=$_GET['submenu_id'];

$query = $con->selectdb('SELECT * FROM tbl_dmenu');
if(mysqli_num_rows($query)>0)
{
    while ($row = dbFetchAssoc($query))
    {
        $menu_items[$row['menu_id']] = array('menu_name' => $row['menu_name'],'menu_parent_id' => $row['menu_parent_id']);
    }
}
else{
    $menu_items = array();
}


// reterive selected value
$sqlC=$con->selectdb("SELECT menu_id FROM tbl_submenu where submenu_id=".$submenu_id."");
while($rowC=mysqli_fetch_assoc($sqlC))
{
  $arraycat_id= explode(",",$rowC['menu_id']);
 }
 $finalarray= array_filter($arraycat_id);

// end of selected value



			    global $menuItems;
                global $parentMenuIds;
				global $finalarray;
                //create an array of parent_menu_ids to search through and find out if the current items have an children
                foreach($menu_items as $parentId)
                {
                  $parentMenuIds[] = $parentId['menu_parent_id'];
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
                            if ($value['menu_parent_id'] == $parent) 
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
                                
                                if($value['menu_parent_id'] == 0 && in_array($key, $parentMenuIds))
                                {
                                    echo '<li data-jstree='.'{"opened":true}'.'><a href="category.php?id=' . $key . '">' . $value['menu_name'] . '<b class="caret"></b></a>';
                                }
                                else if($value['menu_parent_id'] != 0 && in_array($key, $parentMenuIds))
                                {
                                    echo '<li data-jstree='.'{"opened":true}'.'><a href="category.php?id=' . $key . '">' . $value['menu_name'] . '</a>';
                                }
                                else
                                {
                                    echo '<li data-jstree='.'{"opened":true,"type":"file"}'.'>'.
                                    '<div style="display: inline!important;" class="custom-control custom-switch">'.
                                        '<input type="checkbox" class="custom-control-input" id="customSwitch'.$key.'" name="mulradio[]" value="'.$key.'"  '.$sel.' />'.
                                        '<label class="custom-control-label" for="customSwitch'.$key.'">' . $value['menu_name'] .'</label>'.
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
                                <form class="form-horizontal" method="post" action="dmenu_upload.php" id="myform" name="myform" enctype="multipart/form-data">
                                    <input type="hidden" name="page" id="page" value="<? echo isset($_GET['page']);?>">
                                    
                                    <?php
										$records=$con->selectdb("SELECT * FROM tbl_submenu where submenu_id=".$submenu_id."");
										while($row=mysqli_fetch_assoc($records))
										{
                                    ?>
										<input type="hidden" name="submenu_id" id="submenu_id" value="<?php echo $row['submenu_id']; ?>" />	
										<input type="hidden" name="menu_id" id="menu_id" value="<?php echo $row['menu_id']; ?>" />
                        
                                       
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Category List</label>
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
                                            <label for="inputEmail3" class="col-sm-12 control-label">Menu Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="menu_name" name="menu_name" placeholder="Menu Name" value="<?php echo $row['submenu_name']; ?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Menu Fa Icon</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="menu_fa" name="menu_fa" placeholder="Fa Name" value="<?php echo $row['submenu_fa']; ?>">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Menu Class</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="menu_class" name="menu_class" placeholder="Class Name" value="<?php echo $row['submenu_class']; ?>">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Menu Link</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="menu_link" name="menu_link" placeholder="Link" value="<?php echo $row['submenu_link']; ?>">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Menu Page Id</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="menu_page_id" name="menu_page_id" placeholder="Page Id" value="<?php echo $row['submenu_page_id']; ?>">
                                            </div>
                                        </div>

										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Image</label>
                                            <div class="col-sm-4">
                                                <input type="file" id="frontimg" name="frontimg" class="dropify" data-default-file="<? if($row['submenu_image']!=''){echo "../menu/".$row['submenu_image'];}?>" />
                                            </div>
											
											<div class="col-sm-12">
											    <input type="hidden" id="frontimg2" name="frontimg2" value="<?php echo $row['submenu_image']?>" />
                                                <?php if($row['submenu_image']!=''){?>
												    <a href="dmenu_upload.php?id=<?php echo $row['submenu_id']; ?>&submenuImage=Del" class="btn btn-lighten-danger" onClick="return confirm('Are you sure want to delete?');">Delete</a>
											    <?php }?>  
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="updateSubmenu" id="updateSubmenu" class="btn btn-success">Update</button>
												<button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='submenuView.php'; return false;" >Cancel</button>
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
