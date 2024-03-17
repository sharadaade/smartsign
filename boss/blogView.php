<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("../connect.php");
include_once("../navigationfun.php");
include_once("imagefunction.php");
include_once("image_lib.php");
require('./Classes/PHPExcel.php');
$cn=new connect();
$cn->connectdb();

$pageID= 'page9';

$sql = $cn->selectdb("SELECT * FROM tbl_blog order by blog_id desc");

?>
<?php

if(isset($_POST['createexcel']))
{   
 	$msg="";
    $var="";
    //write your query      
    $sql="select * from tbl_blog";
    $res = $con->selectdb($sql);
    
  
  


// create new PHPExcel object
$objPHPExcel = new PHPExcel;

// set default font
$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');

// set default font size
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);

// create the writer
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");


/**

 * Define currency and number format.

 */

// currency format, � with < 0 being in red color
//$currencyFormat = '#,#0.## \�;[Red]-#,#0.## \�';

// number format, with thousands separator and two decimal points.
//$numberFormat = '#,#0.##;[Red]-#,#0.##';



// writer already created the first sheet for us, let's get it
$objSheet = $objPHPExcel->getActiveSheet();

// rename the sheet
$objSheet->setTitle('Property file');



// let's bold and size the header font and write the header
// as you can see, we can specify a range of cells, like here: cells from A1 to A4
$objSheet->getStyle('A1:F1')->getFont()->setBold(true)->setSize(12);

// write header

$objSheet->getCell('A1')->setValue('ID');
$objSheet->getCell('B1')->setValue('Property Name');
$objSheet->getCell('C1')->setValue('Description');
$objSheet->getCell('D1')->setValue('Category ID');
$objSheet->getCell('E1')->setValue('Property Single Image');
$objSheet->getCell('F1')->setValue('Property Multi Images');


$i=2;
$sql1=$con->selectdb("SELECT * FROM tbl_blog");												
						 //print_r($sql1);
while(empty($sql1)==0 AND $row1 = mysqli_fetch_array($sql1))
{ 
	$objSheet->getCell('A'.$i)->setValue($row1['blog_id']);
	$objSheet->getCell('B'.$i)->setValue($row1['blog_name']);
	$objSheet->getCell('C'.$i)->setValue($row1['description']);
	$objSheet->getCell('D'.$i)->setValue($row1['cat_id']);
	$objSheet->getCell('E'.$i)->setValue($row1['blog_image']);
	$objSheet->getCell('F'.$i)->setValue($row1['multi_images']);


	$i++;
}

// autosize the columns
$objSheet->getColumnDimension('A')->setAutoSize(true);
$objSheet->getColumnDimension('B')->setAutoSize(true);
$objSheet->getColumnDimension('C')->setAutoSize(true);
$objSheet->getColumnDimension('D')->setAutoSize(true);
$objSheet->getColumnDimension('E')->setAutoSize(true);
$objSheet->getColumnDimension('F')->setAutoSize(true);

$objWriter->save('file.xlsx');

header('location:test.php');

}//end of create excel file...
?>


<?
//start coding for uploading products single images for excel entries

