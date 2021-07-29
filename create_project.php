<?php
// Require and includes

// This holds the database information.
require_once($_SERVER['DOCUMENT_ROOT'] . '/HylduThree/lib/PHP/core/Initialization.php');

// Instantiated object of DBWrapplet.php
$DBInteraction = new DBWrapplet();

// Instantiated object of Validate.php
$validate = new Validation();

$currentUser = $DBInteraction->data()->userID;

if(isset($_POST["confirm_publish"])) 
{
    if(CheckInput::inputExists())
    {
        $validate->validateCheck($_POST, array(
                'company_name' => array(
                    'required' => true,
                    'min' => 4,
                    'max' => 255
            ),
                'company_catch_line' => array(
                    'min' => 4,
                    'max' => 255
            ),
            
                'company_owner_name' => array(
                    'min' => 4,
                    'max' => 50
            ),
                'company_owner_share_one' => array(
                    'min' => 4,
                    'max' => 50
            ),
                'company_owner_share_two' => array(
                    'min' => 4,
                    'max' => 50
            ),
                'company_owner_share_three' => array(
                    'min' => 4,
                    'max' => 50
            ),
                'company_information' => array(
                    'min' => 4,
                    'max' => 5000
            )
        ));

        if($validate->passed())
        {
            try
            {
                $plan_destination = '';
                $project_image_destination = '';

                if ($_FILES['business_plan_file']['size'] == 0)
                {
                    
                }else{
                    // Retrieve the file from createHoliday.php.
                    $file = $_FILES['business_plan_file'];

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
                    $allowed = array('docx', 'txt', 'pdf');

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
                                    $plan_destination = 'lib/user_files/documents/' . $file_name_new;

                                    // If setting movement of the file was successful.
                                    if(move_uploaded_file($file_tmp, $plan_destination))
                                    {
                                        // The files destination.
                                        $plan_destination;

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

                if ($_FILES['business_image_file']['size'] == 0)
                {

                }else{
                    // Retrieve the file from createHoliday.php.
                    $file = $_FILES['business_image_file'];

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
                                    $project_image_destination = 'lib/user_files/project_images/' . $file_name_new;

                                    // If setting movement of the file was successful.
                                    if(move_uploaded_file($file_tmp, $project_image_destination))
                                    {
                                        // The files destination.
                                        $project_image_destination;

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

                $DBInteraction->createProject(array(
                    'userID' => $currentUser,
                    
                    'company_name' => CheckInput::get('company_name'),
                    'company_tag' => CheckInput::get('company_catch_line'),

                    'category_id' => CheckInput::get('company_category'),

                    'current_state_id' => CheckInput::get('company_state'),

                    'company_owner' => CheckInput::get('company_owner_name'),
                    'company_share_one' => CheckInput::get('company_owner_share_one'),
                    'company_share_two' => CheckInput::get('company_owner_share_two'),
                    'company_share_three' => CheckInput::get('company_owner_share_three'),
                    'company_information' => CheckInput::get('company_information'),

                    'company_file' => $plan_destination,

                    'company_pri_image' => $project_image_destination,

                    'is_active' => 1
                ));


                    
                //Redirect::redirectTo('account.php');
            }catch(Exception $e)
            {
                die($e->getMessage());
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Hyldu - Create</title>
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
			<h2>Register a project</h2>
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
            <form method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box-shadow-full">
                            <div class="about-me pt-4 pt-md-0">

                                <!-- Company same -->
                                <div class="form-group">
                                    <label for="company_name">Name.</label>
                                    <input 
                                            class="form-control" 
                                            type="text" 
                                            id="company_name" 
                                            name="company_name" 
                                            placeholder="Name"

                                            data-toggle="tooltip"
                                            data-html="true" 
                                            title="Your companies <em>Name</em>">
                                </div>
                                
                                <!-- Company catch line -->
                                <div class="form-group">
                                    <label for="company_catch_line">Company Tag/Catch Line.</label>
                                    <input 
                                            class="form-control" 
                                            type="text"                                     
                                            id="company_catch_line" 
                                            name="company_catch_line" 
                                            placeholder="Company Tag/Catch Line"
                                            
                                            data-toggle="tooltip"
                                            data-html="true" 
                                            title="Your companies <br><em>Call To Action</em>">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="about-me pt-4 pt-md-0">

                                        <!-- Category selection -->
                                        <div class="form-group">
                                            <label for="company_category">Category.</label>
                                                <select 
                                                    class="form-control" 
                                                    id="company_category"
                                                    value="<?php 
                                                                // Gets an escaped version of the information from the location ID option field.
                                                                echo escape(CheckInput::get('company_category')); 
                                                            ?>"
                                                    name="company_category"
                                                    
                                                    data-toggle="tooltip"
                                                    data-html="true" 
                                                    title="Your companies <em>Speciality</em>">

                                                    <option value="company_category">Choose Category</option>
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

                                        <!-- State selection -->
                                        <div class="form-group">
                                            <label for="company_state">Current State.</label>
                                                <select 
                                                    class="form-control" 
                                                    id="company_state"
                                                    value="<?php 
                                                                // Gets an escaped version of the information from the location ID option field.
                                                                echo escape(CheckInput::get('company_state')); 
                                                            ?>"
                                                    name="company_state"
                                                    
                                                    data-toggle="tooltip"
                                                    data-html="true" 
                                                    title="Your companies <em>Condition</em>">

                                                    <option value="company_state">Choose State</option>
                                                    <?php
                                                        // Sets $getLocation to an sql statement.
                                                        $getState = DatabaseConnectivity::getInstance()->query("
                                                            SELECT current_state_id, current_state_declaration FROM company_current_state;");

                                                    // Check that locations are being counted.
                                                    if($getState->count())
                                                    {
                                                        // Returns the location using a foreach loop.
                                                        foreach($getState->results() as $state)
                                                        {
                                                    ?>
                                                        <option value="<?php
                                                                            // Pulls the location ID from the database.
                                                                            echo escape($state->current_state_id); 
                                                                        ?>">
                                                                        <?php 
                                                                            // pulls the location name from the database
                                                                            // to be displayed to the user.
                                                                            echo escape($state->current_state_declaration); 
                                                                        ?>
                                                        </option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>              
                                            <select>
                                        </div>

                                        
                                            <div class="row">
                                                <div class="col-sm">

                                                    <!-- File input -->
                                                    <label>Buisness Plan.</label>
                                                    <div style="position:relative;">
                                                        <a class='btn btn-primary' href='javascript:;'>
                                                            Choose File...
                                                            <input 
                                                                    type="file" 
                                                                    name="business_plan_file" 
                                                                    style='position:absolute;z-index:2;top:0;left:0;right:0;ilter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' 
                                                                    size="40"  
                                                                    onchange='$("#upload-plan-file-info").html($(this).val());'
                                                                    
                                                                    data-toggle="tooltip"
                                                                    data-html="true" 
                                                                    title="A buisness plan">

                                                        </a>

                                                        <span class='label label-info' id="upload-plan-file-info"></span>

                                                    </div>    
                                            
                                                </div>
                                                
                                                <div class="col-sm">

                                                    <!-- File input -->
                                                    <label>Project Image.</label>
                                                    <div style="position:relative;">
                                                        <a class='btn btn-primary' href='javascript:;'>
                                                            Choose File...
                                                            <input 
                                                                    type="file" 
                                                                    name="business_image_file" 
                                                                    style='position:absolute;z-index:2;top:0;left:0;right:0;ilter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' 
                                                                    size="40"  
                                                                    onchange='$("#upload-image-file-info").html($(this).val());'
                                                                    
                                                                    data-toggle="tooltip"
                                                                    data-html="true" 
                                                                    title="An image to show of your <em>Website?</em>">

                                                        </a>

                                                        <span class='label label-info' id="upload-image-file-info"></span>

                                                    </div>

                                                </div>
                                            </div>
                                        

                                        
                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <!-- Onwer -->
                                    <div class="form-group">
                                        <label for="company_owner_name">Owner.</label>
                                        <input 
                                                class="form-control" 
                                                type="text" 
                                                id="company_owner_name"
                                                name="company_owner_name"
                                                placeholder="Owner"
                                                
                                                data-toggle="tooltip"
                                                data-html="true" 
                                                title="The company <em>Owner</em>">
                                    </div>
                                    
                                    <!-- Share holder -->
                                    <div class="form-group">
                                        <label for="company_owner_share_one">Share/Stake Holder One.</label>
                                        <input 
                                                class="form-control" 
                                                type="text" 
                                                id="company_owner_share_one"
                                                name="company_owner_share_one" 
                                                placeholder="Share..."
                                                
                                                data-toggle="tooltip"
                                                data-html="true" 
                                                title="A <em>Shareholder</em>">
                                    </div>

                                    <!-- Share holder -->
                                    <div class="form-group">
                                        <label for="company_owner_share_two">Share/Stake Holder Two.</label>
                                        <input 
                                                class="form-control" 
                                                type="text" 
                                                id="company_owner_share_two" 
                                                name="company_owner_share_two"
                                                placeholder="Share..."
                                                
                                                data-toggle="tooltip"
                                                data-html="true" 
                                                title="A <em>Shareholder</em>">
                                    </div>

                                    <!-- Share holder -->
                                    <div class="form-group">
                                        <label for="company_owner_share_three">Share/Stake Holder Three.</label>
                                        <input 
                                                class="form-control" 
                                                type="text" 
                                                id="company_owner_share_three"
                                                name="company_owner_share_three" 
                                                placeholder="Share..."
                                                
                                                data-toggle="tooltip"
                                                data-html="true" 
                                                title="A <em>Shareholder</em>">
                                    </div>
                                </div>
                            </div>

                            <!-- Information, brief about the project -->
                            <div class="form-group">
                                <label for="company_information">Brief about your idea, company, project.</label>
                                    <p class="lead">
                                        <TextArea 
                                                rows="10"
                                                cols="99"
                                                class="form-control testing" 
                                                type="text"
                                                name="company_information"
                                                id="company_information"
                                                maxlength="5000"
                                                placeholder="Information"
                                                
                                                data-toggle="tooltip"
                                                data-html="true" 
                                                title="Please hand type instead of pasting"></TextArea>

                                                <p id="count_message"></p>

                                    </p>
                                </div>


                                <button 
                                        name="confirm_publish" 
                                        type="submit" 
                                        class="btn btn-success">Publish</button>

                                <button 
                                        name="confirm_draft" 
                                        type="submit" 
                                        class="btn btn-secondary">Save as Draft</button>
                        </div>
                    </div>
                </div>
            </form>
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
<script src="js/blog_custom.js"></script>

<script>
    // Count remaining charactors allowed
    var text_max = 5000;
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