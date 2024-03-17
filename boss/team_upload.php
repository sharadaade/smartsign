<?php
include_once("../connect.php");
include_once("image_lib_rname.php"); 

$con=new connect();
$con->connectdb();
$link_url="../".$con->setdomain();
 date_default_timezone_set("Asia/Kolkata");
 
	  
  $parseurl=parse_url($_SERVER['HTTP_REFERER']);
  //echo "<br/>";
 // echo $parseurl['path'];die;

	  if(isset($_POST['updateCategory']))
	  {
	  			$cat_id=$_POST['cat_id'];
				$cat_name=$_POST['cat_name'];
				$page = $_POST['page'];
				$meta_tag_title=$_POST['meta_tag_title'];
				$meta_tag_description=$_POST['meta_tag_description'];
				$meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
			
									
				
                
				$slug=$_POST['slug'];
				$frontimg2=$_POST['frontimg2'];
				//if($frontimg2
				
				// single image
			if($_FILES["frontimg"]['error'] > 0)// it means no new image selected insert previous one......
				{
				
				$con->insertdb("UPDATE `tbl_teamcategory` SET cat_name='".$cat_name."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where cat_id=".$cat_id."");
				}
				else
				{
				
				@unlink("../teamcategory/big_img/". $frontimg2);
			    @unlink("../teamcategory/". $frontimg2);
				$catImage = createImage('frontimg',"../teamcategory/");

				$con->insertdb("UPDATE `tbl_teamcategory` SET cat_name='".$cat_name."',cat_image='".$catImage."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where cat_id=".$cat_id."");
				}

			// end of image
			
				
				
	         header("location: teamCatView.php?page=$page");

	  }
	  
	  if(isset($_POST['addProduct']))
	  {
	     // print_r($_POST);

			$team_name=$_POST['team_name'];
			$description=$_POST['description'];
			$meta_tag_title=$_POST['meta_tag_title'];
			$meta_tag_description=$_POST['meta_tag_description'];
			$meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
		    $slug=$_POST['slug'];
		    $team_video=$_POST['team_video'];
			// $tags=$_POST['tags'];
			
			//single image 
			//----------------------
			$single_image = createImage('frontimg', "../team/");			
				
			// end of single image
			//-------------------------
			
			//-----------------------------
			//pdf
			//-----------------------------
			
			$pdf_file = createPDF('download_file', "../download_pdf/");			
			
			//--------------------		
			//end of pdf
			//--------------------
	
			//-------------------
			// Multiple images
			//-------------------
			$images_name = createMultiImage('image_title', "../teamF/");			
			
			//-------------------
			// end of Multiple images
			//-------------------
			
			//----------------------------
			//display on home page or not
			if (isset($_POST['home_page'])) {
				$home_page=1;
			}
			else
			{
				$home_page=0;
			}
	
		$catID = '';
		if(isset($_POST['mulradio']))
		{
			//get multiple value of radio (multiple categories)
			foreach ($_POST['mulradio'] as $attributeKey => $attributes){
				// echo $attributeKey.' '.$_POST['mulradio'][$attributeKey].'<br>';
				$catID.= $_POST['mulradio'][$attributeKey].",";
			} //foreach
		}
			
		$con->insertdb("INSERT INTO `tbl_team` (
							`team_name` ,
							`description` ,
							`cat_id`,
							`team_image`,
							`pdf_file`,
							`team_video`,
							`bdate`,
							`meta_tag_title`,
							`meta_tag_description`,
							`meta_tag_keywords`,
							`multi_images`,
							`slug`
							
							)
							VALUES (
							'".$team_name."',
							'".$description."', 
							'".$catID."', 
							'".$single_image."',
							'".$pdf_file."', 
							'".$team_video."',
							'".date('Y-m-d H:i:s')."', 
							'".$meta_tag_title."', 
							'".$meta_tag_description."', 
							'".$meta_tag_keywords."', 
							'".$images_name."',
							'".$slug."');");

							
			header("location:teamView.php");
			}
	   
	   
	   if(isset($_POST['addCategory']))
	  {
	  
	   
	   		$cat_parent_id=$_POST['cat_parent_id'];
			$page = $_POST['page'];
			$cat_name=$_POST['cat_name'];
			$meta_tag_title=$_POST['meta_tag_title'];
			$meta_tag_description=$_POST['meta_tag_description'];
			$meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
			
			$slug=$_POST['slug'];
			
			//single image 
			//----------------------
			$catImage = createImage('frontimg', "../teamcategory/");			
				
			// end of single image
			//-------------------------
			
			$con->insertdb("insert into tbl_teamcategory(cat_parent_id,cat_name,cat_image,meta_tag_title, meta_tag_description, meta_tag_keywords,slug) 
			values(".$cat_parent_id.",'".$cat_name."','".$catImage."', '".$meta_tag_title."', '".$meta_tag_description."', '".$meta_tag_keywords."', '".$slug."')");
			header("location: teamCatView.php?page=$page");
	   }
	   
	   
	    if(isset($_POST['updateProduct']))
	  {
	   
			$catID ='';
			$team_id=$_POST['team_id'];
   			$team_name=$_POST['team_name'];
			$slug=$_POST['slug'];
			$description=$_POST['description'];
			$page = $_POST['page'];
			$team_video = $_POST['team_video'];
			$meta_tag_title=$_POST['meta_tag_title'];
			$meta_tag_description=$_POST['meta_tag_description'];
			$meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
			//$cat_id=$_POST['cat_id'];
			// $tags=$_POST['tags'];
			// if (isset($_POST['home_page'])) {
			// 	$home_page=1;
			// }
			// else
			// {
			// 	$home_page=0;
			// }
			
			//get multiple value of radio (multiple categories)
			foreach ($_POST['mulradio'] as $attributeKey => $attributes){
		   //echo $attributeKey.' '.$_POST['mulradio'][$attributeKey].'<br>';
			
				$catID.= $_POST['mulradio'][$attributeKey].",";
			} //foreach
			
			$frontimg2=$_POST['frontimg2'];
			$frontimg1=$_POST['frontimg1'];
		    $frontimgpdf2=$_POST['frontimgpdf2'];
	
			// single image
			if($_FILES["frontimg"]['error'] > 0)// it means no new image selected insert previous one......
				{
				
					$con->insertdb("UPDATE `tbl_team` SET team_name='".$team_name."',description='".$description."',cat_id='".$catID."',team_image='".$frontimg2."',multi_images='".$frontimg1."',team_video='".$team_video."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."'  where team_id='".$team_id."'");
				}
				else
				{
				
				@unlink("../team/big_img/". $frontimg2);
			    @unlink("../team/". $frontimg2);
				$single_image = createImage('frontimg',"../team/");

				$con->insertdb("UPDATE `tbl_team` SET team_name='".$team_name."',description='".$description."',cat_id='".$catID."',team_image='".$single_image."' ,multi_images='".$frontimg1."',team_video='".$team_video."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where team_id='".$team_id."'");
				}

			// end of image
			
			//------------------------
			//pdf
			//------------------------
			
			if($_FILES["download_file"]["name"]=="")
				{
				
					$con->insertdb("UPDATE `tbl_team` SET team_name='".$team_name."',description='".$description."',cat_id='".$catID."', team_video='".$team_video."',meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."'  where team_id='".$team_id."'");
				}
				else
				{
				
				@unlink("../download_pdf/". $frontimgpdf2);

				$pdf_file = createPDF('download_file',"../download_pdf/");

				$con->insertdb("UPDATE `tbl_team` SET team_name='".$team_name."',description='".$description."',cat_id='".$catID."',pdf_file='".$pdf_file."' ,team_video='".$team_video."' ,meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where team_id='".$team_id."'");
				}
			 		
			//-----------------				
			//end of pdf
			//--------------------
			
			
			//------------------------
			//multiple images
			//------------------------
			$size_sum = array_sum($_FILES['image_title']['size']);
			if ($size_sum > 0) {
			 // at least one file has been uploaded
			
			 $images_name = createMultiImage('image_title', "../teamF/");	
			 
			 $records=$con->selectdb("select * from tbl_team where team_id='".$team_id."'");
			 $row=mysqli_fetch_row($records);
			//echo $row[2]."<br>";
			//echo $images; die;
			 $final= $row[13].$images_name;
					

				$con->insertdb("UPDATE `tbl_team` SET team_name='".$team_name."',description='".$description."',cat_id='".$catID."',multi_images='".$final."' , team_video='".$team_video."',meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where team_id='".$team_id."'");
				
			} else {
			 // no file has been uploaded
			 $con->insertdb("UPDATE `tbl_team` SET team_name='".$team_name."',description='".$description."',cat_id='".$catID."',multi_images='".$frontimg1."', team_video='".$team_video."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."'  where team_id='".$team_id."'");	
				
			}
			
			//-----------------				
			//end of multiple images
			//--------------------
			
			header("location:teamView.php?page=$page");
			
			
	   }
	
if(isset($_GET["Image"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_teamcategory where cat_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../teamcategory/'.$row[4]);
	  unlink('../teamcategory/big_img/'.$row[4]);

	}
	$con->selectdb("update tbl_teamcategory set cat_image='' where cat_id = '".$id."'");
	header("location: teamcategory_up.php?category_id=".$id."&page=".$page);



}	

if(isset($_GET["ProImage"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_team where team_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../team/'.$row[4]);
	  unlink('../team/big_img/'.$row[4]);

	}
	$con->selectdb("update tbl_team set team_image='' where team_id = '".$id."'");
	header("location: team_up.php?team_id=".$id."&page=".$page);


}	

//multiple images	
 if(isset($_REQUEST["btnDeleteImages"]))
{
	$team_id = $_POST['team_id'];
	$page = $_POST['page'];

	$image = $_POST['frontimg1'];
	$image_list = explode(',',$image);
	$new_image_list = '';
	
	if(isset($_REQUEST["imageEdit"]))
	{
		foreach($_REQUEST['imageEdit'] as $row)
		{
			 $image = str_replace($row.',' , '' ,$image);
			 @unlink('../teamF/big_img/'.$row);
			 @unlink('../teamF/'.$row);
		}
		echo $image;
		$con->selectdb("update tbl_team set multi_images='".$image."' where team_id = '".$team_id."'");
		header("location: team_up.php?team_id=".$team_id."&page=".$page);
	}
	else
	{
		echo 'No Image selected';
	}
		
} 


if(isset($_GET["btnDeletepdf"]))
	{
		//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_team where team_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
		unlink('../download_pdf/'.$row[8]);
	}
	$con->selectdb("update tbl_team set pdf_file='' where team_id = '".$id."'");
	header("location: team_up.php?team_id=".$id."&page=".$page);
}	
?>