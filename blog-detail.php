<?php
$page_id=3;
$slug=$_GET['bid'];
include_once 'header.php';
?>

                      <?php
                        $sql="SELECT blog_name,description,blog_image,bdate,slug FROM tbl_blog WHERE slug='$slug'";
                        $result=$cn->selectdb($sql);
                        if($cn->numRows($result)>0){
                            $row=$cn->fetchAssoc($result);
                    ?>

<section class="page_title c-gutter-0 container-px-xl-0 ds ms s-overlay s-parallax s-pt-xl-100 s-pt-md-100 s-pb-md-80 s-pt-60 s-pb-60">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1><?php echo $row['blog_name'];?></h1>
						</div>
					</div>
				</div>
			</section> 


<div class="rs-blog inner single pt-100 pb-100 md-pt-80 md-pb-80">
        <div class="container">
            <div class="row">

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

        <div class="col-lg-4 md-mb-50 pl-35 lg-pl-15">
                <div class="sidebar-popular-post sidebar-grid shadow mb-50">
                    <div class="sidebar-title">
                        <h5 class="title mb-20 p-2">Recent Post</h5>
                    </div>
                    <?php
                        $sql = "SELECT blog_name, description, blog_image, bdate, slug FROM tbl_blog ORDER BY recordListingID LIMIT 5";
                        $result = $cn->selectdb($sql);
                        if ($cn->numRows($result) > 0) {
                            while ($row = $cn->fetchAssoc($result)) {
                    ?>
                    <div class="single-post mb-20 row p-2">
                        <div class="post-image col-6">
                            <a href="Blog-Detail/<?php echo $row['slug']; ?>"><img style="object-fit: cover; height: 80px; width: auto;" src="blog/big_img/<?php echo $row['blog_image']; ?>" alt="post image"></a>
                        </div>
                        <div class="col-6">
                            <div>
                                <p class="margin-0" style="font-size:14px;"><a href="Blog-Detail/<?php echo $row['slug']; ?>">
                                        <?php echo $row['blog_name']; ?>
                                    </a></p>
                            </div>                  
                                <i class="fa fa-calendar" style="font-size:12px; color:red;"> <?php echo date("F d, Y", strtotime($row['bdate']));?></i>                 
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>

                         <?php
		                 	$sql="SELECT * FROM tbl_contact WHERE con_id=1";
		                 	$result=$cn->selectdb($sql);
		                 	if($cn->numRows($result)>0){
		                 		$rowContact=$cn->fetchAssoc($result);
		                 	}else{
		                 		header("location:404/");
		                 	}
		                 ?>

                             <div class="icon-box text-center ls box-shadow">
						    		<div class="icon-styled color-main fs-60">
						    			<i class="ico ico-location"></i>
						    		</div>
						    		<h5>our location</h5>
						    		<p><?php echo $rowContact['contact_desc'];?></p>
						    	</div>
    
                                <div class="icon-box text-center ls box-shadow mt-2">
						    		<div class="icon-styled color-main fs-60">
						    			<i class="ico ico-paper-plane"></i>
						    		</div>
						    		<h5>Email Us</h5>
						    		<?php
						    			$emls=explode(',',$rowContact['email']);
						    			for ($i=0; $i < count($emls); $i++) { 
						    		?>
						    		<p><a href="mailto:<?php echo $emls[$i];?>"><?php echo $emls[$i];?></a></p>
						    		<?php
						    			}
						    		?>
						    	</div>

                          <div class="icon-box text-center ls box-shadow mt-2">
								<div class="icon-styled color-main fs-60">
									<i class="ico ico-support"></i>
								</div>
								<h5>call us</h5>
								<?php
									$conts=explode(',',$rowContact['contact_no']);
									for ($i=0; $i < count($conts); $i++) { 
								?>
                                    <p><a href="tel:<?php echo $conts[$i];?>"><?php echo $conts[$i];?></a></p>
                                    <?php
									}
								?>
							</div>
   
   
   
                        </div>
                    </div> 
                    <!-- left div end -->

                            
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </div>

        <?php
		include_once 'footer.php';
		?>