if(isset($_POST['addImage']))
{
	
	$images = '';
		if(isset($_FILES["imageName"]))
		{
		for($i=0;$i<count($_FILES['imageName']['name']);$i++)
		{
			if($_FILES["imageName"]['name'][$i]!="")
			{
					if (($_FILES["imageName"]["type"][$i] == "image/gif")
						|| ($_FILES["imageName"]["type"][$i] == "image/jpeg")
						|| ($_FILES["imageName"]["type"][$i] == "image/jpg")
						|| ($_FILES["imageName"]["type"][$i] == "image/png")
						|| ($_FILES["imageName"]["type"][$i] == "image/bmp"))
						  {
							  //rand ()
							  if($_FILES["imageName"]["type"][$i] == "image/gif")
									$extension=".gif";
							   else if($_FILES["imageName"]["type"][$i] == "image/jpeg")
									$extension=".jpeg";
							   else if($_FILES["imageName"]["type"][$i] == "image/jpg")
									$extension=".jpg";
								else if($_FILES["imageName"]["type"][$i] == "image/bmp")
									$extension=".bmp";
								else if($_FILES["imageName"]["type"][$i] == "image/png")
									$extension=".png";		
							
							
							$name4= $_FILES["imageName"]['name'][$i];
							
							//echo "extesnion==".$extension;
							
						  if ($_FILES["imageName"]["error"][$i] > 0)
							{
								echo "Return Code: " . $_FILES["imageName"]["error"][$i] . "<br />";
							}
						  else
							{	
									//move_uploaded_file($_FILES["imageName"]["tmp_name"][$i],"../galleryimage/big_img/".$name4.$extension);
									
									move_uploaded_file($_FILES["imageName"]["tmp_name"][$i],"../blog/big_img/" . $name4);
									
										
									make_thumb("../blog/big_img/".$name4,"../blog/".$name4,500,$extension);
									
									

							}
						  }
						else
			  {
				  
			  echo "Invalid file".$_FILES["imageName"]["type"][$i];
			  }
			 }//end if
		}//end for
	}//ed if
		//header('Location: '.$_SERVER['PHP_SELF']);
		echo "<script>alert('Images are uploaded sucessfully....');</script>";
		header('Location: '.$_SERVER['PHP_SELF']);

}//end if addimage
//echo $subcategory_id

//end coding for uploading products multiple images for excel entries
?>

<?php
//start code for uploading excel file...........
$uploadedStatus = 0;

if ( isset($_POST["addexcel"]) ) {
if ( isset($_FILES["file"])) {
//if there was an error uploading the file
if ($_FILES["file"]["error"] > 0) {
echo "<script>alert('File not uploaded sucessfully..');</script>";

}
else {
if (file_exists($_FILES["file"]["name"])) {
//unlink($_FILES["file"]["name"]);
}
$storagename = "property.xlsx";
move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);
$uploadedStatus = 1;
// start coding for import records from excel to db.......

include 'Classes/PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$inputFileName = 'property.xlsx'; 

try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}



$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
$i=2;
while($i<=$arrayCount)
{
$blog_id = trim($allDataInSheet[$i]["A"]);

$blog_name = trim($allDataInSheet[$i]["B"]);
$description = trim($allDataInSheet[$i]["C"]);
$cat_id = trim($allDataInSheet[$i]["D"]);
$blog_image = trim($allDataInSheet[$i]["E"]);
$multi_images = trim($allDataInSheet[$i]["F"]);


	$query = "SELECT blog_id FROM tbl_blog WHERE blog_id = ".$blog_id;
	$sql = $con->selectdb($query);
	$recResult = mysqli_fetch_array($sql);
	$existid = $recResult["blog_id"];
	
	if($existid>0) {
		//$msg = 'Record already exist. so updated it.... <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
		$insertTable= $con->selectdb("UPDATE tbl_blog SET blog_name = '".$blog_name."', description = '".$description."',cat_id = '".$cat_id."',blog_image = '".$blog_image."',multi_images = '".$multi_images."' WHERE blog_id = ".$blog_id.";");
		//echo "UPDATE tbl_blog SET product_title = '".$title."', blog_imagelist = '".$imagelist."', product_desc = '".$desc."', price = '".$price."', cat_id=".$catid.", size = '".$size."' WHERE blog_id = ".$id.";";
	
	} else {
		$insertTable= $con->selectdb("INSERT INTO tbl_blog (blog_id,blog_name, description, cat_id,blog_image,multi_images) VALUES ('".$blog_id."','".$blog_name."', '".$description."', '".$cat_id."','".$blog_image."','".$multi_images."');");
		//$msg = 'Record has been added. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
	}
	$i++;
}

// end coding for import records from excel to db.......

echo "<script> alert('Your Excel File is imported sucessfully.. Please upload profile pics also..');</script>";
//reloading new records.........
header('Location: '.$_SERVER['PHP_SELF']);
}
} else {
echo "<script>alert('No file selected..');</script>";
}
}

