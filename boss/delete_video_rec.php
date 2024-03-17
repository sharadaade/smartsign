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
	//mysql_query("delete from tbl_video_features where video_id=$id");
	
	
	$cn->selectdb("delete from tbl_video where video_id=$id");

	//$cn->Deletedata($tablename,$primarykey,$id);
	header("location: videoView.php?page=$page");


?>
