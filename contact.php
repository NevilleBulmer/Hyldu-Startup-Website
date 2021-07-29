<?php
// Require and includes

// This holds the database information.
require_once($_SERVER['DOCUMENT_ROOT'] . '/HylduThree/lib/PHP/core/Initialization.php');

// Instantiated object of DBWrapplet.php
$DBInteraction = new DBWrapplet();

$validateContactForm = new Validation();

if(CheckInput::inputExists())
{
    $validateContactForm->validateCheck($_POST, array(
        'form_name' => array(
            'required' => true,
            'min' => 2,
            'max' => 50
    ),
        'form_email' => array(
            'required' => true,
            'min' => 2,
            'max' => 50
    ),
        'form_subject' => array(
            'required' => true,
            'min' => 2,
            'max' => 255
    ),
        'form_message' => array(
            'required' => true,
            'min' => 2,
            'max' => 1000
    )

    ));

    // Checks if validation passed validate, passed.
    if($validateContactForm->passed())
    {
        try
        {
            $DBInteraction->addContactMessage(array(
                // Insert into users, name.
                'contact_name' => CheckInput::get('form_name'),

                'contact_email' => CheckInput::get('form_email'),

                'contact_subject' => CheckInput::get('form_subject'),

                'contact_message' => CheckInput::get('form_message')
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
<title>Hyyldu - Contact</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="hyldu Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link href="plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
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
                <li><a href="about.php">About Us</a></li>
                <li class="active"><a href="contact.php">Contact</a></li>
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
                <li><a href="about.php">About Us</a></li>
                <li class="active"><a href="contact.php">Contact</a></li>
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
			<h2>Contact</h2>
			<div class="next_section_scroll">
				<div class="next_section nav_links" data-scroll-to=".contact">
					<i class="fas fa-chevron-down trans_200"></i>
					<i class="fas fa-chevron-down trans_200"></i>
				</div>
			</div>
		</div>
	
	</div>

	<!-- Contact -->

	<div class="contact">
		
		<div class="container">

			<div class="row contact_row">
				<div class="col-lg-8">
					
					<!-- Reply -->

					<div class="reply">
						
						<div class="reply_title">Leave a reply</div>
						<div class="reply_form_container">

                        <p>
                            <?php
                                // counts throught the errors and displays them to the user.
                                foreach ($validateContactForm->errors() as $error)
                                {
                                    $validateContactForm = str_replace("form_", " ", $error);
                                    echo 'A ', $validateContactForm, '<br/>';
                                }
                            ?>
                        </p>
							
							<!-- Reply Form -->

							<form id="reply_form" method="post" enctype="multipart/form-data" autocomplete="off">
								<div>

                                    <input 
                                            id="form_name"
                                            name="form_name" 
                                            class="input_field reply_form_name" 
                                            type="text" 
                                            placeholder="Name" 
                                            required="required" 
                                            data-error="Name is required.">

                                    <input 
                                            id="form_email"
                                            name="form_email" 
                                            class="input_field reply_form_email" 
                                            type="email" 
                                            placeholder="E-mail" 
                                            required="required" 
                                            data-error="Valid email is required.">
                                    
                                    <input 
                                            id="form_subject"
                                            name="form_subject"
                                            class="input_field reply_form_subject" 
                                            type="text" 
                                            placeholder="Subject" 
                                            required="required" 
                                            data-error="Subject is required.">
                                    
                                    <textarea 
                                            id="form_message" 
                                            name="form_message"
                                            class="text_field reply_form_message" 
                                            name="message"  
                                            placeholder="Message"
                                            rows="4"
                                            required data-error="Please, write us a message."></textarea>

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

				<div class="col-lg-4">
					
					<!-- Contact Info -->

					<div class="contact_info">

						<div class="contact_title">Contact info</div>
						
						<div class="contact_info_container">

							<div class="logo contact_logo">
								<a href="#">Hyldu</a>
							</div>
							<p>We are allways happy to hear from our clients/users.</p>

							<div class="address_container clearfix">
								<div class="contact_info_icon">i</div>
								<div class="contact_info_content">
									<ul>
										<li class="address">Example Address</li>
										<li class="city">Example City</li>
										<li class="phone">Example Number</li>
										<li class="email">Example@Example.com</li>
									</ul>									
								</div>
							</div>
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
<script src="plugins/colorbox/jquery.colorbox-min.js"></script>
<script src="plugins/scrollTo/jquery.scrollTo.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="js/CustomGoogleMapMarker.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/contact_custom.js"></script>
</body>

</html>