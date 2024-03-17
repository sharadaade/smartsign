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
				
				$con->insertdb("UPDATE `tbl_blogcategory` SET cat_name='".$cat_name."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where cat_id=".$cat_id."");
				}
				else
				{
				
				@unlink("../blogcategory/big_img/". $frontimg2);
			    @unlink("../blogcategory/". $frontimg2);
				$catImage = createImage('frontimg',"../blogcategory/");

				$con->insertdb("UPDATE `tbl_blogcategory` SET cat_name='".$cat_name."',cat_image='".$catImage."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where cat_id=".$cat_id."");
				}

			// end of image
			
				
				
	         header("location: blogCatView.php?page=$page");

	  }
	  
	  if(isset($_POST['addProduct']))
	  {
	     // print_r($_POST);

			$blog_name=$_POST['blog_name'];
			$description=$_POST['description'];
			$meta_tag_title=$_POST['meta_tag_title'];
			$meta_tag_description=$_POST['meta_tag_description'];
			$meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
		    $slug=$_POST['slug'];
		    $blog_video=$_POST['blog_video'];
			// $tags=$_POST['tags'];
			
			//single image 
			//----------------------
			$single_image = createImage('frontimg', "../blog/");			
				
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
			$images_name = createMultiImage('image_title', "../blogF/");			
			
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
			
		$con->insertdb("INSERT INTO `tbl_blog` (
							`blog_name` ,
							`description` ,
							`cat_id`,
							`blog_image`,
							`pdf_file`,
							`blog_video`,
							`bdate`,
							`meta_tag_title`,
							`meta_tag_description`,
							`meta_tag_keywords`,
							`multi_images`,
							`slug`
							
							)
							VALUES (
							'".$blog_name."',
							'".$description."', 
							'".$catID."', 
							'".$single_image."',
							'".$pdf_file."', 
							'".$blog_video."',
							'".date('Y-m-d H:i:s')."', 
							'".$meta_tag_title."', 
							'".$meta_tag_description."', 
							'".$meta_tag_keywords."', 
							'".$images_name."',
							'".$slug."');");
							$to="";
							
							
							$contact=$con->selectdb("SELECT * FROM tbl_contact WHERE `con_id`=1");
							while($row_contact = mysqli_fetch_array($contact))
							{
									$from	= $row_contact['email'];
							}
							
							
							$sql=  $con->selectdb("select * from tbl_newsletter_emails ");
							while($row = mysqli_fetch_assoc($sql))
							{
								$to.=", ".$row['email'];
							}
							$to=trim($to,",");
							$subject = "New Blog Available : Wellness";
							$message = file_get_contents("mail.html");
							
							//adding value to mail
							
							$new_message=str_replace("src='images/img-01.jpg'","src='".$link_url."blog/big_img/".$single_image."'",$message);
							$new_message=str_replace("title_here",$blog_name,$new_message);
							$new_message=str_replace("desc_here",$description,$new_message);
							$new_message=str_replace("link_here",$link_url."Blogdetail/".$slug."/",$new_message);
							
							
							$header = "From: ".$from."\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";
							$header.= "bcc: ".$to."\r\n";
							$subject = "New blog posted on wellness : " .$blog_name;
							$to="";
							mail($to, $subject, $new_message , $header);				
							echo $new_message;
							echo "<script>alert('Message Sent');</script>";
							
			header("location:blogView.php");
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
			$catImage = createImage('frontimg', "../blogcategory/");			
				
			// end of single image
			//-------------------------
			
			$con->insertdb("insert into tbl_blogcategory(cat_parent_id,cat_name,cat_image,meta_tag_title, meta_tag_description, meta_tag_keywords,slug) 
			values(".$cat_parent_id.",'".$cat_name."','".$catImage."', '".$meta_tag_title."', '".$meta_tag_description."', '".$meta_tag_keywords."', '".$slug."')");
			header("location: blogCatView.php?page=$page");
	   }
	   
	   
	    if(isset($_POST['updateProduct']))
	  {
	   
			$catID ='';
			$blog_id=$_POST['blog_id'];
   			$blog_name=$_POST['blog_name'];
			$slug=$_POST['slug'];
			$description=$_POST['description'];
			$page = $_POST['page'];
			$blog_video = $_POST['blog_video'];
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
				
					$con->insertdb("UPDATE `tbl_blog` SET blog_name='".$blog_name."',description='".$description."',cat_id='".$catID."',blog_image='".$frontimg2."',multi_images='".$frontimg1."',blog_video='".$blog_video."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."'  where blog_id='".$blog_id."'");
				}
				else
				{
				
				@unlink("../blog/big_img/". $frontimg2);
			    @unlink("../blog/". $frontimg2);
				$single_image = createImage('frontimg',"../blog/");

				$con->insertdb("UPDATE `tbl_blog` SET blog_name='".$blog_name."',description='".$description."',cat_id='".$catID."',blog_image='".$single_image."' ,multi_images='".$frontimg1."',blog_video='".$blog_video."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where blog_id='".$blog_id."'");
				}

			// end of image
			
			//------------------------
			//pdf
			//------------------------
			
			if($_FILES["download_file"]["name"]=="")
				{
				
					$con->insertdb("UPDATE `tbl_blog` SET blog_name='".$blog_name."',description='".$description."',cat_id='".$catID."', blog_video='".$blog_video."',meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."'  where blog_id='".$blog_id."'");
				}
				else
				{
				
				@unlink("../download_pdf/". $frontimgpdf2);

				$pdf_file = createPDF('download_file',"../download_pdf/");

				$con->insertdb("UPDATE `tbl_blog` SET blog_name='".$blog_name."',description='".$description."',cat_id='".$catID."',pdf_file='".$pdf_file."' ,blog_video='".$blog_video."' ,meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where blog_id='".$blog_id."'");
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
			
			 $images_name = createMultiImage('image_title', "../blogF/");	
			 
			 $records=$con->selectdb("select * from tbl_blog where blog_id='".$blog_id."'");
			 $row=mysqli_fetch_row($records);
			//echo $row[2]."<br>";
			//echo $images; die;
			 $final= $row[13].$images_name;
					

				$con->insertdb("UPDATE `tbl_blog` SET blog_name='".$blog_name."',description='".$description."',cat_id='".$catID."',multi_images='".$final."' , blog_video='".$blog_video."',meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where blog_id='".$blog_id."'");
				
			} else {
			 // no file has been uploaded
			 $con->insertdb("UPDATE `tbl_blog` SET blog_name='".$blog_name."',description='".$description."',cat_id='".$catID."',multi_images='".$frontimg1."', blog_video='".$blog_video."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."'  where blog_id='".$blog_id."'");	
				
			}
			
			//-----------------				
			//end of multiple images
			//--------------------
			
			header("location:blogView.php?page=$page");
			
			
	   }
	
if(isset($_GET["Image"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_blogcategory where cat_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../blogcategory/'.$row[4]);
	  unlink('../blogcategory/big_img/'.$row[4]);

	}
	$con->selectdb("update tbl_blogcategory set cat_image='' where cat_id = '".$id."'");
	header("location: blogcategory_up.php?category_id=".$id."&page=".$page);



}	

if(isset($_GET["ProImage"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_blog where blog_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../blog/'.$row[4]);
	  unlink('../blog/big_img/'.$row[4]);

	}
	$con->selectdb("update tbl_blog set blog_image='' where blog_id = '".$id."'");
	header("location: blog_up.php?blog_id=".$id."&page=".$page);


}	

//multiple images	
 if(isset($_REQUEST["btnDeleteImages"]))
{
	$blog_id = $_POST['blog_id'];
	$page = $_POST['page'];

	$image = $_POST['frontimg1'];
	$image_list = explode(',',$image);
	$new_image_list = '';
	
	if(isset($_REQUEST["imageEdit"]))
	{
		foreach($_REQUEST['imageEdit'] as $row)
		{
			 $image = str_replace($row.',' , '' ,$image);
			 @unlink('../blogF/big_img/'.$row);
			 @unlink('../blogF/'.$row);
		}
		echo $image;
		$con->selectdb("update tbl_blog set multi_images='".$image."' where blog_id = '".$blog_id."'");
		header("location: blog_up.php?blog_id=".$blog_id."&page=".$page);
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
	$records=$con->selectdb("SELECT * FROM tbl_blog where blog_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
		unlink('../download_pdf/'.$row[8]);
	}
	$con->selectdb("update tbl_blog set pdf_file='' where blog_id = '".$id."'");
	header("location: blog_up.php?blog_id=".$id."&page=".$page);
}	
?>