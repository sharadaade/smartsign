<?php
$page_id=7;
include_once 'header.php';
?>


<?php
   $sql="SELECT page_name,image FROM tbl_page WHERE page_id=$page_id";
   $result=$cn->selectdb($sql);
   if($cn->numRows($result)>0){
      $rowH=$cn->fetchAssoc($result);
   }else{
      header("location:404/");
   }
?>

			<section class="page_title c-gutter-0 container-px-xl-0 ds ms s-overlay s-parallax s-pt-xl-100 s-pt-md-100 s-pb-md-80 s-pt-60 s-pb-60">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1><?php echo $rowH['page_name'];?></h1>
						</div>
					</div>
				</div>
			</section>

            <!-- Section Ends Here -->

            <section class="ls s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="row shortcode-service isotope-wrapper masonry-layout c-gutter-50 c-mb-50">
                               
                        <?php
                        $sqlcatser="SELECT * FROM `tbl_category` ORDER BY recordListingID";
                        $resultcatser=$cn->selectdb($sqlcatser);
                        if($cn->numRows($resultcatser)>0){
                        while($rowserv=$cn->fetchAssoc($resultcatser))
                        {
                        ?>
								<div class="col-lg-4 col-md-6 col-12">
									<div class="vertical-item content-padding padding-small ls box-shadow item-service">
										<div class="item-media">
											<img src="category/big_img/<? echo $rowserv['cat_image'];?>" alt="img">
											<div class="media-links">
												<a class="abs-link" href="Product-Detail/<?php echo $rowserv['cat_id'];?>"></a>
											</div>
										</div>
										<div class="item-content">
											<h5><a href="Product-Detail/<?php echo $rowserv['cat_id'];?>"><? echo $rowserv['cat_name'];?></a></h5>
											<!-- <p>
												Home Owners Association approval process discussed
											</p> -->
											<div class="btn-service">
												<a class="btn btn-maincolor " href="Product-Detail/<?php echo $rowserv['cat_id'];?>">read more</a>
											</div>
										</div>
									</div>
								</div>

						<?php
            	        } }
				        ?>
								
								
							
								
							</div>
							<div class="mt--50"></div>
						</div>
					</div>
				</div>
			</section>


        <?php
		include_once 'footer.php';
		?>