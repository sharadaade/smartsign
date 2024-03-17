
<?
	include("../connect.php");
	$cn=new connect();
    $cn->connectdb();
    $id=$_GET['id'];
    
	$query = "SELECT 
    `blog_id`, 
    `blog_name`, 
    `description`, 
    `cat_id`, 
    `price`, 
    `bdate`, 
    `meta_tag_title`, 
    `meta_tag_description`, 
    `meta_tag_keywords`, 
    `slug` 
    FROM `tbl_blog` WHERE blog_id =$id";

	$result = $cn->selectdb($query);
    $data = mysqli_fetch_assoc($result);
    extract($data);
    
	$query = "INSERT INTO `tbl_blog`(
        `blog_name`, 
        `description`, 
        `cat_id`, 
        `blog_image`, 
        `price`, 
        `bdate`, 
        `recordListingID`, 
        `pdf_file`, 
        `meta_tag_title`, 
        `meta_tag_description`, 
        `meta_tag_keywords`, 
        `multi_images`, 
        `slug`) 
        VALUES (
            '$blog_name',
            '$description',
            '$cat_id',
            '',
            null,
            '$bdate',
            0,
            '',
            '$meta_tag_title',
            '$meta_tag_description',
            '$meta_tag_keywords',
            '',
            '$slug')
            ";
	$cn->selectdb($query);

	$last_id = mysqli_insert_id($cn->getConnection());
	$sql=$cn->selectdb("select * from `tbl_blog` where blog_id=".$last_id);
	$row = mysqli_fetch_assoc($sql);
	// echo "<script>alert('".$last_id."');</script>";
	$cn->selectdb("update tbl_blog set `blog_name`='".$row['blog_name']." (copy)' where blog_id=".$last_id);
	
	header('Location:blogView.php');
?>