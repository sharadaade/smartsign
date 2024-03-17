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

$pageID= 'page3';

$product_id=$_GET['product_id'];

$query = $con->selectdb('SELECT * FROM tbl_category');
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
$sqlC=$con->selectdb("SELECT cat_id FROM tbl_product where product_id=".$product_id."");
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
                        $sel1 ='';

                    if(in_array($key,$finalarray))
                    {
                        $sel= 'checked="checked"';
                        $sel1= '"checked":"checked"';
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
                    //   echo '<li><input type="checkbox" name="mulradio[]" value="'.$key.'"  '.$sel.' />' . $value['cat_name'] . '';
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
        
        <!--Morris Chart-->
        <link rel="stylesheet" href="assets/libs/morris-js/morris.css" />
        
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
                    <h4 class="page-title-main">Product</h4>
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
                                <h4 class="mt-0 header-title">Product Form</h4>
                                
                                <form class="form-horizontal" method="post" action="prod_upload.php" id="myform"
                                    name="myform" enctype="multipart/form-data">
                                    <input type="hidden" name="page" id="page" value="<? echo isset($_GET['page']);?>">

                                    <?php
										$records=$cn->selectdb("SELECT * FROM tbl_product where product_id=".$product_id."");
										while($row=mysqli_fetch_array($records))
										{
										?>
                                    <input type="hidden" name="product_id" id="product_id"
                                        value="<?php echo $row[0]; ?>" />
                                    <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $row[3]; ?>" />


                                <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Category List</label>
                                        <div class="col-sm-10">
                                            <div class="panel-body">
                                                <div id="basicTree" >
                                                    <ul>
                                                        <li data-jstree='{"opened":true}'>Category List
                                                            <?php generate_menu(0);	?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Slug</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="<?php echo $row[12]; ?>">
                                        </div>
                                    </div>

                                    <!--<div class="form-group">-->
                                    <!--    <label for="inputEmail3" class="col-sm-12 control-label">Date</label>-->
                                    <!--    <div class="col-sm-12">-->
                                    <!--        <input type="text" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo $row[13]; ?>">-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <!--<div class="form-group">-->
                                    <!--    <label for="inputEmail3" class="col-sm-12 control-label">Month</label>-->
                                    <!--    <div class="col-sm-12">-->
                                    <!--        <input type="text" class="form-control" id="month" name="month" placeholder="Month" value="<?php echo $row[14]; ?>">-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <div class="form-group" style="display: none;">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Price</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="year" name="year"
                                                placeholder="Pirce" value="<?php echo $row[15]; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Product Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $row[1]; ?>" placeholder="Product Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Description</label>
                                        <div class="col-sm-12">
                                            <textarea class="ckeditor" cols="80" id="description" name="description" rows="10"><? echo $row[2];?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Image</label>
                                        <div class="col-sm-4">
                                            <input type="file" id="frontimg" name="frontimg" data-default-file="<?if($row[4]!=''){echo '../product/'.$row[4];}?>" class="dropify"/>
                                            <? if($row[4]!=''){?>
                                            <!-- <img src="../product/<? echo $row[4];?>" width="100"> -->
                                            <a href="prod_upload.php?id=<?php echo $row[0]; ?>&ProImage=Del" class="btn btn-lighten-danger" onClick="return confirm('Are you sure want to delete?');">Delete</a>
                                            <? } ?>
                                            <input type="hidden" id="frontimg2" name="frontimg2" value="<?php echo $row[4]?>" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Multiple Images</label>
                                        <input type="hidden" class="form-control" id="frontimg1" name="frontimg1" placeholder="Multiple Images" value="<? echo $row['multi_images']; ?>">
                                        <div class="col-sm-4">
                                            <input type="file" class="dropify" name="image_title[]" multiple />
                                            <div class="attached-files mt-4">
                                                <ul class="list-inline files-list">
                                                    
                                                    <?
                                                    if(isset($_GET["product_id"]))
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
                                                                            <img src="../productF/<?php echo $image_list[$i]; ?>" class="img-fluid img-thumbnail" alt="attached-img" width="80">
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
                                    <!-- multi images -->

                                    <!--< pdf ->-->
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">PDF File</label>
                                        <input type="hidden" class="form-control" id="frontpdf" name="frontpdf" placeholder="Multiple pdfs" value="<? echo $row['pdf_file']; ?>">
                                        <div class="row">
                                        <div class="col-sm-12">
                                            <input type="file" id="download_file" name="download_file[]" class="dropify"  />
                                            <div class="attached-files mt-4">
                                                <div class="task-tags mt-2">
                                                    <h5>PDF's</h5>
                                                    <?
                                                    if(isset($_GET["product_id"]))
                                                    {
                                                        $pdf = $row['pdf_file'];
                                                        
                                                        if($pdf!="" || $pdf!=NULL)
                                                        {
                                                            $pdf_list = explode(',',$pdf);
                                                            $cnt = 1;
                                                                
                                                            for($i=0;$i<count($pdf_list)-1;$i++)
                                                            {
                                                    ?>
                                                                <div class="bootstrap-tagsinput">
                                                                    <span class="tag label label-info bg-light">
                                                                        <div class=" custom-control custom-switch">
                                                                            <input class="custom-control-input" type="checkbox" id="<?php echo $pdf_list[$i]; ?>" name="pdfEdit[]" value="<?php echo $pdf_list[$i]; ?>">
                                                                            <label class="custom-control-label" for="<?php echo $pdf_list[$i]; ?>"><?echo $pdf_list[$i];?></label>
                                                                        </div>
                                                                    </span>
                                                                </div>
                                                    <?php
                                                            }
                                                            echo '<div class="row mt-2 mb-2"><div class="col-12"><input type="submit" class="btn btn-lighten-danger" name="btnDeletepdfs" value="Delete Selected pdfs"></div></div>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <input type="hidden" id="frontimgpdf2" name="frontimgpdf2" value="<?php echo $row[7]?>" />
                                        </div>
                                        </div>
                                    </div>
                       
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label"><span style="color:#F00; font-weight:bold;">*</span> Meta Tag Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="meta_tag_title" name="meta_tag_title" placeholder="Meta Tag Title" value="<?php echo $row[8]?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Meta Tag Description</label>
                                        <div class="col-sm-12">
                                            <textarea cols="5" rows="5" class="form-control" id="meta_tag_description" name="meta_tag_description" placeholder="Meta Tag Description"><?php echo $row[9]?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Meta Tag Keywords</label>
                                        <div class="col-sm-12">
                                            <textarea cols="5" rows="5" class="form-control" id="meta_tag_keywords" name="meta_tag_keywords" placeholder="Meta Tag Keywords"><?php echo $row[10]?></textarea>
                                        </div>
                                    </div>

                                    <!--<div class="form-group">-->
                                    <!--    <label for="inputEmail3" class="col-sm-12 control-label">Product Video</label>-->
                                    <!--    <div class="col-sm-12">-->
                                    <!--        <textarea cols="5" rows="5" class="form-control" id="product_video" name="product_video" placeholder="Embeded code of the video"><?php echo $row[16]?></textarea>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <!--<div class="form-group">-->
                                    <!--    <label for="inputEmail3" class="col-sm-12 control-label">Product Map</label>-->
                                    <!--    <div class="col-sm-12">-->
                                    <!--        <textarea cols="5" rows="5" class="form-control" id="product_map" name="product_map" placeholder="Embeded code of the Map"><?php echo $row[17]?></textarea>-->
                                    <!--    </div>-->
                                    <!--</div>-->


                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="updateProduct" id="updateProduct" class="btn btn-success">Update</button>
                                            <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='productView.php'; return false;">Cancel</button>
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

    
    <!-- form-upload init -->
    <script src="assets/js/pages/form-fileupload.init.js"></script>
    
    <!-- ckeditor -->
    <script src="assets/libs/ckeditor/ckeditor.js"></script>
    
    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>
    
    <!-- Tree view js -->
    <script src="assets/libs/treeview/jstree.min.js?v=<?echo time();?>"></script>
    <script src="assets/js/pages/treeview.init.js"></script>
    
    <!-- App js -->
    <script src="assets/js/app.min.js?v=<?echo time();?>"></script>

    <!-- dropify js -->
    <script src="assets/libs/dropify/dropify.min.js"></script>
    
    <!-- form-upload init -->
    <script src="assets/js/pages/form-fileupload.init.js"></script>
<!-- <script>

$("#categoryViewTree").jstree({
    core: {
        themes: {
            responsive: !1
        }
    },
    types: {
        default: {
            icon: "mdi mdi-folder-star"
        },
        file: {
            icon: "mdi mdi-file"
        }
    },
    plugins: ["types"]
})
</script> -->
</body>


</html>