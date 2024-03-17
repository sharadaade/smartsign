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
	//mysql_query("delete from tbl_blog_features where blog_id=$id");
	
	// second product table 
	$sql=  $cn->selectdb("select * from tbl_blog where blog_id=$id");
	while($row = mysqli_fetch_row($sql))
	{
		//image
		@unlink('../blog/big_img/'.$row[4]);
		@unlink('../blog/'.$row[4]);
		//end of image
		
		// pdf
		@unlink('../download_pdf/'.$row[8]);
		
		//multiple images
		$image_list = explode(',',$row[13]);

		foreach($image_list as $rowF)
		{
			//print_r($image_list);die;
			$new_image_list = '';
			@unlink('../blogF/big_img/'.$rowF);
			@unlink('../blogF/'.$rowF);
		}
		
		
		
	}

	$cn->selectdb("delete from tbl_blog where blog_id=$id");

	//$cn->Deletedata($tablename,$primarykey,$id);
	header("location: blogView.php?page=$page");


?>
