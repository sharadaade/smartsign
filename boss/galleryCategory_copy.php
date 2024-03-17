
<?
	include("../connect.php");
	$cn=new connect();
$cn->connectdb();
	$id=$_GET['id'];

	$query = "SELECT 
	`cat_parent_id`, 
	`cat_name`, 
	`cat_description`, 
	`cat_image`, 
	`meta_tag_title`, 
	`meta_tag_description`, 
	`meta_tag_keywords`, 
	`recordListingID`, 
	`slug`
    FROM `tbl_gallery_category` WHERE cat_id =$id";

	$result = $cn->selectdb($query);
    $data = mysqli_fetch_assoc($result);
    extract($data);
	
	$query = "INSERT INTO `tbl_gallery_category`(
        `cat_parent_id`, 
		`cat_name`, 
		`cat_description`, 
		`cat_image`, 
		`meta_tag_title`, 
		`meta_tag_description`, 
		`meta_tag_keywords`, 
		`recordListingID`, 
		`slug`) 
        VALUES (
            '$cat_parent_id',
            '$cat_name',
            '$cat_description',
            '',
            '$meta_tag_title',
            '$meta_tag_description',
            '$meta_tag_keywords',
            0,
            '$slug')
            ";
	$cn->selectdb($query);



	// $cn->selectdb("INSERT INTO tbl_gallery_category ( `cat_parent_id`, `cat_name`, `cat_description`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `slug`)SELECT `cat_parent_id`, `cat_name`, `cat_description`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `slug` FROM `tbl_gallery_category` WHERE cat_id =".$id);
	$last_id = mysqli_insert_id($cn->getConnection());
	$sql=$cn->selectdb("SELECT * FROM `tbl_gallery_category` where cat_id=".$last_id);
	$row = mysqli_fetch_assoc($sql);
	//echo "<script>alert('".$last_id."');</script>";
	$cn->selectdb("update tbl_gallery_category set `cat_name`='".$row['cat_name']." (copy)' where cat_id=".$last_id);
	
	header('Location:galleryCatView.php');
?>