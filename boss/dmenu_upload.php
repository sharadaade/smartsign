<?php
include_once("../connect.php");
include_once("image_lib_rname.php"); 

$con=new connect();
$con->connectdb();

 
 
	  
  $parseurl=parse_url($_SERVER['HTTP_REFERER']);
  //echo "<br/>";
 // echo $parseurl['path'];die;

	  if(isset($_POST['updateMenu']))
	  {
	  			$menu_parent_id=$_POST['menu_parent_id'];
				$page = $_POST['page'];
				$menu_name=$_POST['menu_name'];
				$menu_fa=$_POST['menu_fa'];
				$menu_class=$_POST['menu_class'];
				$menu_link=$_POST['menu_link'];
				$menu_page_id=$_POST['menu_page_id'];
				$menu_id=$_POST['menu_id'];
                
				
				
				  
				//$frontimg1=$_POST['frontimg1'];
				$frontimg2=$_POST['frontimg2'];
				//if($frontimg2
				
				// single image
				if($_FILES["frontimg"]['error'] > 0)// it means no new image selected insert previous one......
				{
				
					$con->insertdb("UPDATE `tbl_dmenu` SET menu_name='".$menu_name."', menu_fa='".$menu_fa."',menu_class='".$menu_class."',menu_link='".$menu_link."',menu_page_id='".$menu_page_id."' where menu_id=".$menu_id."");
				}
				else
				{
					@unlink("../menu/big_img/". $frontimg2);
					@unlink("../menu/". $frontimg2);
					$menuImage = createImage('frontimg',"../menu/");

					$con->insertdb("UPDATE `tbl_dmenu` SET menu_name='".$menu_name."', menu_fa='".$menu_fa."',menu_class='".$menu_class."',menu_link='".$menu_link."',menu_page_id='".$menu_page_id."',menu_image='".$menuImage."' where menu_id=".$menu_id."");
				}

			// end of image
			
			
			
			//------------------------
			//multiple images
			//------------------------
			
			
			//-----------------				
			//end of multiple images
			//--------------------
				
				
	         header("location: dmenuView.php?page=$page");

	  }
	  
	  
	   if(isset($_POST['addMenu']))
	  {
	  
	   
	   		$menu_parent_id=$_POST['menu_parent_id'];
			$page = $_POST['page'];
			$menu_name=$_POST['menu_name'];
			$menu_fa=$_POST['menu_fa'];
			$menu_class=$_POST['menu_class'];
			$menu_link=$_POST['menu_link'];
			$menu_page_id=$_POST['menu_page_id'];
			
			
			
			//single image 
			//----------------------
			$menuImage = createImage('frontimg', "../menu/");			
				
			// end of single image
			//-------------------------
			
			//-------------------
			// Multiple images
			//-------------------
					
			
			//-------------------
			// end of Multiple images
			//-------------------
			
			
			$con->insertdb("insert into tbl_dmenu(menu_parent_id,menu_name,menu_fa,menu_class,menu_link,menu_page_id,menu_image) 
			values(".$menu_parent_id.",'".$menu_name."','".$menu_fa."', '".$menu_class."', '".$menu_link."', '".$menu_page_id."','".$menuImage."')");
			header("location: dmenuView.php?page=$page");
	   }
	   

	   //SUBMENU UPLOAD/ADD:--------------------------------------------------------------------------------------- 
	  

	  if(isset($_POST['addSubmenu']))
	  {
	     // print_r($_POST);

			
			//$page = $_POST['page'];
			$menu_name=$_POST['menu_name'];
			$menu_fa=$_POST['menu_fa'];
			$menu_class=$_POST['menu_class'];
			$menu_link=$_POST['menu_link'];
			$menu_page_id=$_POST['menu_page_id'];
			//single image 
			//----------------------
			$menuImage = createImage('frontimg', "../menu/");			
				
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
			
			
			//-------------------
			// end of Multiple images
			//-------------------
			
	
		$submenuID = '';
		//get multiple value of radio (multiple categories)
		foreach ($_POST['mulradio'] as $attributeKey => $attributes){
	   // echo $attributeKey.' '.$_POST['mulradio'][$attributeKey].'<br>';
		
		$submenuID.= $_POST['mulradio'][$attributeKey].",";
			} //foreach
			
		$con->insertdb("INSERT INTO `tbl_submenu` 
							(menu_id,submenu_name,submenu_fa,submenu_class,submenu_link,submenu_page_id,submenu_image) 
			values('".$submenuID."','".$menu_name."','".$menu_fa."', '".$menu_class."', '".$menu_link."', '".$menu_page_id."','".$menuImage."');");
					
			
			header("location:submenuView.php");
			}
	   
		// SUBMENU UPDATE :-------------------------------------------------------------------------------------------
	   
	   
		if(isset($_POST['updateSubmenu']))
		{
	   
			$menuID ='';
			$menu_id=$_POST['menu_id'];
			$page = $_POST['page'];
			$menu_name=$_POST['menu_name'];
			$menu_fa=$_POST['menu_fa'];
			$menu_class=$_POST['menu_class'];
			$menu_link=$_POST['menu_link'];
			$menu_page_id=$_POST['menu_page_id'];
			$submenu_id=$_POST['submenu_id'];					  		
			//$cat_id=$_POST['cat_id'];
			
			//get multiple value of radio (multiple categories)
			foreach ($_POST['mulradio'] as $attributeKey => $attributes){
		   //echo $attributeKey.' '.$_POST['mulradio'][$attributeKey].'<br>';
			
				$menuID.= $_POST['mulradio'][$attributeKey].",";
			} //foreach
			
			$frontimg2=$_POST['frontimg2'];
		    //$frontimg1=$_POST['frontimg1'];

		    //$frontimgpdf2=$_POST['frontimgpdf2'];
	
			// single image
			if($_FILES["frontimg"]['error'] > 0)// it means no new image selected insert previous one......
				{
					echo $menu_name;
					$con->insertdb("UPDATE `tbl_submenu` SET menu_id='".$menuID."', submenu_name='".$menu_name."', submenu_fa='".$menu_fa."',submenu_class='".$menu_class."',submenu_link='".$menu_link."',submenu_page_id='".$menu_page_id."' where submenu_id=".$submenu_id."");
					
				}
				else
				{
				
					@unlink("../menu/big_img/". $frontimg2);
					@unlink("../menu/". $frontimg2);
					$menuImage = createImage('frontimg',"../menu/");

					$con->insertdb("UPDATE `tbl_submenu` SET menu_id='".$menuID."', submenu_name='".$menu_name."', submenu_fa='".$menu_fa."',submenu_class='".$menu_class."',submenu_link='".$menu_link."',submenu_page_id='".$menu_page_id."',submenu_image='".$menuImage."' where submenu_id=".$submenu_id."");
				}

			
			
			header("location:submenuView.php?page=$page");
			
			
	   }
	
if(isset($_GET["Image"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_dmenu where menu_id=".$id."");
	while($row=mysqli_fetch_assoc($records))
	{
	  unlink('../menu/'.$row['menu_image']);
	  unlink('../menu/big_img/'.$row['menu_image']);

	}
	$con->selectdb("update tbl_dmenu set menu_image='' where menu_id = '".$id."'");
	header("location: dmenu_up.php?dmenu_id=".$id."&page=".$page);



}	

if(isset($_GET["submenuImage"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
	$records=$con->selectdb("SELECT * FROM tbl_submenu where submenu_id=".$id."");
	while($row=mysqli_fetch_assoc($records))
	{
	  unlink('../menu/'.$row['submenu_image']);
	  unlink('../menu/big_img/'.$row['submenu_image']);

	}
	$con->selectdb("update tbl_submenu set submenu_image='' where submenu_id = '".$id."'");
	header("location: submenu_up.php?submenu_id=".$id."&page=".$page);


}	


?>