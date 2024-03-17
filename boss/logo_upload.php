<?php
include_once("../connect.php");
include_once("imagefunction.php");
include_once("image_lib_rname.php"); 
$con=new connect();
$con->connectdb();

	  if(isset($_POST['editbtn']))
	  {
	   //echo "<br/>";

	  //print_r($_POST);die;
	  			$logo_id=$_POST['logo_id'];
				
				$frontimg2=$_POST['frontimg2'];
				

				
				// single image
			if($_FILES["frontimg"]['error'] > 0)// it means no new image selected insert previous one......
				{
				
				$con->insertdb("UPDATE `tbl_logo` SET image_name='".$frontimg2."' where logo_id=".$logo_id."");

				}
				else
				{
				
			    @unlink("../logo/". $frontimg2);
				@unlink("../logo/big_img/". $frontimg2);

				$Image = createImage('frontimg',"../logo/");

				$con->insertdb("UPDATE `tbl_logo` SET image_name='".$Image."' where logo_id=".$logo_id."");
				}

			// end of image
								
				header("location:logoView.php");	
	  }
	  
	  if(isset($_GET["Image"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_logo where logo_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../logo/'.$row[1]);
	  unlink('../logo/big_img/'.$row[1]);

	}
	$con->selectdb("update tbl_logo set image_name='' where logo_id = '".$id."'");
	header("location: logo_edit.php?logo_id=".$id."&page=".$page);



}	

	  
 
?>