//end code for uploading excel file...........

function deleteblog($id){

    $cn=new connect();
    $cn->connectdb();
    $sql=  $cn->selectdb("select * from tbl_blog where blog_id=$id");
	while($row = mysqli_fetch_row($sql))
	{
		//image
		@unlink('../blog/big_img/'.$row[4]);
		@unlink('../blog/'.$row[4]);
		//end of image
		
		// pdf
		@unlink('../download_pdf/'.$row[8]);
		
		//multiple images
		$image_list = explode(',',$row[13]);

		foreach($image_list as $rowF)
		{
			//print_r($image_list);die;
			$new_image_list = '';
			@unlink('../blogF/big_img/'.$rowF);
			@unlink('../blogF/'.$rowF);
		}
		
		
		
	}

	$cn->selectdb("delete from tbl_blog where blog_id=$id");

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
                    <h4 class="page-title-main">Blog</h4>
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
                                <h4 class="mt-0 header-title">Blog View</h4>
                                <?php
                                    if(isset($_POST['delete']))
                                    {
                                    $cnt=array();
                                    $cnt=count($_POST['chkbox']);
                                    for($i=0;$i<$cnt;$i++)
                                    {
                                        $del_id=$_POST['chkbox'][$i];
                                        deleteblog($del_id);
                                    }
                                        echo "<script>window.open('blogView.php','_SELF')</script>";
                                    }
                                ?>
                                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href="blog.php" class="btn btn-success m-b-sm mt-2 mb-2">Add</a>
                                            <a href="sorting_blog.php" class="btn btn-success m-b-sm mt-2 mb-2">Sort</a>
                                            <input type="submit" class="btn btn-danger m-b-sm mt-2 mb-2"name="delete" value="delete"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkall" class="checkall" name="sample"/> Select all</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Copy</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th><input type="checkbox" id="checkall" class="checkall" name="sample"/> Select all</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Copy</th>
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
                                                    $catID= explode(",",$cat_id);
                                                    //print_r($catID);
                                                    $cnt  =sizeof($catID)-1; 
                                                    //echo $cnt;
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" name="chkbox[]" id="chkbox" class="chkbox"  value="<?echo $blog_id?>"/></td>
												<td><?php echo $blog_name ?></td>
												<td>
                                                    <? for($i=0; $i<$cnt;$i++){ ?>
														<?php echo $cn->getname('tbl_blogcategory','cat_id','cat_name',$catID[$i]); ?>,
													<? } ?>
												</td>
                                                <td>
												    <a href='blog_copy.php?id=<?php echo $blog_id ?>&page=<? echo isset($_GET['page']);?>'><i class="fa fa-copy"></i></a>
                                                </td>
                                                <td><a href='blog_up.php?blog_id=<?php echo $blog_id ?>&page=<? echo isset($_GET['page']);?>'><i class="fa fa-edit"></i></a></td>
												<td><a href='delete_blog_rec.php?tablename=tbl_blog&primarykey=blog_id&id=<?php echo $blog_id ?>&page=<? echo isset($_GET['page']);?>' onClick="return confirm('Are you sure want to delete?');"><i class="fa fa-trash"></i></a></td>
                                                
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
    <!--<script src="assets/js/pages/datatables.init.js"></script>-->
    <script>
        $(document).ready(function(){$("#datatable").DataTable();var a=$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","pdf"]});$("#key-table").DataTable({keys:!0}),$("#responsive-datatable").DataTable(),$("#selection-datatable").DataTable({select:{style:"multi"}}),a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")});
    </script>

    <!-- App js -->
    <script src="assets/js/app.min.js?v=<?echo time();?>"></script>
</body>

</html>