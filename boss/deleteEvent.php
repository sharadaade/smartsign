<?php
include_once("../connect.php");
$cn=new connect();
$cn->connectdb();


if($_GET['Del']== 'del')
{
$id=  $_GET['id'];
$page= $_GET['page'];

	$sql=mysqli_query($cn->getConnection(),"select * from tbl_event where event_id=$id");
	while($row = mysqli_fetch_row($sql))
	{
		//Images
		unlink("../event/". $row[2]);	
		unlink("../event/big_img/". $row[2]);
		//Banner
		@unlink('../eventB/big_img/'.$row[8]);
		@unlink('../eventB/'.$row[8]);
		//Multi Images
		$imgs=explode(',',$row[15]);
		for ($i=0; $i < count($imgs)-1; $i++) { 
			@unlink('../eventF/big_img/'.$imgs[$i]);
			@unlink('../eventF/'.$imgs[$i]);
		}
	}
	mysqli_query($cn->getConnection(),"delete from tbl_event where event_id=$id");
	//$cn->Deletedata($tablename,$primarykey,$id);
	header("location:eventView.php?page=$page");	
}

function deleteClient($id)
{
	$cn=new connect();
	$cn->connectdb();
	$id = $id;

	$sql=  $cn->selectdb("select * from tbl_event where event_id=$id");
	while($row = mysqli_fetch_row($sql))
	{
		//image
		@unlink('../event/big_img/'.$row[2]);
		@unlink('../event/'.$row[2]);
		//end of image
	}

	$cn->selectdb("delete from tbl_event where event_id=$id");

}

?>