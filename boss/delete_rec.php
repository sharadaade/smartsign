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
	$sql=  $cn->selectdb("select * from tbl_product where product_id=$id");
	while($row = mysqli_fetch_row($sql))
	{
		//image
		@unlink('../product/big_img/'.$row[4]);
		@unlink('../product/'.$row[4]);
		//end of image
		
		// pdf
		@unlink('../download_pdf/'.$row[7]);
		
		//multiple images
		$image_list = explode(',',$row[11]);

		foreach($image_list as $rowF)
		{
			//print_r($image_list);die;
			$new_image_list = '';
			@unlink('../productF/big_img/'.$rowF);
			@unlink('../productF/'.$rowF);
		}
		
		
		
	}

	$cn->selectdb("delete from tbl_product where product_id=$id");

	//$cn->Deletedata($tablename,$primarykey,$id);
	header("location: productView.php?page=$page");
	}
	function deleteProduct($id)
	{
		$cn=new connect();
		$cn->connectdb();
		$id = $id;
	//first delete product features table
	//mysql_query("delete from tbl_product_features where product_id=$id");
	
	// second product table 
	$sql=  $cn->selectdb("select * from tbl_product where product_id=$id");
	while($row = mysqli_fetch_row($sql))
	{
		//image
		@unlink('../product/big_img/'.$row[4]);
		@unlink('../product/'.$row[4]);
		//end of image
		
		// pdf
		@unlink('../download_pdf/'.$row[7]);
		
		//multiple images
		$image_list = explode(',',$row[11]);

		foreach($image_list as $rowF)
		{
			//print_r($image_list);die;
			$new_image_list = '';
			@unlink('../productF/big_img/'.$rowF);
			@unlink('../productF/'.$rowF);
		}
		
		
		
	}

	$cn->selectdb("delete from tbl_product where product_id=$id");

	//$cn->Deletedata($tablename,$primarykey,$id);
	//header("location: productView.php?page=$page");
	}

?>
