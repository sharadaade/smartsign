<?php
ob_start();
include_once("../connect.php");
include_once("../navigationfun.php");
include_once("image_lib_rname.php"); 

$cn=new connect();
$cn->connectdb();


 	  
if(isset($_POST['add']))
{
  	$page_name=$_POST['page_name'];
	$page_desc=$_POST['page_desc'];
	$page_parent_id=$_POST['page_parent_id'];
	
	$meta_tag_title=$_POST['meta_tag_title'];
	$meta_tag_description=$_POST['meta_tag_description'];
	$meta_tag_keywords=$_POST['meta_tag_keywords'];
	$slug=$_POST['slug'];

	
	$title=implode("NEWTITLE",$_POST['title']);
	$desc=implode("NEWDESC",$_POST['desc']);
	
	//print_r($_POST);
	
	//single image 
	//----------------------
	$single_image = createImage('frontimg', "../page/");			
		
	// end of single image
	//-------------------------
	
	//-------------------
	// Multiple images
	//-------------------
	$images_name = createMultiImage('image_title', "../pageF/");			
	
	//-------------------
	// end of Multiple images
	//-------------------
	
	$con->insertdb("insert into tbl_page values(NULL,'".$page_name."','".$page_desc."','".$page_parent_id."','".$single_image."','".$meta_tag_title."','".$meta_tag_description."','".$meta_tag_keywords."','".$images_name."','".$slug."',0)");
	
    // get last inserted id to store in tbl_addmore table
	$page_id = mysqli_insert_id($con->_connection);
				
	//insert in tbl_addmore table
	foreach($_POST['title'] as $i => $item) 
	{
 		if($_POST['title'][$i]!='')
		{
		$title= $_POST['title'][$i];
		$descsd= $_POST['descsd'][$i];
		$desc= $_POST['desc'][$i];
		
		//-------------------
		// Multiple icons
		//-------------------
		$multi_icons_image = createMultiIcon('iconimg', "../icon/",$i);	
		
		//-------------------
		// end of Multiple icons
		//-------------------
		
		$con->insertdb("insert into tbl_addmore (`page_id`, `title`, `small_desc`, `extra_desc`, `extra_icon`) values('".$page_id."','".$title."','".$descsd."','".$desc."','".$multi_icons_image."')");
		}
	}
	header("location:pageView.php");
}

