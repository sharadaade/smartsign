
<?
	include("../connect.php");
	$cn=new connect();
$cn->connectdb();
	$id=$_GET['id'];
	$cn->selectdb("INSERT INTO tbl_submenu ( menu_id,submenu_name,submenu_fa,submenu_class,submenu_link,submenu_page_id)SELECT   menu_id,submenu_name,submenu_fa,submenu_class,submenu_link,submenu_page_id from tbl_submenu WHERE submenu_id =".$id);
	$last_id = mysqli_insert_id($cn->getConnection());
	$sql=$cn->selectdb("select * from `tbl_submenu` where submenu_id=".$last_id);
	$row = mysqli_fetch_assoc($sql);
	//echo "<script>alert('".$last_id."');</script>";
	$cn->selectdb("update tbl_submenu set `submenu_name`='".$row['submenu_name']." (copy)' where submenu_id=".$last_id);
	
	header('Location:submenuView.php');
?>