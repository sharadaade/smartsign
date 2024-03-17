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

$pageID= 'page27';

$sql = $cn->selectdb("SELECT * FROM tbl_socialmedia order by social_id desc");

function deleteSocial($id)
{
	$cn=new connect();
	$cn->connectdb();
	$id = $id;

$sql2=  $cn->selectdb("SELECT * FROM tbl_socialmedia WHERE social_id=$id");
while($row = mysqli_fetch_row($sql2))
{
	//image
	@unlink('../social/big_img/'.$row[1]);
	@unlink('../social/'.$row[1]);
	//end of image
}

$cn->selectdb("DELETE FROM tbl_socialmedia WHERE social_id=$id");

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
                    <h4 class="page-title-main">Social</h4>
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
                                <h4 class="mt-0 header-title">Social View</h4>
                                <?php
									if(isset($_POST['delete']))
									{
									$cnt=array();
									$cnt=count($_POST['chkbox']); 
									for($i=0;$i<$cnt;$i++)
									{
										$del_id=$_POST['chkbox'][$i];
										deleteSocial($del_id);
										
									}
										echo "<script>window.open('socialView.php','_SELF')</script>";
									}
								?>
								
                                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href="social.php" class="btn btn-success m-b-sm mt-2 mb-2">Add</a>
                                            <a href="sorting_social.php" class="btn btn-success m-b-sm mt-2 mb-2">Sorting</a>
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
                                                    <!--<th>Image</th>-->
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th><input type="checkbox" id="checkall" class="checkall" name="sample"/> Select all</th>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <!--<th>Image</th>-->
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                <?php
                                                if (mysqli_num_rows($sql) > 0) 
                                                {
                                                $i = 0;
                                                    while($row = mysqli_fetch_assoc($sql)) 
                                                    {
                                                        extract($row);
                                                        
                                                ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="chkbox[]" class="chkbox"  value="<?echo $social_id?>"/></td>
                                                        <th><? echo $social_id; ?></th>
                                                        <td><?php echo $social_title; ?></td>
                                                        <!--<td><?php if($image_name!=''){?><img src='../social/<?php echo $image_name; ?>' height="50" width="50"><?php } else { echo "No Image"; }?></td>-->
                                                        <td><a href='socialUpdate.php?social_id=<?php echo $social_id ?>&page=<?  if (isset($_GET['page']) && !empty($_GET['page'])) echo $_GET['page'];?>'><i class="fa fa-edit"></i></a></td>
                                                        <td><a href='deleteSocial.php?Del=del&id=<?php echo $social_id ?>&page=<?  if (isset($_GET['page']) && !empty($_GET['page'])) echo $_GET['page'];?>' onClick="return confirm('Are you sure want to delete?');"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    <? } } ?>
                                                    <input type="hidden" name="page" id="page" value="<?  if (isset($_GET['page']) && !empty($_GET['page'])) echo $_GET['page'];?>">
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
    <!--<script src="assets/js/pages/datatables.init.js"></script>-->
    <script>
        $(document).ready(function(){$("#datatable").DataTable();var a=$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","pdf"]});$("#key-table").DataTable({keys:!0}),$("#responsive-datatable").DataTable(),$("#selection-datatable").DataTable({select:{style:"multi"}}),a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")});
    </script>

    <!-- App js -->
    <script src="assets/js/app.min.js?v=<?echo time();?>"></script>
    
</body>

</html>