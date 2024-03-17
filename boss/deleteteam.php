<?php
include_once("../connect.php");
$cn=new connect();
$cn->connectdb();


if($_GET['Del']== 'del')
{
$id=  $_GET['id'];
$page= $_GET['page'];

	$sql=mysqli_query($cn->getConnection(),"select * from tbl_team where team_id=$id");
	while($row = mysqli_fetch_row($sql))
	{
		unlink("../team/". $row[2]);	
		unlink("../team/big_img/". $row[2]);
		
			
	}
	mysqli_query($cn->getConnection(),"delete from tbl_team where team_id=$id");
	//$cn->Deletedata($tablename,$primarykey,$id);
	header("location:teamView.php?page=$page");	
}
