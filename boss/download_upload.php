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
				
				$con->insertdb("UPDATE `tbl_downloadcategory` SET cat_name='".$cat_name."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where cat_id=".$cat_id."");
				}
				else
				{
				
				@unlink("../downloadcategory/big_img/". $frontimg2);
			    @unlink("../downloadcategory/". $frontimg2);
				$catImage = createImage('frontimg',"../downloadcategory/");

				$con->insertdb("UPDATE `tbl_downloadcategory` SET cat_name='".$cat_name."',cat_image='".$catImage."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where cat_id=".$cat_id."");
				}

			// end of image
			
				
				
	         header("location: downloadCatView.php?page=$page");

	  }
	  
	  if(isset($_POST['addProduct']))
	  {
	     // print_r($_POST);

			$download_name=$_POST['download_name'];
			$description=$_POST['description'];
			$meta_tag_title=$_POST['meta_tag_title'];
			$meta_tag_description=$_POST['meta_tag_description'];
			$meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
		    $slug=$_POST['slug'];
			
			//single image 
			//----------------------
			$single_image = createImage('frontimg', "../download/");			
				
			// end of single image
			//-------------------------
			
			//-----------------------------
			//pdf
			//-----------------------------
			
			$pdf_file = createPDF('download_file', "../download_pdf/");
			
			//--------------------		
			//end of pdf
			//--------------------
	
			
		$catID = '';
		//get multiple value of radio (multiple categories)
		foreach ($_POST['mulradio'] as $attributeKey => $attributes){
	   // echo $attributeKey.' '.$_POST['mulradio'][$attributeKey].'<br>';
		
		$catID.= $_POST['mulradio'][$attributeKey].",";
			} //foreach
			
		$con->insertdb("INSERT INTO `tbl_download` (
							`download_name` ,
							`description` ,
							`cat_id`,
							`download_image`,
							`pdf_file`,
							`meta_tag_title`,
							`meta_tag_description`,
							`meta_tag_keywords`,
							
							`slug`
							
							)
							VALUES (
							'".$download_name."','".$description."',  '".$catID."', '".$single_image."', '".$pdf_file."', '".$meta_tag_title."', '".$meta_tag_description."', '".$meta_tag_keywords."', '".$slug."');");
					
			
			header("location:downloadView.php");
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
			$catImage = createImage('frontimg', "../downloadcategory/");			
				
			// end of single image
			//-------------------------
			
			$con->insertdb("insert into tbl_downloadcategory(cat_parent_id,cat_name,cat_image,meta_tag_title, meta_tag_description, meta_tag_keywords,slug) 
			values(".$cat_parent_id.",'".$cat_name."','".$catImage."', '".$meta_tag_title."', '".$meta_tag_description."', '".$meta_tag_keywords."', '".$slug."')");
			header("location: downloadCatView.php?page=$page");
	   }
	   
	   
	    if(isset($_POST['updateProduct']))
	  {
	   
			$catID ='';
			$download_id=$_POST['download_id'];
   			$download_name=$_POST['download_name'];
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

		    $frontimgpdf2=$_POST['frontimgpdf2'];
	
			// single image
			if($_FILES["frontimg"]['error'] > 0)// it means no new image selected insert previous one......
				{
				
					$con->insertdb("UPDATE `tbl_download` SET download_name='".$download_name."',description='".$description."',cat_id='".$catID."',download_image='".$frontimg2."',pdf_file='".$frontimgpdf2."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."'  where download_id='".$download_id."'");
				}
				else
				{
				
				@unlink("../download/big_img/". $frontimg2);
			    @unlink("../download/". $frontimg2);
				$single_image = createImage('frontimg',"../download/");

				$con->insertdb("UPDATE `tbl_download` SET download_name='".$download_name."',description='".$description."',cat_id='".$catID."',download_image='".$single_image."',pdf_file='".$frontimgpdf2."' ,meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where download_id='".$download_id."'");
				}

			// end of image
			
			//------------------------
			//pdf
			//------------------------
			
			if($_FILES["download_file"]["error"]>0)
				{
				
					$con->insertdb("UPDATE `tbl_download` SET download_name='".$download_name."',description='".$description."',cat_id='".$catID."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."',pdf_file='".$frontimgpdf2."'  where download_id='".$download_id."'");
				}
				else
				{
				
				@unlink("../download_pdf/". $frontimgpdf2);

				$pdf_file = createPDF('download_file',"../download_pdf/");

				$con->insertdb("UPDATE `tbl_download` SET download_name='".$download_name."',description='".$description."',cat_id='".$catID."',pdf_file='".$pdf_file."' ,meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where download_id='".$download_id."'");
				}

			 		
			//-----------------				
			//end of pdf
			//--------------------
			
			
			
			header("location:downloadView.php?page=$page");
			
			
	   }
	
if(isset($_GET["Image"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_downloadcategory where cat_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../downloadcategory/'.$row[4]);
	  unlink('../downloadcategory/big_img/'.$row[4]);

	}
	$con->selectdb("update tbl_downloadcategory set cat_image='' where cat_id = '".$id."'");
	header("location: downloadcategory_up.php?category_id=".$id."&page=".$page);



}	

if(isset($_GET["ProImage"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_download where download_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../download/'.$row[4]);
	  unlink('../download/big_img/'.$row[4]);

	}
	$con->selectdb("update tbl_download set download_image='' where download_id = '".$id."'");
	header("location: download_up.php?download_id=".$id."&page=".$page);


}	
if(isset($_GET["PDF"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_download where download_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  @unlink('../download_pdf/'.$row[6]);

	}
	$con->selectdb("update tbl_download set pdf_file='' where download_id = '".$id."'");
	header("location: download_up.php?download_id=".$id."&page=".$page);


}	

?>