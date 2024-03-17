<?php
include_once("../connect.php");
include_once("image_lib_rname.php"); 
$con=new connect();
$con->connectdb();

 
 
	  
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
				
				$con->insertdb("UPDATE `tbl_video_category` SET cat_name='".$cat_name."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where cat_id=".$cat_id."");
				}
				else
				{
				
				@unlink("../videocategory/big_img/". $frontimg2);
			    @unlink("../videocategory/". $frontimg2);
				$catImage = createImage('frontimg',"../videocategory/");

				$con->insertdb("UPDATE `tbl_video_category` SET cat_name='".$cat_name."',cat_image='".$catImage."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where cat_id=".$cat_id."");
				}

			// end of image
			
				
				
	         header("location: videoCatView.php?page=$page");

	  }
	  
	  if(isset($_POST['addProduct']))
	  {
	     // print_r($_POST);

			$video_name=$_POST['video_name'];
			$description=$_POST['description'];
			$meta_tag_title=$_POST['meta_tag_title'];
			$meta_tag_description=$_POST['meta_tag_description'];
			$meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
		    $slug=$_POST['slug'];
		    $video_url=$_POST['video_url'];

			
			
	
		$catID = '';
		//get multiple value of radio (multiple categories)
		foreach ($_POST['mulradio'] as $attributeKey => $attributes){
	   // echo $attributeKey.' '.$_POST['mulradio'][$attributeKey].'<br>';
		
		$catID.= $_POST['mulradio'][$attributeKey].",";
			} //foreach
			
		$con->insertdb("INSERT INTO `tbl_video` (
							`video_name` ,
							`description` ,
							`cat_id`,
							`meta_tag_title`,
							`meta_tag_description`,
							`meta_tag_keywords`,
							`slug`,
							`video_url`
							
							)
							VALUES (
							'".$video_name."','".$description."',  '".$catID."', '".$meta_tag_title."', '".$meta_tag_description."', '".$meta_tag_keywords."', '".$slug."', '".$video_url."');");
					
			
			header("location:videoView.php");
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
			$catImage = createImage('frontimg', "../videocategory/");			
				
			// end of single image
			//-------------------------
			
			$con->insertdb("insert into tbl_video_category(cat_parent_id,cat_name,cat_image,meta_tag_title, meta_tag_description, meta_tag_keywords,slug) 
			values(".$cat_parent_id.",'".$cat_name."','".$catImage."', '".$meta_tag_title."', '".$meta_tag_description."', '".$meta_tag_keywords."', '".$slug."')");
			header("location: videoCatView.php?page=$page");
	   }
	   
	   
	    if(isset($_POST['updateProduct']))
	  {
	   
			$catID ='';
			$video_id=$_POST['video_id'];
   			$video_name=$_POST['video_name'];
			$slug=$_POST['slug'];
			$description=$_POST['description'];
			$video_url=$_POST['video_url'];

			$page = $_POST['page'];
			$meta_tag_title=$_POST['meta_tag_title'];
			$meta_tag_description=$_POST['meta_tag_description'];
			$meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
			//$cat_id=$_POST['cat_id'];
			
			//get multiple value of radio (multiple categories)
			foreach ($_POST['mulradio'] as $attributeKey => $attributes){
		   //echo $attributeKey.' '.$_POST['mulradio'][$attributeKey].'<br>';
			
				$catID.= $_POST['mulradio'][$attributeKey].",";
			} //foreach
			
			
				
			$con->insertdb("UPDATE `tbl_video` SET video_name='".$video_name."',description='".$description."',video_url='".$video_url."',cat_id='".$catID."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."'  where video_id='".$video_id."'");
			
			
			header("location:videoView.php?page=$page");
			
			
	   }
	
if(isset($_GET["Image"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_video_category where cat_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../videocategory/'.$row[4]);
	  unlink('../videocategory/big_img/'.$row[4]);

	}
	$con->selectdb("update tbl_video_category set cat_image='' where cat_id = '".$id."'");
	header("location: video_category_up.php?category_id=".$id."&page=".$page);



}	

?>