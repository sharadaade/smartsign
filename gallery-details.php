<?php
   $page_id = 4;
   $slug = $_GET['gid'];
   include_once 'header.php';
?>

<?
   $sql_page = "SELECT cat_name FROM tbl_gallery_category WHERE `cat_id` = '$slug'";
   $result_page = $cn->selectdb($sql_page);
   
   if ($cn->numRows($result_page) > 0) {
       $rowH = $cn->fetchAssoc($result_page); 
   } else {
       header("Location: 404/");
       exit;
   }
?>

              <section class="page_title c-gutter-0 container-px-xl-0 ds ms s-overlay s-parallax s-pt-xl-100 s-pt-md-100 s-pb-md-80 s-pt-60 s-pb-60">
                  <div class="container">
                      <div class="row">
                          <div class="col-md-12">
                              <h1><?php echo $rowH['cat_name']; ?></h1>
                          </div>
                      </div>
                  </div>
              </section>

             <section class="ls s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
                 <div class="container">
                     <div class="row">
                         <div class="col-lg-10 offset-lg-1">
                             <div class="vertical-item portfolio-single content-padding box-shadow">
             
                                 <div class="item-content">
                                     <?php 
                                     if ($slug !== null) {
                                         $sql_description = "SELECT cat_id, description FROM tbl_gallery WHERE FIND_IN_SET('$slug', cat_id)";
                                         $result_description = $cn->selectdb($sql_description);
                                         if ($cn->numRows($result_description) > 0) {
                                             $row_description = $cn->fetchAssoc($result_description);
                                     ?> 
                                         <p style="text-align:center;">
                                         <?php echo strip_tags($row_description['description']);?>
                                         </p>       
                                         

                                     <?php } } ?>

                                 </div>                    
                             </div>
                         </div>
                     </div>
                 </div>
             </section>


             <section class="ls portfolio s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
				<div class="container">
					<div class="row">
						<div class="col-lg-10 offset-lg-1">
							<div class="row isotope-wrapper masonry-layout gallery-shortcode c-gutter-30 c-mb-30" data-filters=".gallery-filters">

                                  <?php                                   
                                  if ($slug !== null) {
                                      $sql_gallery = "SELECT cat_id, description, multi_images FROM tbl_gallery WHERE FIND_IN_SET('$slug', cat_id)";
                                      $result_gallery = $cn->selectdb($sql_gallery);
                                  
                                      if ($cn->numRows($result_gallery) > 0) {
                                          $row_gallery = $cn->fetchAssoc($result_gallery);
                                          $mulimg = array_filter(explode(",", $row_gallery['multi_images']));
                                          
                                          // Check if $mulimg is not empty before looping through it
                                          if (!empty($mulimg)) {
                                              foreach ($mulimg as $image) {
                                  ?>

								<div class="col-xl-4 col-sm-6 walkways">
									<div class="vertical-item item-gallery only-img ds">
										<div class="item-media">
											<img src="galleryF/big_img/<?php echo $image; ?>" alt="">
											<div class="media-links">
												<div class="links-wrap">
													<a class="link-zoom photoswipe-link" title="" href="galleryF/big_img/<?php echo $image; ?>"></a>
												</div>
											</div>
										</div>
									</div>
								</div>

                                   <?php 
                                   }
                               }
                           }
                       }
                       ?>															
							</div>							
						</div>
					</div>
				</div>
			</section>
<?php
include_once 'footer.php';
?>

