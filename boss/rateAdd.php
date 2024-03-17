<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("../connect.php");
// include_once("../navigationfun.php");
$cn=new connect();
$cn->connectdb();
$con=new connect();
$con->connectdb();

$pageID= 'page2';

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
                <?php include 'adminLogo.php'; ?>
            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <h4 class="page-title-main">Slider</h4>
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
                                <h4 class="mt-0 header-title">Rate View</h4>
                                    <?php
                                        $qry="SELECT * FROM tbl_country ORDER BY cname";
                                        $result = $con->selectdb($qry);
                                        // if(mysqli_num_rows($result)>0){
                                    ?>                
                                    <form class="form-horizontal" method="post" id="myform" name="myform" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">Country</label>
                                            <div class="col-sm-4">
                                                <select name='selCon' id='selCon' class="form-control">
                                                    <option value="0">Select Country</option>
                                                    <?php
                                                        while($row=$result->fetch_assoc()){
                                                            extract($row);
                                                    ?>
                                                        <option value="<?php echo $cid;?>"><?php echo $cname;?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-12 control-label">import CSV Sheet</label>
                                            <div class="col-sm-12">
                                                <input type="file" id="file" name="file" class="form-control"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="btnAdd" id="btnAdd" class="btn btn-success">Add</button>
												<button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='logoView.php'; return false;" >Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                    <?//}?>
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
    <script src="assets/js/app.min.js"></script>
    
</body>

</html>

<?

if(isset($_POST["btnAdd"]))
{


    $cid = $_POST['selCon'];
    //First we need to make a connection with the database
    $base = "uploads/";
    $filename=$base . $_FILES["file"]["name"];
    $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
    if($_FILES["file"]["size"] != 0 && $cid > 0)
    {
        if($ext == ".csv")
        {
            if($_FILES["file"]["size"] > 0)
            {
            //$cn->insertdb("Drop Table tbl_rate");
            move_uploaded_file($_FILES['file']['tmp_name'], $filename);
            $file = fopen($filename, "r");
            $count = 0; 
/*$cn->insertdb("CREATE TABLE `tbl_rate` (
 `Rid` int(11) NOT NULL AUTO_INCREMENT,
 `country` varchar(200) DEFAULT NULL,
 `service` varchar(200) DEFAULT NULL,
 `gm500` int(11) DEFAULT NULL,
 `kg1` int(11) DEFAULT NULL,
 `kg1.5` int(11) DEFAULT NULL,
 `kg2` int(11) DEFAULT NULL,
 `kg2.5` int(11) DEFAULT NULL,
 `kg3` int(11) DEFAULT NULL,
 `kg3.5` int(11) DEFAULT NULL,
 `kg4` int(11) DEFAULT NULL,
 `kg4.5` int(11) DEFAULT NULL,
 `kg5` int(11) DEFAULT NULL,
 `kg5.5` int(11) DEFAULT NULL,
 `kg6` int(11) DEFAULT NULL,
 `kg7-10` int(11) DEFAULT NULL,
 `kg11-16` int(11) DEFAULT NULL,
 `kg17-20` int(11) DEFAULT NULL,
 `kg21-30` int(11) DEFAULT NULL,
 `kg31-50` int(11) DEFAULT NULL,
 `kg51-70` int(11) DEFAULT NULL,
 `kg100p` int(11) DEFAULT NULL,
 `days` varchar(100) DEFAULT NULL,
 PRIMARY KEY (`Rid`)
) ENGINE=InnoDB AUTO_INCREMENT=1     DEFAULT CHARSET=latin1");  */        // add this line

            while (($emapData = fgetcsv($file)) !== FALSE)
            {
            //print_r($emapData);
            //exit();
            $count++;                                      // add this line

            //if($count>1){  
       // echo "<script>alert('aaa');</script>";
               $qry =  "INSERT into tbl_rate(`cid`, `sname`, `kg`, `rate`, `estime`) values ('$cid','$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]')";
            //echo "<script>alert('$emapData[1]');</script>";
              // echo "<script>alert('$qry');</script>";
            $cn->insertdb($qry);
      
            //}                                              // add this line
            }
            fclose($file);
            //echo 'CSV File has been successfully Imported';
            // echo "<script>window.location.assign('rateView.php');</script>";
            }
            else
                echo "<script>alert('Invalid File:Please Upload CSV File');</script>";
        }
        else
            echo "<script>alert('Invalid File:Please Upload CSV File');</script>";
        
    }
    else
        echo "<script>alert('Please select a file or country');</script>";
}
?>