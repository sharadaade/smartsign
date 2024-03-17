<?php
include_once("../connect.php");
$cn=new connect();
$cn->connectdb();


if($_GET['Del']== 'del')
{
$id=  $_GET['id'];
$page= $_GET['page'];

	$sql=mysqli_query($cn->getConnection(),"select * from tbl_client where client_id=$id");
	while($row = mysqli_fetch_row($sql))
	{
		unlink("../client/". $row[2]);	
		unlink("../client/big_img/". $row[2]);
		
			
	}
	mysqli_query($cn->getConnection(),"delete from tbl_client where client_id=$id");
	//$cn->Deletedata($tablename,$primarykey,$id);
	header("location:clientView.php?page=$page");	
}

function deleteClient($id)
{
	$cn=new connect();
	$cn->connectdb();
	$id = $id;

	$sql=  $cn->selectdb("select * from tbl_client where client_id=$id");
	while($row = mysqli_fetch_row($sql))
	{
		//image
		@unlink('../client/big_img/'.$row[2]);
		@unlink('../client/'.$row[2]);
		//end of image
	}

	$cn->selectdb("delete from tbl_client where client_id=$id");

}

?>


