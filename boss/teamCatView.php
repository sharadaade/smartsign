<?php
session_start();
if(!isset($_SESSION['user']))
{
    header("location:Login.php");
}

include_once("../connect.php");
include_once("../navigationfun.php");
include_once("imagefunction.php");
include_once("image_lib_rname.php"); 
require('./Classes/PHPExcel.php');
$cn=new connect();
$cn->connectdb();

$pageID= 'pager9';

if(isset($_GET['parentid']))
{
    $parentid=$_GET['parentid'];
}
else
{
    $parentid=0;
}
   
    $result = $cn->selectdb("SELECT cat_id,cat_parent_id,cat_name,cat_description,cat_image FROM tbl_teamcategory where cat_parent_id=".$parentid." order by cat_id desc");
            
            
?>

<?php

if(isset($_POST['createexcel']))
{   
    $msg="";
    $var="";
    //write your query      
    $sql="select * from tbl_teamcategory";
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
$objSheet->setTitle('Category file');



// let's bold and size the header font and write the header
// as you can see, we can specify a range of cells, like here: cells from A1 to A4
$objSheet->getStyle('A1:E1')->getFont()->setBold(true)->setSize(12);

// write header

$objSheet->getCell('A1')->setValue('ID');
$objSheet->getCell('B1')->setValue('Parent ID');
$objSheet->getCell('C1')->setValue('Category Name');
$objSheet->getCell('D1')->setValue('Category Image');
$objSheet->getCell('E1')->setValue('Architect Id');


$i=2;
$sql1=$con->selectdb("SELECT * FROM tbl_blogcategory");                                             
                         //print_r($sql1);
while(empty($sql1)==0 AND $row1 = mysqli_fetch_array($sql1))
{ 
    $objSheet->getCell('A'.$i)->setValue($row1['cat_id']);
    $objSheet->getCell('B'.$i)->setValue($row1['cat_parent_id']);
    $objSheet->getCell('C'.$i)->setValue($row1['cat_name']);
    $objSheet->getCell('D'.$i)->setValue($row1['cat_image']);
    $objSheet->getCell('E'.$i)->setValue($row1['architect_id']);


    $i++;
}

// autosize the columns
$objSheet->getColumnDimension('A')->setAutoSize(true);
$objSheet->getColumnDimension('B')->setAutoSize(true);
$objSheet->getColumnDimension('C')->setAutoSize(true);
$objSheet->getColumnDimension('D')->setAutoSize(true);
$objSheet->getColumnDimension('E')->setAutoSize(true);

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
                                    
                                    move_uploaded_file($_FILES["imageName"]["tmp_name"][$i],"../category/big_img/" . $name4);
                                    
                                        
                                    make_thumb("../category/big_img/".$name4,"../category/".$name4,500,$extension);
                                    
                                    

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
$storagename = "category.xlsx";
move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);
$uploadedStatus = 1;
// start coding for import records from excel to db.......

include 'Classes/PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$inputFileName = 'category.xlsx'; 

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
$cat_id = trim($allDataInSheet[$i]["A"]);

