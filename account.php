<?php
// Require and includes

// This holds the database information.
require_once($_SERVER['DOCUMENT_ROOT'] . '/HylduThree/lib/PHP/core/Initialization.php');

// Instantiated object of DBWrapplet.php
$DBInteraction = new DBWrapplet();

// If needed the current userID
$currentUser = $DBInteraction->data()->userID;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Hyldu - Account</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="hyldu Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link href="plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">

<link href="plugins/lightbox/css/lightbox.min.css" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="styles/blog_post_styles.css">
<link rel="stylesheet" type="text/css" href="styles/blog_post_responsive.css">

<link rel="stylesheet" type="text/css" href="styles/style-red.css">
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
			<h2><?php echo escape($DBInteraction->data()->firstname . " " . $DBInteraction->data()->surname); ?>'s Account</h2>
			<div class="next_section_scroll">
				<div class="next_section nav_links" data-scroll-to="#about">
					<i class="fas fa-chevron-down trans_200"></i>
					<i class="fas fa-chevron-down trans_200"></i>
				</div>
			</div>
		</div>
    </div>

    <section id="about" class="about-mf sect-pt4 route">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box-shadow-full">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-6 col-md-5">
                                        <div class="about-img">
                                            <img class="rounded-circle" src="<?php echo escape($DBInteraction->data()->image); ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-7">
                                        <div class="about-info">
                                            <p>
                                                <span class="title-s">Name: </span> 
                                                    <span>
                                                        <?php echo escape($DBInteraction->data()->firstname . " " . $DBInteraction->data()->surname); ?>
                                                    </span>
                                            </p>
                                            <p>
                                                <span class="title-s">C/Role: </span> 
                                                    <span>
                                                    <?php echo escape($DBInteraction->data()->current_role); ?>
                                                    </span>
                                            </p>
                                            <p>
                                                <span class="title-s">Email: </span> 
                                                    <span>
                                                        <?php echo escape($DBInteraction->data()->email); ?>    
                                                    </span>
                                            </p>
                                            <p>
                                                <span class="title-s">Phone: </span> 
                                                    <span>
                                                        <?php echo escape($DBInteraction->data()->phone); ?>
                                                    </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="skill-mf">
                                    <p class="title-s">Relevant Skills</p>

                                        <span>HTML</span> <span class="pull-right">85%</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 85%;"
                                                aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        <span>CSS3</span> <span class="pull-right">75%</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 75%"
                                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        <span>PHP</span> <span class="pull-right">50%</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        <span>JAVASCRIPT</span> <span class="pull-right">90%</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 90%"
                                                aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        <span>ANIMATION</span> <span class="pull-right">30%</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 30%"
                                                aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        <span>PHOTOSHOP</span> <span class="pull-right">50%</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 50%"
                                                aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="about-me pt-4 pt-md-0">
                                    <div class="title-box-2">
                                        <h5 class="title-left">
                                            About me
                                        </h5>
                                    </div>
                                    <p class="lead">
                                        <?php echo escape($DBInteraction->data()->biography); ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <a href="edit.php?id=<?php echo escape($DBInteraction->data()->userID); ?>">
                            <i class="far fa-edit fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--/ Section Portfolio Star /-->
    <section id="work" class="portfolio-mf sect-pt4 route">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title-box text-center">
                        <h3 class="title-a">
                            Portfolio
                        </h3>
                        <p class="subtitle-a">
                            A look into your previouse projects.
                        </p>
                        <div class="line-mf"></div>
                    </div>
                </div>
            </div>

            <div class="row">

                <?php

                    $portfolioInformation = DatabaseConnectivity::getInstance()->query("
                        SELECT 
                            t1.portfolioID,
                            t1.userID,
                            t1.portfolio_name,
                            t1.portfolio_image,
                            t1.category_id, 
                            t1.portfolio_creation_date,
                            t1.portfolio_description,

                            t2.category_id,
                            t2.category_name
                            
                        FROM 
                            users_portfolio

                        AS

                            t1
                        LEFT JOIN 
                            company_categories
                        as 
                            t2 
                        ON 
                            t1.category_id = t2.category_id

                        WHERE userID = $currentUser

                        ORDER BY portfolioID
                    ");


                    //Check that holidays are being counted.
                    if($portfolioInformation->count())
                    {
                        // Returns the holiday information using a foreach loop.
                        foreach($portfolioInformation->results() as $information)
                        {
                ?>

                    <div class="col-md-4">
                        <div class="work-box">
                            <div class="work-img">
                                <img src="<?php echo escape($information->portfolio_image); ?>" data-toggle="modal" data-target="#<?php echo escape($information->portfolioID); ?>" alt="" class="img-fluid">
                            </div>
                            <div class="work-content">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h2 class="w-title"><?php echo escape($information->portfolio_name); ?></h2>
                                        <div class="w-more">
                                            <span class="w-ctegory"><?php echo escape($information->category_name); ?></span> 
                                                / 
                                            <span class="w-date"><?php echo escape($information->portfolio_creation_date); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="w-like">
                                            <span class="ion-ios-plus-outline"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="<?php echo escape($information->portfolioID); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo escape($information->portfolio_name); ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <img style="width: 100%;" src="<?php echo escape($information->portfolio_image); ?>">

                                    <hr>

                                    <?php echo escape($information->portfolio_description); ?>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    <span class="w-ctegory"><?php echo escape($information->category_name); ?></span> 
                                        / 
                                    <span class="w-date"><?php echo escape($information->portfolio_creation_date); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

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
<script src="plugins/easing/easing.js"></script>
<script src="plugins/masonry/masonry.js"></script>

<script src="plugins/lightbox/js/lightbox.min.js"></script>

<script src="js/blog_custom.js"></script>

<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>
</body>

</html>