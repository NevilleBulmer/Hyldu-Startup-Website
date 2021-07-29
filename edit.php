<?php
// Require and includes

// This holds the database information.
require_once($_SERVER['DOCUMENT_ROOT'] . '/HylduThree/lib/PHP/core/Initialization.php');

// Instantiated object of DBWrapplet.php
$DBInteraction = new DBWrapplet();

// Instantiated object of Validate.php
$validate = new Validation();

// If needed the current userID
$currentUser = $DBInteraction->data()->userID;

if(isset($_POST["confirm_edit"])) 
{
    if(CheckInput::inputExists())
    {
        $validate->validateCheck($_POST, array(
                'form_firstname' => array(
                    'min' => 4,
                    'max' => 20
            ),
                'form_surname' => array(
                    'min' => 4,
                    'max' => 20
            ),
            
                'form_current_role' => array(
                    'min' => 4,
                    'max' => 20
            ),
                'form_email' => array(
                    'min' => 4,
                    'max' => 20
            ),
                'form_phone' => array(
                    'min' => 4,
                    'max' => 11
            ),
                'form_biography' => array(
                    'min' => 4,
                    'max' => 255
            )
        ));

        if ($validate->passed())
        {
            try
            {
                    if($_POST['form_firstname'] == '')
                    {
                    }else{
                        DatabaseConnectivity::getInstance()->update('hyldu_users', $currentUser, array(
                            'firstname' => CheckInput::get('form_firstname')
                        ));
                    }

                    if($_POST['form_surname'] == '')
                    {

                    }else{
                        DatabaseConnectivity::getInstance()->update('hyldu_users', $currentUser, array(
                            'surname' => CheckInput::get('form_surname')
                        ));
                    }

                    if($_POST['form_current_role'] == '')
                    {

                    }else{
                        DatabaseConnectivity::getInstance()->update('hyldu_users', $currentUser, array(
                            'current_role' => CheckInput::get('form_current_role')
                        ));
                    }

                    if($_POST['form_email'] == '')
                    {

                    }else{
                        DatabaseConnectivity::getInstance()->update('hyldu_users', $currentUser, array(
                            'email' => CheckInput::get('form_email')
                        ));
                    }

                    if($_POST['form_biography'] == '')
                    {

                    }else{
                        DatabaseConnectivity::getInstance()->update('hyldu_users', $currentUser, array(
                            'biography' => CheckInput::get('form_biography')
                        ));
                    }

                    if($_POST['form_phone'] == '')
                    {

                    }else{
                        DatabaseConnectivity::getInstance()->update('hyldu_users', $currentUser, array(
                            'phone' => CheckInput::get('form_phone')
                        ));
                    }
                
                    if ($_FILES['user_image_file']['size'] == 0)
                    {
                        
                    }else{
                        // Retrieve the file from createHoliday.php.
                        $file = $_FILES['user_image_file'];

                        // File proerties.
                        // Instantiateds file_destination so it can be used in the creationarray.
                        $profile_image_destination = '';

                        // The file name.
                        $file_name = $file['name'];

                        // The files temp location.
                        $file_tmp = $file['tmp_name'];

                        // The files size.
                        $file_size = $file['size'];

                        // If there is an error it can be used/deisplayed using file_error.
                        $file_error = $file['error'];

                        // Extracting the file extension.
                        $file_ext = explode('.', $file_name);

                        // Makes the file extension lower case.
                        $file_ext = strtolower(end($file_ext));

                        // Allowed extensions array.
                        $allowed = array('png', 'jpg', 'jpeg');

                            if(in_array($file_ext, $allowed))
                            {
                                // Checks if there was any error, if error is === 0 then no errors
                                // where found or detected.
                                if($file_error === 0)
                                {
                                    // Checks the file size to see if it is less than or equal too 5mb,
                                    // if it is then a unique id is generated for its file name.
                                    if($file_size <= 5242880)
                                    {
                                        // Generating the unique id for the file name.
                                        $file_name_new = uniqid('', true) . '.' . $file_ext;

                                        // Declare the file destination I.e. file path with name.
                                        $profile_image_destination = 'lib/user_files/profile_images/' . $file_name_new;

                                        // If setting movement of the file was successful.
                                        if(move_uploaded_file($file_tmp, $profile_image_destination))
                                        {
                                            // The files destination.
                                            $profile_image_destination;

                                        }else
                                        {
                                            // If there was a problem moving the file.
                                            throw new Exception('There was a problem moving the file');
                                        }
                                    }else
                                    {
                                        // If the file is too big I.e. bigger than 5MB.
                                        throw new Exception('Sorry the file is too large');
                                    }
                                }else
                                {
                                    // If any error is found or detected a new exception will be thrown.
                                    // Last line of defence.
                                    throw new Exception($file_error);
                                }
                            }

                        DatabaseConnectivity::getInstance()->update('hyldu_users', $currentUser, array(
                            'image' => $profile_image_destination
                        ));
                    }

                Redirect::redirectTo('account.php');
            }catch(Exception $e)
            {
                die($e->getMessage());
            }
        }
    }
}


