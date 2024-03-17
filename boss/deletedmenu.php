<?php
ob_start();
include_once("../connect.php");
include_once("../navigationfun.php");
$cn=new connect();
$cn->connectdb();
//function deleteCategory()
//{
//print_r($_GET);die;
	if (isset($_GET['menuId']) && (int)$_GET['menuId'] > 0) {
        $catId = $_GET['menuId'];
		
		$children = getChildren($catId);
	
	// make an array containing this category and all it's children
	$categories  = array_merge($children, array($catId));
	$numCategory = count($categories);
	
	for($i=0; $i<$numCategory;$i++)
	{
	
	$sql = "SELECT menu_id,submenu_id,submenu_image
	        FROM tbl_submenu
			WHERE FIND_IN_SET('".$categories[$i]."',menu_id)>0";
	//echo $sql;die;
	
	/*$sql = "SELECT pro_id,pro_image
	        FROM tbl_product
			WHERE cat_id IN (" . implode(',', $categories) . ")";*/
			//echo $sql;die;
	$result = dbQuery($sql);
	
	
		//unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_image']);	
		//unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_thumbnail']);
		//print_r($row);die;
		if (dbNumRows($result)>0) {
		//echo 'hi';die;
		while ($row = dbFetchAssoc($result)) {
			//unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_image']);	
			//unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_thumbnail']);
			//echo $row[0];die;
				$menuID =array_filter(explode(",",$row['menu_id']));
				$cntMenuId =count($menuID);
				//print_r($cntCatId);die;
				if($cntMenuId>1)
				{
				  $sqlupdate =mysqli_query("UPDATE tbl_submenu SET menu_id = replace(menu_id, '".$categories[$i].",', '') WHERE FIND_IN_SET('".$categories[$i]."',menu_id)>0");

				}
				elseif($cntMenuId== 1)
				{
					$image_list = explode(',',$row['submenu_image']);
					//echo count($image_list);die;
					//print_r($image_list);die;
					foreach($image_list as $row2)
					{
						
						$new_image_list = '';
						unlink('../menu/big_img/'.$row2);
						unlink('../menu/'.$row2);
					}
					
					//pdf file
					//unlink("../download_pdf/". $row['pdf_file']);	
					//end of pdf
					
					
					
					// delete the products
					$sqlD = "DELETE FROM tbl_submenu
							WHERE submenu_id='".$row['submenu_id']."'";
					dbQuery($sqlD);
					
					
			   }//elseif		

		}//while
	}//if	
	
	}//for
	
	
	// then remove the categories image
	_deleteImage($categories);

    // finally remove the category from database;
    $sql = "DELETE FROM tbl_dmenu
            WHERE menu_id IN (" . implode(',', $categories) . ")";
    dbQuery($sql);
    
    header("location: dmenuview.php?page=$page");
    } else {
        
    }
	
	
	function delmultirec($menuid)
	
	{
        $catId = $menuid;
		
		$children = getChildren($catId);
	
	// make an array containing this category and all it's children
	$categories  = array_merge($children, array($catId));
	$numCategory = count($categories);
	
	for($i=0; $i<$numCategory;$i++)
	{
	
	$sql = "SELECT menu_id,submenu_id,submenu_image
	        FROM tbl_submenu
			WHERE FIND_IN_SET('".$categories[$i]."',menu_id)>0";
	//echo $sql;die;
	
	/*$sql = "SELECT pro_id,pro_image
	        FROM tbl_product
			WHERE cat_id IN (" . implode(',', $categories) . ")";*/
			//echo $sql;die;
	$result = dbQuery($sql);
	
	
		//unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_image']);	
		//unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_thumbnail']);
		//print_r($row);die;
		if (dbNumRows($result)>0) {
		//echo 'hi';die;
		while ($row = dbFetchAssoc($result)) {
			//unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_image']);	
			//unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_thumbnail']);
			//echo $row[0];die;
				$menuID =array_filter(explode(",",$row['menu_id']));
				$cntMenuId =count($menuID);
				//print_r($cntCatId);die;
				if($cntMenuId>1)
				{
				  $sqlupdate =mysqli_query("UPDATE tbl_submenu SET menu_id = replace(menu_id, '".$categories[$i].",', '') WHERE FIND_IN_SET('".$categories[$i]."',menu_id)>0");

				}
				elseif($cntMenuId== 1)
				{
					$image_list = explode(',',$row['submenu_image']);
					//echo count($image_list);die;
					//print_r($image_list);die;
					foreach($image_list as $row2)
					{
						
						$new_image_list = '';
						unlink('../menu/big_img/'.$row2);
						unlink('../menu/'.$row2);
					}
					
					//pdf file
					//unlink("../download_pdf/". $row['pdf_file']);	
					//end of pdf
					
					
					
					// delete the products
					$sqlD = "DELETE FROM tbl_submenu
							WHERE submenu_id='".$row['submenu_id']."'";
					dbQuery($sqlD);
					
					
			   }//elseif		

		}//while
	}//if	
	
	}//for
	
	
	// then remove the categories image
	_deleteImage($categories);

    // finally remove the category from database;
    $sql = "DELETE FROM tbl_dmenu
            WHERE menu_id IN (" . implode(',', $categories) . ")";
    dbQuery($sql);
    
	
//print_r($_GET['page']);die;
		
    }
	

    function deleteImg($id)
	{
	  $catId = $id;
    // find all the children categories
	$children = getChildren($catId);
	
	// make an array containing this category and all it's children
	$categories  = array_merge($children, array($catId));
	$numCategory = count($categories);
	// remove all product image & thumbnail 
	
	
	// if the product's category is in  $categories================================================================
	
	
	
	
	
	
	
	// then remove the categories image
	_deleteImage($categories);

    // finally remove the category from database;
    $sql = "DELETE FROM tbl_dmenu 
            WHERE menu_id IN (" . implode(',', $categories) . ")";
    dbQuery($sql);
    
	//$page = $_GET['page'];
//print_r($_GET['page']);die;
    //header("location: categoryview.php?page=$page");
//}
}

/*
	Recursively find all children of $catId
*/
function getChildren($catId)
{
    $sql = "SELECT menu_id ".
           "FROM tbl_dmenu ".
           "WHERE menu_parent_id = $catId ";
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
    Remove a category image
*/
function deleteImage()
{
    if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
        $catId = (int)$_GET['catId'];
    } else {
        header('Location: index.php');
    }
    
	_deleteImage($catId);
	
	// update the image name in the database
	$sql = "UPDATE tbl_dmenu
			SET menu_image = ''
			WHERE menu_id = $catId";
	dbQuery($sql);        

    header("Location: index.php?view=modify&catId=$catId");
}

/*
	Delete a category image where category = $catId
*/
function _deleteImage($catId)
{
    // we will return the status
    // whether the image deleted successfully
    $deleted = false;

	// get the image(s)
    $sql = "SELECT menu_image 
            FROM tbl_dmenu
            WHERE menu_id ";
	
	if (is_array($catId)) {
		$sql .= " IN (" . implode(',', $catId) . ")";
	} else {
		$sql .= " = $catId";
	}	

    $result = dbQuery($sql);
    
    if (dbNumRows($result)) {
        while ($row = dbFetchAssoc($result)) {
	        // delete the image file
    	    //$deleted = @unlink(SRV_ROOT . CATEGORY_IMAGE_DIR . $row['cat_image']);
			$deleted = @unlink("../menu/". $row['menu_image']);	
			@unlink("../menu/big_img/". $row['menu_image']);	
		}	
    }
    
    return $deleted;
}

?>