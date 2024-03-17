<?php
include_once("../connect.php");
$cn=new connect();
$cn->connectdb();


if($_GET['Del']== 'del')
{
$id=  $_GET['id'];
$page= $_GET['page'];

	$sql=mysqli_query($cn->getConnection(),"select * from tbl_socialmedia where social_id=$id");
	while($row = mysqli_fetch_row($sql))
	{
		unlink("../social/". $row[1]);	
		unlink("../social/big_img/". $row[1]);
		
			
	}
	mysqli_query($cn->getConnection(),"delete from tbl_socialmedia where social_id=$id");
	//$cn->Deletedata($tablename,$primarykey,$id);
	header("location:socialView.php?page=$page");	
}

?>
