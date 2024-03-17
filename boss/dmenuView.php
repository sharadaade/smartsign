<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("deletedmenu.php");
include_once("../connect.php");
include_once("../navigationfun.php");
include_once("imagefunction.php");
include_once("image_lib_rname.php"); 
require('./Classes/PHPExcel.php');
$cn=new connect();
$cn->connectdb();

$pageID= 'page12';

if(isset($_GET['parentid']))
{
	$parentid=$_GET['parentid'];
}
else
{
	$parentid=0;
}
   
    $result = $cn->selectdb("SELECT * FROM tbl_dmenu where menu_parent_id=".$parentid." order by menu_id desc");
			
			
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

        <!-- third party css -->
        <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

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
                    <h4 class="page-title-main">Menu</h4>
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
                                <h4 class="mt-0 header-title">Menu View</h4>
                                <?php
									if(isset($_POST['delete']))
									{
									$cnt=array();
									$cnt=count($_POST['chkbox']);
									for($i=0;$i<$cnt;$i++)
									{
										$del_id=$_POST['chkbox'][$i];
                                        delmultirec($del_id);
									}
										echo "<script>window.open('dmenuview.php','_SELF')</script>";
									}
								?>
								
                                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href="dmenu.php?parentid=<?php echo $parentid; ?>" class="btn btn-success m-b-sm mt-2 mb-2">Add Category</a>
                                            <?
                                                if(isset($parentid))
                                                {
                                            ?>
                                                    <a href="sorting_dmenu.php?parentid=<?echo $parentid?>" class="btn btn-success m-b-sm">Sorting</a>
                                            <?
                                                }
                                                else
                                                {
                                            ?>
                                                    <a href="sorting_dmenu.php?parentid=0" class="btn btn-success m-b-sm">Sorting</a>
                                            <?
                                                }
                                            ?>
                                            <input type="submit" class="btn btn-danger m-b-sm mt-2 mb-2"name="delete" value="delete"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkall" class="checkall" name="sample"/> Select all</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Copy</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
									</thead>
									<tfoot>
										<tr>
                                            <th><input type="checkbox" id="checkall" class="checkall" name="sample"/> Select all</th>
                                            <th>ID</th>
                                            <th>Name</th>
											<th>Image</th>
                                            <th>Copy</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </tfoot>

                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($result) > 0) 
                                            {
                                                while($row = mysqli_fetch_assoc($result)) 
                                                {
                                                    extract($row);
                                                    ?>
                                            <tr>
                                                <td><input type="checkbox" name="chkbox[]" class="chkbox"  value="<?echo $menu_id?>"/></td>
												<td><?php echo $menu_id; ?></td>
												<td><a href="dmenuview.php?parentid=<?php echo $menu_id; ?>"><?php echo $menu_name; ?></a></td>
												<td><?php if($menu_image!=''){?><img src='../menu/<?php echo $menu_image; ?>' height="100" width="100"><?php } else { echo "No Image"; }?></td>
                                                
												 <td>
												<a href='dmenu_copy.php?id=<?php echo $menu_id ?>&page=<? echo isset($_GET['page']);?>'><i class="fa fa-copy"></i></a>
												
												</td>
												
												<td><a href='dmenu_up.php?dmenu_id=<?php echo $menu_id; ?>&page=<? echo isset($_GET['page']);?>'><i class="fa fa-edit"></i></a></td>
												<td><a href='deletedmenu.php?menuId=<?php echo $menu_id; ?>&page=<? echo isset($_GET['page']);?>' onClick="return confirm('Are you sure want to delete?');"><i class="fa fa-trash"></i></a></td>
                                                
                                            </tr>
											<? } } ?>
											<input type="hidden" name="page" id="page" value="<? echo isset($_GET['page']);?>">

                                            
                                        </tbody>
                                    </table>
                                            
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

    <!-- third party js -->
    <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables/dataTables.bootstrap4.js"></script>
    <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables/buttons.flash.min.js"></script>
    <script src="assets/libs/datatables/buttons.print.min.js"></script>
    <script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables/dataTables.select.min.js"></script>
    <script src="assets/libs/pdfmake/vfs_fonts.js"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js?v=<?echo time();?>"></script>
    
</body>

</html>