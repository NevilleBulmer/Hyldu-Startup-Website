<?php
// Require and includes

// This holds the database information.
require_once($_SERVER['DOCUMENT_ROOT'] . '/HylduThree/lib/PHP/core/Initialization.php');

// Instantiated object of DBWrapplet.php
$DBInteraction = new DBWrapplet();

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 20;

$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

if(isset($_POST["search_username"])) 
{
    $searchTerm = $_POST['search_querie'];

    $projectInformation = DatabaseConnectivity::getInstance()->query("
        SELECT 
            t1.projectID,
            t1.userID,
            t1.company_name,
            t1.company_tag,
            t1.category_id,
            t1.company_information,
            t1.company_pri_image,

            t2.category_id,
            t2.category_name
            
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

            WHERE company_name LIKE '%%$searchTerm%%'
    ");

} else {

    $projectInformation = DatabaseConnectivity::getInstance()->query("
        SELECT 
            t1.projectID,
            t1.userID,
            t1.company_name,
            t1.company_tag,
            t1.category_id,
            t1.company_information,
            t1.company_pri_image,

            t2.category_id,
            t2.category_name
            
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

            ORDER BY company_name

            LIMIT {$start}, {$perPage}
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
<link rel="stylesheet" type="text/css" href="styles/portfolio_styles.css">
<link rel="stylesheet" type="text/css" href="styles/portfolio_responsive.css">
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

	<div class="home">
		<div class="home_background_container prlx_parent">
            <div class="home_background prlx" style="background-image:url(images/slider_background.jpg)"></div>
		</div>
		
		<div class="home_title">
			<h2>Projects</h2>
			<div class="next_section_scroll">
				<div class="next_section nav_links" data-scroll-to=".portfolio">
					<i class="fas fa-chevron-down trans_200"></i>
					<i class="fas fa-chevron-down trans_200"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="portfolio">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="portfolio_categories button-group filters-button-group">
						<ul>
							<li class="portfolio_category active is-checked" data-filter="*">all</li>
							<li class="portfolio_category" data-filter=".Graphic-Design">Graphic Design</li>
                            <li class="portfolio_category" data-filter=".Animation">Animation</li>
							<li class="portfolio_category" data-filter=".Branding">Branding</li>
							<li class="portfolio_category" data-filter=".Web-Design">Web Design</li>
                            <li class="portfolio_category" data-filter=".Software">Software</li>

                            <li class="portfolio_category" data-filter=".Mobile">Mobile</li>

                            <li class="portfolio_category" data-filter=".UI">UI</li>

                            <li class="portfolio_category" data-filter=".UX">UX</li>

                            
                            <form class="" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="row ">
                                    <!--end of col-->
                                    <div class="col px-2">
                                        <input class="form-control form-control-lg form-control-borderless" type="search" name="search_querie" placeholder="Search project name">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-success" name="search_username" type="submit">Search</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </ul>
					</div>
				</div>
            </div>
            
			<div class="row">
                
                    <?php

                        $numOfCols = 3;
                        $rowCount = 0;
                        $bootstrapColWidth = 12 / $numOfCols;
                        //Check that projects are being counted.
                        if($projectInformation->count())
                        {
                            // Returns the project information using a foreach loop.
                            foreach($projectInformation->results() as $information)
                            {
                    ?>

                            
                        
                            <!--end of col-->
                            <div class="portfolio_item col-md-<?php echo $bootstrapColWidth; ?> <?php echo escape($information->category_name); ?>">


                                <img class="card-img-top" src="<?php echo escape($information->company_pri_image); ?>" alt="">

                                <div class="card-header"><?php echo escape($information->category_name); ?></div>
                                <div class="card-title"><?php echo escape($information->company_name); ?></div>
                                <div class="card-text"><?php echo escape(mb_strimwidth($information->company_information, 0, 100)); ?></div>
                                <div class="card-link"><a href="project.php?id=<?php echo escape($information->projectID); ?>">read more</a></div>
                            </div>

                            <!--end of col-->
                       

                    <?php
                            }
                        }
                    ?>
                
			</div>
		</div>

        <div class="home_title">
            <a href="#">&laquo;</a>
            <a href="?page=1">1</a>
            <a href="">&raquo;</a>
        </div>
    </div>
    
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
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/scrollTo/jquery.scrollTo.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/portfolio_custom.js"></script>
</body>

</html>