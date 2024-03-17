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
$pageID= 'page28';

if(isset($_GET['parentid']))
{
	$parentid=$_GET['parentid'];
}
else
{
	$parentid=0;
}

//print_r($_POST);
    $result = $cn->selectdb("SELECT * FROM tbl_newsletter_emails order by email_id desc ");
	$count=mysqli_num_rows($cn->selectdb("SELECT * FROM tbl_newsletter_emails order by email_id desc "));
			
if(isset($_POST['submit']))
{
	//echo "<script> alert('called');</script>";
	//print_r($_POST);die;
		$to="";
		$cnt=array();
		$cnt=count($_POST['emails']);
		for($i=0;$i<$cnt;$i++)
		{
			$m_id=$_POST['emails'][$i];
			$sql=  $cn->selectdb("select * from tbl_newsletter_emails where email_id=$m_id");
			$row = mysqli_fetch_assoc($sql);
			$to.=", ".$row['email'];
		}
		echo  "<script>alert('".trim($to,",")."')</script>";
		/*
		$name=$_POST['name'];
		//$subject=$_POST['subject'];		
		$msg=$_POST['message'];				
		$email=$_POST['email'];
		
		//$to = "bansalrupali@gmail.com";
		
		$from=$_POST['email'];
		$contact=$_POST['contact'];
		$headers = "From: ".$from."\r\n"."X-Mailer: php";
		$subject = "Dr.Vimal: You have an Message from the ".$name;
						
		
		//$subject="Subject :".$_POST['subject'];
		$email="Email :".$_POST['email'];
		$contact="Contact No :".$_POST['contact'];				
		$msg="Details :".$_POST['message'];				
		
						//$items="Phone :".$_POST['items'];
						//$amount="Phone :".$_POST['amount'];
						//$chqno="Phone :".$_POST['chqno'];
						
		$body = $name."\n\n".$msg."\n\n".$email."\n\n".$contact;
						//$body = $name."\n\n".$phone."\n\n".$email."\n\n".$address."\n\n".$items."\n\n".$amount."\n\n".$chqno;
		if($domain!="localhost")
		{
			echo "<script> alert('Message Sent Successfully!');</script>";
			mail($to, $subject, $body, $headers);
		}
		else{
			echo "<script> alert('Message Not Sent!');</script>";
		}
		
		*/	
	

} 
								
?>

<?php
function deleteSubscriber($id)
{
	$cn=new connect();
	$cn->connectdb();
	$id = $id;
$cn->selectdb("delete from tbl_newsletter_emails where email_id=$id");
}
    // if(isset($_POST['delete']))
    // {
    //     $cnt=array();
    //     $cnt=count($_POST['emails']);
    //     for($i=0;$i<$cnt;$i++)
    //     {
    //         $del_id=$_POST['emails'][$i];
            
    //         //echo "<script>alert('".$del_id."');</script>";
    //         //$query="delete from product where product_id=".$del_id;
    //         $con->selectdb("delete from `tbl_newsletter` where news_id=".$del_id);
    //     }
    //     echo "<script>window.open('newsletterView.php','_SELF')</script>";
    // }
					
					
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
                    <h4 class="page-title-main">Newsletter</h4>
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
                                <h4 class="mt-0 header-title">Newsletter View</h4>
                                <?php
									if(isset($_POST['delete']))
									{
									$cnt=array();
									$cnt=count($_POST['chkbox']); 
									for($i=0;$i<$cnt;$i++)
									{
										$del_id=$_POST['chkbox'][$i];
										deleteSubscriber($del_id);
										
									}
										echo "<script>window.open('newslettersubscriberView.php','_SELF')</script>";
									}
								?>
                                <form id="form1" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                                <div class="row mt-3 mb-3">
                                    <div class="col-lg-12">
                                        <a href="newslettersubscriber.php" class="btn btn-success m-b-sm">Add</a>
                                        <input type="submit" class="btn btn-lighten-danger m-b-sm" name="delete" value="delete" />
                                    </div>
                                </div>

                                    <div class="table-responsive" id="page">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="checkall" class="checkall" name="sample"/> Select all</th>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th><input type="checkbox" id="checkall" class="checkall" name="sample"/> Select all</th>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($result) > 0) 
                                                {
                                                    $i=0;
                                                    while($row = mysqli_fetch_assoc($result)) 
                                                    {
                                                        extract($row);
                                                        $i++;
                                                ?>
                                                <tr>
                                                    <td><input id="chkFile<?echo $i?>" type="checkbox" name="chkbox[]" class="chkbox"  value="<?echo $email_id?>"/></td>
                                                    <td><?php echo $email_id ?></td>
                                                    <td><?php echo $name; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td><a href='newslettersubscriberUpdate.php?email_id=<?php echo $email_id ?>&page=<?  if (isset($_GET['page']) && !empty($_GET['page'])) echo $_GET['page'];?>'><i class="fa fa-edit"></i></a></td>
                                                    <td><a href='deletenewsletteremail.php?Del=del&id=<?php echo $email_id ?>&page=<?  if (isset($_GET['page']) && !empty($_GET['page'])) echo $_GET['page'];?>' onClick="return confirm('Are you sure want to delete?');"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                                <? } } ?>
                                                <input type="hidden" name="page" id="page" value="<?  if (isset($_GET['page']) && !empty($_GET['page'])) echo $_GET['page'];?>">
                                            </tbody>
                                        </table>
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
    
    <!-- ckeditor -->
    <script src="assets/libs/ckeditor/ckeditor.js"></script>
</body>

</html>