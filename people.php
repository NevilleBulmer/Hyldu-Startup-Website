<?php
// Require and includes

// This holds the database information.
require_once($_SERVER['DOCUMENT_ROOT'] . '/HylduThree/lib/PHP/core/Initialization.php');

// Instantiated object of DBWrapplet.php
$DBInteraction = new DBWrapplet();

if(isset($_POST["search_username"])) 
{
    $searchTerm = $_POST['search_querie'];

    $personInformation = DatabaseConnectivity::getInstance()->query("
        SELECT 
            userID,
            firstname,
            surname,
            image,
            current_role, 
            biography 
            
        FROM 
            hyldu_users

        WHERE firstname LIKE '%%$searchTerm%%'
    ");

} else {

    $personInformation = DatabaseConnectivity::getInstance()->query("
        SELECT 
            userID,
            firstname,
            surname,
            image,
            current_role, 
            biography 
            
        FROM 
            hyldu_users
    ");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Hyldu - Projects</title>
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

	<header class="header d-flex flex-row justify-content-end align-items-center trans_200">
		
		<!-- Logo -->
		<div class="logo mr-auto">
			<a href="#">Hyldu</a>
		</div>

		<!-- Navigation -->
		<nav class="main_nav justify-self-end text-right">
			<ul>
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="people.php">People</a></li>
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
                <li class="active"><a href="people.php">People</a></li>
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
			<h2>People</h2>
			<div class="next_section_scroll">
				<div class="next_section nav_links" data-scroll-to=".people">
					<i class="fas fa-chevron-down trans_200"></i>
					<i class="fas fa-chevron-down trans_200"></i>
				</div>
			</div>
		</div>
	
    </div>
  
    <!-- Service Boxes -->
    
	<div class="people">
		<div class="container">
		
        <!-- Search form -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <form class="card-sm" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="card-body row no-gutters align-items-center">
                        <!--end of col-->
                        <div class="col px-2">
                            <input class="form-control form-control-lg form-control-borderless" type="search" name="search_querie" placeholder="Search firstname">
                        </div>
                        <!--end of col-->
                        <div class="col-auto">
                            <button class="btn btn-lg btn-success" name="search_username" type="submit">Search</button>
                        </div>
                        <!--end of col-->
                    </div>
                </form>
            </div>
            <!--end of col-->
        </div>

        <div class="row">
            <?php
                //Check that holidays are being counted.
                if($personInformation->count())
                {
                    // Returns the holiday information using a foreach loop.
                    foreach($personInformation->results() as $information)
                    {
            ?>

                <div class="col-sm-4 my-4">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo escape($information->image); ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo escape($information->firstname . " " . $information->surname); ?></h5>
                            <p class="card-text"><?php echo escape(mb_strimwidth($information->biography, 0, 100)); ?></p>

                            <div class="card-link"><a href="person.php?id=<?php echo escape($information->userID); ?>">Visit Profile</a></div>
                        </div>       
                        <div class="card-footer">
                            <small class="text-muted">Last online ?</small>
                        </div> 
                    </div>
                </div>

            <?php
                    }
                }
            ?>
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
<script src="js/services_custom.js"></script>
</body>

</html>