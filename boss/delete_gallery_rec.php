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
	//mysql_query("delete from tbl_gallery_features where gallery_id=$id");
	
	// second product table 
	$sql=  $cn->selectdb("select * from tbl_gallery where gallery_id=$id");
	while($row = mysqli_fetch_assoc($sql))
	{
		//image
		@unlink('../gallery/big_img/'.$row['gallery_image']);
		@unlink('../gallery/'.$row['gallery_image']);
		//end of image
		
		
		//multiple images
		$image_list = explode(',',$row['multi_images']);

		foreach($image_list as $rowF)
		{
			//print_r($image_list);die;
			$new_image_list = '';
			@unlink('../galleryF/big_img/'.$rowF);
			@unlink('../galleryF/'.$rowF);
		}
		
		
		
	}

	$cn->selectdb("delete from tbl_gallery where gallery_id=$id");

	//$cn->Deletedata($tablename,$primarykey,$id);
	header("location: galleryView.php?page=$page");


?>
