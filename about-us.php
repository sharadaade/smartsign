<?php
$page_id=8;
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

            <?php
            $sql = "SELECT page_name,page_desc,slug,multi_images FROM tbl_page WHERE page_id=8";
            $result = $cn->selectdb($sql);
            if ($cn->numRows($result) > 0) {
                $row = $cn->fetchAssoc($result);
                $Img = explode(',', $row['multi_images']);
            ?>

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
									who we are
								</span>
							</h3>
							<div class="fw-divider-space divider-25 divider-lg-45"></div>
							<div class="text-block">
								<p>
                                <?php echo $row['page_desc']; ?>
								</p>
							</div>
							<!-- <div class="fw-divider-space divider-25 divider-lg-35"></div>
							<div class="fw-divider-line-styled ls ms left-line"></div> -->
							<!-- <div class="fw-divider-space divider-30 divider-lg-35"></div>
							<p class="special-heading">
								<span class="text-capitalize ">
									call us now
								</span>
							</p>
							<h3 class="special-heading color-main thin ">
								<span class="text-capitalize ">
									<a href="callto:(+254)723337560">(+254)723337560</a>
								</span>
							</h3> -->
							
						</div>
					</div>
				</div>
			</section>

             <?php
             }
             ?>
            <!-- Section Ends here -->

             <?
             $sqlproduct = "SELECT * from tbl_page where page_id=11";
             $resultprod = $cn->selectdb($sqlproduct);
             if ($cn->numRows($resultprod) > 0) {
             	$rowprod = $cn->fetchAssoc($resultprod);
             ?>

            <!--Section practice-->
			<section id="steps" class="ls ms s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
				<div class="container">
					<div class="row">
						<div class="col-12">
							
							<h3 class="special-heading ">
								<span class="text-capitalize ">
                                <? echo $rowprod['page_name']; ?>
								</span>
							</h3>
                            <p class="special-heading with-decoration" style="max-width:100%;">
								<span class="text-capitalize">
                                <? echo strip_tags($rowprod['page_desc']); ?>
								</span>
							</p>
							<div class="fw-divider-space divider-25 divider-lg-45"></div>
							<div class="row steps-number-line c-gutter-0 c-mb-40">

                            <?php
                              $sql = "SELECT * FROM tbl_addmore WHERE page_id=11";
                              $result = $cn->selectdb($sql);
                              if ($cn->numRows($result) > 0) {
                              while ($row = $cn->fetchAssoc($result)) {
                            ?>


								<div class="col-lg-3 step">
									<h3 class="step-number"></h3>
									<p class="step-title">
                                    <?php echo strip_tags($row['title']); ?>
									</p>
									<span class="step-dote"><span></span></span>
									<p>
                                    <?php echo strip_tags($row['small_desc']); ?>
									</p>
								</div>

                              <?php }
                              } ?>

							</div>
							<div class="mt--40"></div>
						</div>
					</div>
				</div>
			</section>
			<!--End Section practise-->
<? } ?>
            <!--Section Questions-->

                             <?php
                              $sql = "SELECT * FROM tbl_page WHERE page_id=12";
                              $result = $cn->selectdb($sql);
                              if ($cn->numRows($result) > 0) {
                              while ($row = $cn->fetchAssoc($result)) {
                            ?>
    
			<section class="ds ms any-question s-overlay s-pt-lg-100 s-pt-md-90 s-pt-60 s-pb-lg-100 s-pb-md-90 s-pb-60" style="background: url('page/big_img/<?php echo $row['image'];?>') center/cover;">
				<div class="container">
					<div class="row">
						<div class="col-12 text-center">
							<h3 class="special-heading text-center">
								<span class="text-capitalize ">
                                <?php echo strip_tags($row['page_name']); ?>
								</span>
							</h3>
							<p class="special-heading text-center">
								<span>
                                <?php echo strip_tags($row['page_desc']); ?>
								</span>
							</p>
							<div class="fw-divider-space divider-30 divider-lg-50"></div>
							<a href="contact.php" class="btn btn-maincolor medium-btn">request a quote</a>
						</div>
					</div>
				</div>
			</section>
            <?php }} ?>
			<!--End Section Questions-->

             <?
             $sqlcounters = "SELECT * from tbl_addmore where page_id=13";
             $resultcounters = $cn->selectdb($sqlcounters);
             if ($cn->numRows($resultcounters) > 0) {
             ?>

            <!--Section Price-->
			<section class="ls s-pt-xl-100 s-pt-lg-100 s-pt-md-90 s-pt-60 s-pb-xl-120 s-pb-lg-100 s-pb-md-60 s-pb-30 c-mb-30">
				<div class="container">
                    <div class="row">
                    <?php
                              $sql = "SELECT * FROM tbl_page WHERE page_id=13";
                              $result = $cn->selectdb($sql);
                              if ($cn->numRows($result) > 0) {
                              while ($row = $cn->fetchAssoc($result)) {
                            ?>
						<div class="col-12">
                        <h3 class="special-heading text-center">
								<span class="text-capitalize ">
                                <?php echo strip_tags($row['page_name']); ?>
								</span>
							</h3>
							<p class="special-heading with-decoration text-center">
								<span class="text-capitalize ">
                                <?php echo strip_tags($row['page_desc']); ?>
								</span>
							</p>
							
							<div class="fw-divider-space divider-5 divider-lg-20"></div>
						</div>
                        <?php }} ?>
                        

                        <?
						$flag = true;
						while ($rowintro = $cn->fetchAssoc($resultcounters)) {
							if ($flag) {
								$flag = false;
						?>

                        
						<div class="col-lg-3 col-md-4">
							<div class="pricing-plan box-shadow ls">
								<div class="plan-wrap">
									<div class="plan-header">
                                    <img src="icon/big_img/<?php echo $rowintro['extra_icon'];?>" alt="img">
										<h5>
                                        <? echo strip_tags($rowintro['title']); ?>
										</h5>
									</div>
									<div class="plan-features">
										<p>
                                        <? echo strip_tags($rowintro['small_desc']); ?>
										</p>
									</div>
									
								</div>
								
							</div>
						</div>
							<? } else {
								$flag = true;
							?>
                       

                        
						<div class="col-lg-3 col-md-4">
							<div class="pricing-plan box-shadow cs">
								<div class="plan-wrap">
									<div class="plan-header">
                                    <img src="icon/big_img/<?php echo $rowintro['extra_icon'];?>" alt="img">
										<h5>
                                        <? echo strip_tags($rowintro['title']); ?>
										</h5>
									</div>
									<div class="plan-features">
										<p>
                                        <? echo strip_tags($rowintro['small_desc']); ?>
										</p>
									</div>									
								</div>
							</div>
						</div>
                        
                        <? }
						} ?>
                                               
					</div>
				</div>
			</section>
            <? } ?>
			<!--End Section Price-->

        <?php
		include_once 'footer.php';
		?>