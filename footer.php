<style type="text/css">
				.whatsapp_box {
					position: fixed;
					bottom: 10px;
					left: 10px;
					z-index: 999;
					height: 60px;
					width: 60px;
					border-radius: 50%;
					background-color: #20B038;
					padding: 10px 15px;
				}

				.whatsapp_box a {
					height: 100%;
					width: 100%;
				}

				.whatsapp_box a i {
					font-size: 35px;
					color: #fff;
				}
			</style>

        <?php
			$sql="SELECT * FROM tbl_contact WHERE con_id=1";
			$result=$cn->selectdb($sql);
			if($cn->numRows($result)>0){
				$rowContact=$cn->fetchAssoc($result);
			}else{
				header("location:404/");
			}
		?>

			<div class="whatsapp_box">
			<?php
                 $conts = explode(',', $rowContact['contact_no']);
                 if (!empty($conts[1])) {
            ?>
				<a href="https://wa.me/<?php echo $conts[1]; ?>" target="_blank">
					<i class="fa fa-whatsapp"></i>
				</a>
				<?php
                    }
                ?>
			</div>

			<footer class="page_footer footer-1 text-center text-sm-left  ds s-pt-lg-100 s-pt-md-90 s-pt-60  s-pb-30 c-mb-30">
				<div class="container">
					<div class="row align-center ">
						<div class="col-lg-5 col-12 text-center text-lg-left">
							<div class="widget widget_nav_menu">
								<ul class="list-bordered">
									<!-- <li>
										<a href="#">News</a>
									</li> -->

									<li>
										<a href="Products/">Products</a>
									</li>
									<li>
										<a href="Contact-Us/">Contact</a>
									</li>
								</ul>
							</div>
						</div>
						<?php
                            $sql = "SELECT image_name FROM tbl_logo WHERE logo_id=2";
                            $result = $cn->selectdb($sql);
                            if ($cn->numRows($result) > 0) {
                                $row = $cn->fetchAssoc($result);
                            ?>
						<div class="col-lg-2 col-12 text-center">
							<a href="./" class="logo">
								<img src="logo/big_img/<?php echo $row['image_name']; ?>" alt="">
							</a>
						</div>
						<?php
                            }
                            ?>
						<div class="col-lg-5 col-12 text-center text-lg-right">
							<div id="mwt_bloginfo-2" class="widget widget_bloginfo">
								<span class="social-icons">
								<?php
                                $sql = "SELECT icon_name,link_url FROM tbl_socialmedia ORDER BY recordListingID";
                                $result = $cn->selectdb($sql);
                                if ($cn->numRows($result) > 0) {
                                    while ($row = $cn->fetchAssoc($result)) {
                                ?>
											<a target="_blank" href="<? echo $row['link_url'] ?>" class="fa fa-<? echo $row['icon_name'] ?>" target="_blank"></a>
								<? }
                                } ?>
								</span>
							</div>
						</div>
					</div>
				</div>
			</footer>


			<section class="page_copyright copyright-1 ds s-pb-15 c-mb-45">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-12 order-1 order-lg-0 text-center ">
							<p class="copyright-text"><span>&copy; 2024 SmartSign and Developed by iced infotech</span>
							</p>
						</div>
						<!-- <div class="col-lg-4">
							<div class="widget widget_mailchimp">
								<form class="signup" action="/">
									<input name="email" type="email" class="form-control mailchimp_email"
										placeholder="Email your Email">
									<button type="submit" class="search-submit">
										<span class="screen-reader-text">
											Subscribe
										</span>
									</button>
									<div class="response"></div>
								</form>
							</div>
						</div>
						<div class="col-lg-8 text-center text-lg-right">
							<p>
								We’ll never share your details.<br>
								See our Privacy Policy.
							</p>
						</div> -->
					</div>
				</div>
			</section>


		</div><!-- eof #box_wrapper -->
	</div><!-- eof #canvas -->


	<script src="js/compressed.js"></script>
	<script src="js/main.js"></script>
	<!-- <script src="js/switcher.js"></script> -->

	<!-- Google Map Script -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0pr5xCHpaTGv12l73IExOHDJisBP2FK4&callback=initGoogleMap">
	</script>

</body>

</html>