if(isset($_POST['update']))
{
  	$page=  $_POST['page'];
	$page_name=$_POST['page_name'];
	$page_id=$_POST['page_id'];
	$page_desc=$_POST['page_desc'];
	$page_parent_id=$_POST['page_parent_id'];
	$slug=$_POST['slug'];

	$meta_tag_title=$_POST['meta_tag_title'];
	$meta_tag_description=$_POST['meta_tag_description'];
	$meta_tag_keywords=$_POST['meta_tag_keywords'];
	
	

	
	$frontimg2=$_POST['frontimg2'];
	$frontimg1=$_POST['frontimg1'];
				
	// single image
	if($_FILES["frontimg"]['error'] > 0)// it means no new image selected insert previous one......
	{
		$con->insertdb("update tbl_page set page_name='".$page_name."',page_desc='".$page_desc."',image='".$frontimg2."',meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where page_id='".$page_id."' ");
	}
	else
	{
		@unlink("../page/big_img/". $frontimg2);
		@unlink("../page/". $frontimg2);
		$single_image = createImage('frontimg',"../page/");
		$con->insertdb("update tbl_page set page_name='".$page_name."',page_desc='".$page_desc."',image='".$single_image."',meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where page_id='".$page_id."' ");
	}
	// end of image
	
	//------------------------
	//multiple images
	//------------------------
	
	$size_sum = array_sum($_FILES['image_title']['size']);
	if ($size_sum > 0) 
	{
		// at least one file has been uploaded
		
		$images_name = createMultiImage('image_title', "../pageF/");	
		$records=$con->selectdb("select * from tbl_page where page_id='".$page_id."'");
			$row=mysqli_fetch_row($records);
		//echo $row[2]."<br>";
		//echo $images; die;
		$final= $row[8].$images_name;
		
		$con->insertdb("update tbl_page set page_name='".$page_name."',page_desc='".$page_desc."',multi_images='".$final."',meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where page_id='".$page_id."' ");
	}
	else
	{
		$con->insertdb("update tbl_page set page_name='".$page_name."',page_desc='".$page_desc."',multi_images='".$frontimg1."',meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where page_id='".$page_id."' ");
	}

	//-----------------				
	//end of multiple images
	//--------------------
	$title=implode("NEWTITLE",$_POST['title']);
	$desc=implode("NEWDESC",$_POST['desc']);
  	$hiddeniconIMG= explode(",",$_POST['hiddeniconIMG']);
		  
	//insert in tbl_addmore table
	foreach($_POST['title'] as $i => $item) 
	{
		if($_POST['title'][$i]!='')
		{
			$title= $_POST['title'][$i]; 
			$descsd= $_POST['descsd'][$i];
			$desc= $_POST['desc'][$i];
			if (isset($_POST['hiddeen_addmore_id'][$i]))
			{
				$addmore_id= $_POST['hiddeen_addmore_id'][$i];
				if(!isset($_POST['set_icon'.$i]))
				{
					if($_FILES['iconimg'.$i]['error'] == 0)
					{
						$multi_icons_image = createImage('iconimg'.$i, "../icon/",$i);	
						$con->insertdb("update tbl_addmore set page_id='".$page_id."',title='".$title."',small_desc='".$descsd."',extra_desc='".$desc."',extra_icon='".$multi_icons_image."' where addmore_id='".$addmore_id."' ");
					}
					else
					{
						$con->insertdb("update tbl_addmore set page_id='".$page_id."',title='".$title."',small_desc='".$descsd."',extra_desc='".$desc."' where addmore_id='".$addmore_id."' ");
					}
				}
				else
				{
					$con->insertdb("update tbl_addmore set page_id='".$page_id."',title='".$title."',small_desc='".$descsd."',extra_desc='".$desc."' where addmore_id='".$addmore_id."' ");
				}
			}
			else
			{
				//-------------------
				// Multiple icons
				//-------------------
				$multi_icons_image = createImage('iconimg'.$i, "../icon/",$i);	
				//-------------------
				// end of Multiple icons
				//-------------------
				//echo "insert into tbl_addmore values(NULL,'".$page_id."','".$title."','".$desc."','".$multi_icons_image."')";die;
				$con->insertdb("insert into tbl_addmore (`page_id`, `title`, `small_desc`, `extra_desc`, `extra_icon`) values ('".$page_id."','".$title."','".$descsd."','".$desc."','".$multi_icons_image."')");
			}
		}	
	}
	header("location:pageView.php?page=$page");
}

//Delete
if(isset($_GET['Del'])=='del')
{
	$page_id = $_GET['page_id'];

	// find all the children categories
	$children = getChildren($page_id);
	
	// make an array containing this category and all it's children
	$categories  = array_merge($children, array($page_id));
	$numCategory = count($categories);
	
	// then remove the categories image
	_deleteImage($categories);

    // delete records from tbl_addmore
    $sql_addmore = "DELETE FROM tbl_addmore 
            WHERE page_id IN (" . implode(',', $categories) . ")";
    dbQuery($sql_addmore);
	
	//----------------------------------
	
	 // finally remove the category from database;
    $sql = "DELETE FROM tbl_page 
            WHERE page_id IN (" . implode(',', $categories) . ")";
    dbQuery($sql);

    $page = $_GET['page'];
    header("location: pageView.php?page=$page");
}

/*
	Recursively find all children of $catId
*/
function getChildren($pageId)
{
    $sql = "SELECT page_id ".
           "FROM tbl_page ".
           "WHERE page_parent_id = $pageId ";
    $result = dbQuery($sql);
    
	$cat = array();
	if (dbNumRows($result) > 0) {
		while ($row = dbFetchRow($result)) {
			$cat[] = $row[0];
			
			// call this function again to find the children
			$cat  = array_merge($cat, getChildren($row[0]));
		}
    }

    return $cat;
}