if(isset($_POST["confirm_publish"])) 
{
    if(CheckInput::inputExists())
    {
        $validate->validateCheck($_POST, array(
                'portfolio_name' => array(
                    'required' => true,
                    'min' => 4,
                    'max' => 255
            ),            
                'portfolio_information' => array(
                    'min' => 4,
                    'max' => 1000
            )

        ));

        if($validate->passed())
        {
            try
            {
                $portfolio_image_destination = '';

                if ($_FILES['portfolio_image_file']['size'] == 0)
                {
                    
                }else{
                    
                    $file = $_FILES['portfolio_image_file'];

                    // The file name.
                    $file_name = $file['name'];

                    // The files temp location.
                    $file_tmp = $file['tmp_name'];

                    // The files size.
                    $file_size = $file['size'];

                    // If there is an error it can be used/deisplayed using file_error.
                    $file_error = $file['error'];

                    // Extracting the file extension.
                    $file_ext = explode('.', $file_name);

                    // Makes the file extension lower case.
                    $file_ext = strtolower(end($file_ext));

                    // Allowed extensions array.
                    $allowed = array('png', 'jpg', 'jpeg');

                        if(in_array($file_ext, $allowed))
                        {
                            // Checks if there was any error, if error is === 0 then no errors
                            // where found or detected.
                            if($file_error === 0)
                            {
                                // Checks the file size to see if it is less than or equal too 5mb,
                                // if it is then a unique id is generated for its file name.
                                if($file_size <= 5242880)
                                {
                                    // Generating the unique id for the file name.
                                    $file_name_new = uniqid('', true) . '.' . $file_ext;

                                    // Declare the file destination I.e. file path with name.
                                    $portfolio_image_destination = 'lib/user_files/portfolio_images/' . $file_name_new;

                                    // If setting movement of the file was successful.
                                    if(move_uploaded_file($file_tmp, $portfolio_image_destination))
                                    {
                                        // The files destination.
                                        $portfolio_image_destination;

                                    }else
                                    {
                                        // If there was a problem moving the file.
                                        throw new Exception('There was a problem moving the file');
                                    }
                                }else
                                {
                                    // If the file is too big I.e. bigger than 5MB.
                                    throw new Exception('Sorry the file is too large');
                                }
                            }else
                            {
                                // If any error is found or detected a new exception will be thrown.
                                // Last line of defence.
                                throw new Exception($file_error);
                            }
                        }
                    }

                $DBInteraction->createPortfolioEntry(array(
                    'userID' => $currentUser,
                    'portfolio_name' => CheckInput::get('portfolio_name'),
                    'portfolio_image' => $portfolio_image_destination,

                    'category_id' => CheckInput::get('portfolio_item_category'),
                    'portfolio_creation_date' => date("F.d Y"),
                    'portfolio_description' => CheckInput::get('portfolio_information')
                ));

                //Redirect::redirectTo('account.php');
            }catch(Exception $e)
            {
                die($e->getMessage());
            }
        }
    }
}


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

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Hyldu - Edit</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="hyldu Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link href="plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
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
				<div class="next_section nav_links" data-scroll-to=".blog">
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
                            <form class="row" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-5">
                                            <div class="about-img">

                                                <input 
                                                        style='height: 150px; width: 150px;' 
                                                        id='img-upload' 
                                                        class="rounded-circle" 
                                                        type="image" src="<?php echo escape($DBInteraction->data()->image); ?>"/>

                                                <div style="position:relative;">
                                                    <a class='btn btn-primary' href='javascript:;'>
                                                        Choose Image...
                                                        <input 
                                                                id="imgInp"
                                                                type="file" 
                                                                name="user_image_file" 
                                                                style='position:absolute; z-index:2; top:0; left:0; right:0; ilter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' 
                                                                size="40"  
                                                    
                                                                data-toggle="tooltip"
                                                                data-html="true" 
                                                                title="Please make the image size<br> 100x100"

                                                                onchange='$("#upload-file-info").html($(this).val());'>
                                                    </a>
                                                    <span class='label label-info' id="upload-file-info"></span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-7">
                                            <div class="about-info">
                                                <p>
                                                    <span class="title-s">Firstname: <br></span> 
                                                        <span>

                                                            <input 
                                                                class="input100" 
                                                                type="text"
                                                                name="form_firstname"
                                                                id="form_firstname"
                                                                placeholder="<?php echo escape($DBInteraction->data()->firstname); ?>">
                                                            
                                                        </span>
                                                </p>

                                                <p>
                                                    <span class="title-s">Surname: <br></span> 
                                                        <span>
                                                        
                                                            <input 
                                                                    class="input100" 
                                                                    type="text"
                                                                    name="form_surname"
                                                                    id="form_surname"
                                                                    placeholder="<?php echo escape($DBInteraction->data()->surname); ?>">

                                                        </span>
                                                </p>

                                                <p>
                                                    <span class="title-s">C/Role: <br></span> 
                                                        <span>
                                                        
                                                            <input 
                                                                    class="input100" 
                                                                    type="text"
                                                                    name="form_current_role"
                                                                    id="form_current_role"
                                                                    placeholder="<?php echo escape($DBInteraction->data()->current_role); ?>">

                                                        </span>
                                                </p>

                                                <p>
                                                    <span class="title-s">Email: <br></span> 
                                                        <span>
                                                        
                                                            <input 
                                                                    class="input100" 
                                                                    type="text"
                                                                    name="form_email"
                                                                    id="form_email"
                                                                    placeholder="<?php echo escape($DBInteraction->data()->email); ?>">

                                                        </span>
                                                </p>

                                                <p>
                                                    <span class="title-s">Phone: <br></span> 
                                                        <span>
                                                            <input 
                                                                    class="input100" 
                                                                    type="text"
                                                                    name="form_phone"
                                                                    id="form_phone"
                                                                    placeholder="<?php echo escape($DBInteraction->data()->phone); ?>">

                                                        </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="skill-mf">
                                        <p class="title-s">Relevant Skills</p>

                                            <span>HTML</span> <span class="pull-right">85%</span>
                                            <div class="slider-wrapper">
                                                <input class="progress-bar" type="range" min="0" max="100" value="85"  id="myRange2" style="width: 100%">
                                                <!-- <span></span> -->
                                            </div>

                                            <span>CSS3</span> <span class="pull-right">75%</span>
                                            <div class="slider-wrapper">
                                                <input class="progress-bar" type="range" min="0" max="100" value="75"  id="myRange2" style="width: 100%">
                                                <!-- <span></span> -->
                                            </div>

                                            <span>PHP</span> <span class="pull-right">50%</span>
                                            <div class="slider-wrapper">
                                                <input class="progress-bar" type="range" min="0" max="100" value="50"  id="myRange2" style="width: 100%">
                                                <!-- <span></span> -->
                                            </div>

                                            <span>JAVASCRIPT</span> <span class="pull-right">90%</span>
                                            <div class="slider-wrapper">
                                                <input class="progress-bar" type="range" min="0" max="100" value="90"  id="myRange2" style="width: 100%">
                                                <!-- <span></span> -->
                                            </div>

                                            <span>ANIMATION</span> <span class="pull-right">30%</span>
                                            <div class="slider-wrapper">
                                                <input class="progress-bar" type="range" min="0" max="100" value="90"  id="myRange2" style="width: 100%">
                                                <!-- <span></span> -->
                                            </div>

                                            <span>PHOTOSHOP</span> <span class="pull-right">90%</span>
                                            <div class="slider-wrapper">
                                                <input class="progress-bar" type="range" min="0" max="100" value="90"  id="myRange2" style="width: 100%">
                                                <!-- <span></span> -->
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

                                            <TextArea 
                                                    rows="27"
                                                    cols="75"
                                                    class="form-control testing" 
                                                    type="text"
                                                    name="form_biography"
                                                    id="form_biography"
                                                    placeholder="<?php echo escape($DBInteraction->data()->biography); ?>"></TextArea>

                                        </p>
                                    </div>
                                </div>
                            </div>
                            <button name="confirm_edit" type="submit" class="btn btn-danger">Update</button>
                            <button name="cancel_edit" type="submit" class="btn btn-success" onclick="return confirm('Are you sure?')">Cancel</button>
                        </form>
                    </div>
                </div>

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

                                    <?php
                                        if($portfolioInformation->count() == 6)
                                        {

                                        } else {
                                    ?>
                                    
                                        <a href="" data-toggle="modal" data-target="#addToPortfolio">
                                            <p class="subtitle-a">
                                                Add to your portfolio.
                                            </p>
                                        </a>

                                    <?php
                                        }
                                    ?>

                                    <div class="line-mf"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <?php

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

                <div class="modal fade" id="addToPortfolio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add to your portfolio</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Company same -->
                                    <div class="form-group">
                                        <label for="company_name">Portfolio Item Name.</label>
                                        
                                        <input 
                                                class="form-control" 
                                                type="text" 
                                                id="portfolio_name" 
                                                name="portfolio_name" 
                                                placeholder="Portfolio name">

                                    </div>
                                    

                                    <!-- Category selection -->
                                    <div class="form-group">
                                        <label for="portfolio_item_category">Category.</label>
                                            <select 
                                                class="form-control" 
                                                id="portfolio_item_category"
                                                value="<?php 
                                                            // Gets an escaped version of the information from the location ID option field.
                                                            echo escape(CheckInput::get('portfolio_item_category')); 
                                                        ?>"
                                                name="portfolio_item_category">

                                                <option value="portfolio_item_category">Choose Category</option>
                                                <?php
                                                    // Sets $getLocation to an sql statement.
                                                    $getCategory = DatabaseConnectivity::getInstance()->query("
                                                        SELECT category_id, category_name FROM company_categories;");

                                                // Check that locations are being counted.
                                                if($getCategory->count())
                                                {
                                                    // Returns the location using a foreach loop.
                                                    foreach($getCategory->results() as $category)
                                                    {
                                                ?>
                                                    <option value="<?php
                                                                        // Pulls the location ID from the database.
                                                                        echo escape($category->category_id); 
                                                                    ?>">
                                                                    <?php 
                                                                        // pulls the location name from the database
                                                                        // to be displayed to the user.
                                                                        echo escape($category->category_name); 
                                                                    ?>
                                                    </option>
                                                <?php
                                                    }
                                                }
                                                ?>              
                                        <select>
                                    </div>


                                </div>
                                
                                <div class="modal-body">
                                                                    
                                    <!-- File input -->
                                    <div style="position:relative;">
                                        <a class='btn btn-primary' href='javascript:;'>
                                            Choose File...
                                            <input 
                                                    type="file" 
                                                    name="portfolio_image_file" 
                                                    style='position:absolute;z-index:2;top:0;left:0;right:0;ilter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' 
                                                    size="40"  
                                                    onchange='$("#upload-portfolio-image-info").html($(this).val());'>

                                        </a>

                                        <span class='label label-info' id="upload-portfolio-image-info"></span>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label for="portfolio_information">Brief about your idea, portfolio item.</label>
                                            <p class="lead">
                                                <TextArea 
                                                        rows="10"
                                                        cols="99"
                                                        class="form-control testing" 
                                                        type="text"
                                                        name="portfolio_information"
                                                        id="portfolio_information"
                                                        maxlength="1000"
                                                        placeholder="Information"></TextArea>

                                                        <p id="count_message"></p>

                                            </p>
                                        </div>


                                        <button 
                                                name="confirm_publish" 
                                                type="submit" 
                                                class="btn btn-success">Publish</button>

                                        <button 
                                                name="cancel_publish" 
                                                type="submit" 
                                                class="btn btn-secondary"
                                                data-dismiss="modal" 
                                                aria-label="Close">Cancel</button>

                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </form>
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
<script src="plugins/easing/easing.js"></script>
<script src="plugins/masonry/masonry.js"></script>
<script src="js/blog_custom.js"></script>

<script>
    var sliderWrappers = document.getElementsByClassName('slider-wrapper');


    for(var i = 0; i < sliderWrappers.length; i++) {

        // This targets the <input> child element.
        var slider = sliderWrappers[i].childNodes[1];
    
        // This targets the <span> child element.
        var sliderOutput = sliderWrappers[i].childNodes[3];

        sliderValue(slider, sliderOutput);
    
    }

    // This function runs on each loop of the for() loop above, meaning the values assigned to the variables individually set on each loop iteration.
    function sliderValue(slider, sliderOutput) {
        sliderOutput.innerHTML = slider.value;
        slider.oninput = function() {
            sliderOutput.innerHTML = this.value;
        }
    }




    // $(document).ready( function() {
    // 	$(document).on('change', '.btn-file :file', function() {
	// 	var input = $(this),
	// 		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	// 	input.trigger('fileselect', [label]);
	// 	});

	// 	$('.btn-file :file').on('fileselect', function(event, label) {
		    
	// 	    var input = $(this).parents('.input-group').find(':text'),
	// 	        log = label;
		    
	// 	    if( input.length ) {
	// 	        input.val(log);
	// 	    } else {
	// 	        if( log ) alert(log);
	// 	    }
	    
	// 	});
	// 	function readURL(input) {
	// 	    if (input.files && input.files[0]) {
	// 	        var reader = new FileReader();
		        
	// 	        reader.onload = function (e) {
	// 	            $('#img-upload').attr('src', e.target.result);
	// 	        }
		        
	// 	        reader.readAsDataURL(input.files[0]);
	// 	    }
	// 	}

	// 	$("#imgInp").change(function(){
	// 	    readURL(this);
	// 	}); 	
    // });
    

    // Count remaining charactors allowed
    var text_max = 1000;
    var text_min = 0;

    $('#count_message').html(text_max + ' remaining');
        $('#company_information').keyup(function()
        {
            var text_length = $('#company_information').val().length;
            text_remaining = text_max - text_length;
            
        $('#count_message').html(text_remaining + ' remaining');
    });

    // Tool tip fucntionality
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

</body>

</html>