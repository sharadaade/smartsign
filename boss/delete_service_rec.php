<?php
include_once("../connect.php");
$cn=new connect();
$cn->connectdb();
$tablename=$_GET['tablename'];
$primarykey=$_GET['primarykey'];
$id=$_GET['id'];

$page = $_GET['page'];
	// second product table 
	$sql=  $cn->selectdb("select * from tbl_service where service_id=$id");
	while($row = mysqli_fetch_row($sql))
	{
		//image
		@unlink('../service/big_img/'.$row[1]);
		@unlink('../service/'.$row[1]);
		//end of image
		
	}

	$cn->selectdb("delete from tbl_service where service_id=$id");

	//$cn->Deletedata($tablename,$primarykey,$id);
	header("location: serviceView.php?page=$page");

?>
