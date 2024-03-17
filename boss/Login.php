<?php
ob_start();
session_start();
include_once("../connect.php");
$cn=new connect();
$cn->connectdb();

if(isset($_POST['Submit']))
{
    global $cn;
    $user = $_POST['username'];
    $pwd = mysqli_real_escape_string($cn->_connection, $_POST['password']); 
    // $user_group = $_POST['user_group'];
}

?>
<?php
	if(isset($_POST['Submit']))
	{
	global $cn;
	$recordset=$cn->selectdb("select * from admintable where BINARY uname='".$user."'");
	$cnt=mysqli_affected_rows($cn->_connection);
        if($cnt==1)
        {
        $recordset2=$cn->selectdb("select * from admintable where BINARY uname='".$user."' and BINARY pwd='".$pwd."'");
        $cnt2=mysqli_affected_rows($cn->_connection);
            if($cnt2==1)
            {
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
                
                $my_date = date("Y-m-d H:i:s");

                $cn->insertdb("UPDATE `admintable` SET ipaddress='".$ip."',lastdatetimelogin='".$my_date."' where uname='".$user."' and pwd='".$pwd."'");
            
                $_SESSION['user']=$user;
                header("location:index.php");
            }
            else
            {
                $error = "toastr.error('Looks like username or password is wrong.', 'Opps..!')";
            }
        }
        else
        {
            $error = "toastr.error('Looks like username or password is wrong.', 'Opps..!')";
        }
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


    <!-- Notification css (Toastr) -->
    <link href="assets/libs/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center mt-2 mb-4">
                        <a href="index.php">
                          
                        <span class="logo-lg">
                            <?$sqlL = $cn->selectdb("select * from tbl_logo where logo_id= 1 ");
                                $rowL = mysqli_fetch_assoc($sqlL);
                            ?>
                                <img src="<?if($rowL['image_name']!=''){echo "../logo/big_img/".$rowL['image_name'];}?>" style="width:200px" alt="">
                            </span>


                        </a>
                    </div>
                    <div class="card">

                        <div class="card-body p-4">
                            
                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Sign In</h4>
                            </div>

                            <form action="" method="post">

                                <div class="form-group mb-3">
                                    <label for="emailaddress">Username</label>
                                    <input class="form-control" type="text" name="username" id="username" required placeholder="username">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" placeholder="Password" name="password" id="password" required>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit" name="Submit" id="Submit" > Log In </button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- Toastr js -->
    <script src="assets/libs/toastr/toastr.min.js"></script>
    <script src="assets/js/pages/toastr.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-center",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        // toastr.error('Looks like username or password is wrong.', 'Opps..!')
        <? if(isset($error)){ echo $error ;} ?>
    </script>
        
</body>
</html>