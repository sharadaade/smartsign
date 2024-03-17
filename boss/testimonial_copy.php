
<?
	include("../connect.php");
	$cn=new connect();
	$cn->connectdb();
	$id=$_GET['id'];
	$query ="SELECT  * FROM `tbl_testimonial` WHERE testimonial_id = $id";

	$sql2 = $cn->selectdb($query);

	$result = mysqli_fetch_assoc($sql2);
	extract($result);

	$query = "INSERT INTO `tbl_testimonial`(
	`image_name`, 
	`image_title`, 
	`description`, 
	`meta_tag_title`, 
	`meta_tag_description`, 
	`meta_tag_keywords`, 
	`test_image`, 
	`test_video`) 
	VALUES ( 
		'', 
		'".$image_title."', 
		'".$description."', 
		'".$meta_tag_title."', 
		'".$meta_tag_description."', 
		'".$meta_tag_keywords."', 
		'', 
		'')";  		

	$cn->selectdb($query);
	$last_id = mysqli_insert_id($cn->getConnection());
	$sql = $cn->selectdb("SELECT * FROM `tbl_testimonial` WHERE testimonial_id = $last_id");
	$row = mysqli_fetch_assoc($sql);
	//echo "<script>alert('".$last_id."');</script>";
	$cn->selectdb("UPDATE tbl_testimonial SET `image_title`='".$row['image_title']." (copy)' WHERE testimonial_id=".$last_id);
	
	header('Location:testimonialView.php');
?>