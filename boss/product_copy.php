
<?
	include("../connect.php");
	$cn=new connect();
$cn->connectdb();
	$id=$_GET['id'];
	$query = "SELECT 
	`product_name`, 
	`description`, 
	`cat_id`, 
	`price`, 
	`recordListingID`, 
	`meta_tag_title`, 
	`meta_tag_description`, 
	`meta_tag_keywords`, 
	`slug`, 
	`date`, 
	`month`, 
	`year` 
	FROM tbl_product WHERE product_id =$id";
	$result = $cn->selectdb($query);
	$data = mysqli_fetch_assoc($result);
	extract($data);
	// $cn->selectdb("INSERT INTO tbl_product ( `product_name`, `description`, `cat_id`, `price`, `recordListingID`,  `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`,  `slug`, `date`, `month`, `year`)SELECT `product_name`, `description`, `cat_id`,  `price`, `recordListingID`,  `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `slug`, `date`, `month`, `year` FROM tbl_product WHERE product_id =".$id);
	$query = "INSERT INTO `tbl_product`(
		`product_name`, 
		`description`, 
		`cat_id`, 
		`product_image`, 
		`price`, 
		`recordListingID`, 
		`pdf_file`, 
		`meta_tag_title`, 
		`meta_tag_description`, 
		`meta_tag_keywords`, 
		`multi_images`, 
		`slug`, 
		`date`, 
		`month`, 
		`year`, 
		`product_video`, 
		`product_map`) 
		VALUES(
			'$product_name',
			'$description',
			'$cat_id',
			'',
			'$price',
			'$recordListingID',
			'',
			'$meta_tag_title',
			'$meta_tag_description',
			'$meta_tag_keywords',
			'',
			'$slug',
			'$date',
			'$month',
			'$year',
			'',
			''
		)
	
	";
	$cn->selectdb($query);

	$last_id = mysqli_insert_id($cn->getConnection());
	$sql=$cn->selectdb("select * from `tbl_product` where product_id=".$last_id);
	$row = mysqli_fetch_assoc($sql);
	// echo "<script>alert('".$last_id."');</script>";
	$cn->selectdb("update tbl_product set `product_name`='".$row['product_name']." (copy)' where product_id=".$last_id);
	
	header('Location:productView.php');
?>