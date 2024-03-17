<?php
ob_start();
include_once("../connect.php");
include_once("../navigationfun.php");
$cn=new connect();
$cn->connectdb();
//function deleteCategory()
//{
//print_r($_GET);die;
    if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
        $catId = (int)$_GET['catId'];
    } else {
        header('Location: index.php');
    }
    
	// find all the children categories
	$children = getChildren($catId);
	
	// make an array containing this category and all it's children
	$categories  = array_merge($children, array($catId));
	$numCategory = count($categories);
	// remove all product image & thumbnail 
	// if the product's category is in  $categories
	for($i=0; $i<$numCategory;$i++)
	{
	
	$sql = "SELECT cat_id,download_id,download_image,pdf_file
	        FROM tbl_download
			WHERE FIND_IN_SET('".$categories[$i]."',cat_id)>0";
	//echo $sql;die;
	
	/*$sql = "SELECT pro_id,pro_image
	        FROM tbl_download
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
				$catID =array_filter(explode(",",$row['cat_id']));
				$cntCatId =count($catID);
				//print_r($cntCatId);die;
				if($cntCatId>1)
				{
				  $sqlupdate =mysqli_query("UPDATE tbl_download SET cat_id = replace(cat_id, '".$categories[$i].",', '') WHERE FIND_IN_SET('".$categories[$i]."',cat_id)>0");

				}
				elseif($cntCatId== 1)
				{
					$image_list = explode(',',$row['download_image']);
					//echo count($image_list);die;
					//print_r($image_list);die;
					foreach($image_list as $row2)
					{
						
						$new_image_list = '';
						unlink('../download/big_img/'.$row2);
						unlink('../download/'.$row2);
					}
					
					//pdf file
					@unlink("../download_pdf/". $row['pdf_file']);	
					//end of pdf
					
					
					// delete the products
					$sqlD = "DELETE FROM tbl_download
							WHERE download_id='".$row['download_id']."'";
					dbQuery($sqlD);
					
					
			   }//elseif		

		}//while
	}//if	
	
	}//for
		
	
	
	// then remove the categories image
	_deleteImage($categories);

    // finally remove the category from database;
    $sql = "DELETE FROM tbl_downloadcategory 
            WHERE cat_id IN (" . implode(',', $categories) . ")";
    dbQuery($sql);
    
	$page = $_GET['page'];
//print_r($_GET['page']);die;
    header("location: downloadCatView.php?page=$page");
//}


/*
	Recursively find all children of $catId
*/
function getChildren($catId)
{
    $sql = "SELECT cat_id ".
           "FROM tbl_downloadcategory ".
           "WHERE cat_parent_id = $catId ";
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
	$sql = "UPDATE tbl_downloadcategory
			SET cat_image = ''
			WHERE cat_id = $catId";
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
    $sql = "SELECT cat_image 
            FROM tbl_downloadcategory
            WHERE cat_id ";
	
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
			$deleted = @unlink("../downloadcategory/". $row['cat_image']);	
			@unlink("../downloadcategory/big_img/". $row['cat_image']);	
		}	
    }
    
    return $deleted;
}

?>