
<?
	include("../connect.php");
	$cn=new connect();
$cn->connectdb();
	$id=$_GET['id'];
	$cn->selectdb("INSERT INTO tbl_page( `page_name`, `page_desc`, `page_parent_id`, `image`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `multi_images`, `slug`, `recordListingID`) SELECT  `page_name`, `page_desc`, `page_parent_id`, `image`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `multi_images`, `slug`, `recordListingID` FROM `tbl_page` WHERE page_id =".$id);
	$last_id = mysqli_insert_id($cn->getConnection());
	$sql=$cn->selectdb("SELECT * FROM `tbl_page` where page_id=".$last_id);
	$row = mysqli_fetch_assoc($sql);
	// echo "<script>alert('".$last_id."');</script>";
	$pagename = $row['page_name'] . ' (copy)';
	$cn->selectdb("update tbl_page set `page_name`='$pagename' where page_id=$last_id");
	
	$addmore = $cn->selectdb("SELECT * FROM tbl_addmore where page_id = $id");
	while($addmorerow = mysqli_fetch_assoc($addmore))
	{
		extract($addmorerow);
		$cn->selectdb("INSERT INTO tbl_addmore( page_id, title, small_desc, extra_desc, extra_icon) VALUES ( $last_id, '$title', '$small_desc', '$extra_desc', '$extra_icon')");
	}

	header('Location:pageView.php');
?>