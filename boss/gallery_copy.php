
<?
	include("../connect.php");
	$cn=new connect();
$cn->connectdb();
	$id=$_GET['id'];

	$query = "SELECT * FROM `tbl_gallery` WHERE gallery_id =$id";

	$result = $cn->selectdb($query);
    $data = mysqli_fetch_assoc($result);
    extract($data);
	
	$query = "INSERT INTO `tbl_gallery`(
		`gallery_name`, 
		`description`, 
		`cat_id`, 
		`gallery_image`, 
		`recordListingID`, 
		`meta_tag_title`, 
		`meta_tag_description`, 
		`meta_tag_keywords`, 
		`multi_images`, 
		`slug`) 
        VALUES (
            '$gallery_name',
            '$description',
            '$cat_id',
            '',
            0,
            '$meta_tag_title',
            '$meta_tag_description',
            '$meta_tag_keywords',
            '',
            '$slug'
            )";
	$cn->selectdb($query);




	$last_id = mysqli_insert_id($cn->getConnection());
	$sql=$cn->selectdb("SELECT * FROM `tbl_gallery` where gallery_id=".$last_id);
	$row = mysqli_fetch_assoc($sql);
	//echo "<script>alert('".$last_id."');</script>";
	$cn->selectdb("update tbl_gallery set `gallery_name`='".$row['gallery_name']." (copy)' where gallery_id=".$last_id);
	
	header('Location:galleryView.php');
?>