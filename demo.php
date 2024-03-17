<section class="page_title c-gutter-0 container-px-xl-0 ds ms s-overlay s-parallax s-pt-xl-100 s-pt-md-100 s-pb-md-80 s-pt-60 s-pb-60">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1><?php echo $rowH['page_name'];?></h1>
						</div>
					</div>
				</div>
			</section>

            <section class="ls no-sidebar s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60 c-gutter-60">
				<div class="container">
				<?php
                        $sql="SELECT blog_name,description,blog_image,bdate,slug FROM tbl_blog WHERE slug='$slug'";
                        $result=$cn->selectdb($sql);
                        if($cn->numRows($result)>0){
                            $row=$cn->fetchAssoc($result);
                    ?>
                <main class="col-lg-8">                       
					<div class="row">
							<article class="vertical-item ls content-padding box-shadow single-post post type-post status-publish format-standard has-post-thumbnail">
								<!-- .post-thumbnail -->
								<div class="item-media post-thumbnail">
									<img src="blog/big_img/<?php echo $row ['blog_image'];?>" alt="img">
								</div>

								<div class="item-content">
									<header class="entry-header">
												<span class="date">
													<i class="fa fa-clock-o" aria-hidden="true"></i>
													<?php echo date("F d, Y",strtotime($row['bdate']));?>
												</span>	
									</header>

									<div class="entry-content">
                                        <h5><?php echo $row ['blog_name'];?></h5>
										<p>
                                        <?php echo $row ['description'];?>
                                        </p>
									</div>									
									<!-- .entry-content -->

								</div>
								<!-- .item-content -->
							</article>
                        </div>
                        </main>
						<?php } ?>
						
                    </div>
            </section>