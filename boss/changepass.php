<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

$username=$_SESSION['user'];
include_once("../connect.php");
$con=new connect();
$con->connectdb();
$cn=new connect();
$cn->connectdb();

$pageID= 'page11';


?>
<?php
if(isset($_POST['changepwd']))
{
	$oldpwd=$_POST['oldpwd'];
	$newpwd=$_POST['newpwd'];
	$conpwd=$_POST['conpwd'];
	$records=$con->selectdb("select pwd from admintable where uname='".$username."'");
	while($row=mysqli_fetch_row($records))
	{
		if($oldpwd==$row[0])
		{
			if($newpwd==$conpwd)
			{
			$con->insertdb("UPDATE `admintable` SET pwd='".$newpwd."' where uname='".$username."'");
			$error ="Your Password has been Changed";
			}
			else
			{
				$error = "new password and confirm password did not matched";
			}
		}
		else
		{
			$error = "password is not matched";
		}
	}
 		header("location:changepass.php?error=$error");
	
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
                <?$sqlF = $con->selectdb("select * from tbl_favicon where fav_id= 1 ");
            $rowF = mysqli_fetch_assoc($sqlF);
        ?>
        <link rel="<?echo $rowF['relation'];?>" href="../favicon/big_img/<?echo $rowF['image_name'];?>" />


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
                <div class="logo-box">
                    <a href="index.php" class="logo text-center">
                        <span class="logo-lg">
                        <?$sqlL = $cn->selectdb("select * from tbl_logo where logo_id= 1 ");
                            $rowL = mysqli_fetch_assoc($sqlL);
                        ?>
                            <img src="<?if($rowL['image_name']!=''){echo "../logo/big_img/".$rowL['image_name'];}?>" alt="" height="16">
                        </span>
                    </a>
                </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <h4 class="page-title-main">Password</h4>
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
                                <h4 class="mt-0 header-title">Change Password</h4>
                                <form class="form-horizontal" method="post" action="#" id="myform" name="myform" enctype="multipart/form-data">
									
                                       <label id="error" style="color:#FF0000"><? if (isset($_GET['error']) && !empty($_GET['error'])) echo $_GET['error'];?></label>
									    <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Old Password</label>
                                            <div class="col-sm-12">
                                                <input type="password" class="form-control" id="oldpwd" name="oldpwd" placeholder="Old Password">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">New Password</label>
                                            <div class="col-sm-12">
                                                <input type="password" class="form-control" id="newpwd" name="newpwd" placeholder="New Password">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Confirm Password</label>
                                            <div class="col-sm-12">
                                                <input type="password" class="form-control" id="conpwd" name="conpwd" placeholder="Confirm Password">
                                            </div>
                                        </div>
										                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-12">
                                                <button type="submit" name="changepwd" id="changepwd" class="btn btn-success">Change</button>
												<button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='index.php'; return false;" >Cancel</button>
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

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    
    <!-- Init js-->
    <script src="assets/js/pages/form-advanced.init.js"></script>
    

</body>

</html>