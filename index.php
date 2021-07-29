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
<title>Hyldu - Home</title>
<meta charset="utf-8">
<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="hyldu Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="plugins/slick-1.8.0/slick.css">
<link href="plugins/icon-font/styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
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
				<li class="active"><a href="index.php">Home</a></li>
                <li><a href="people.php">People</a></li>
                <li><a href="projects.php">Projects</a></li>
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
							<a class="dropdown-item text-body" href="account.php">Profile</a>
							<a class="dropdown-item text-body" href="signout.php">Log Out</a>
							<a class="dropdown-item text-body" href="create_project.php">Found project</a>
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
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="people.php">People</a></li>
                <li><a href="projects.php">Projects</a></li>
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
		
		<!-- Hero Slider -->
		<div class="hero_slider_container">
			
			<!-- Slider -->
			<div class="owl-carousel owl-theme hero_slider">

				<!-- Slider Item -->
				<div class="owl-item hero_slider_item item_1 d-flex flex-column align-items-center justify-content-center">
					<span></span>
					<span><img src="" alt=""></span>
                    <span>Hyldu</span>
                    <br/>
					<span>The home of great ideas!</span>
				</div>

				<!-- Slider Item -->
				<div class="owl-item hero_slider_item item_1 d-flex flex-column align-items-center justify-content-center">
					<span></span>
					<span><img src="" alt=""></span>
                    <span>Hyldu</span>
                    <br/>
					<span>The home of great ideas!</span>
				</div>

				<!-- Slider Item -->
				<div class="owl-item hero_slider_item item_1 d-flex flex-column align-items-center justify-content-center">
					<span></span>
					<span><img src="" alt=""></span>
                    <span>Hyldu</span>
                    <br/>
					<span>The home of great ideas!</span>
				</div>

			</div>
			
			<!-- Hero Slider Navigation Left -->
			<div class="hero_slider_nav hero_slider_nav_left">
				<div class="hero_slider_prev d-flex flex-column align-items-center justify-content-center trans_200">
					<i class="fas fa-chevron-left trans_200"></i>
				</div>
			</div>

			<!-- Hero Slider Navigation Right -->
			<div class="hero_slider_nav hero_slider_nav_right">
				<div class="hero_slider_next d-flex flex-column align-items-center justify-content-center trans_200">
					<i class="fas fa-chevron-right trans_200"></i>
				</div>
			</div>

		</div>

		<div class="hero_side_text_container">
			<div class="double_arrow_container d-flex flex-column align-items-center justify-content-center">
				<div class="double_arrow nav_links" data-scroll-to=".icon_boxes">
					<i class="fas fa-chevron-left trans_200"></i>
					<i class="fas fa-chevron-left trans_200"></i>
				</div>
			</div>
			<div class="hero_side_text">
				<h2>Welcome to the dream factory</h2>
				<p>Register, create your project, find like minded people.</p>
			</div>
		</div>
		
		<div class="next_section_scroll">
			<div class="next_section nav_links" data-scroll-to=".icon_boxes">
				<i class="fas fa-chevron-down trans_200"></i>
				<i class="fas fa-chevron-down trans_200"></i>
			</div>
		</div>
			
	</div>

	<!-- Icon Boxes -->

	<div class="icon_boxes">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 icon_box_col">
					<div class="portfolio_items product-grid">
                        <h2 class="text-center">Founder</h2>
						<!-- Portfolio Item -->
						<div class="card branding">
							<div class="card_image">
								<img class="card-img-top" src="images/portfolio_1.jpg" alt="image by https://unsplash.com/@heysupersimi">
							</div>
							
							<div class="card-body">
								<div class="card-title">Intellilect Software Co.</div>
                                    <div class="card-text">
                                    We are a boutique digital transformation consultancy and software development company that provides cutting edge engineering solutions, 
                                    helping Fortune 500 companies and enterprise clients untangle complex issues that always emerge during their digital evolution journey. 
                                    Since 2007 we have been a visionary and a reliable software engineering partner for world-class brands.
                                    </div>
							</div>
                        </div>
                    </div>
				</div>

				<div class="col-lg-6 icon_box_col">
                    <div class="portfolio_items product-grid">
                        <h2 class="text-center">Champion</h2>
						<!-- Portfolio Item -->
						<div class="card branding">
							<div class="card_image">
								<img class="card-img-top" src="images/portfolio_2.jpg" alt="image by https://unsplash.com/@heysupersimi">
							</div>
							<div class="card-body">
								<div class="card-title">Inhouse Software Co.</div>
								    <div class="card-text">
                                        Established in 1967, Inhouse is one of the largest information technology consulting firms in the world. 
                                        Spread in over 40 countries with a workforce of 1.90 lakh employees, it has generated revenue of 12.8 billion Euros in the previous year. 
                                        They were awarded the world’s most ethical company in 2015 and also they co-wrote the 2013 world wealth report.
                                    </div>
							</div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>

	<!-- Services -->

	<div class="services">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title">
						<h1>Hyldu. We take care of your business/project ideas</h1>
						<span>Explore what we value</span>
					</div>
				</div>
			</div>
		</div>

		<div class="h_slider_container services_slider_container">
			<div class="service_slider_outer">
				<div class="owl-carousel owl-theme services_slider">
					<div class="owl-item services_item">
						<div class="services_item_inner">
							<div class="service_item_content">
								<div class="service_item_title">
									<div class="service_item_icon">
										<div data-icon="&#xe083;" class="icon"></div>
									</div>
									<h2>Amazing service</h2>
								</div>
								<p>We pride ourselves on excellent customer service, this shows in how quick we answer queries and give feedback to our customers.</p>
								<div class="button service_item_button trans_200">
									<a href="#" class="trans_200">discover more</a>
								</div>
							</div>
						</div>
					</div>

					<!-- Services Slider Item-->
					<div class="owl-item services_item">
						<div class="services_item_inner">
							<div class="service_item_content">
								<div class="service_item_title">
									<div class="service_item_icon">
										<div data-icon="&#xe059;" class="icon"></div>
									</div>
									<h2>Information</h2>
								</div>
								<p>All of our accounts are managed in house and none of your information, personal or otherwise will ever leave our care.</p>
								<div class="button service_item_button trans_200">
									<a href="#" class="trans_200">discover more</a>
								</div>
							</div>
						</div>
					</div>

					<!-- Services Slider Item-->
					<div class="owl-item services_item">
						<div class="services_item_inner">
							<div class="service_item_content">
								<div class="service_item_title">
									<div class="service_item_icon">
										<div data-icon="&#xe024;" class="icon"></div>
									</div>
									<h2>Awsomeness</h2>
								</div>
								<p>We provide the tools and whatch while you create awsomeness, we think coporate level tools, familly level interaction.</p>
								<div class="button service_item_button trans_200">
									<a href="#" class="trans_200">discover more</a>
								</div>
							</div>
						</div>
					</div>

					<!-- Services Slider Item-->
					<div class="owl-item services_item">
						<div class="services_item_inner">
							<div class="service_item_content">
								<div class="service_item_title">
									<div class="service_item_icon">
										<div data-icon="&#xe05e;" class="icon"></div>
									</div>
									<h2>Sharing</h2>
								</div>
								<p>We provide many tools and one of these is built in sharing capabilities, your company/project in front of millions.</p>
								<div class="button service_item_button trans_200">
									<a href="#" class="trans_200">discover more</a>
								</div>
							</div>
						</div>
					</div>

					<!-- Services Slider Item-->
					<div class="owl-item services_item">
						<div class="services_item_inner">
							<div class="service_item_content">
								<div class="service_item_title">
									<div class="service_item_icon">
										<div data-icon="&#xe059;" class="icon"></div>
									</div>
									<h2>Great team</h2>
								</div>
								<p>Our team is passionate about your company/project, it is with this passion that we create all of the tools you will use and where sure you will love.</p>
								<div class="button service_item_button trans_200">
									<a href="#" class="trans_200">discover more</a>
								</div>
							</div>
						</div>
					</div>

					<!-- Services Slider Item-->
					<div class="owl-item services_item">
						<div class="services_item_inner">
							<div class="service_item_content">
								<div class="service_item_title">
									<div class="service_item_icon">
										<div data-icon="&#xe040;" class="icon"></div>
									</div>
									<h2>Values</h2>
								</div>
								<p>We try in everything we do to embody older values with modern day interactions, technology and communications.</p>
								<div class="button service_item_button trans_200">
									<a href="#" class="trans_200">discover more</a>
								</div>
							</div>
						</div>
					</div>

					<!-- Services Slider Item-->
					<div class="owl-item services_item">
						<div class="services_item_inner">
							<div class="service_item_content">
								<div class="service_item_title">
									<div class="service_item_icon">
										<div data-icon="&#xe020;" class="icon"></div>
									</div>
									<h2>Flagship</h2>
								</div>
								<p>Our team strive everyday to provide a flagship experience at a reasonable price, this is fused into our familly motto of familly.</p>
								<div class="button service_item_button trans_200">
									<a href="#" class="trans_200">discover more</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			
				<div class="services_slider_nav services_slider_nav_left">
                    <i class="fas fa-chevron-left trans_200"></i>
                </div>

				<div class="services_slider_nav services_slider_nav_right">
                    <i class="fas fa-chevron-right trans_200"></i>
                </div>

			</div>
		</div>
	</div>

	<!-- Call to action -->

	<div class="cta">
		<div class="cta_background" style="background-image:url(images/family-room.jpeg)"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-5 order-lg-1 order-2">
					<div class="cta_content">
						<h1>We love our customers</h1>
						<p>So why don't you join the familly.</p>
					</div>
				</div>

				<div class="col-lg-6 offset-lg-1 order-lg-2 order-1">
					<div class="cta_image d-flex flex-column justify-content-end">
						<img src="" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- Example project -->
    
    <?php
    
    $projectInformation = DatabaseConnectivity::getInstance()->query("
        SELECT 
            projectID,
            userID,
            company_name,
            company_information,
            company_pri_image

        FROM 
            projects

            ORDER BY RAND()

        LIMIT 1

    ");

    //Check that projects are being counted.
    if($projectInformation->count())
    {
        // Returns the project information using a foreach loop.
        foreach($projectInformation->results() as $information)
        {

    ?>
        <div class="text_line">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 text-lg-right text-center">
                        <div class="text_line_image">
                            <img src="<?php echo escape($information->company_pri_image); ?>" alt="">
                        </div>
                    </div>
                    



                    <div class="col-lg-6 offset-lg-1">
                        <div class="text_line_content">
                            <h1><?php echo escape($information->company_name); ?></h1>
                            <p><?php echo escape(mb_strimwidth($information->company_information, 0, 100)); ?></p>
                            <div class="button text_line_button trans_200">
                                <a href="project.php?id=<?php echo escape($information->projectID); ?>" class="trans_200">discover more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    }
    ?>

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
<script src="js/custom.js"></script>
</body>

</html>