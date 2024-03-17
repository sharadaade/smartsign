<?php
include_once("../connect.php");
$cn=new connect();
$cn->connectdb();


if($_GET['Del']== 'del')
{
$id=  $_GET['id'];
$page= $_GET['page'];

    $sql=  $cn->selectdb("select * from tbl_testimonial where testimonial_id=$id");
    while($row = mysqli_fetch_assoc($sql))
    {
        //image
        @unlink('../testimonial/big_img/'.$row['image_name']);
        @unlink('../testimonial/'.$row['image_name']);
        
    }
    $cn->selectdb("DELETE FROM `tbl_testimonial` where `testimonial_id`=".$id);
	//$cn->Deletedata($tablename,$primarykey,$id);
	header("location:testimonialView.php?page=$page");	
}
