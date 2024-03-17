<?php
include 'connect.php';
$cn = new connect();
$cn->connectdb();


$sql = $cn->selectdb("SELECT * FROM  tbl_page where page_id=$page_id");
if (mysqli_num_rows($sql) > 0) {
    $row1 = mysqli_fetch_assoc($sql);
}
if (isset($_GET['bid'])) {
    $sql = $cn->selectdb("SELECT meta_tag_title,meta_tag_description,meta_tag_keywords FROM  tbl_blog where slug='" . $_GET['bid'] . "'");
    if (mysqli_num_rows($sql) > 0) {
        $row1 = mysqli_fetch_assoc($sql);
    }
}
if (isset($_GET['gid'])) {
    $sql = $cn->selectdb("SELECT meta_tag_title,meta_tag_description,meta_tag_keywords FROM  tbl_gallery where slug='" . $_GET['gid'] . "'");
    if (mysqli_num_rows($sql) > 0) {
        $row1 = mysqli_fetch_assoc($sql);
    }
}

if (isset($_GET['pid'])) {
    $sql = $cn->selectdb("SELECT meta_tag_title,meta_tag_description,meta_tag_keywords FROM  tbl_category where cat_id='" . $_GET['pid'] . "'");
    if (mysqli_num_rows($sql) > 0) {
        $row1 = mysqli_fetch_assoc($sql);
    }
}

