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
				
				$con->insertdb("UPDATE `tbl_gallery_category` SET cat_name='".$cat_name."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where cat_id=".$cat_id."");
				}
				else
				{
				
				@unlink("../gallerycategory/big_img/". $frontimg2);
			    @unlink("../gallerycategory/". $frontimg2);
				$catImage = createImage('frontimg',"../gallerycategory/");

				$con->insertdb("UPDATE `tbl_gallery_category` SET cat_name='".$cat_name."',cat_image='".$catImage."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where cat_id=".$cat_id."");
				}

			// end of image
			
				
				
	         header("location: galleryCatView.php?page=$page");

	  }
	  
	  if(isset($_POST['addProduct']))
	  {
	     // print_r($_POST);

			$gallery_name=$_POST['gallery_name'];
			$description=$_POST['description'];
			$meta_tag_title=$_POST['meta_tag_title'];
			$meta_tag_description=$_POST['meta_tag_description'];
			$meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
		    $slug=$_POST['slug'];
			
			//single image 
			//----------------------
			$single_image = createImage('frontimg', "../gallery/");			
				
			// end of single image
			//-------------------------
			
			//-----------------------------
			//pdf
			//-----------------------------
			
			//$pdf_file = createPDF('download_file', "../download_pdf/");			
			
			//--------------------		
			//end of pdf
			//--------------------
	
			//-------------------
			// Multiple images
			//-------------------
			$images_name = createMultiImage('image_title', "../galleryF/");			
			
			//-------------------
			// end of Multiple images
			//-------------------
			
	
		$catID = '';
		//get multiple value of radio (multiple categories)
		foreach ($_POST['mulradio'] as $attributeKey => $attributes){
	   // echo $attributeKey.' '.$_POST['mulradio'][$attributeKey].'<br>';
		
		$catID.= $_POST['mulradio'][$attributeKey].",";
			} //foreach
			
		$con->insertdb("INSERT INTO `tbl_gallery` (
							`gallery_name` ,
							`description` ,
							`cat_id`,
							`gallery_image`,
							`meta_tag_title`,
							`meta_tag_description`,
							`meta_tag_keywords`,
							`multi_images`,
							`slug`
							
							)
							VALUES (
							'".$gallery_name."','".$description."',  '".$catID."', '".$single_image."', '".$meta_tag_title."', '".$meta_tag_description."', '".$meta_tag_keywords."', '".$images_name."', '".$slug."');");
					
			
			header("location:galleryView.php");
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
			$catImage = createImage('frontimg', "../gallerycategory/");			
				
			// end of single image
			//-------------------------
			
			$con->insertdb("insert into tbl_gallery_category(cat_parent_id,cat_name,cat_image,meta_tag_title, meta_tag_description, meta_tag_keywords,slug) 
			values(".$cat_parent_id.",'".$cat_name."','".$catImage."', '".$meta_tag_title."', '".$meta_tag_description."', '".$meta_tag_keywords."', '".$slug."')");
			header("location: galleryCatView.php?page=$page");
	   }
	   
	   
	    if(isset($_POST['updateProduct']))
	  {
	   
			$catID ='';
			$gallery_id=$_POST['gallery_id'];
   			$gallery_name=$_POST['gallery_name'];
			$slug=$_POST['slug'];
			$description=$_POST['description'];
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
			
			$frontimg2=$_POST['frontimg2'];
		    $frontimg1=$_POST['frontimg1'];

		    //$frontimgpdf2=$_POST['frontimgpdf2'];
	
			// single image
			if($_FILES["frontimg"]['error'] > 0)// it means no new image selected insert previous one......
				{
				
					$con->insertdb("UPDATE `tbl_gallery` SET gallery_name='".$gallery_name."',description='".$description."',cat_id='".$catID."',gallery_image='".$frontimg2."',multi_images='".$frontimg1."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."'  where gallery_id='".$gallery_id."'");
				}
				else
				{
				
				@unlink("../gallery/big_img/". $frontimg2);
			    @unlink("../gallery/". $frontimg2);
				$single_image = createImage('frontimg',"../gallery/");

				$con->insertdb("UPDATE `tbl_gallery` SET gallery_name='".$gallery_name."',description='".$description."',cat_id='".$catID."',gallery_image='".$single_image."',multi_images='".$frontimg1."' ,meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where gallery_id='".$gallery_id."'");
				}

			// end of image
			
			
			
			//------------------------
			//multiple images
			//------------------------
			
			$size_sum = array_sum($_FILES['image_title']['size']);
			if ($size_sum > 0) 
			{
			 // at least one file has been uploaded
				
				$images_name = createMultiImage('image_title', "../galleryF/");	
				$records=$con->selectdb("select * from tbl_gallery where gallery_id='".$gallery_id."'");
				 $row=mysqli_fetch_assoc($records);
				//echo $row[2]."<br>";
				//echo $images; die;
			 	$final= $row['multi_images'].$images_name;
					

				$con->insertdb("UPDATE `tbl_gallery` SET gallery_name='".$gallery_name."',description='".$description."',cat_id='".$catID."',multi_images='".$final."' ,meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where gallery_id='".$gallery_id."'");
					
				}
				else
				{
				$con->insertdb("UPDATE `tbl_gallery` SET gallery_name='".$gallery_name."',description='".$description."',cat_id='".$catID."',multi_images='".$frontimg1."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."'  where gallery_id='".$gallery_id."'");	
			    }

			//-----------------				
			//end of multiple images
			//--------------------
			
			header("location:galleryView.php?page=$page");
			
			
	   }
	
if(isset($_GET["Image"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_gallery_category where cat_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../gallerycategory/'.$row[4]);
	  unlink('../gallerycategory/big_img/'.$row[4]);

	}
	$con->selectdb("update tbl_gallery_category set cat_image='' where cat_id = '".$id."'");
	header("location: gallery_category_up.php?category_id=".$id."&page=".$page);



}	

if(isset($_GET["ProImage"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_gallery where gallery_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../gallery/'.$row[4]);
	  unlink('../gallery/big_img/'.$row[4]);

	}
	$con->selectdb("update tbl_gallery set gallery_image='' where gallery_id = '".$id."'");
	header("location: gallery_up.php?gallery_id=".$id."&page=".$page);


}	

//multiple images	
 if(isset($_REQUEST["btnDeleteImages"]))
{
	$gallery_id = $_POST['gallery_id'];
	$page = $_POST['page'];

	$image = $_POST['frontimg1'];
	$image_list = explode(',',$image);
	$new_image_list = '';
	
	if(isset($_REQUEST["imageEdit"]))
	{
		foreach($_REQUEST['imageEdit'] as $row)
		{
			 $image = str_replace($row.',' , '' ,$image);
			 @unlink('../galleryF/big_img/'.$row);
			 @unlink('../galleryF/'.$row);
		}
		
		$con->selectdb("update tbl_gallery set multi_images='".$image."' where gallery_id = '".$gallery_id."'");
		header("location: gallery_up.php?gallery_id=".$gallery_id."&page=".$page);
	}
	else
	{
		echo 'No Image selected';
	}
		
} 
?>