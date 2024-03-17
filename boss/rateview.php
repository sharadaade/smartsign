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

$pageID= 'page4';

$sql = $cn->selectdb("SELECT *FROM tbl_rate");

function deletemultirec($id)
{
	$cn=new connect();
	$cn->connectdb();
	$id = $id;

$cn->selectdb("delete from tbl_rate where rate_id=$id");

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
									if(isset($_POST['delete']))
									{
									$cnt=array();
									$cnt=count($_POST['chkbox']); 
									for($i=0;$i<$cnt;$i++)
									{
										$del_id=$_POST['chkbox'][$i];
										deletemultirec($del_id);
										
									}
										echo "<script>window.open('rateview.php','_SELF')</script>";
									}
								?>

                                <form id="myform" name="myform" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="">CSV FILE</label>
                                            <input type="file" id="file" name="file" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row pt-2 pb-2">
                                        <div class="col-lg-12">
                                            <input type="submit" id="excelfile" name="excelfile" value="Import Data" class="btn btn-success m-b-sm">&nbsp;&nbsp;
                                            <input type="submit" id="appendfile" name="appendfile" value="Add More" class="btn btn-success m-b-sm">&nbsp;&nbsp;
                                            <a href="exportSQL.php" id="exportfile" name="exportfile" value="Export Data" class="btn btn-success m-b-sm">Export Data</a>&nbsp;&nbsp;
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th> </th>
                                                            <th>COUNTRY</th>
                                                            <th>Service</th>
                                                            <th>500gm</th>
                                                            <th>1kg</th>
                                                            <th>1.5kg</th>
                                                            <th>2kg</th>
                                                            <th>2.5kg</th>
                                                            <th>3kg</th>
                                                            <th>3.5kg</th>
                                                            <th>4kg</th>
                                                            <th>4.5kg</th>
                                                            <th>5kg</th>
                                                            <th>5.5kg</th>
                                                            <th>6kg</th>
                                                            <th>7-10kg</th>
                                                            <th>11-16kg</th>
                                                            <th>17-20kg</th>
                                                            <th>21-30kg</th>
                                                            <th>31-50kg</th>
                                                            <th>51-70kg</th>
                                                            <th>100+kg</th>
                                                            <th>WORKING DAYS</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th> </th>
                                                            <th>COUNTRY</th>
                                                            <th>Service</th>
                                                            <th>500gm</th>
                                                            <th>1kg</th>
                                                            <th>1.5kg</th>
                                                            <th>2kg</th>
                                                            <th>2.5kg</th>
                                                            <th>3kg</th>
                                                            <th>3.5kg</th>
                                                            <th>4kg</th>
                                                            <th>4.5kg</th>
                                                            <th>5kg</th>
                                                            <th>5.5kg</th>
                                                            <th>6kg</th>
                                                            <th>7-10kg</th>
                                                            <th>11-16kg</th>
                                                            <th>17-20kg</th>
                                                            <th>21-30kg</th>
                                                            <th>31-50kg</th>
                                                            <th>51-70kg</th>
                                                            <th>100+kg</th>
                                                            <th>WORKING DAYS</th>
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
                                                            <td></td>

                                                            <td><?php echo $country; ?></td>
                                                            <td><?php echo $service; ?></td>
                                                            <td><?php echo $gm500; ?></td>
                                                            <td><?php echo $kg1; ?></td>
                                                            <td><?php echo $row["kg1.5"]; ?></td>
                                                            <td><?php echo $kg2; ?></td>
                                                            <td><?php echo $row["kg2.5"]; ?></td>
                                                            <td><?php echo $kg3; ?></td>
                                                            <td><?php echo $row["kg3.5"]; ?></td>
                                                            <td><?php echo $kg4; ?></td>
                                                            <td><?php echo $row["kg4.5"]; ?></td>
                                                            <td><?php echo $kg5; ?></td>
                                                            <td><?php echo $row["kg5.5"]; ?></td>
                                                            <td><?php echo $kg6; ?></td>
                                                            <td><?php echo $row["kg7-10"]; ?></td>

                                                            <td><?php echo $row["kg11-16"]; ?></td>
                                                            <td><?php echo $row["kg17-20"]; ?></td>
                                                            <td><?php echo $row["kg21-30"]; ?></td>
                                                            <td><?php echo $row["kg31-50"]; ?></td>
                                                            <td><?php echo $row["kg51-70"]; ?></td>

                                                            <td><?php echo $kg100p; ?></td>
                                                            <td>
                                                                <? echo $days;?>
                                                            </td>

                                                            <td><a href='deleteRecord.php?tablename=tbl_rate&primarykey=Rid&id=<?php echo $Rid ?>&page=<?  if (isset($_GET['
                                                                    page']) && !empty($_GET['page'])) echo
                                                                    $_GET['page'];?>' onClick="return
                                                                    confirm('Are you sure want to
                                                                    delete?');"><i
                                                                        class="fa fa-trash"></i></a></td>

                                                        </tr>
                                                        <? } } ?>
                                                        <input type="hidden" name="page" id="page"
                                                            value="<?  if (isset($_GET['page']) && !empty($_GET['page'])) echo $_GET['page'];?>">


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
    <script src="assets/js/app.min.js"></script>
    
