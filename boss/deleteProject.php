<?php
include_once("../connect.php");
$cn=new connect();
$cn->connectdb();


if($_GET['Del']== 'del')
{
$id=  $_GET['id'];
$page= $_GET['page'];

	$sql=mysqli_query($cn->getConnection(),"select * from tbl_project where project_id=$id");
	while($row = mysqli_fetch_row($sql))
	{
		unlink("../project/". $row[1]);	
		unlink("../project/big_img/". $row[1]);
		
			
	}
	mysqli_query($cn->getConnection(),"delete from tbl_project where project_id=$id");
	//$cn->Deletedata($tablename,$primarykey,$id);
	header("location:projectView.php?page=$page");	
}

?>
