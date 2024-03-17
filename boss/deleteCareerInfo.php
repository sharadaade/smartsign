<?php
include_once("../connect.php");
$cn=new connect();
$cn->connectdb();


if($_GET['Del']== 'del')
{
$id=  $_GET['id'];
$page= $_GET['page'];

	$sql=mysqli_query($cn->getConnection(),"select * from tbl_career_info where cid=$id");
	while($row = mysqli_fetch_row($sql))
	{
		unlink("../career/". $row[6]);	
	}
	mysqli_query($cn->getConnection(),"delete from tbl_career_info where cid=$id");
	header("location:careerInfoView.php?page=$page");	
}