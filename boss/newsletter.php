<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}
include_once("../connect.php");

$cn=new connect();
$cn->connectdb();
$pageID= 'page21';

$email_result = $cn->selectdb("SELECT * FROM tbl_newsletter_emails order by email_id desc ");


if(isset($_POST['send']))
{
    $to="";
    $cnt=array();
    $cnt=count($_POST['chkbox']);		
    for($i=0;$i<$cnt;$i++)
    {
        $m_id=$_POST['chkbox'][$i];
        $sql=  $cn->selectdb("select * from tbl_newsletter_emails where email_id=$m_id");
        $row = mysqli_fetch_assoc($sql);
        $to.=$row['email'].",";
    }
    // echo  "<script>alert('".trim($to,",")."')</script>";
    
    $news = $_POST['news'];
    $subject = $_POST['subject'];


    $cn->insertdb("INSERT INTO `tbl_newsletter` (`subject`, `news`, `emails`) VALUES ('".$subject."', '".$news."', '".$to."');");
    
    if($domain!="localhost")
    {
        echo "<script> alert('Message Sent Successfully!');</script>";
        mail($to, $subject, $body);
    }
    else{
        echo "<script> alert('Message Not Sent!');</script>";
    }
    
    header("location:newsletterView.php");
	
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
                                <h4 class="mt-0 mb-2 header-title">Newsletter Form</h4>
                                <form class="form-horizontal" method="post" action="#" id="myform" name="myform" enctype="multipart/form-data">				
                                                
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Subject</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" >
                                        </div>
                                    </div>										
                                                
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Compose Email</label>
                                        <div class="col-sm-12">
                                            <textarea id="news" name="news" class="ckeditor" rows="5"></textarea>
                                        </div>
                                    </div>										
                                    
                                    <div class="table-responsive" id="page">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="checkall" class="checkall" name="sample"/> Select all</th>
                                                    <th>Id</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th><input type="checkbox" id="checkall" class="checkall" name="sample"/> Select all</th>
                                                    <th>Id</th>
                                                    <th>Email</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($email_result) > 0) 
                                                {
                                                    $i=0;
                                                    while($row = mysqli_fetch_assoc($email_result)) 
                                                    {
                                                        extract($row);
                                                        $i++;
                                                ?>
                                                <tr>
                                                    <td><input id="chkFile<?echo $i?>" type="checkbox" name="chkbox[]" class="chkbox"  value="<?echo $email_id?>"/></td>
                                                    <td><?php echo $email_id ?></td>
                                                    <td><?php echo $email; ?></td>
                                                </tr>
                                                <? } } ?>
                                                <input type="hidden" name="page" id="page" value="<?  if (isset($_GET['page']) && !empty($_GET['page'])) echo $_GET['page'];?>">
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="send" id="send" class="btn btn-success">send</button>
                                            <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='newsletterView.php'; return false;" >Cancel</button>
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

    <!-- ckeditor -->
    <script src="assets/libs/ckeditor/ckeditor.js"></script>
    
    <!-- App js -->
    <script src="assets/js/app.min.js?v=<?echo time();?>"></script>
    </body>

</html>