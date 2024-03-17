<?php
include_once("../connect.php");
$cn=new connect();
$cn->connectdb();



//$parseurl=parse_url($_SERVER['HTTP_REFERER']);
//echo $parseurl['path'];die;
	
	if (isset($_GET['id']) && (int)$_GET['id'] > 0) {
        $id = (int)$_GET['id'];
	//first delete product features table
	//mysql_query("delete from tbl_product_features where product_id=$id");
	
	// second product table 
	$sql=  $cn->selectdb("select * from tbl_submenu where submenu_id=$id");
	while($row = mysqli_fetch_assoc($sql))
	{
		//image
		@unlink('../menu/big_img/'.$row['submenu_image']);
		@unlink('../menu/'.$row['submenu_image']);
		//end of image
	}

	$cn->selectdb("delete from tbl_submenu where submenu_id=$id");

	//$cn->Deletedata($tablename,$primarykey,$id);
	header("location: submenuView.php?page=$page");
	}
	
	
	function deleteSubmenu($id)
	{
		$cn=new connect();
		$cn->connectdb();
		$id = $id;
	//first delete product features table
	//mysql_query("delete from tbl_product_features where product_id=$id");
	
	// second product table 
	$sql=  $cn->selectdb("select * from tbl_submenu where submenu_id=$id");
	while($row = mysqli_fetch_assoc($sql))
	{
		//image
		@unlink('../menu/big_img/'.$row['submenu_image']);
		@unlink('../menu/'.$row['submenu_image']);
		//end of image
	}

	$cn->selectdb("delete from tbl_submenu where submenu_id=$id");

	//$cn->Deletedata($tablename,$primarykey,$id);
	//header("location: productView.php?page=$page");
	}

?>
