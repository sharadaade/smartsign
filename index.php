  <? 
    $page_id=1;
    include_once 'header.php'; 
  ?>

             <?php
				$sqlslide="SELECT image_name,image_title,desc_slider,link_url FROM tbl_slider ORDER BY recordListingID";
				$resultslide=$cn->selectdb($sqlslide);
				if($cn->numRows($resultslide)>0){
				    $cnt=0;
			 ?>

			<!--Section Main Slider With Services-->
			<section class="ls container-px-0 c-gutter-0">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="page_slider">
								<div class="flexslider slider-1 top-space" data-nav="false">
									<ul class="slides">
									<?	
                                        while($rowslide1=$cn->fetchAssoc($resultslide)){
                                        #$cnt++;
                                    ?>

										<li class="ds ms slide-1 cover-image s-overlay text-left  ">
											<img src="slider/big_img/<?php echo $rowslide1['image_name'];?>" alt="img">
											<div class="container">
												<div class="row align-items-center">
													<div class="col-12">
														<!-- <div class="intro_layers_wrapper"> --
															<div class="intro_layers">
																<div class="intro_layer main-title"
																	data-animation="fadeInLeft" data-delay="150">
																	<h1>In Business <br> Since 2003</h1>
																</div>
																<div class="intro_layer text"
																	data-animation="fadeInLeft" data-delay="150">
																	<p>
																		We Are manufacturer in Road sign with 14 years
																		of experience.<br>
																		In kenya we can complete 5000+ projects.
																	</p>
																</div>
																<div class="intro_layer slider-button"
																	data-animation="fadeInLeft" data-delay="150">
																	<a class="btn medium-btn btn-maincolor"
																		href="#">book appointment</a>
																</div>
																<div class="intro_layer slider-social"
																	data-animation="fadeInLeft" data-delay="150">
																	<div class="social-icons">
																		<a href="https://www.youtube.com/"
																			class="fa fa-youtube-play"
																			title="youtube"></a>
																		<a href="https://web.telegram.org/"
																			class="fa fa-paper-plane"
																			title="telegram"></a>
																		<a href="https://www.instagram.com/"
																			class="fa fa-instagram"
																			title="instagram"></a>
																		<a href="https://www.facebook.com/"
																			class="fa fa-facebook" title="facebook"></a>
																	</div>
																</div>
															</div> <!-- eof .intro_layers --
													</div>
													<!--eof .intro_layers_wrapper-->
													</div> <!-- eof .col-* -->
												</div><!-- eof .row -->
											</div><!-- eof .container-fluid -->
											<!-- <div class="social-icons">
												<a href="https://www.youtube.com/" class="fa fa-youtube-play rounded-icon" title="youtube"></a>
												<a href="https://web.telegram.org/" class="fa fa-paper-plane" title="telegram"></a>
												<a href="https://www.instagram.com/" class="fa fa-instagram" title="instagram"></a>
												<a href="https://www.facebook.com/" class="fa fa-facebook" title="facebook"></a>
											</div> -->
										</li>
										<? } ?>

									</ul>
								</div> <!-- eof flexslider -->
							</div>
						</div>
						<!--	<div class="col-lg-12 column-absolute-top-right">
							<div class="fw-divider-space divider-30 divider-xxl-0"></div>
							<div class="owl-carousel shortcode-service  owl-shadowitems bottom-right-nav"
								data-dots="false" data-center="false" data-nav="true" data-autoplay="false"
								data-margin="30" data-loop="false" data-responsive-xxl="1" data-responsive-xl="4"
								data-responsive-lg="3" data-responsive-md="2" data-responsive-sm="2"
								data-responsive-xs="1">
								<div
									class="vertical-item content-padding padding-small cs box-shadow item-service item-layout2 big-padding">
									<div class="item-media">
										<img src="images/services/11.jpg" alt="img">
										<div class="media-links">
											<a class="abs-link" href="service-single.html"></a>
										</div>
									</div>
									<div class="item-content">
										<h5 class="number-service">
											01
										</h5>
										<h5><a href="service-single.html">Warning Signs</a></h5>
										<p>
											Road warning signs alert drivers to potential hazards or changes in road
											conditions, enhancing safety by providing advance notice of upcoming
											obstacles, intersections, or specific rules, helping drivers make informed
											decisions.
										</p>
										<div class="btn-service">
											<a class="btn btn-outline-maincolor only-link"
												href="service-single.html">read more</a>
										</div>
									</div>
								</div>
								<div
									class="vertical-item content-padding padding-small cs box-shadow item-service item-layout2 big-padding">
									<div class="item-media">
										<img src="images/services/12.jpg" alt="img">
										<div class="media-links">
											<a class="abs-link" href="service-single.html"></a>
										</div>
									</div>
									<div class="item-content">
										<h5 class="number-service">
											02
										</h5>
										<h5><a href="service-single.html">INFORMATORY SIGNS</a></h5>
										<p>
											Informatory road signs convey essential information to drivers, guiding them
											with details about routes, destinations, services, and regulations,
											facilitating smooth navigation and enhancing overall road awareness.
										</p>
										<div class="btn-service">
											<a class="btn btn-outline-maincolor only-link"
												href="service-single.html">read more</a>
										</div>
									</div>
								</div>
								<div
									class="vertical-item content-padding padding-small cs box-shadow item-service item-layout2 big-padding">
									<div class="item-media">
										<img src="images/services/13.jpg" alt="img">
										<div class="media-links">
											<a class="abs-link" href="service-single.html"></a>
										</div>
									</div>
									<div class="item-content">
										<h5 class="number-service">
											03
										</h5>
										<h5><a href="service-single.html">ROAD PROJECT DIRECTORIES</a></h5>
										<p>
											Road project directories serve as comprehensive guides, providing essential
											information about ongoing or upcoming construction projects, helping
											commuters and stakeholders stay informed about developments, detours, and
											project timelines for improved navigation and planning.
										</p>
										<div class="btn-service">
											<a class="btn btn-outline-maincolor only-link"
												href="service-single.html">read more</a>
										</div>
									</div>
								</div>
								<div
									class="vertical-item content-padding padding-small cs box-shadow item-service item-layout2 big-padding">
									<div class="item-media">
										<img src="images/services/14.jpg" alt="img">
										<div class="media-links">
											<a class="abs-link" href="service-single.html"></a>
										</div>
									</div>
									<div class="item-content">
										<h5 class="number-service">
											04
										</h5>
										<h5><a href="service-single.html">DIRECTIONAL SIGNS</a></h5>
										<p>
											Directional signs guide motorists with clear and concise information,
											indicating routes, exits, and locations to facilitate smooth navigation,
											ensuring efficient and safe travel on roadways.
										</p>
										<div class="btn-service">
											<a class="btn btn-outline-maincolor only-link"
												href="service-single.html">read more</a>
										</div>
									</div>
								</div>
								<div
									class="vertical-item content-padding padding-small cs box-shadow item-service item-layout2 big-padding">
									<div class="item-media">
										<img src="images/services/14.jpg" alt="img">
										<div class="media-links">
											<a class="abs-link" href="service-single.html"></a>
										</div>
									</div>
									<div class="item-content">
										<h5 class="number-service">
											05
										</h5>
										<h5><a href="service-single.html"> ROAD FURNITURES & ALL
												ROAD MARKINGS </a></h5>
										<p>
											Road furniture includes essential elements like barriers, traffic signals,
											and signposts, while road markings encompass painted lines and symbols,
											collectively ensuring organized traffic flow and enhancing road safety by
											providing visual cues and regulating driver behavior.
										</p>
										<div class="btn-service">
											<a class="btn btn-outline-maincolor only-link"
												href="service-single.html">read more</a>
										</div>
									</div>
								</div>
							</div>
						</div>-->
					</div>
				</div>
			</section>
			<? } ?>
			<!-- Slider Ends Here -->


   <!-- About us section -->
			<?php
              $sql = "SELECT page_name,page_desc,slug,multi_images FROM tbl_page WHERE page_id=8";
              $result = $cn->selectdb($sql);
              if ($cn->numRows($result) > 0) {
                  $row = $cn->fetchAssoc($result);
                  $Img = explode(',', $row['multi_images']);
            ?>

			
			<!--Section Who We Are-->
			<section id="about" class="ls ms s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
				<div class="container">
					<div class="row align-center">
						<div class="col-lg-6">
							<img src="pageF/big_img/<?php echo $Img[0]; ?>" alt="img">
						</div>
						<div class="col-lg-6 col-xl-5 offset-xl-1">
							<div class="fw-divider-space divider-30 divider-lg-0"></div>
							<p class="special-heading with-decoration">
								<span class="text-capitalize ">
								<?php echo $row['page_name']; ?>
								</span>
							</p>
							<h3 class="special-heading">
								<span class="text-capitalize ">
								<?php echo $row['slug']; ?>
								</span>
							</h3>
							<div class="fw-divider-space divider-25 divider-lg-45"></div>
							<div class="text-block">
								<p>
								<?php echo $row['page_desc']; ?>
								</p>
							</div>
							<div class="fw-divider-space divider-25 divider-lg-35"></div>
							<div class="fw-divider-line-styled ls ms left-line"></div>
							<div class="fw-divider-space divider-30 divider-lg-35"></div>
							<p class="special-heading">
								<span class="text-capitalize ">
									call us now
								</span>
							</p>
			<?php
			   $sql="SELECT * FROM tbl_contact WHERE con_id=1";
			   $result=$cn->selectdb($sql);
			   if($cn->numRows($result)>0){
			   	$rowContact=$cn->fetchAssoc($result);
			   }else{
			   	header("location:404/");
			   }
		    ?>
							<h3 class="special-heading color-main thin ">
								<span class="text-capitalize ">
								<?php
                                    $conts = explode(',', $rowContact['contact_no']);
                                    if (!empty($conts[0])) {
                                    ?>
                                        <a href="callto:<?php echo $conts[0]; ?>"><?php echo $conts[0]; ?></a>
                                    <?php
                                    }
                                ?>

								</span>
							</h3>
							<div class="fw-divider-space divider-25 divider-lg-50"></div>
			<?php
                $sql = "SELECT meta_tag_description FROM tbl_page WHERE page_id=11";
                $result = $cn->selectdb($sql);
                if ($cn->numRows($result) > 0) {
                    $row = $cn->fetchAssoc($result);               
                ?>

			    <a href="<?php echo strip_tags($row['meta_tag_description']); ?>" class=" photoswipe-link-button" target="_blank">

			 <?php
                 }
             ?>
								<span>
									<i class="fa fa-play" aria-hidden="true"></i>
								</span>
								play video
							</a>
							<a class="btn about-btn btn-maincolor" href="about-us.php">read more</a>
						</div>
					</div>
				</div>
			</section>

		<?php } ?>
