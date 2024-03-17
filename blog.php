<?php
$page_id=3;
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
					<div class="row c-gutter-60">
					<?php
                        $sql="SELECT blog_name,description,blog_image,bdate,slug FROM tbl_blog ORDER BY recordListingID";
                        $result=$cn->selectdb($sql);
                        if($cn->numRows($result)>0){
                            while($row=$cn->fetchAssoc($result)){
                        ?>
						<main class=" col-lg-4 mt-4">
							<article class="vertical-item ls content-padding box-shadow post type-post status-publish format-video has-post-thumbnail">
								<div class="item-media post-thumbnail">
									<div class="embed-responsive embed-responsive-3by2">				
											<img src="blog/big_img/<?php echo $row ['blog_image'];?>" alt="img">										
									</div>
								</div><!-- .post-thumbnail -->
								<div class="item-content">
									<header class="entry-header">
									<i class="fa fa-clock-o"></i> <?php echo date("F d, Y",strtotime($row['bdate']));?>												
										<h6 class="entry-title mt-2">
											<a href="Blog-Detail/<?php echo $row['slug'];?>" rel="bookmark">
											<?php
                                            $blogtitle = explode(" ", $row['blog_name']);
                                            $displaytitle = array_slice($blogtitle, 0, 5);
                                            echo implode(" ", $displaytitle);
                                        ?>
											</a>
										</h6>
									</header>
									<!-- .entry-header -->
									<div class="entry-content">
										<p>
										<?php
                                            $words = explode(" ", $row['description']);
                                            $displayWords = array_slice($words, 0, 20);
                                            echo implode(" ", $displayWords);
                                        ?>

										</p>
									</div><!-- .entry-content -->

									<div class="entry-footer">
										<div class="entry-meta">
											<div>
												<span class="more-button">
													<a class="btn btn-maincolor" href="Blog-Detail/<?php echo $row['slug'];?>">read more</a>
												</span>
											</div>
										</div>
									</div>

								</div><!-- .item-content -->
							</article><!-- #post-## -->							
						</main>
						<?php
            	        } }
				        ?>
					</div>
				</div>
			</section>




        <?php
		include_once 'footer.php';
		?>