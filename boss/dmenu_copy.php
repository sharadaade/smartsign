
<?
	include("../connect.php");
	$cn=new connect();
	$cn->connectdb();
	$id=$_GET['id'];

	$query = "SELECT * FROM `tbl_dmenu` WHERE menu_id =".$id;
	$result = $cn->selectdb($query);
	$row = mysqli_fetch_assoc($result);
	extract($row);

	$query = "INSERT INTO `tbl_dmenu`(
		`menu_parent_id`, 
		`menu_name`, 
		`menu_fa`, 
		`menu_class`, 
		`menu_link`, 
		`menu_page_id`, 
		`menu_description`, 
		`menu_image`, 
		`recordListingID`) 
		VALUES (
			$menu_parent_id,
			'$menu_name',
			'$menu_fa',
			'$menu_class',
			'$menu_link',
			'$menu_page_id',
			'$menu_description',
			'',
			0)";
	$cn->selectdb($query);
	$last_id = mysqli_insert_id($cn->getConnection());
	$sql=$cn->selectdb("select * from `tbl_dmenu` where menu_id=".$last_id);
	$row = mysqli_fetch_assoc($sql);
	echo "<script>alert('".$last_id."');</script>";
	$cn->selectdb("update tbl_dmenu set `menu_name`='".$row['menu_name']." (copy)' where menu_id=".$last_id);
	
	header('Location:dmenuView.php');
?>