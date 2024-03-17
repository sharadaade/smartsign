
<?
	include("../connect.php");
	$cn=new connect();
    $cn->connectdb();
    $id=$_GET['id'];
    
    $query = "SELECT * FROM `tbl_slider` WHERE slider_id =$id";

	$result = $cn->selectdb($query);
    $data = mysqli_fetch_assoc($result);
    extract($data);
	
	$query = "INSERT INTO `tbl_slider`(
		`image_name`, 
		`image_title`, 
        `desc_slider`, 
        `meta_tag_title`, 
        `slug`, 
        `link_url`, 
        `bg_image`,
        `recordListingID`
        )
        VALUES (
            '',
            '$image_title',
            '$desc_slider',
            '$meta_tag_title',
            '$slug',
            '$link_url',
            '',
            0)";
	$cn->selectdb($query);

	$last_id = mysqli_insert_id($cn->getConnection());
	$sql=$cn->selectdb("SELECT * FROM `tbl_slider` where slider_id=".$last_id);
	$row = mysqli_fetch_assoc($sql);
	//echo "<script>alert('".$last_id."');</script>";
	$cn->selectdb("update tbl_slider set `image_title`='".$row['image_title']." (copy)' where slider_id=".$last_id);
	
	header('Location:sliderView.php');
?>