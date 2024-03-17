<?php
include_once("../connect.php");
$cn=new connect();
$cn->connectdb();
$tablename=$_GET['tablename'];
$primarykey=$_GET['primarykey'];
$id=$_GET['id'];

//$parseurl=parse_url($_SERVER['HTTP_REFERER']);
//echo $parseurl['path'];die;
$page = $_GET['page'];
	//first delete product features table
	//mysql_query("delete from tbl_download_features where download_id=$id");
	
	// second product table 
	$sql=  $cn->selectdb("select * from tbl_download where download_id=$id");
	while($row = mysqli_fetch_row($sql))
	{
		//image
		@unlink('../download/big_img/'.$row[4]);
		@unlink('../download/'.$row[4]);
		//end of image
		
		// pdf
		@unlink('../download_pdf/'.$row[6]);
		
		
		
		
	}

	$cn->selectdb("delete from tbl_download where download_id=$id");

	//$cn->Deletedata($tablename,$primarykey,$id);
	header("location: downloadView.php?page=$page");


?>