</body>

</html>
<?

if(isset($_POST["excelfile"]))
{
    //First we need to make a connection with the database
    $base = "uploads/";
    $filename=$base . $_FILES["file"]["name"];
    $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
    if($_FILES["file"]["size"] != 0)
    {
        if($ext == ".csv")
        {
            if($_FILES["file"]["size"] > 0)
            {
            $cn->insertdb("Drop Table tbl_rate");
            move_uploaded_file($_FILES['file']['tmp_name'], $filename);
            $file = fopen($filename, "r");
            $count = 0; 
            $cn->insertdb("CREATE TABLE `tbl_rate` (
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
            ) ENGINE=InnoDB AUTO_INCREMENT=1     DEFAULT CHARSET=latin1");          // add this line
            while (($emapData = fgetcsv($file)) !== FALSE)
            {
                //print_r($emapData);
                //exit();
                $count++;                                      // add this line

                //if($count>1){  
            
                    
                //echo "<script>alert('$emapData[1]');</script>";
                $cn->insertdb("INSERT into tbl_rate(`country`, `service`, `gm500`, `kg1`, `kg1.5`, `kg2`, `kg2.5`, `kg3`, `kg3.5`, `kg4`, `kg4.5`, `kg5`, `kg5.5`, `kg6`, `kg7-10`, `kg11-16`, `kg17-20`, `kg21-30`, `kg31-50`, `kg51-70`,`kg100p`, `days`) values ('$emapData[0]','$emapData[1]',$emapData[2],$emapData[3],$emapData[4],$emapData[5],$emapData[6],$emapData[7],$emapData[8],$emapData[9],$emapData[10],$emapData[11],$emapData[12],$emapData[13],$emapData[14],$emapData[15],$emapData[16],$emapData[17],$emapData[18],$emapData[19],$emapData[20],'$emapData[21]')");
        
                //} // add this line
            }
            fclose($file);
            echo 'CSV File has been successfully Imported';
             echo "<script>window.location.assign('rateView.php');</script>";
            }
            else
                echo "<script>alert('Invalid File:Please Upload CSV File');</script>";
        }
        else
            echo "<script>alert('Invalid File:Please Upload CSV File');</script>";
        
    }
    else
        echo "<script>alert('Please select a file');</script>";
}
if(isset($_POST["appendfile"]))
{
    //First we need to make a connection with the database
    $base = "uploads/";
    $filename=$base . $_FILES["file"]["name"];
    $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
    if($_FILES["file"]["size"] != 0)
    {
        if($ext == ".csv")
        {
        if($_FILES["file"]["size"] > 0)
        {
        
        move_uploaded_file($_FILES['file']['tmp_name'], $filename);
        $file = fopen($filename, "r");
        $count = 0;                                         // add this line
        while (($emapData = fgetcsv($file)) !== FALSE)
        {
    //print_r($emapData);
    //exit();
    //$count++;                                      // add this line

    //if($count>1){  
        //echo "<script>alert('Invalid File:Pad CSV File');</script>";
        $qry = "INSERT into tbl_rate(`country`, `service`, `gm500`, `kg1`, `kg1.5`, `kg2`, `kg2.5`, `kg3`, `kg3.5`, `kg4`, `kg4.5`, `kg5`, `kg5.5`, `kg6`, `kg7-10`, `kg11-16`, `kg17-20`, `kg21-30`, `kg31-50`, `kg51-70`,`kg100p`, `days`) values ('$emapData[0]','$emapData[1]',$emapData[2],$emapData[3],$emapData[4],$emapData[5],$emapData[6],$emapData[7],$emapData[8],$emapData[9],$emapData[10],$emapData[11],$emapData[12],$emapData[13],$emapData[14],$emapData[15],$emapData[16],$emapData[17],$emapData[18],$emapData[19],$emapData[20],'$emapData[21]')";
        //echo "<script>alert('".$qry."');</script>";
        $sql = $cn->insertdb($qry);
      
        //}                                              // add this line
        }
        fclose($file);
        echo 'CSV File has been successfully Imported';
      echo "<script>window.location.assign('rateView.php');</script>";
        }
        else
        {
            echo "<script>alert('Invalid File:Please Upload CSV File');</script>";
            
        }
        }
        else
        {
        echo "<script>alert('Invalid File:Please Upload CSV File');</script>";
        
        }
    }
    else
        echo "<script>alert('Please select file');</script>";
    
}
//to export data in EXCEL
/*
if(isset($_POST['exportfile'])){
echo "<script>window.open('exportSQL.php','_BLANK');</script>";
//header("Location:exportSQL.php");
}*/
if(isset($_POST['customer'])){
    
    $base = "uploads/";
    $filename= $_FILES["file1"]["name"];
    move_uploaded_file($_FILES['file1']['tmp_name'], $base . $filename);
$sql = $cn->insertdb("update tbl_cratelist set file = '".$filename."' where crid = 1");

}
?>  