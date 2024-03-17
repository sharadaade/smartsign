<?php
$page_id=1;
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
			$sql="SELECT * FROM tbl_contact WHERE con_id=1";
			$result=$cn->selectdb($sql);
			if($cn->numRows($result)>0){
				$rowContact=$cn->fetchAssoc($result);
			}else{
				header("location:404/");
			}
		?>

			<section class="ls ms s-pt-xl-50 s-pt-lg-50 s-pt-md-40 s-pt-40 s-pb-xl-40 s-pb-lg-40 s-pb-md-30 s-pb-20 c-gutter-50 c-mb-30 c-mb-lg-50">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<p class="special-heading with-decoration text-center">
								<span class="text-capitalize">
									contacts
								</span>
							</p>
							<h3 class="special-heading text-center">
								<span class="text-capitalize ">
									our contacts
								</span>
							</h3>
						</div>
						<div class="col-lg-4">
							<div class="icon-box text-center ls box-shadow">
								<div class="icon-styled color-main fs-60">
									<i class="ico ico-location"></i>
								</div>
								<h5>our location</h5>
								<p><?php echo $rowContact['contact_desc'];?></p>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="icon-box text-center ls box-shadow">
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
						</div>
						<div class="col-lg-4">
							<div class="icon-box text-center ls box-shadow">
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
				</div>
			</section>

			<section class="container-px-0">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
						<?php echo $rowContact['maptag'];?>
						</div>
					</div>
				</div>
			</section>

			<section class="ls contact-section s-py-xl-150 s-py-lg-130 s-py-md-90 s-py-60">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-12 offset-lg-12 animate" data-animation="scaleAppear">
							<div class="form-wrapper p-30 p-lg-60 p-xl-80 box-shadow ls">
							<form class="c-mb-30 c-gutter-10" method="post" action="">
                                   <div class="row">
                                       <div class="col-12 form-title">
                                           <h3>Get in touch</h3>
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-sm-6">
                                           <div class="form-group has-placeholder">
                                               <label for="name">Your Name <span class="required">*</span></label>
                                               <input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control border pt-3" placeholder="Your Name*">
                                           </div>
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="form-group has-placeholder">
                                               <label for="email">Your Email<span class="required">*</span></label>
                                               <input type="email" aria-required="true" size="30" value="" name="email" id="email" class="form-control border pt-3" placeholder="Your Email*">
                                           </div>
                                       </div>
                                   </div>
                               
                                   <div class="row">
                                       <div class="col-sm-6">
                                           <div class="form-group has-placeholder">
                                               <label for="contact">Your Contact <span class="required">*</span></label>
                                               <input type="text" aria-required="true" size="30" value="" name="phone" id="phone" class="form-control border pt-3" placeholder="Your Contact*">
                                           </div>
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="form-group has-placeholder">
                                               <label for="subject">Subject<span class="required">*</span></label>
                                               <input type="text" aria-required="true" size="30" value="" name="subject" id="subject" class="form-control border  pt-3" placeholder="Enter Subject">
                                           </div>
                                       </div>
                                   </div>
                               
                                   <div class="row">
                                       <div class="col-sm-12">
                                           <div class="form-group has-placeholder">
                                               <label for="message">Message</label>
                                               <textarea aria-required="true" name="message" id="message" class="form-control border  pt-3" placeholder="Your Message"></textarea>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-sm-12 mt-10">
                                           <div class="form-group">
                                               <input class="btn btn-maincolor" name="submit-form" type="submit" value="Send Request">
                                           </div>
                                       </div>
                                   </div>
                                </form>

							</div>
						</div>
						<!--.col-* -->
					</div>
				</div>
			</section>

		<?php
		include_once 'footer.php';
		?>

<?php
	if(isset($_POST['submit-form'])){


		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$subject="Contact Us - ".$_POST['subject'];
		$message=$_POST['message'];

		$sql="INSERT INTO `tbl_contactdetails`(`contact_name`, `email`, `phone`, `subject`, `message`) VALUES('".$name."','".$email."','".$phone."','".$subject."','".$message."')";
		$cn->insertdb($sql);

		$to="sales@smartsign.co.ke";
		$message = "<html><head><title>Contact Details</title></head><body><p><table><tr><td>Name</td><td>".$name."</td></tr><tr><td>Email-ID. </td><td>".$email."</td></tr><tr><td>Phone </td><td>".$phone."</td></tr><tr><td>Message</td><td>".$message."</td></tr></table></p></body></html>";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$from=$email;
		$headers .= "From: ".$from."\r\n";
		if($domain!="localhost"){
			mail($to,$subject,$message,$headers);
			echo "<script>alert('Message has been send');</script>";
		}else{
			echo "<script>alert('Error');</script>";
		}
	}
?>