<!-- Ends About Us here -->

			
			<!--Section Products Starts Here-->
			<section id="services" class="ls s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
				<div class="container">
					<div class="row">

					        <?php
                              $sql = "SELECT * FROM tbl_page WHERE page_id=7";
                              $result = $cn->selectdb($sql);
                              if ($cn->numRows($result) > 0) {
                              while ($row = $cn->fetchAssoc($result)) {
                            ?>

						<div class="col-lg-12">
							<h3 class="special-heading with-decoration" style="text-align: center;">
								<span class="text-capitalize ">
								<?php echo strip_tags($row['page_name']); ?>
								</span>
							</h3>
						</div>
						<?php }} ?>
						<!-- <div class="col-lg-6">
							<div class="fw-divider-space divider-25 divider-lg-0"></div>
							<div class="text-block">
								<p>
									We manufacture all sorts of
									signs both free standing as
									well as with the help of Gantry
								</p>
							</div>
							<div class="fw-divider-space divider-30"></div>
							<a class="btn btn-maincolor" href="#">all services</a>
						</div> -->
						<style>
							.service-carousel .owl-nav {
								left: 1000px;
								opacity: 1;
								position: absolute;
								right: 0;
								-webkit-tap-color-main-color: transparent;
								text-align: center;
								top: -50px;
								transform: translateY(-50%);
							}

							@media (max-width:767px) {
								.service-carousel .owl-nav {
									left: 400px;
									opacity: 1;
									position: absolute;
									right: 0;
									-webkit-tap-color-main-color: transparent;
									text-align: center;
									top: -25px;
									transform: translateY(-50%);
								}
							}
						</style>
						<div class="col-12"> 
							<div class="fw-divider-space divider-30 divider-lg-55"></div>
							<div class="owl-carousel owl-shadowitems service-carousel" data-nav="true" data-dots="false" data-center="false" data-autoplay="false" data-margin="50" data-loop="false" data-responsive-xxl="3" data-responsive-xl="3" data-responsive-lg="3" data-responsive-md="2" data-responsive-sm="2" data-responsive-xs="1">

                        <?php
                           $sqlcatser="SELECT * FROM `tbl_category` ORDER BY recordListingID";
                           $resultcatser=$cn->selectdb($sqlcatser);
                           if($cn->numRows($resultcatser)>0){
                           while($rowserv=$cn->fetchAssoc($resultcatser))
                           {
                        ?>
								<div class="vertical-item text-center content-padding content-box-shadow content-up padding-small item-service layout-2">
									<div class="item-media">
										<img src="category/big_img/<? echo $rowserv['cat_image'];?>" alt="img">
										<div class="media-links">
											<a class="abs-link" href="product-details.php?id=<?php echo $rowserv['cat_id'];?>"></a>
										</div>
									</div>
									<div class="item-content ls">
										<h5><a href="product-details.php?id=<?php echo $rowserv['cat_id'];?>"><? echo $rowserv['cat_name'];?></a></h5>
									</div>
								</div>

						<?php } } ?>

						</div>
							<style>
								.center {
									display: flex;
									justify-content: center;
								}
							</style>
							<div class="center"><a class="btn btn-maincolor" href="#" style="text-align:center">all Products</a></div>
						</div>
					</div>
				</div>
			</section>
			<!--End Section Products-->

			<!--Section Start Partners and Quote-->
			<section class="ls s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60 c-gutter-120">
				<div class="container">
					<div class="row align-center">

					       <?php
                              $sql = "SELECT * FROM tbl_page WHERE page_id=14";
                              $result = $cn->selectdb($sql);
                              if ($cn->numRows($result) > 0) {
                              while ($row = $cn->fetchAssoc($result)) {
                            ?>

						<div class="col-lg-6 border-right">
							<div class="fw-divider-space divider-0 divider-lg-90"></div>
							<!-- <p class="special-heading with-decoration">
								<span class="text-capitalize ">
									Partners
								</span>
							</p> -->
							<h3 class="special-heading with-decoration">
								<span class="text-capitalize ">
								<?php echo strip_tags($row['page_name']); ?>
								</span>
							</h3>
							<div class="fw-divider-space divider-25 divider-lg-45"></div>
							<div class="text-block">
								<p>
								<?php echo strip_tags($row['page_desc']); ?>
								</p>
							</div>
							<?php } } ?>
           
							<div class="fw-divider-space divider-25 divider-lg-50"></div>
							<div class="owl-carousel dots-left" data-dots="true" data-center="false" data-autoplay="true" data-margin="60" data-loop="true" data-responsive-xxl="3" data-responsive-xl="3" data-responsive-lg="3" data-responsive-md="3" data-responsive-sm="3" data-responsive-xs="2">
							<?
							    $sqlclientimg="SELECT * from tbl_client";
							    $resultclientimg=$cn->selectdb($sqlclientimg);
							    if($cn->numRows($resultclientimg)>0){
                                while($rowclientimg=$cn->fetchAssoc($resultclientimg))
                                 {
                            ?>
								<div class="filter-grayscale text-center">
									<a href="#">
										<img src="client/big_img/<? echo $rowclientimg['image_title'];?>" alt="img">
									</a>
								</div>

								<? } }?>

							</div>
							<div class="fw-divider-space divider-0 divider-lg-90"></div>
						</div>
						
                         <div class="col-lg-6">
                             <div class="fw-divider-space divider-30 divider-lg-0"></div>
                             <div class="owl-carousel shortcode-quote layout-1 dots-left" data-dots="true" data-center="false" data-autoplay="false" data-margin="0" data-loop="true" data-responsive-lg="1" data-responsive-md="1" data-responsive-sm="1" data-responsive-xs="1">
                                 <?
                                   $sqlcatser = "SELECT * FROM `tbl_testimonial`"; // removed space before tbl_testimonial
                                   $resultcatser = $cn->selectdb($sqlcatser);
                                   if ($cn->numRows($resultcatser) > 0) {
                                       while ($rowserv = $cn->fetchAssoc($resultcatser)) {
                                 ?>
                                         <div class="quote-item">
                                             <div class="quote-img">
                                                 <img src="testimonial/big_img/<? echo $rowserv['image_name']; ?>" alt="img">
                                             </div>
                                             <div class="quote-content">
                                                 <h5><? echo $rowserv['image_title']; ?></h5>
                                                 <span>Happy Client</span>
                                                 <blockquote>
                                                     <p>
                                                         <? echo $rowserv['description']; ?>
                                                     </p>
                                                 </blockquote>
                                                 <!-- <div class="quote-date">
                         											<span><i class="fa fa-calendar" aria-hidden="true"></i>26 Feb 2020</span>
                         										</div> -->
                                             </div>
                                         </div>
                         
                                 <? } } ?>
                         		
                             </div>
                         </div>


					</div>
				</div>
			</section>
			<!--End Section Partners and Quote-->

			<!--Section Steps
			<section id="steps" class="ls ms s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<p class="special-heading with-decoration">
								<span class="text-capitalize">
									Easy Steps
								</span>
							</p>
							<h3 class="special-heading ">
								<span class="text-capitalize ">
									Easy Steps To Having<br> An Awesome Patio
								</span>
							</h3>
							<div class="fw-divider-space divider-25 divider-lg-45"></div>
							<div class="row steps-number-line c-gutter-0 c-mb-40">
								<div class="col-lg-3 step">
									<h3 class="step-number"></h3>
									<p class="step-title">
										Strategy
									</p>
									<span class="step-dote"><span></span></span>
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit
									</p>
								</div>
								<div class="col-lg-3 step">
									<h3 class="step-number"></h3>
									<p class="step-title">
										Organization
									</p>
									<span class="step-dote"><span></span></span>
									<p>
										Ut enim ad minim veniam, quis nostrud exercitation
									</p>
								</div>
								<div class="col-lg-3 step">
									<h3 class="step-number"></h3>
									<p class="step-title">
										Management
									</p>
									<span class="step-dote"><span></span></span>
									<p>
										Duis aute irure dolor in reprehenderit
									</p>
								</div>
								<div class="col-lg-3 step">
									<h3 class="step-number"></h3>
									<p class="step-title">
										Support
									</p>
									<span class="step-dote"><span></span></span>
									<p>
										Excepteur sint occaecat cupidatat non
									</p>
								</div>
							</div>
							<div class="mt--40"></div>
						</div>
					</div>
				</div>
			</section>
			<!--End Section Steps-->


			<!--Section Gallery Start-->
			<section id="gallery" class="ls s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<p class="special-heading with-decoration text-center">
								<span class="text-capitalize">
									What We Do
								</span>
							</p>
							<h3 class="special-heading text-center">
								<span class="text-capitalize ">
									Recent Projects
								</span>
							</h3>
							<div class="fw-divider-space  divider-30"></div>
							<!-- <div class="row justify-content-center">
								<div class="col-lg-12">
									<div class="filters gallery-filters">
										<a href="#" data-filter="*" class="active selected">All</a>
										<a href="#" data-filter=".walkways">Walkways</a>
										<a href="#" data-filter=".driveways">Driveways</a>
										<a href="#" data-filter=".landscaping">Landscaping</a>
										<a href="#" data-filter=".ambiance">Ambiance</a>
									</div>
								</div>
							</div> -->
							<div class="row isotope-wrapper masonry-layout gallery-shortcode c-gutter-30 c-mb-30" data-filters=".gallery-filters">

        <?php
          $sql = "SELECT multi_images FROM tbl_gallery WHERE gallery_id=1";
          $result = $cn->selectdb($sql);
          if ($cn->numRows($result) > 0) {
              $row = $cn->fetchAssoc($result);
              $Img = explode(',', $row['multi_images']);          
              // Limiting to 6 images
              $numImagesToShow = min(count($Img), 6);         
              for ($i = 0; $i < $numImagesToShow; $i++) {
          ?>

                            <div class="col-lg-4 col-md-6 walkways">
                                <div class="vertical-item item-gallery only-img ds">
                                    <div class="item-media">
                                        <img src="galleryF/big_img/<?php echo $Img[$i]; ?>" alt="">
                                        <div class="media-links">
                                            <div class="links-wrap">
                                                <a class="link-zoom photoswipe-link" title="" href="images/gallery/full/01.jpg"></a>
                                                <a class="link-anchor" title="" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

        <?php } } ?>

							</div>
							<!-- .isotope-wrapper-->
							<div class="mb--30"></div>
						</div>
					</div>
				</div>
			</section>
			<!--End Section Gallery-->

			<!--Section Contact Us-->
			<section class="ls s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
				<div class="cover-image ds  s-cover-right s-cover-small ">
					<img src="images/contact-bg.jpg" alt="img">
				</div>
				<div class="container">
					<div class="row align-center">
						<div class="col-lg-6">

			<?php
               $sql = "SELECT page_name,page_desc FROM tbl_page WHERE page_id=15";
               $result = $cn->selectdb($sql);
               if ($cn->numRows($result) > 0) {
                   $row = $cn->fetchAssoc($result);
            ?>
							<p class="special-heading with-decoration">
								<span class="text-capitalize">
								<?php echo strip_tags($row['page_name']); ?>
								</span>
							</p>
			<?php } ?>
							<h3 class="special-heading">
								<span class="text-capitalize ">
								<?php echo strip_tags($row['page_desc']); ?>
								</span>
							</h3>
							<div class="fw-divider-space divider-25 divider-lg-35"></div>
							<div class="fw-divider-line-styled ls ms left-line"></div>
							<div class="fw-divider-space divider-30 divider-lg-35"></div>
							<p class="special-heading">
								<span class="text-capitalize ">
									call us now
								</span>
							</p>
							<h3 class="special-heading color-main thin ">
								<span class="text-capitalize ">
								<?php
                                    $conts = explode(',', $rowContact['contact_no']);
                                    if (!empty($conts[0])) {
                                    ?>
                                        <a href="callto:<?php echo $conts[0]; ?>"><?php echo $conts[0]; ?></a>
                                    <?php
                                    }
                                ?>
								</span>
							</h3>
						</div>
						<div class="col-lg-6">
							<div class="fw-divider-space divider-30 divider-lg-0"></div>
							<div class="form-wrapper p-30 p-lg-60 p-xl-80 box-shadow ls">
								<form class="contact-form c-mb-30 c-gutter-10" method="post" action="">
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group has-placeholder">
												<label for="name">Your Name <span class="required">*</span></label>
												<input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control" placeholder="Your Name*">
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group has-placeholder">
												<label for="email">Your Email<span class="required">*</span></label>
												<input type="email" aria-required="true" size="30" value="" name="email" id="email" class="form-control" placeholder="Your Email*">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 ">
											<div class="form-group has-placeholder">
												<label for="message">Message</label>
												<textarea aria-required="true" rows="3" cols="45" name="message" id="message" class="form-control" placeholder="Your Message"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 mt-10">
											<div class="form-group">
												<input class="btn btn-maincolor" name="submit-form" type="submit" value="Submit">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--End Section Contact Us-->

			<div class="fw-divider-space divider-0 divider-lg-130 divider-xl-150"></div>

			<!--Section Steps 2--
			<section class="ls container-px-0">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="row steps-number c-gutter-110">
								<div class="col-lg-4 step ds cover-image s-overlay py-40 py-xl-110">
									<img src="images/steps/01.jpg" alt="step1">
									<h3 class="step-number">01</h3>
									<div class="step-content">
										<h4 class="step-title">
											Pavers Installation
										</h4>
										<p class="step-text">
											Our vetted, qualified, and beyond certified contractors can install Pavers
											for you
										</p>
									</div>
								</div>
								<div class="col-lg-4 step cs cover-image s-overlay py-40 py-xl-110">
									<img src="images/steps/02.jpg" alt="step1">
									<h3 class="step-number">02</h3>
									<div class="step-content">
										<h4 class="step-title">
											Paving Replacement
										</h4>
										<p class="step-text">
											It’s almost always preferable to replace pavers rather than patch it.
										</p>
									</div>
								</div>
								<div class="col-lg-4 step ls cover-image s-overlay py-40 py-xl-110">
									<img src="images/steps/03.jpg" alt="step1">
									<h3 class="step-number">03</h3>
									<div class="step-content">
										<h4 class="step-title">
											Paving Removal
										</h4>
										<p class="step-text">
											Let our vetted contractors remove those outdated pavers
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--End Section Steps 2-->

			<!--Section Blog-->
			<!-- <section id="blog" class="ls s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<p class="special-heading with-decoration text-center">
								<span class="text-capitalize">
									blog posts
								</span>
							</p>
							<h3 class="special-heading text-center">
								<span class="text-capitalize ">
									Recent News
								</span>
							</h3>
							<div class="fw-divider-space divider-30 divider-lg-50"></div>
							<div class="owl-carousel shortcode-blog owl-shadowitems" data-dots="false"
								data-center="false" data-nav="false" data-autoplay="false" data-margin="50"
								data-loop="false" data-responsive-xxl="3" data-responsive-xl="3" data-responsive-lg="2"
								data-responsive-md="2" data-responsive-sm="1" data-responsive-xs="1">
								<article
									class="vertical-item ls content-padding box-shadow post type-post status-publish format-standard has-post-thumbnail">
									<div class="item-media post-thumbnail">
										<a href="#">
											<img src="images/blog/01.jpg" alt="img">
										</a>
									</div>
									<div class="item-content">
										<header class="entry-header">
											<!-- <div class="entry-meta">
												<span class="cat-links">
													<a href="blog-right.html" rel="category tag">
														patios
													</a>
												</span>
											</div> --
											<h5 class="entry-title">
												<a href="#" rel="bookmark">
													Navigating the Road to Safety: A Comprehensive Guide to Road
													Furniture
												</a>
											</h5>
										</header>
										<div class="entry-footer">
											<div class="fw-divider-line-styled ls ms left-line"></div>
											<div class="fw-divider-space divider-30 divider-lg-35"></div>
											<div class="entry-meta">
												<span class="author vcard">
													by
													<img src="images/team/testimonial1.jpg" alt="img">
													<a class="url fn n" href="blog-right.html">Roger P. Johnson</a>
												</span> --
												<div>
													<span class="more-button">
														<a class="btn btn-maincolor" href="blog-single-right.html">read
															more</a>
													</span>
													<span class="social-icons">
														<a href="https://www.facebook.com/" class="fa fa-facebook"
															title="facebook"></a>
														<a href="https://www.instagram.com/" class="fa fa-instagram"
															title="instagram"></a>
														<a href="https://web.telegram.org/" class="fa fa-paper-plane"
															title="telegram"></a>
													</span> 
												</div>
											</div>
										</div>
									</div>
								</article>
								<article
									class="vertical-item ls content-padding box-shadow post type-post status-publish format-standard has-post-thumbnail">
									<div class="item-media post-thumbnail">
										<a href="#">
											<img src="images/blog/02.jpg" alt="img">
										</a>
									</div>
									<div class="item-content">
										<header class="entry-header">
											<div class="entry-meta">
												<span class="cat-links">
													<a href="blog-right.html" rel="category tag">
														design
													</a>
												</span>
											</div> --
											<h5 class="entry-title">
												<a href="#" rel="bookmark">
													Designing Tomorrow's Streets: The Role of Road Furniture in Urban
													Planning
												</a>
											</h5>
										</header>
										<div class="entry-footer">
											<div class="fw-divider-line-styled ls ms left-line"></div>
											<div class="fw-divider-space divider-30 divider-lg-35"></div>
											<div class="entry-meta">
												 <span class="author vcard">
													by
													<img src="images/team/testimonial1.jpg" alt="img">
													<a class="url fn n" href="#">Marlene G. Purser</a>
												</span> --
												<div>
													<span class="more-button">
														<a class="btn btn-maincolor" href="#">read
															more</a>
													</span>
													 <span class="social-icons">
														<a href="https://www.facebook.com/" class="fa fa-facebook"
															title="facebook"></a>
														<a href="https://www.instagram.com/" class="fa fa-instagram"
															title="instagram"></a>
														<a href="https://web.telegram.org/" class="fa fa-paper-plane"
															title="telegram"></a>
													</span> --
												</div>
											</div>
										</div>
									</div>
								</article>
								<article
									class="vertical-item ls content-padding box-shadow post type-post status-publish format-standard has-post-thumbnail">
									<div class="item-media post-thumbnail">
										<a href="#">
											<img src="images/blog/03.jpg" alt="img">
										</a>
									</div>
									<div class="item-content">
										<header class="entry-header">
											 <div class="entry-meta">
												<span class="cat-links">
													<a href="blog-right.html" rel="category tag">
														brick
													</a>
												</span>
											</div> --
											<h5 class="entry-title">
												<a href="#" rel="bookmark">
													Decoding Road Signage: The Language of Safety and Efficiency
												</a>
											</h5>
										</header>
										<div class="entry-footer">
											<div class="fw-divider-line-styled ls ms left-line"></div>
											<div class="fw-divider-space divider-30 divider-lg-35"></div>
											<div class="entry-meta">
												<span class="author vcard">
													by
													<img src="images/team/testimonial1.jpg" alt="img">
													<a class="url fn n" href="#">James A. Bart</a>
												</span> --
												<div>
													<span class="more-button">
														<a class="btn btn-maincolor" href="#">read
															more</a>
													</span>
													<span class="social-icons">
														<a href="https://www.facebook.com/" class="fa fa-facebook"
															title="facebook"></a>
														<a href="https://www.instagram.com/" class="fa fa-instagram"
															title="instagram"></a>
														<a href="https://web.telegram.org/" class="fa fa-paper-plane"
															title="telegram"></a>
													</span> --
												</div>
											</div>
										</div>
									</div>
								</article>
								<article
									class="vertical-item ls content-padding box-shadow post type-post status-publish format-standard has-post-thumbnail">
									<div class="item-media post-thumbnail">
										<a href="#">
											<img src="images/blog/04.jpg" alt="img">
										</a>
									</div>
									<div class="item-content">
										<header class="entry-header">
											 <div class="entry-meta">
												<span class="cat-links">
													<a href="blog-right.html" rel="category tag">
														patios
													</a>
												</span>
											</div> --
											<h5 class="entry-title">
												<a href="#" rel="bookmark">
													Beyond the Surface: The Unseen Engineering Marvels of Road Furniture
												</a>
											</h5>
										</header>
										<div class="entry-footer">
											<div class="fw-divider-line-styled ls ms left-line"></div>
											<div class="fw-divider-space divider-30 divider-lg-35"></div>
											<div class="entry-meta">
												<span class="author vcard">
													by
													<img src="images/team/testimonial1.jpg" alt="img">
													<a class="url fn n" href="#">Roger P. Johnson</a>
												</span>
												<div>
													<span class="more-button">
														<a class="btn btn-maincolor" href="#">read
															more</a>
													</span>
													<span class="social-icons">
														<a href="https://www.facebook.com/" class="fa fa-facebook"
															title="facebook"></a>
														<a href="https://www.instagram.com/" class="fa fa-instagram"
															title="instagram"></a>
														<a href="https://web.telegram.org/" class="fa fa-paper-plane"
															title="telegram"></a>
													</span>
												</div>
											</div>
										</div>
									</div>
								</article>
							</div>
						</div>
					</div>
				</div>
			</section>
			End Section Blog -->


			<?php
			include_once 'footer.php';
			?>

<?php
if(isset($_POST['submit-form'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO `tbl_contactdetails`(`contact_name`, `email`, `message`) VALUES('".$name."','".$email."','".$message."')";
    $cn->insertdb($sql);

    $to = "sales@smartsign.co.ke";
    $subject = "Contact Us - Message from ".$name; // Provide a subject for the email
    $message = "<html><head><title>Contact Details</title></head><body><p><table><tr><td>Name</td><td>".$name."</td></tr><tr><td>Email-ID. </td><td>".$email."</td></tr><tr><td>Message</td><td>".$message."</td></tr></table></p></body></html>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $from = $email;
    $headers .= "From: ".$from."\r\n";
    if($domain != "localhost"){ // Assuming $domain is defined elsewhere
        mail($to, $subject, $message, $headers);
        echo "<script>alert('Message has been sent');</script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}
?>