$cat_parent_id = trim($allDataInSheet[$i]["B"]);
$cat_name = trim($allDataInSheet[$i]["C"]);
$cat_image = trim($allDataInSheet[$i]["D"]);
$architect_id = trim($allDataInSheet[$i]["E"]);


    $query = "SELECT cat_id FROM tbl_teamcategory WHERE cat_id = ".$cat_id;
    $sql = $con->selectdb($query);
    $recResult = mysqli_fetch_array($sql);
    $existid = $recResult["cat_id"];
    
    if($existid>0) {
        //$msg = 'Record already exist. so updated it.... <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
        $insertTable= $con->selectdb("UPDATE tbl_teamcategory SET cat_parent_id = '".$cat_parent_id."', cat_name = '".$cat_name."',cat_image = '".$cat_image."',architect_id = '".$architect_id."' WHERE cat_id = ".$cat_id.";");
        //echo "UPDATE tbl_product SET product_title = '".$title."', product_imagelist = '".$imagelist."', product_desc = '".$desc."', price = '".$price."', cat_id=".$catid.", size = '".$size."' WHERE product_id = ".$id.";";
    
    } else {
        $insertTable= $con->selectdb("INSERT INTO tbl_teamcategory (cat_id,cat_parent_id, cat_name, cat_image,architect_id) VALUES ('".$cat_id."','".$cat_parent_id."', '".$cat_name."', '".$cat_image."','".$architect_id."');");
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

function delmultiblogcat($id)
{
    $cn=new connect();
    $cn->connectdb();
    $id = (int)$id;

    // find all the children categories
    $children = getChildren($id);
    
    // make an array containing this category and all it's children
    $categories  = array_merge($children, array($id));
    $numCategory = count($categories);

    for($i=0; $i<$numCategory;$i++)
    {
    
    $sql = "SELECT cat_id,team_id,image_name
            FROM tbl_team
            WHERE FIND_IN_SET('".$categories[$i]."',cat_id)>0";
    //echo $sql;die;
    
    /*$sql = "SELECT pro_id,pro_image
            FROM tbl_blog
            WHERE cat_id IN (" . implode(',', $categories) . ")";*/
            //echo $sql;die;
    $result = dbQuery($sql);
    
    
        //unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_image']);  
        //unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_thumbnail']);
        //print_r($row);die;
        if (dbNumRows($result)>0) {
        //echo 'hi';die;
        while ($row = dbFetchAssoc($result)) {
            //unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_image']);  
            //unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_thumbnail']);
            //echo $row[0];die;
                $catID =array_filter(explode(",",$row['cat_id']));
                $cntCatId =count($catID);
                //print_r($cntCatId);die;
                if($cntCatId>1)
                {
                  $sqlupdate =mysqli_query("UPDATE tbl_team SET cat_id = replace(cat_id, '".$categories[$i].",', '') WHERE FIND_IN_SET('".$categories[$i]."',cat_id)>0");

                }
                elseif($cntCatId== 1)
                {
                    $image_list = explode(',',$row['image_name']);
                    //echo count($image_list);die;
                    //print_r($image_list);die;
                    foreach($image_list as $row2)
                    {
                        
                        $new_image_list = '';
                        unlink('../team/big_img/'.$row2);
                        unlink('../team/'.$row2);
                    }
                    
                    //pdf file
                    //unlink("../download_pdf/". $row['pdf_file']); 
                    //end of pdf
                    /*
                    //multiple images
                    $image_list1 = array_filter(explode(',',$row['multi_images']));
                    //echo count($image_list);
                    foreach($image_list1 as $rowF1)
                    {
                        //print_r($image_list);die;
                        $new_image_list1 = '';
                        unlink('../blogF/big_img/'.$rowF1);
                        unlink('../blogF/'.$rowF1);
                    }
                    // end of multiple images
                    */
                    // delete the products
                    $sqlD = "DELETE FROM tbl_team
                            WHERE team_id='".$row['team_id']."'";
                    dbQuery($sqlD);
                    
                    
               }//elseif        

        }//while
    }//if   
    
    }//for
        
    
    
    // then remove the categories image
    _deleteImage($categories);

    // finally remove the category from database;
    $sql = "DELETE FROM tbl_teamcategory 
            WHERE cat_id IN (" . implode(',', $categories) . ")";
    dbQuery($sql);
    
//}


/*
    Recursively find all children of $catId
*/
}


function getChildren($catId)
{
    $sql = "SELECT cat_id ".
           "FROM tbl_teamcategory ".
           "WHERE cat_parent_id = $catId ";
    $result = dbQuery($sql);
    
    $cat = array();
    if (dbNumRows($result) > 0) {
        while ($row = dbFetchRow($result)) {
            $cat[] = $row[0];
            
            // call this function again to find the children
            $cat  = array_merge($cat, getChildren($row[0]));
        }
    }

    return $cat;
}

/*
    Remove a category image
*/
function deleteImage()
{
    if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
        $catId = (int)$_GET['catId'];
    } else {
        header('Location: index.php');
    }
    
    _deleteImage($catId);
    
    // update the image name in the database
    $sql = "UPDATE tbl_teamcategory
            SET cat_image = ''
            WHERE cat_id = $catId";
    dbQuery($sql);        

    header("Location: index.php?view=modify&catId=$catId");
}

/*
    Delete a category image where category = $catId
*/
function _deleteImage($id)
{
    // we will return the status
    // whether the image deleted successfully
    $deleted = false;

    // get the image(s)
    $sql = "SELECT cat_image 
            FROM tbl_teamcategory
            WHERE cat_id ";
    
    if (is_array($id)) {
        $sql .= " IN (" . implode(',', $id) . ")";
    } else {
        $sql .= " = $id";
    }   

    $result = dbQuery($sql);
    
    if (dbNumRows($result)) {
        while ($row = dbFetchAssoc($result)) {
            // delete the image file
            //$deleted = @unlink(SRV_ROOT . CATEGORY_IMAGE_DIR . $row['cat_image']);
            $deleted = @unlink("../teamcategory/". $row['cat_image']);  
            @unlink("../teamcategory/big_img/". $row['cat_image']); 
        }   
        $deleted = true;
    }
    
    return $deleted;
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
                    <h4 class="page-title-main">Team Category</h4>
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
                                <h4 class="mt-0 header-title">Team Category View</h4>
                                <?php
                                    if(isset($_POST['delete']))
                                    {
                                    $cnt=array();
                                    $cnt=count($_POST['chkbox']);
                                    for($i=0;$i<$cnt;$i++)
                                    {
                                        $del_id=$_POST['chkbox'][$i];
                                        delmultiblogcat($del_id);
                                    }
                                        echo "<script>window.open('teamCatView.php','_SELF')</script>";
                                    }
                                ?>
                                
                                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href="teamcategory.php?parentid=<?php echo $parentid; ?>" class="btn btn-success m-b-sm mt-2 mb-2">Add Category</a>
                                            <!--a href="sorting_blog_category.php" class="btn btn-success m-b-sm mt-2 mb-2">Sorting</a-->
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
                                                <td><input type="checkbox" name="chkbox[]" class="chkbox"  value="<?echo $cat_id?>"/></td>
                                                <td><?php echo $cat_id; ?></td>
                                                <td><a href="teamCatView.php?parentid=<?php echo $cat_id; ?>"><?php echo $cat_name; ?></a></td>
                                                <td><?php if($cat_image!=''){?><img src='../teamcategory/<?php echo $cat_image; ?>' height="100" width="100"><?php } else { echo "No Image"; }?></td>
                                                <td><a href='teamcategory_up.php?category_id=<?php echo $cat_id; ?>&page=<? echo isset($_GET['page']);?>'><i class="fa fa-edit"></i></a></td>
                                                <td><a href='deleteteam_cat.php?catId=<?php echo $cat_id; ?>&page=<? echo isset($_GET['page']);?>' onClick="return confirm('Are you sure want to delete?');"><i class="fa fa-trash"></i></a></td>
                                                
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