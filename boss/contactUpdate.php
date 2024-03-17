<?php
include_once("../connect.php");
include_once("imagefunction.php");
include_once("../navigationfun.php");
include_once("../sitemap.php");
$con=new connect();
$con->connectdb();

if(isset($_POST['add']))
{
	$name = $_POST['oname'];
  	$maptag=$_POST['maptag'];
	$contact_desc=$_POST['contact_desc'];
	$email=$_POST['email'];
    $contact_no=$_POST['contact_no'];
	$opening_hours=$_POST['opening_hours'];
	$meta_tag_title=$_POST['meta_tag_title'];
	$meta_tag_description=$_POST['meta_tag_description'];
	$meta_tag_keywords=$_POST['meta_tag_keywords'];

	
	$con->insertdb("insert into tbl_contact values(NULL,'".$maptag."','".$contact_desc."','".$email."','".$contact_no."','".$opening_hours."','".$meta_tag_title."','".$meta_tag_description."','".$meta_tag_keywords."','".$name."')");

 		header("location:contactView.php");
}

if(isset($_POST['update']))
{
	$name = $_POST['oname'];
  	$page=  $_POST['page'];
	$con_id=  $_POST['con_id'];
	$maptag=$_POST['maptag'];
	$email=$_POST['email'];
    $contact_no=$_POST['contact_no'];
	$opening_hours=$_POST['opening_hours'];

	$contact_desc=$_POST['contact_desc'];
	
	$meta_tag_title=$_POST['meta_tag_title'];
	$meta_tag_description=$_POST['meta_tag_description'];
	$meta_tag_keywords=$_POST['meta_tag_keywords'];
	
	//echo "update tbl_contact set maptag='".$maptag."',contact_desc='".$contact_desc."' where con_id='".$con_id."' ";die;
	$con->insertdb("update tbl_contact set maptag='".$maptag."',contact_desc='".$contact_desc."',email='".$email."',contact_no='".$contact_no."',opening_hours='".$opening_hours."',meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',office_name='".$name."' where con_id='".$con_id."' ");

 		header("location:contactView.php?page=$page");
}

//Delete
if($_GET['Del']=='del')
{
$con_id = $_GET['id'];

 // finally remove the record from database;
    $sql = "DELETE FROM tbl_contact  WHERE con_id = $con_id";
    dbQuery($sql);
    $page = $_GET['page'];
    header("location: contactView.php?page=$page");

}

?>