<?php
$page_id=4;
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

            <section class="ls s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="row gallery-shortcode isotope-wrapper masonry-layout c-gutter-30 c-mb-30" data-filters=".gallery-filters">
                                     
                        <?
                        $sqlcatser="SELECT * FROM `tbl_gallery_category`";
                        $resultcatser=$cn->selectdb($sqlcatser);
                        if($cn->numRows($resultcatser)>0)
                        {
                    ?>

                        <?
                            while($rowserv=$cn->fetchAssoc($resultcatser))
                            {
                        ?>
								<div class="col-xl-4 col-md-6 business news">
									<div class="vertical-item text-center content-padding content-box-shadow content-up padding-small only-img ls">
										<div class="item-media">
											<img src="gallerycategory/big_img/<? echo $rowserv['cat_image'];?>" alt="img">
											<div class="media-links">
												<div class="links-wrap">
													<a class="link-anchor" title="" href="Gallery-Details/<?php echo $rowserv['cat_id']; ?>"></a>
												</div>
											</div>
										</div>
										<div class="item-content ls"> 
											<h5>
												<a href="Gallery-Details/<?php echo $rowserv['cat_id']; ?>"><? echo $rowserv['cat_name'];?></a>
											</h5>
										</div>
									</div>
								</div>
                                <? } ?>
                                <? } ?>


								
								
							</div>
							<!-- .isotope-wrapper-->
							<div class="mt--30"></div>
						</div>
					</div>
				</div>
			</section>


            <?php
            include_once 'footer.php';
            ?>