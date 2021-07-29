<?php
// Require and includes

// This holds the database information.
require_once($_SERVER['DOCUMENT_ROOT'] . '/HylduThree/lib/PHP/core/Initialization.php');

// Instantiated object of DBWrapplet.php
$DBInteraction = new DBWrapplet();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Hyldu - Blog Post</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="hyldu Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link href="plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/blog_post_styles.css">
<link rel="stylesheet" type="text/css" href="styles/blog_post_responsive.css">
</head>

<body>

<div class="super_container">
	
	<!-- Header -->

	<header class="header d-flex flex-row justify-content-end align-items-center trans_200">
		
		<!-- Logo -->
		<div class="logo mr-auto">
			<a href="#">Hyldu</a>
		</div>

		<!-- Navigation -->
		<nav class="main_nav justify-self-end text-right">
			<ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="people.php">People</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li class="active"><a href="blog.php">Blog</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php
                if(!$DBInteraction->isLoggedIn())
                {
                ?>
                    <li><a href="login.php">Login</a></li>
                <?php
                } else {
                ?>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Accounts
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="account.php">Profile</a>
							<a class="dropdown-item" href="signout.php">Log Out</a>
							<a class="dropdown-item" href="create_project.php">Found project</a>
						</div>
					</li>

                <?php
                }
                ?>
			</ul>

		</nav>

		<!-- Hamburger -->
		<div class="hamburger_container bez_1">
			<i class="fas fa-bars trans_200"></i>
		</div>
		
	</header>

	<!-- Menu -->

	<div class="menu_container">
        <div class="menu menu_mm text-right">
            <div class="menu_close"><i class="far fa-times-circle trans_200"></i></div>
            <ul class="menu_mm">
                <li><a href="index.php">Home</a></li>
                <li><a href="people.php">People</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li class="active"><a href="blog.php">Blog</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php
                if(!$DBInteraction->isLoggedIn())
                {
                ?>
                    <li><a href="login.php">Login</a></li>
                <?php
                } else {
                ?>
				<hr>
					<li><a href="account.php">Profile</a></li>
					<li><a href="signout.php">Log Out</a></li>
					<li><a href="create_project.php">Found project</a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>

	<!-- Home -->

	<div class="home">
		<div class="home_background_container prlx_parent">
            <div class="home_background prlx" style="background-image:url(images/slider_background.jpg)"></div>
		</div>
		
		<div class="home_title">
			<h2>Blog - Title</h2>
			<div class="next_section_scroll">
				<div class="next_section nav_links" data-scroll-to=".blog">
					<i class="fas fa-chevron-down trans_200"></i>
					<i class="fas fa-chevron-down trans_200"></i>
				</div>
			</div>
		</div>
	
	</div>

	<!-- Blog -->

	<div class="blog">
		
		<div class="container">
			<div class="row">
				
				<div class="col-lg-12">
					
					<!-- Blog Post -->

					<div class="blog_container">

						<!-- Image -->
						<div class="blog_post_image">
							<img src="images/blog_post.jpg" alt="https://unsplash.com/@heysupersimi">
						</div>

						<!-- Blog Post Body -->
						<div class="blog_post_body">
							<div class="blog_post_date">oct 29, 2019</div>
							<h2 class="blog_post_title">A beautiful day</h2>
							<p>Vivamus in urna eu enim porttitor consequat. Proin vitae pulvinar libero. Proin ut hendrerit metus. Aliquam erat volutpat. Donec fermentum convallis ante eget tristique. Sed lacinia turpis at ultricies vestibulum.</p>
							<p>Curabitur et elementum orci. Nam vitae laoreet quam. Vestibulum a erat quis nulla tempus mollis in eu orci. Nulla sed eleifend ex, ultrices convallis arcu. Pellentesque et enim non augue varius hendrerit. Donec pretium, lectus ac dictum viverra, nisl augue maximus orci, at scelerisque ipsum sapien in lorem. Pellentesque vehicula facilisis purus sit amet ultricies. Nam eleifend sit amet nisl ut fermentum. Etiam rhoncus odio non tellus eleifend ornare.</p>
							<p>Mauris eu urna auctor, pharetra dolor ut, laoreet sem. Morbi ornare justo sit amet molestie dictum. Ut scelerisque nec lacus sed posuere. Ut viverra elit ac lectus rhoncus, non tincidunt nisl tristique.</p>
							<div class="blog_post_highlight">
								Donec pretium, lectus ac dictum viverra, nisl augue maximus orci, at scelerisque ipsum sapien in lorem. Pellentesque vehicula facilisis purus sit amet ultricies. Nam eleifend sit amet nisl ut fermentum.
							</div>
							<p>Curabitur et elementum orci. Nam vitae laoreet quam. Vestibulum a erat quis nulla tempus mollis in eu orci. Nulla sed eleifend ex, ultrices convallis arcu. Pellentesque et enim non augue varius hendrerit</p>
						</div>

						<!-- Comments -->
						<div class="blog_post_comments">
							<div class="comments_title">Comments</div>
							<ul class="comments_container">

								<!-- Comment -->
								<li class="comment">
									<div class="comment_content clearfix">
										<div class="comment_image"><img src="images/comment_1.jpg" alt=""></div>
										<div class="comment_body">
											<div class="comment_name">Michael Smith</div>
											<div class="comment_date">27 oct 2019</div>
											<p class="comment_text">Curabitur et elementum orci. Nam vitae laoreet quam. Vestibulum a erat quis nulla tempus mollis in eu orci. Nulla sed eleifend ex, ultrices convallis arcu. Pellentesque et enim non augue varius hendrerit</p>
											<div class="comment_link">
												<a href="#">reply</a>
											</div>
										</div>
									</div>

									<ul class="children">
										<li class="comment">
											<div class="comment_content clearfix">
												<div class="comment_image"><img src="images/comment_2.jpg" alt=""></div>
												<div class="comment_body">
													<div class="comment_name">Michael Smith</div>
													<div class="comment_date">27 oct 2019</div>
													<p class="comment_text">Elementum orci. Nam vitae laoreet quam. Vestibulum a erat quis nulla tempus mollis in eu orci. Nulla sed eleifend ex, ultrices convallis arcu. Pellentesque et enim non augue varius hendrerit</p>
													<div class="comment_link">
														<a href="#">reply</a>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</li>

							</ul>
						</div>

						<!-- Reply -->

						<div class="reply">
							
							<div class="reply_title">Leave a reply</div>
							<div class="reply_form_container">
								
								<!-- Reply Form -->

								<form id="reply_form" action="post">
									<div>
										<input id="reply_form_name" class="input_field reply_form_name" type="text" placeholder="Name" required="required" data-error="Name is required.">
										<input id="reply_form_email" class="input_field reply_form_email" type="email" placeholder="E-mail" required="required" data-error="Valid email is required.">
										<input id="reply_form_subject" class="input_field reply_form_subject" type="text" placeholder="Subject" required="required" data-error="Subject is required.">
										<textarea id="reply_form_message" class="text_field reply_form_message" name="message"  placeholder="Message" rows="4" required data-error="Please, write us a message."></textarea>
									</div>
									<div>
										<button id="reply_form_submit" type="submit" class="reply_submit_btn trans_300" value="Submit">
											send reply
										</button>
									</div>

								</form>

							</div>
						</div>
					</div>
					
				</div>


			</div>
		</div>
		
	</div>

	<!-- Footer -->

    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/HylduThree/lib/PHP/includes/footer.php';
    ?>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/colorbox/jquery.colorbox-min.js"></script>
<script src="plugins/scrollTo/jquery.scrollTo.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/blog_post_custom.js"></script>
</body>

</html>