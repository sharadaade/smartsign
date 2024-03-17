<?php
$page_id=2;
include_once 'header.php';
?>

<?php
   $sql="SELECT * FROM tbl_page WHERE page_id=$page_id";
   $result=$cn->selectdb($sql);
   if($cn->numRows($result)>0){
      $rowH=$cn->fetchAssoc($result);
      $mulimg=array_filter(explode(",",$rowH['multi_images']));
      //print_r($mulimg);
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
						<div class="col-12">
							<div class="row vertical-tabs video-tabs c-gutter-0">

                            
								
								<div class="col-lg-8">
									
                                    <div class="row">
                                       <div class="col-12 form-title">
                                           <h5>CAREER FORM</h5>
                                       </div>
                                   </div>
										                                  
                                   <form class="c-mb-30 c-gutter-10" method="post" action="" enctype="multipart/form-data">
                                   <div class="row">
                                       <div class="col-sm-6 p-1">
                                           <div class="form-group has-placeholder">
                                               <label for="name">Your Name <span class="required">*</span></label>
                                               <input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control border pt-3" placeholder="Your Name*">
                                           </div>
                                       </div>
                                       <div class="col-sm-6 p-1">
                                           <div class="form-group has-placeholder">
                                               <label for="email">Your Email<span class="required">*</span></label>
                                               <input type="email" aria-required="true" size="30" value="" name="email" id="email" class="form-control border pt-3" placeholder="Your Email*">
                                           </div>
                                       </div>
                                   </div>
                               
                                   <div class="row">
                                       <div class="col-sm-6 p-1">
                                           <div class="form-group has-placeholder">
                                               <label for="contact">Your Contact <span class="required">*</span></label>
                                               <input type="text" aria-required="true" size="30" value="" name="phone" id="phone" class="form-control border pt-3" placeholder="Your Contact*">
                                           </div>
                                       </div>
                                       <div class="col-sm-6 p-1">
                                           <div class="form-group has-placeholder">
                                               <label for="subject">Subject<span class="required">*</span></label>
                                               <input type="text" aria-required="true" size="30" value="" name="subject" id="subject" class="form-control border  pt-3" placeholder="Enter Subject">
                                           </div>
                                       </div>
                                   </div>

                                   <div class="row">
                                       <div class="col-sm-6 p-1">
                                           <div class="form-group has-placeholder">
                                               <label for="experience">Experience <span class="required">*</span></label>
                                               <input aria-required="true" type="text" class="form-control border pt-3" name="experience" id="experience" placeholder="Experience">
                                           </div>
                                       </div>

                                       <div class="col-sm-6 p-1">
                                           <div class="form-group has-placeholder">
                                               <label for="designation">Designation <span class="required">*</span></label>
                                               <input aria-required="true" type="text" class="form-control border pt-3" name="designation" id="designation" placeholder="designation">
                                           </div>
                                       </div>
                                      
                                   </div>
                               
                                   <div class="row">
                                   <div class="col-sm-12 p-1">
                                           <div class="form-group has-placeholder">
                                               <label for="file">Resume Upload<span class="required">*</span></label>
                                               <input aria-required="true" type="file" class="form-control border p-2" name="file" id="file" placeholder="Resume Upload" data-show-upload="false" data-show-caption="true" required>
                                           </div>
                                       </div>

                                       <div class="col-sm-12 p-1">
                                           <div class="form-group has-placeholder">
                                               <label for="message">Message</label>
                                               <textarea aria-required="true" name="message" id="message" class="form-control border  pt-3" placeholder="Your Message"></textarea>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="row">
                                   
                                       <div class="col-sm-12 mt-10 p-1">
                                           <div class="form-group">
                                               <input class="btn btn-maincolor" name="submitcareer" type="submit" value="Send Request">
                                           </div>
                                       </div>
                                   </div>
                                </form>
									</div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-3 border p-1"style="background-image: url('pageF/big_img/<?php echo $mulimg[0];?>'); background-size: cover; background-position: center;"> 
                                        <h6>Currently Hiring :</h6>
                                        <p>
                                        <?php echo $rowH['page_desc'];?>
                                        </p>                                                     
								</div>
                                

                                
							</div>
						</div>
					</div>
				</div>
			</section>

<?php
include_once 'footer.php';
?>


<?php
    if(isset($_POST['submitcareer'])){

      $name=$_POST['name'];
      $phone=$_POST['phone'];
      $email=$_POST['email'];
      $designation = $_POST['designation'];
      $message=$_POST['message'];
      $experience=$_POST['experience'];

       $form_image="";
        if($_FILES['file']['size'] > 0)
        {
            // $allowed_types = array ( 'image/jpg', 'image/jpeg', 'image/png' );
            // $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            // $detected_type = finfo_file( $fileInfo, $_FILES['file']['tmp_name'] );
            
            // if ( !in_array($detected_type, $allowed_types) ) {
            //     display_error("Please select a valid image file!");
            //     exit();
            // }
            $form_image = rand(1000,9999).$_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'],"career/".$form_image);
            //$image_file_link = $_SERVER['HTTP_HOST'].'career/'.$form_image;
        }
        else
        {
            display_error("Please select file!");
            exit();
        }

        $cn->insertdb("INSERT INTO `tbl_career_info`(`cname`, `cemail`, `cphone`,`cexperience`, `capply`, `cresume`,`cmsg`) VALUES ('".$name."','".$email."','".$phone."','".$experience."','".$designation."','".$form_image."','".$message."')");

         $to="";
         $contact=$cn->selectdb("SELECT email FROM tbl_contact WHERE `con_id`=1");
             while($row_contact = mysqli_fetch_array($contact)){
                 $contactnom=array_filter(explode(",",$row_contact['email']));
                 $to=$contactnom[0];
                 //echo $to;
             }

        $subject = "Career Application from ".$name;

        $html = "<table style='border:1px solid black'>";
        $html.= "<tr><td>Name : </td><td>".$name ."</td></tr>";
        $html.= "<tr><td>Email : </td><td>".$email."</td></tr>";
        $html.= "<tr><td>Phone : </td><td>".$phone."</td></tr>";
        $html.= "<tr><td>Experience : </td><td>".$experience."</td></tr>";
        $html.= "<tr><td>Designation : </td><td>".$designation."</td></tr>";
        $html.= "<tr><td>Message : </td><td>".$message."</td></tr>";

         // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $domain=$_SERVER['HTTP_HOST'];

        if($domain!="localhost")
        {
            echo "<script>alert('Message has been send');</script>";
            mail($to,$subject,$html,$headers);
        }
        else
        {
            echo "<script>alert('Message has been send');</script>";
            mail($to,$subject,$html,$headers);
        }

  function display_error($error)
  {
      echo '<div class="alert alert-warning"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$error.' </div>';
  }
}
?>