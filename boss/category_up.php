<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("../connect.php");
$con=new connect();
$con->connectdb();
$cn=new connect();
$cn->connectdb();

$category_id=$_GET['category_id'];
$pageID= 'page3';

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
                    <h4 class="page-title-main">Menu Country</h4>
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
                                <h4 class="mt-0 mb-2 header-title">Form</h4>
                                <form class="form-horizontal" method="post" action="prod_upload.php" id="myform"
                                    name="myform" enctype="multipart/form-data">
                                    <?php
                            
                                        $records=$con->selectdb("SELECT * FROM tbl_category  where cat_id=".$category_id."");
                        
                                        while($row=mysqli_fetch_row($records))
                                        {
                                    ?>
                                    <input type="hidden" name="page" id="page" value="<? echo $_GET['page'];?>">
                                    <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $row[0]; ?>" />
                                    <input type="hidden" id="cat_parent_id" name="cat_parent_id"
                                        value="<?php echo $row[1]; ?>" />



                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Slug</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="slug" name="slug"
                                                placeholder="Slug" value="<?php echo $row[10]; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="cat_name" name="cat_name"
                                                placeholder="Name" value="<?php echo $row[2]; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Description</label>
                                        <div class="col-sm-12">
                                            <textarea class="ckeditor" cols="80" id="description" name="cat_description_up" rows="10"><? echo $row[3];?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <!-- image -->
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                                            <div class="col-sm-4">
                                                    <!-- <input type="file" id="frontimg" name="frontimg" /> -->
                                                    <input type="file" id="frontimg" class="dropify" name="frontimg" data-default-file="<?if(isset($row[4])){echo '../category/'.$row[4];}?>"  />
                                                    <? if(isset($_GET['category_id']))
                                                    {
                                                        if($row[4]!=''){
                                                    ?>
                                                        <input type="hidden" id="frontimg2" name="frontimg2" value="<?php echo $row[4]?>"  />
                                                        <!-- <img src="../page/<? echo $row[4];?>" width="100"> -->
                                                        <a class="btn btn-lighten-danger" href="prod_upload.php?id=<?php echo $row[0]; ?>&Image=Del" onClick="return confirm('Are you sure want to delete?');">Delete</a>

                                                        <?php }?>	
                                                    <? } ?> 
                                            </div>
                                        </div>
                                    </div>
                                    <!-- image -->
                                    
                                    <!-- multi image -->
                                    <?php /*
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Multiple Images:</label>
                                        <input type="hidden" class="form-control" id="frontimg1" name="frontimg1" placeholder="Multiple Images"
                                            value="<?php if(isset($_GET['category_id'])) echo $row['5']; ?>">
                                        <div class="col-sm-4">
                                            <input type="file" class="dropify" name="image_title[]" multiple />
                                            <div class="attached-files mt-4">
                                                <ul class="list-inline files-list">
                                                    <?
                                                if(isset($_GET["category_id"]))
                                                    {
                                                        $image = $row['5'];
                                                        
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

                                                                        <!-- <input type="checkbox" name="imageEdit[]" value="<?php echo $image_list[$i]; ?>"> -->

                                                                        <!-- <img src="../pageF/<?php echo $image_list[$i]; ?>" height="50" width="75"/> -->

                                                                        <li class="list-inline-item file-box">
                                                                            <img src="../categoryF/<?php echo $image_list[$i]; ?>" class="img-fluid img-thumbnail" alt="attached-img"
                                                                                width="80">
                                                                            <input class="checkbox checkbox-primary text-center m-auto" type="checkbox" name="imageEdit[]"
                                                                                value="<?php echo $image_list[$i]; ?>">
                                                                        </li>

                                                    <?php
                                                                if ($i==count($image_list)-1 || $cnt%4==0)
                                                                {
                                                                    echo '</tr>';
                                                                    $cnt = 1;
                                                                }
                                                                $cnt++;
                                                            }
                                                            echo '<tr><td><input type="submit" class="btn btn-lighten-danger" name="btnDeleteImages2" value="Delete Selected Images"</td></tr></table>';
                                                            }
                                                        }
                                                    ?>
                                                </ul>
                                            </div>
                                            <!-- <input type="file" name="image_title[]" multiple/>	 -->
                                        </div>
                                    </div>
                                    <!-- multi image -->
                                    */?>
                                    
                                     <!-- meta tag title -->
                                    <div class="form-group">
                                        <!-- meta tag title -->
                                        <label for="txtpdfFile" class="col-sm-2 control-label"><span
                                                style="color:#F00; font-weight:bold;">*</span> PDF FILE</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="txtpdfFile" accept="application/pdf" 
                                                name="txtpdfFile" placeholder="Meta Tag Title"
                                                value="<?php echo $row[11]?>">
                                        </div>
                                    </div>
                                    
                                    <!-- meta tag title -->
                                    <div class="form-group">
                                        <!-- meta tag title -->
                                        <label for="inputEmail3" class="col-sm-2 control-label"><span
                                                style="color:#F00; font-weight:bold;">*</span> Meta Tag Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="meta_tag_title"
                                                name="meta_tag_title" placeholder="Meta Tag Title"
                                                value="<?php echo $row[6]?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag
                                            Description</label>
                                        <div class="col-sm-10">
                                            <textarea cols="5" rows="5" class="form-control" id="meta_tag_description"
                                                name="meta_tag_description"
                                                placeholder="Meta Tag Description"><?php echo $row[7]?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag
                                            Keywords</label>
                                        <div class="col-sm-10">
                                            <textarea cols="5" rows="5" class="form-control" id="meta_tag_keywords"
                                                name="meta_tag_keywords"
                                                placeholder="Meta Tag Keywords"><?php echo $row[8]?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="updateCategory" id="updateCategory"
                                                class="btn btn-success">Update</button>
                                            &nbsp;&nbsp;
                                            <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger"
                                                onClick="window.location.href='categoryview.php'; return false;">Cancel</button>
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