/*
	Delete a category image where category = $catId
*/
function _deleteImage($pageId)
{
    // we will return the status
    // whether the image deleted successfully
    $deleted = false;

	// get the image(s)
    $sql = "SELECT page_id,image,multi_images 
            FROM tbl_page
            WHERE page_id ";
	
	if (is_array($pageId)) {
		$sql .= " IN (" . implode(',', $pageId) . ")";
	} else {
		$sql .= " = $pageId";
	}	
    $result = dbQuery($sql);
    
    if (dbNumRows($result)) {
        while ($row = dbFetchAssoc($result)) {
		
	        // delete the image file
    	    //$deleted = @unlink(SRV_ROOT . CATEGORY_IMAGE_DIR . $row['cat_image']);
			$deleted = unlink("../page/". $row['image']);	
			unlink("../page/big_img/". $row['image']);	
			
			// multiple images
			$images = explode(',',$row['multi_images']);
			foreach($images as $rowF)
			{
			//print_r($image_list);die;
			$new_image_list = '';
			@unlink('../pageF/big_img/'.$rowF);
			@unlink('../pageF/'.$rowF);
			}

			// end of multiple images
			
			// Delete icon from tbl_addmore
			$sql_icon = "SELECT extra_icon 
					FROM tbl_addmore
					WHERE page_id =".$row['page_id'];
					
			$result_icon = dbQuery($sql_icon);
    
			if (dbNumRows($result_icon)) {
				while ($row_icon = dbFetchAssoc($result_icon)) 
				{
					// multiple images
					$images_icon = explode(',',$row_icon['extra_icon']);
					foreach($images_icon as $row_icon)
					{
					@unlink('../icon/big_img/'.$row_icon);
					@unlink('../icon/'.$row_icon);
					}
					// end of multiple images
				}
			}	
			//----------------------------
		}	
    }
    
    return $deleted;
}
if(isset($_GET["ProImage"]))
	{
	//print_r($_POST);die;
	$id= $_GET['id'];
		$page= $_GET['page'];

	$records=$con->selectdb("SELECT * FROM tbl_page where page_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../page/'.$row[4]);
	  unlink('../page/big_img/'.$row[4]);

	}
	$con->selectdb("update tbl_page set image='' where page_id = '".$id."'");
	header("location: page.php?page_id=".$id."&page=".$page);


}	


if(isset($_GET["IconImage"]))
	{
	//print_r($_GET);die;
	$id= $_GET['id'];
	echo $id;
	$page_id= $_GET['page_id'];

	$records=$con->selectdb("SELECT * FROM tbl_addmore where addmore_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../icon/'.$row[5]);
	  unlink('../icon/big_img/'.$row[5]);

	}
	$con->selectdb("update tbl_addmore set extra_icon='' where addmore_id = '".$id."'");
	header("location: page.php?page_id=".$page_id."&page=".$page);


}	


if(isset($_GET["ExtraContent"]))
	{
	//print_r($_GET);die;
	$id= $_GET['id'];
	$page_id= $_GET['page_id'];

	$records=$con->selectdb("SELECT * FROM tbl_addmore where addmore_id=".$id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../icon/'.$row[5]);
	  unlink('../icon/big_img/'.$row[5]);

	}
	$cn->selectdb("delete from tbl_addmore where addmore_id=$id");

	header("location: page.php?page_id=".$page_id."&page=".$page);
}	

//multiple images	
 if(isset($_REQUEST["btnDeleteImages"]))
{
	$page_id = $_POST['page_id'];
	$page = $_POST['page'];

	$image = $_POST['frontimg1'];
	$image_list = explode(',',$image);
	$new_image_list = '';
	
	if(isset($_REQUEST["imageEdit"]))
	{
		foreach($_REQUEST['imageEdit'] as $row)
		{
			 $image = str_replace($row.',' , '' ,$image);
			 @unlink('../pageF/big_img/'.$row);
			 @unlink('../pageF/'.$row);
		}
		
		$con->selectdb("update tbl_page set multi_images='".$image."' where page_id = '".$page_id."'");
		header("location: page.php?page_id=".$page_id."&page=".$page);
	}
	else
	{
		echo 'No Image selected';
	}
		
} 
	
  
?>