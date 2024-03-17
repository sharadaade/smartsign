<?
	include("../connect.php");
	$cn=new connect();
	$cn->connectdb();
	$id=$_GET['id'];
	$query = "SELECT * FROM tbl_category WHERE cat_id =".$id;
	$RES = $cn->selectdb($query);
	$result = mysqli_fetch_assoc($RES);
	extract($result);

	$query = "INSERT INTO tbl_category ( 
		cat_parent_id, 
		cat_name, 
		cat_description, 
		cat_image, 
		multi_images, 
		meta_tag_title, 
		meta_tag_description, 
		meta_tag_keywords, 
		slug) 
		VALUES(
		'$cat_parent_id',
		'$cat_name',
		'$cat_description',
		'',
		'',
		'$meta_tag_title',
		'$meta_tag_description',
		'$meta_tag_keywords',
		'$slug')
		";
	$cn->selectdb($query);
	$last_id = mysqli_insert_id($cn->getConnection());
	$query = "select * from tbl_category where cat_id=$last_id";
	$sql=$cn->selectdb($query);
	$row = mysqli_fetch_assoc($sql);
	extract($row);
	// echo "<script>alert('".$last_id."');</script>";

	$query = "update tbl_category set cat_name='".$row['cat_name']." (copy)' where cat_id=$last_id";
	$cn->selectdb($query);

	header('Location:categoryview.php');
?>