
<?
	include("../connect.php");
	$cn=new connect();
$cn->connectdb();
	$id=$_GET['id'];

	$query = "SELECT * FROM `tbl_download` WHERE download_id =$id";

	$result = $cn->selectdb($query);
    $data = mysqli_fetch_assoc($result);
    extract($data);
	
	$query = "INSERT INTO `tbl_download`(
		`download_name`, 
		`description`, 
		`cat_id`, 
		`download_image`, 
		`recordListingID`, 
		`pdf_file`, 
		`meta_tag_title`, 
		`meta_tag_description`, 
		`meta_tag_keywords`, 
		`slug`) 
        VALUES (
            '$download_name',
            '$description',
            '$cat_id',
            '',
            0,
            '',
            '$meta_tag_title',
            '$meta_tag_description',
            '$meta_tag_keywords',
            '$slug')";
	$cn->selectdb($query);

	$last_id = mysqli_insert_id($cn->getConnection());
	$sql=$cn->selectdb("SELECT * FROM `tbl_download` where download_id=".$last_id);
	$row = mysqli_fetch_assoc($sql);
	//echo "<script>alert('".$last_id."');</script>";
	$cn->selectdb("update tbl_download set `download_name`='".$row['download_name']." (copy)' where download_id=".$last_id);
	
	header('Location:downloadView.php');
?>