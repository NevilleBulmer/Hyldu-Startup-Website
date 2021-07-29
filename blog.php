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
<title>Hyldu - Blog</title>
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
			<h2>Blog</h2>
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
				
				<div class="col-lg-8">
					
					<div class="blog_container">
						<div class="post_container" data-masonry='{ "itemSelector": ".card", "gutter": 30 }'>
							
							<div class="card trans_200">
								<img class="card-img-top" src="images/blog_1.jpg" alt="https://unsplash.com/@heysupersimi">
								<div class="card-body">
									<div class="card-header">oct 29, 2017</div>
									<div class="card-title"><a href="blog_post.html">A beautiful day</a></div>
									<div class="card-text">
										Etiam nec odio vestibulum est mattis effic iturut magna. Pellen tesque sit am et tellus blandit...
									</div>
								</div>
							</div>

							<div class="card trans_200">
								<img class="card-img-top" src="images/blog_2.jpg" alt="https://unsplash.com/@philberndt">
								<div class="card-body">
									<div class="card-header">oct 29, 2017</div>
									<div class="card-title"><a href="blog_post.html">Design inspiration</a></div>
									<div class="card-text">
										Etiam nec odio vestibulum est mattis effic iturut magna. Pellen tesque sit am et tellus blandit...
									</div>
								</div>
							</div>

							<div class="card trans_200">
								<img class="card-img-top" src="images/blog_3.jpg" alt="https://unsplash.com/@lucabravo">
								<div class="card-body">
									<div class="card-header">oct 29, 2017</div>
									<div class="card-title"><a href="blog_post.html">A beautiful day</a></div>
									<div class="card-text">
										Etiam nec odio vestibulum est mattis effic iturut magna. Pellen tesque sit am et tellus blandit...
									</div>
								</div>
							</div>

							<div class="card trans_200">
								<img class="card-img-top" src="images/blog_4.jpg" alt="https://unsplash.com/@heysupersimi">
								<div class="card-body">
									<div class="card-header">oct 29, 2017</div>
									<div class="card-title"><a href="blog_post.html">Design inspiration</a></div>
									<div class="card-text">
										Etiam nec odio vestibulum est mattis effic iturut magna. Pellen tesque sit am et tellus blandit...
									</div>
								</div>
							</div>

							<div class="card trans_200">
								<img class="card-img-top" src="images/blog_5.jpg" alt="https://unsplash.com/@jcpeacock">
								<div class="card-body">
									<div class="card-header">oct 29, 2017</div>
									<div class="card-title"><a href="blog_post.html">A beautiful day</a></div>
									<div class="card-text">
										Etiam nec odio vestibulum est mattis effic iturut magna. Pellen tesque sit am et tellus blandit...
									</div>
								</div>
							</div>

							<div class="card trans_200">
								<img class="card-img-top" src="images/blog_6.jpg" alt="https://unsplash.com/@dmpop">
								<div class="card-body">
									<div class="card-header">oct 29, 2017</div>
									<div class="card-title"><a href="blog_post.html">Design inspiration</a></div>
									<div class="card-text">
										Etiam nec odio vestibulum est mattis effic iturut magna. Pellen tesque sit am et tellus blandit...
									</div>
								</div>
							</div>

						</div>
					</div>
						

					<div class="blog_pages">
						<ul>
							<li class="active"><a href="#">01.</a></li>
							<li><a href="#">02.</a></li>
							<li><a href="#">03.</a></li>
							<li><a href="#">04.</a></li>
						</ul>
					</div>

				</div>

				<div class="col-lg-4">
					
					<!-- Sidebar -->

					<div class="sidebar">
						
						<!-- Sidebar Categories -->
						<div class="sidebar_section categories_section">
							
							<div class="sidebar_section_title">Categories</div>
							<div class="sidebar_categories">
								<ul>
									<li><a href="#">Vestibulum maximus</a></li>
									<li><a href="#">Nisi eu lobortis pharetra</a></li>
									<li><a href="#">Orci quam accumsan</a></li>
									<li><a href="#">Auguen pharetra massa</a></li>
									<li><a href="#">Tellus ut nulla</a></li>
									<li><a href="#">Etiam egestas viverra</a></li>
								</ul>
							</div>
						</div>
						
						<!-- Sidebar Tags -->

						<div class="sidebar_section tags_section">

							<div class="sidebar_section_title">Tags</div>
							
							<div class="tags_container d-flex flex-row flex-wrap">
								<div class="tag_item"><a href="#">branding</a></div>
								<div class="tag_item"><a href="#">identity</a></div>
								<div class="tag_item"><a href="#">video</a></div>
								<div class="tag_item"><a href="#">design</a></div>
								<div class="tag_item"><a href="#">inspiration</a></div>
								<div class="tag_item"><a href="#">web design</a></div>
								<div class="tag_item"><a href="#">photography</a></div>
							</div>
						</div>

						<!-- Sidebar Quote -->

						<div class="sidebar_section quote_section">
							
							<div class="sidebar_section_title">Quote</div>
							<div class="quote_quote"><img src="images/quote.svg" alt=""></div>
							<p class="quote_text">Vivamus in urna eu enim porttitor consequat. Proin vitae pulvinar libero. Proin ut hendrerit metus. Aliquam erat volutpat. Donec fermen tum convallis ante eget tristique. Sed lacinia turpis at ultricies vestibulum.</p>
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
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/scrollTo/jquery.scrollTo.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/portfolio_custom.js"></script>
</body>

</html>