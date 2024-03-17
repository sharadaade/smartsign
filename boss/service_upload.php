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
				$cat_description=$_POST['description'];
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
				
				$con->insertdb("UPDATE `tbl_service_category` SET cat_name='".$cat_name."',cat_description='".$cat_description."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where cat_id=".$cat_id."");
				}
				else
				{
				
				@unlink("../servicecategory/big_img/". $frontimg2);
			    @unlink("../servicecategory/". $frontimg2);
				$catImage = createImage('frontimg',"../servicecategory/");

				$con->insertdb("UPDATE `tbl_service_category` SET cat_name='".$cat_name."',cat_description='".$cat_description."',cat_image='".$catImage."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where cat_id=".$cat_id."");
				}

			// end of image
			
				
				
	         header("location: serviceCatView.php?page=$page");

	  }
	  
	if(isset($_POST['addProduct']))
	{
	     // print_r($_POST);

			$service_title=$_POST['service_title'];
			$description=$_POST['description'];
			$meta_tag_title=$_POST['meta_tag_title'];
			$meta_tag_description=$_POST['meta_tag_description'];
			$meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
		    $slug=$_POST['slug'];
			
			//single image 
			//----------------------
			$single_image = createImage('frontimg', "../service/");	
			
			$images_name = createMultiImage('image_title', "../serviceF/");	
				
			// end of single image
			//-------------------------
			
		$catID = '';
		//get multiple value of radio (multiple categories)
		foreach ($_POST['mulradio'] as $attributeKey => $attributes){
			// echo $attributeKey.' '.$_POST['mulradio'][$attributeKey].'<br>';
			$catID.= $_POST['mulradio'][$attributeKey].",";
		} //foreach
			
		$con->insertdb("INSERT INTO `tbl_service` (
							`service_title` ,
							`description` ,
							`cat_id`,
							`image_name`,
							
							`meta_tag_title`,
							`meta_tag_description`,
							`meta_tag_keywords`,
							`slug`)
							VALUES (
							'".$service_title."',
							'".$description."', 
							'".$catID."', 
							'".$single_image."',
							 
							'".$meta_tag_title."', 
							'".$meta_tag_description."', 
							'".$meta_tag_keywords."', 
							'".$slug."');");

			/*echo "INSERT INTO `tbl_service` (
				`service_title` ,
				`description` ,
				`cat_id`,
				`image_name`,
				`meta_tag_title`,
				`meta_tag_description`,
				`meta_tag_keywords`,
				`slug`)
				VALUES (
				'".$service_title."',
				'".$description."', 
				'".$catID."', 
				'".$single_image."',
				'".$meta_tag_title."', 
				'".$meta_tag_description."', 
				'".$meta_tag_keywords."', 
				'".$slug."');";*/
					
			
			header("location:serviceView.php");
	}
	   
	   
	if(isset($_POST['addCategory']))
	{
	  
	   
	   		$cat_parent_id=$_POST['cat_parent_id'];
			$page = $_POST['page'];
			$cat_name=$_POST['cat_name'];
			$cat_description=$_POST['description'];
			$meta_tag_title=$_POST['meta_tag_title'];
			$meta_tag_description=$_POST['meta_tag_description'];
			$meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
			
			$slug=$_POST['slug'];
			
			//single image 
			//----------------------
			$catImage = createImage('frontimg', "../servicecategory/");			
				
			// end of single image
			//-------------------------
			
			$con->insertdb("insert into tbl_service_category(cat_parent_id,cat_name,cat_description,cat_image,meta_tag_title, meta_tag_description, meta_tag_keywords,slug) 
			values(".$cat_parent_id.",'".$cat_name."','".$cat_description."','".$catImage."', '".$meta_tag_title."', '".$meta_tag_description."', '".$meta_tag_keywords."', '".$slug."')");
			header("location: serviceCatView.php?page=$page");
	}
	   
	   
	if(isset($_POST['updateProduct']))
	{
			$catID ='';
			$service_id=$_POST['service_id'];
			$service_title=$_POST['service_title'];
			$description=$_POST['description'];
			$meta_tag_title=$_POST['meta_tag_title'];
			$meta_tag_description=$_POST['meta_tag_description'];
			$meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
		    $slug=$_POST['slug'];				  		
			//$cat_id=$_POST['cat_id'];
			
			//get multiple value of radio (multiple categories)
			foreach ($_POST['mulradio'] as $attributeKey => $attributes){
		   //echo $attributeKey.' '.$_POST['mulradio'][$attributeKey].'<br>';
			
				$catID.= $_POST['mulradio'][$attributeKey].",";
			} //foreach
			
			$frontimg2=$_POST['frontimg2'];
			$frontimg1=$_POST['frontimg1'];

			// single image
			if($_FILES["frontimg"]['error'] > 0)// it means no new image selected insert previous one......
				{
				
					$con->insertdb("UPDATE `tbl_service` SET service_title='".$service_title."',description='".$description."',cat_id='".$catID."',image_name='".$frontimg2."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."'  where service_id='".$service_id."'");
					
				}
				else
				{
				
				@unlink("../service/big_img/". $frontimg2);
			    @unlink("../service/". $frontimg2);
				$single_image = createImage('frontimg',"../service/");

				$con->insertdb("UPDATE `tbl_service` SET service_title='".$service_title."',description='".$description."',cat_id='".$catID."',image_name='".$single_image."',meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where service_id='".$service_id."'");
				
				}

				$size_sum = array_sum($_FILES['image_title']['size']);
				if ($size_sum > 0) 
				{
					// at least one file has been uploaded

					$images_name = createMultiImage('image_title', "../serviceF/");	
					$records=$con->selectdb("select * from tbl_service where service_id='".$service_id."'");  
					$row=mysqli_fetch_assoc($records);
					//echo $row[2]."<br>";
					//echo $images; die;
					$final= $row['multi_images'].$images_name;


					$con->insertdb("UPDATE `tbl_service` SET service_title='".$service_title."',description='".$description."',multi_images='".$final."' ,cat_id='".$catID."',meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."',legal_doc='".$frontpdf4."',status='".$status."',number='".$number."',location='".$location."',video_url='".$video_url."' where service_id='".$service_id."'");
				}
				else
				{

					$con->insertdb("UPDATE `tbl_service` SET service_title='".$service_title."',description='".$description."',multi_images='".$frontimg1."',cat_id='".$catID."',meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."',status='".$status."',number='".$number."',location='".$location."',video_url='".$video_url."' where service_id='".$service_id."'");
				}

			// end of image
			header("location:serviceView.php?page=$page");
			
			
	}
	
if(isset($_GET["Image"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_service_category where cat_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../servicecategory/'.$row[4]);
	  unlink('../servicecategory/big_img/'.$row[4]);

	}
	$con->selectdb("update tbl_service_category set cat_image='' where cat_id = '".$id."'");
	header("location: serviceCategory_up.php?category_id=".$id."&page=".$page);



}	

if(isset($_GET["ProImage"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_service where service_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../service/'.$row[1]);
	  unlink('../service/big_img/'.$row[1]);

	}
	$con->selectdb("update tbl_service set image_name='' where service_id = '".$id."'");
	header("location: service_up.php?service_id=".$id."&page=".$page);


}	

?>

<?
if(isset($_REQUEST["btnDeleteImages"]))
{
	$service_id = $_POST['service_id'];
	$page = $_POST['page'];

	$image = $_POST['frontimg1'];
	$image_list = explode(',',$image);
	$new_image_list = '';
	
	if(isset($_REQUEST["imageEdit"]))
	{
		foreach($_REQUEST['imageEdit'] as $row)
		{
			 $image = str_replace($row.',' , '' ,$image);
			 @unlink('../serviceF/big_img/'.$row);
			 @unlink('../serviceF/'.$row);
		}
		
		$con->selectdb("update tbl_service set multi_images='".$image."' where service_id = '".$service_id."'");
		header("location: service_up.php?service_id=".$service_id."&page=".$page);
	}
	else
	{
		echo 'No Image selected';
	}
		
} 
?>