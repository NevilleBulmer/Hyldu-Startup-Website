<?php
// Require and includes

// This holds the database information.
require_once($_SERVER['DOCUMENT_ROOT'] . '/HylduThree/lib/PHP/core/Initialization.php');

// Instantiated object of DBWrapplet.php
$DBInteraction = new DBWrapplet();

$validateNewsletter = new Validation();

if(CheckInput::inputExists())
{
    $validateNewsletter->validateCheck($_POST, array(
        'form_email' => array(
        'required' => true,
        'min' => 2,
        'max' => 50
    )

    ));

    // Checks if validation passed validate, passed.
    if($validateNewsletter->passed())
    {
        try
        {
            $DBInteraction->addNewsletterContact(array(
                // Insert into users, name.
                'newsletterEmail' => CheckInput::get('form_email')
            ));

        // Catch any thrown exceptions.
        }catch (Exception $e)
        {
            die($e->getMessage());
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Hyldu - About</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="hyldu Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="styles/about_styles.css">
<link rel="stylesheet" type="text/css" href="styles/about_responsive.css">
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
                <li class="active"><a href="about.php">About Us</a></li>
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
                <li class="active"><a href="about.php">About Us</a></li>
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
			<h2>About us</h2>
			<div class="next_section_scroll">
				<div class="next_section nav_links" data-scroll-to=".icon_boxes">
					<i class="fas fa-chevron-down trans_200"></i>
					<i class="fas fa-chevron-down trans_200"></i>
				</div>
			</div>
		</div>
	
	</div>

	<!-- Icon Boxes -->

	<div class="icon_boxes">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="icon_box_title">
						<h1>A passionate team with a strong background</h1>
					</div>
				</div>

				<div class="col-lg-4 icon_box_col">

					<!-- Icon Box Item -->
					<div class="icon_box_paragraph">
						<p>Our team is made up of people from all backgrounds and technical levels,
						We strive for the best in everything we do and it is with this diversity that we are 
						able to acomplish this.
						<br>
						<br>
						We beleive that for any team to thrive and acomplsih preatty much anything then diversity is a must,
						This diversity allows for a unique belnd of talent and ideas which can not be beaten.
						</p>
					</div>

				</div>

				<div class="col-lg-4 icon_box_col">

					<!-- Icon Box Item -->
					<div class="icon_box_paragraph">
						<p>At Hyldu we have core values which include, privacy of our customers information, quality
						of everything we do or allow our time to be spent on and most of all relationships, we do not think
						in terms of clients, we think in terms of relationships, our relationship with you.</p>
					</div>
					
				</div>
			</div>
		</div>
	</div>

	<!-- Vertical Slider Section -->

	<div class="v_slider_section">
		<div class="container fill_height">
			<div class="row fill_height">
				<div class="col-lg-6 v_slider_section_image">
					<div class="v_slider_image">
						<img src="images/testimonials.jpeg" alt="">
					</div>
				</div>

				<div class="col-lg-5 offset-lg-1 v_slider_content d-flex flex-column justify-content-center">
					
					<!-- Testimonials Slider -->
					<div class="v_slider_title">
						<h1>What clients say</h1>
					</div>

					<div class="v_slider_container">

						<!-- Vertical Slider -->
						<div class="v_slider">

							<!-- Vertical Slider Item -->
							<div class="v_slider_item">
								<span>“</span>
								<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut. Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut.</p>
								<div class="person d-flex flex-row">
									<div class="person_image">
										<img src="images/person_1.png" alt="">
									</div>
									<div class="person_meta">
										<div class="person_name">Michael Smith</div>
										<div class="person_title">Manager</div>
									</div>
								</div>
							</div>

							<!-- Vertical Slider Item -->
							<div class="v_slider_item">
								<span>“</span>
								<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut. Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut.</p>
								<div class="person d-flex flex-row">
									<div class="person_image">
										<img src="images/person_1.png" alt="">
									</div>
									<div class="person_meta">
										<div class="person_name">Michael Smith</div>
										<div class="person_title">Manager</div>
									</div>
								</div>
							</div>

							<!-- Vertical Slider Item -->
							<div class="v_slider_item">
								<span>“</span>
								<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut. Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut.</p>
								<div class="person d-flex flex-row">
									<div class="person_image">
										<img src="images/person_1.png" alt="">
									</div>
									<div class="person_meta">
										<div class="person_name">Michael Smith</div>
										<div class="person_title">Manager</div>
									</div>
								</div>
							</div>

							<!-- Vertical Slider Item -->
							<div class="v_slider_item">
								<span>“</span>
								<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut. Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut.</p>
								<div class="person d-flex flex-row">
									<div class="person_image">
										<img src="images/person_1.png" alt="">
									</div>
									<div class="person_meta">
										<div class="person_name">Michael Smith</div>
										<div class="person_title">Manager</div>
									</div>
								</div>
							</div>

							<!-- Vertical Slider Item -->
							<div class="v_slider_item">
								<span>“</span>
								<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut. Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut.</p>
								<div class="person d-flex flex-row">
									<div class="person_image">
										<img src="images/person_1.png" alt="">
									</div>
									<div class="person_meta">
										<div class="person_name">Michael Smith</div>
										<div class="person_title">Manager</div>
									</div>
								</div>
							</div>

							<!-- Vertical Slider Item -->
							<div class="v_slider_item">
								<span>“</span>
								<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut. Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut.</p>
								<div class="person d-flex flex-row">
									<div class="person_image">
										<img src="images/person_1.png" alt="">
									</div>
									<div class="person_meta">
										<div class="person_name">Michael Smith</div>
										<div class="person_title">Manager</div>
									</div>
								</div>
							</div>

							<!-- Vertical Slider Item -->
							<div class="v_slider_item">
								<span>“</span>
								<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut. Etiam nec odio vestibulum est mattis effic iturut magna. Pelle ntesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mattis effic iturut.</p>
								<div class="person d-flex flex-row">
									<div class="person_image">
										<img src="images/person_1.png" alt="">
									</div>
									<div class="person_meta">
										<div class="person_name">Michael Smith</div>
										<div class="person_title">Manager</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Team -->

	<div class="team">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-lg-center text-left team_title">
					<h1>Meet the team</h1>
					<p>A look at what we look like and what our roles are, Have a comment or a query?<br>
					Get in touch.</p>
				</div>
			</div>
			<div class="row">



            <div class="col-sm-4 my-4">
                <div class="">
                    <img class="card-img-top rounded-circle" src="images/team/team_1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Neville Bulmer</h5>
                        <p class="card-text">Chief Technical Officer</p>

                        <p class="card-text">Neville is the brains behind the technical side of Hyldu, everything you see came from him.</p>

                    </div>
                </div>
            </div>

            <div class="col-sm-4 my-4">
                <div class="">
                    <img class="card-img-top rounded-circle" src="images/team/team_2.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Luke Chambers</h5>
                        <p class="card-text">Chief Operations Officer</p>

                        <p class="card-text">Luke runs the comany as well as being the founder, Hyldu was and is his brain child.</p>

                    </div>
                </div>
            </div>

            <div class="col-sm-4 my-4">
                <div class="">
                    <img class="card-img-top rounded-circle" src="images/team/team_3.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Little One</h5>
                        <p class="card-text">Chief Inspirational Officer</p>

                        <p class="card-text">Lukes son is the chief inspirational officer, if you have ever met him then you know why.</p>

                    </div>
                </div>
            </div>
				

			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col text-lg-center text-left">
					<div class="newsletter_content">

						<!-- Newsletter Title -->
						<div class="newsletter_title">
							<h1>Subscribe to our newsletter</h1>
							<span>We will only ever be in touch when absolutely necesary.</span>
						</div>
						
						<!-- Newsletter Form -->
						<div class="newsletter_form_container">
							<form method="post" enctype="multipart/form-data" autocomplete="off">
								<div class="input-group">

                                    <input 
                                            type="email" 
                                            name="form_email"
                                            value="<?php
                                                        // Gets the information inputted into the name field.
                                                        echo escape(CheckInput::get('form_contact_email'));
                                                    ?>"
                                            class="newsletter_email" 
                                            placeholder="Your e-mail address here" 
                                            required="required" 
                                            data-error="Valid email address is required.">

									<button id="newsletter_form_submit" type="submit" class="button newsletter_submit_button trans_200" value="Submit">
										subscribe
									</button>
								</div>
									
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
    </div>
    
    <hr>

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
<script src="plugins/slick-1.8.0/slick.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/scrollTo/jquery.scrollTo.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/about_custom.js"></script>
</body>

</html>