<?php
$page_id=7;
$slug=$_GET['ptid'];
include_once 'header.php';
?>

                      
<?php
$sqlimg = "SELECT * FROM tbl_product WHERE slug='$slug'";
$reslutimg = $cn->selectdb($sqlimg);

if ($cn->numRows($reslutimg) > 0) {
    $rowimg = $cn->fetchAssoc($reslutimg);
    $multi_images = $rowimg['multi_images'];
    $Img = explode(',', $multi_images);
?>

<section class="page_title c-gutter-0 container-px-xl-0 ds ms s-overlay s-parallax s-pt-xl-100 s-pt-md-100 s-pb-md-80 s-pt-60 s-pb-60">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $rowimg['product_name']; ?></h1>
            </div>
        </div>
    </div>
</section>

<!--Section Service Single-->
<section class="ls service-single s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article class="vertical-item  box-shadow content-padding padding-big">
                    <div class="item-media">
                        <img src="product/big_img/<?php echo $rowimg['product_image']; ?>" alt="img">
                    </div>
                    <div class="item-content">
                        <p>
                            <?php echo $rowimg['description']?>
                        </p>
                    </div>

                    <div class="isotope-wrapper masonry-layout gallery-shortcode c-gutter-30 c-mb-30" data-filters=".gallery-filters">
                        <?php 
                        if (!empty($Img)) {
                            foreach ($Img as $image) {
                                if (!empty($image)) {
                        ?>
                            <div class="col-xl-3 col-sm-6 walkways">
                                <div class="vertical-item item-gallery only-img ds">
                                    <div class="item-media">
                                        <img src="productF/big_img/<?php echo $image; ?>" alt="">
                                        <div class="media-links">
                                            <div class="links-wrap">
                                                <a class="link-zoom photoswipe-link" title="" href="productF/big_img/<?php echo $image; ?>"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                                }
                            }
                        } else {
                            echo "No images found.";
                        }
                        ?>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<?php 
} else {
    echo "No results found.";
}
?>


			<!--End Section Service Single-->

			<!--Section Service Carousel-->
			<section class=" ls  s-pb-xl-150 s-pb-lg-130 s-pb-md-90 s-pb-60">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<p class="special-heading with-decoration text-center">
								<span class="text-capitalize">
									what we do
								</span>
							</p>
							<h3 class="special-heading text-center">
								<span class="text-capitalize ">
									other Products
								</span>
							</h3>
							<div class="fw-divider-space divider-25 divider-lg-45"></div>
							<div class="owl-carousel shortcode-service owl-shadowitems" data-dots="false" data-center="false" data-autoplay="true" data-margin="30" data-loop="true" data-responsive-xxl="3" data-responsive-xl="3" data-responsive-lg="2" data-responsive-md="2" data-responsive-sm="1" data-responsive-xs="1">
                                   
                        <?php
                        $sqlcatser="SELECT * FROM `tbl_category` ORDER BY recordListingID";
                        $resultcatser=$cn->selectdb($sqlcatser);
                        if($cn->numRows($resultcatser)>0){
                        while($rowserv=$cn->fetchAssoc($resultcatser))
                        {
                        ?>
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
                               
                        <?php
            	        } }
				        ?>
															
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--End Section Service Carousel-->

        <?php
		include_once 'footer.php';
		?>