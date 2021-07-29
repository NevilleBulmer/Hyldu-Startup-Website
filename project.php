<?php
// Require and includes

// This holds the database information.
require_once($_SERVER['DOCUMENT_ROOT'] . '/HylduThree/lib/PHP/core/Initialization.php');

// Instantiated object of DBWrapplet.php
$DBInteraction = new DBWrapplet();

if (!$_GET['id'])
{
    echo 'Sorry we could not retrieve the required data.';

}
{
    // Checks if the id has been retrieved, if it has then it is used
    // in a query/array to retrieve the holiday corresponding with the id.
    $projectID = $_GET['id'];

    $retrieveProject = DatabaseConnectivity::getInstance()->query("
    SELECT 
        t1.projectID,
        t1.userID,
        t1.company_name,
        t1.company_owner,
        t1.company_tag,
        t1.category_id,
        t1.company_file,
        t1.company_information,
        t1.company_pri_image,
        t1.company_share_one,
        t1.company_share_two,
        t1.company_share_three,

        t2.category_id,
        t2.category_name,

        t3.current_state_id,
        t3.current_state_declaration
        
    FROM 
        projects

        as 
            t1
        LEFT JOIN 
            company_categories
        as 
            t2 
        ON 
            t1.category_id = t2.category_id
        LEFT JOIN 
            company_current_state
        as 
            t3
        ON 
            t1.current_state_id = t3.current_state_id

        WHERE projectID = $projectID

    ");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Hyldu - Project</title>
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
<link rel="stylesheet" type="text/css" href="styles/portfolio_item_styles.css">
<link rel="stylesheet" type="text/css" href="styles/portfolio_item_responsive.css">
</head>

<body>

<div class="super_container">

	<header class="header d-flex flex-row justify-content-end align-items-center trans_200">
		
        <div class="logo mr-auto">
			<a href="#">Hyldu</a>
		</div>

		<nav class="main_nav justify-self-end text-right">
			<ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="people.php">People</a></li>
                <li class="active"><a href="projects.php">Projects</a></li>
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

		<div class="hamburger_container bez_1">
			<i class="fas fa-bars trans_200"></i>
		</div>
		
	</header>

	<div class="menu_container">
        <div class="menu menu_mm text-right">
            <div class="menu_close"><i class="far fa-times-circle trans_200"></i></div>
            <ul class="menu_mm">
                <li><a href="index.php">Home</a></li>
                <li><a href="people.php">People</a></li>
                <li class="active"><a href="projects.php">Projects</a></li>
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

    <?php
        foreach($retrieveProject->results() as $project)
        {
    ?>

	<div class="home">
		<div class="home_background_container prlx_parent">
            <div class="home_background prlx" style="background-image:url(images/slider_background.jpg)"></div>
		</div>
		
		<div class="home_title">
			<h2><?php echo escape($project->company_name); ?></h2>
			<div class="next_section_scroll">
				<div class="next_section nav_links" data-scroll-to=".portfolio">
					<i class="fas fa-chevron-down trans_200"></i>
					<i class="fas fa-chevron-down trans_200"></i>
				</div>
			</div>
		</div>
	
	</div>

	<div class="portfolio">        
		<div class="portfolio_content">
			<div class="container">

                <div class="row">
                    <div class="col-lg-6">
                        <img src="<?php echo escape($project->company_pri_image); ?>" alt="" style="width:100%">
                    </div>

                    <div class="col-lg-6">
                        <ul class="">
                            <li class="info_box_title">Owner</li>
                            <li class="info_box_content">
                                <a href="person.php?id=<?php echo escape($project->userID); ?>"><?php echo escape($project->company_owner); ?></a>
                            </li>
                        </ul>

                        <ul class="">
                            <li class="info_box_title">Share Holders</li>
                            <li class="info_box_content">
                                <a href="#"><?php echo escape($project->company_share_one); ?>, </a>
                                <a href="#"><?php echo escape($project->company_share_two); ?>, </a>
                                <a href="#"><?php echo escape($project->company_share_three); ?></a>
                            </li>
                        </ul>

                        <ul class="">
                            <li class="info_box_title">Company Category</li>
                            <?php echo escape($project->category_name); ?>
                        </ul>

                        <ul class="">
                            <li class="info_box_title">Current State</li>
                            <?php echo escape($project->current_state_declaration); ?>
                        </ul>

                        <ul class="">
                            <li class="info_box_title">Buisness Plan</li>

                            <?php
                                if($DBInteraction->isLoggedIn())
                                {
                                    if($DBInteraction->userHasPermission("elevated"))
                                    {
                                        ?>
                                            <a href="<?php echo escape($project->company_file); ?>">Download</a>
                                        <?php
                                    } else {
                                        ?>
                                            <a href="upgrade.php">Upgrade to show link</a>
                                        <?php
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>

				<div class="row">
					<div class="col-lg-4 portfolio_title_container">
						<h2 class="portfolio_title"><?php echo escape($project->company_name); ?></h2>
                        <div class="portfolio_category"><?php echo escape($project->category_name); ?></div>
                        <div class="portfolio_category"><?php echo escape($project->company_tag); ?></div>
					</div>
				</div>

				<div class="row">
                    <div class="col-lg-12">
                        <p>
                            <?php echo escape($project->company_information); ?>
                        </p>
                    </div>
				</div>
			</div>
		</div>
	</div>

    <?php
        }
    ?>

    <hr>

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
<script src="js/portfolio_item_custom.js"></script>
</body>

</html>