if (isset($_GET['ptid'])) {
    $sql = $cn->selectdb("SELECT meta_tag_title,meta_tag_description,meta_tag_keywords FROM  tbl_product where slug='" . $_GET['ptid'] . "'");
    if (mysqli_num_rows($sql) > 0) {
        $row1 = mysqli_fetch_assoc($sql);
    }
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
	<?php
    	$cn->setdomain();
    ?>
	<title><? echo $row1['meta_tag_title'] ?>|SmartSign & Road Furniture LTD.</title>
	<meta charset="utf-8">
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->
	<meta name="description" content="<? echo $row1['meta_tag_description'] ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="format-detection" content="telephone=no">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<!-- FAVICONS ICON -->
	<?php
    $sql = "SELECT image_name FROM tbl_favicon WHERE fav_id=1";
    $result = $cn->selectdb($sql);
    if ($cn->numRows($result) > 0) {
        $row = $cn->fetchAssoc($result);
    ?>
	<link rel="icon" href="favicon/big_img/<?php echo $row['image_name']; ?>" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon/big_img/<?php echo $row['image_name']; ?>" />
	<?php
    }
    ?>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animations.css">
	<link rel="stylesheet" href="css/icomoon.css">

	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/vendor/modernizr-2.6.2.min.js"></script>

	<!--[if lt IE 9]>
		<script src="js/vendor/html5shiv.min.js"></script>
		<script src="js/vendor/respond.min.js"></script>
		<script src="js/vendor/jquery-1.12.4.min.js"></script>
	<![endif]-->

</head>

<body>
	<!--[if lt IE 9]>
		<div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="color-main">upgrade your browser</a> to improve your experience.</div>
	<![endif]-->

	<div class="preloader">
		<div class="preloader_image"></div>
	</div>

	<!-- search modal -->
	<div class="modal" tabindex="-1" role="dialog" aria-labelledby="search_modal" id="search_modal">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<div class="widget widget_search">
			<form method="get" class="searchform search-form" action="/">
				<div class="form-group">
					<input type="text" value="" name="search" class="form-control" placeholder="Search keyword" id="modal-search-input2">
				</div>
				<button type="submit" class="btn">Search</button>
			</form>
		</div>
	</div>

	<!-- Login Modal -->
	<div class="modal fade" id="login-form" tabindex="-1" role="dialog" aria-labelledby="login-form" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl modal-lg modal-sm" role="document">
			<div class="modal-content ls container-px-0">
				<div class="container ">
					<div class="row align-items-center c-gutter-0">
						<div class="col-lg-6 d-none d-lg-block">
							<img src="images/gallery/full/05.jpg" alt="">
						</div>
						<div class="col-lg-6">
							<div class="form-wrapper p-lg-40 p-20">
								<form class="contact-form" method="post" action="/">
									<div class="row c-mb-20">
										<div class="col-12 form-title  text-center">
											<h5>Login</h5>
										</div>
										<div class="col-sm-12">
											<div class="form-group has-placeholder">
												<label for="name3334">Your Login <span class="required">*</span></label>
												<input type="text" aria-required="true" size="30" value="" name="name" id="name3334" class="form-control" placeholder="Your Login">
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group has-placeholder">
												<label for="pass12111">Your Password<span class="required">*</span></label>
												<input type="password" id="pass12111" class="form-control" name="pass" aria-required="true" placeholder="Your Password">
											</div>
										</div>
										<div class="col-sm-12 mt-lg-40 mt-15 mb-0 text-center">
											<div class="form-group">
												<input class="btn btn-outline-maincolor" type="submit" value="Login">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>


	<!-- wrappers for visual page editor and boxed version of template -->
	<div id="canvas">
		<div id="box_wrapper">

			<!-- template sections -->
			
			<div class="page_header_wrapper ls affix-top-wrapper" style="height: 85px;">
				<header class="page_header ls s-py-5 justify-nav-center affix-top">
					<div class="container-fluid">
						<div class="row align-items-center">
						<?php
                            $sql = "SELECT image_name FROM tbl_logo WHERE logo_id=1";
                            $result = $cn->selectdb($sql);
                            if ($cn->numRows($result) > 0) {
                                $row = $cn->fetchAssoc($result);
                            ?>
							<div class="col-xl-2 col-lg-3 col-11">
								<a href="./" class="logo">
									<img src="logo/big_img/<?php echo $row['image_name']; ?>" alt="">  
								</a>
							</div>
							<?php
                            }
                            ?>
							<div class="col-xl-7 col-lg-6 col-1 text-sm-center">
								<!-- main nav start -->
								<nav class="top-nav justify-nav-center">
									<ul class="nav sf-menu sf-js-enabled sf-arrows" style="touch-action: pan-y;">

										<li class="active"> 
											<a href="./">
												<font style="vertical-align: inherit;">
													<font style="vertical-align: inherit;"><strong class="nav-strong">Home</strong></font>
												</font>
											</a>
										</li>
										<li>
											<a href="About-Us/">
												<font style="vertical-align: inherit;">
													<font style="vertical-align: inherit;"><strong class="nav-strong">About</strong></font>
												</font>
											</a>
										</li>


										<li>
											<a href="Products/" class="sf-with-ul">
												<font style="vertical-align: inherit;">
													<font style="vertical-align: inherit;"><strong class="nav-strong">Products</strong>
													</font>
												</font>
											</a><span class="sf-menu-item-mobile-toggler"></span>
											<ul style="display:none; margin-top:10px;">
												<li>
													<a href="#">
														<font style="vertical-align: inherit;">
															<font style="vertical-align: inherit;"><strong class="nav-strong">Warning
																	signs</strong>
															</font>
														</font>
													</a>
												</li>
												<li>
													<a href="#">
														<font style="vertical-align: inherit;">
															<font style="vertical-align: inherit;"><strong class="nav-strong">Informatory
																	signs</strong>
															</font>
														</font>
													</a>
												</li>
												<li>
													<a href="#">
														<font style="vertical-align: inherit;">
															<font style="vertical-align: inherit;"><strong class="nav-strong">Road project
																	Directories</strong>
															</font>
														</font>
													</a>
												</li>
												<li>
													<a href="#">
														<font style="vertical-align: inherit;">
															<font style="vertical-align: inherit;"><strong class="nav-strong">Directional
																	Signs</strong>
															</font>
														</font>
													</a>
												</li>
												<li>
													<a href="#">
														<font style="vertical-align: inherit;">
															<font style="vertical-align: inherit;"><strong class="nav-strong">Road
																	Furnitures & All
																	Road Markings</strong>
															</font>
														</font>
													</a>
												</li>
											</ul>
										</li>
										
										<!--<li>
											<a href="#">
												<font style="vertical-align: inherit;">
													<font style="vertical-align: inherit;"><strong
															class="nav-strong">safety
															solutions</strong>
													</font>
												</font>
											</a>
										</li>-->
										
										<li> 
											<a href="Gallery-Category/">
												<font style="vertical-align: inherit;">
													<font style="vertical-align: inherit;"><strong class="nav-strong">Gallery</strong>
													</font>
												</font>
											</a>
										</li>
										<li>
											<a href="Blogs/">
												<font style="vertical-align: inherit;">
													<font style="vertical-align: inherit;"><strong class="nav-strong">Blogs</strong>
													</font>
												</font>
											</a>
										</li>
										<li>
											<a href="Careerr/">
												<font style="vertical-align: inherit;">
													<font style="vertical-align: inherit;"><strong class="nav-strong">careers</strong>
													</font>
												</font>
											</a>
										</li>
										<li>
											<a href="Contact-Us/">
												<font style="vertical-align: inherit;">
													<font style="vertical-align: inherit;"><strong class="nav-strong">contact</strong>
													</font>
												</font>
											</a>
										</li>
								</nav>
								<!-- eof main nav -->
							</div>
							<div class="col-xl-3 col-lg-3 text-right d-none d-xl-block">

								<ul class="top-includes">


									<li>
										<span class="social-icons">
								<?php
                                $sql = "SELECT icon_name,link_url FROM tbl_socialmedia ORDER BY recordListingID";
                                $result = $cn->selectdb($sql);
                                if ($cn->numRows($result) > 0) {
                                    while ($row = $cn->fetchAssoc($result)) {
                                ?>
											<a target="_blank" href="<? echo $row['link_url'] ?>" class="fa fa-<? echo $row['icon_name'] ?> color-icon border-icon round" title="YouTube"></a>
								<? }
                                } ?>
								            <!-- <a href="https://www.youtube.com/" class="fa fa-youtube-play color-icon border-icon round" title="YouTube"></a>
											<a href="https://web.telegram.org/" class="fa fa-paper-plane color-icon border-icon round" title="telegram"></a>
											<a href="https://www.instagram.com/" class="fa fa-instagram color-icon border-icon round" title="instagram"></a>
											<a href="https://www.facebook.com/" class="fa fa-facebook color-icon border-icon round" title="Facebook"></a>
										</span> -->
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- header toggler -->
					<span class="toggle_menu"><span></span></span>
				</header>
			</div>