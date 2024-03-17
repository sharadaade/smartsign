<?php
$page_id=16;
$catid=$_GET['pid'];
include_once 'header.php';
?>
                    <?php					   
                        $sqlcatpr="SELECT * from tbl_category where cat_id=$catid";
                        $resultcatpr=$cn->selectdb($sqlcatpr);
                        if($cn->numRows($resultcatpr)>0){
                        while($rowpr=$cn->fetchAssoc($resultcatpr))
                        {
                    ?>

			<section class="page_title c-gutter-0 container-px-xl-0 ds ms s-overlay s-parallax s-pt-xl-100 s-pt-md-100 s-pb-md-80 s-pt-60 s-pb-60">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1><? echo $rowpr['cat_name']; ?></h1>
						</div>
					</div>
				</div>
			</section>

            <?php
            } }
			?>

            <!-- Section Ends Here -->

            <section class="ls s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="row shortcode-service isotope-wrapper masonry-layout c-gutter-50 c-mb-50">
                               
                            <?
                               $sqlimg="SELECT * from tbl_product where cat_id=$catid";
                               $reslutimg=$cn->selectdb($sqlimg);
                               if($cn->numRows($reslutimg)>0){
			                   	while($rowimg=$cn->fetchAssoc($reslutimg))
			                   	{ 
                            ?>

								<div class="col-lg-4 col-md-6 col-12">
									<div class="vertical-item content-padding padding-small ls box-shadow item-service">
										<div class="item-media">
											<img src="product/big_img/<?php echo $rowimg['product_image'];?>" alt="img">
											<div class="media-links">
												<a class="abs-link" href="Detail/<?php echo $rowimg['slug'];?>"></a>
											</div>
										</div>
										<div class="item-content">
											<h5><a href="Detail/<?php echo $rowimg['slug'];?>"><? echo $rowimg['product_name'];?></a></h5>
											<!-- <p>
												Home Owners Association approval process discussed
											</p> -->
											<div class="btn-service">
												<a class="btn btn-maincolor " href="Detail/<?php echo $rowimg['slug'];?>">read more</a>
											</div>
										</div>
									</div>
								</div>

						<?php } } ?>
																
							</div>
							<div class="mt--50"></div>
						</div>
					</div>
				</div>
			</section>


        <?php
		include_once 'footer.php';
		?>