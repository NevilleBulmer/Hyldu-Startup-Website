<?php
// Require and includes

// This holds the database information.
require_once($_SERVER['DOCUMENT_ROOT'] . '/HylduThree/lib/PHP/core/Initialization.php');

// Instantiated object of DBWrapplet.php
$DBInteraction = new DBWrapplet();

// Instantiated object of validate.php
$validateRegister = new Validation();

if(CheckInput::inputExists())
{
    if(Token::check(CheckInput::get('token')))
    {
        $validateRegister->validateCheck($_POST, array(
            'form_firstname' => array(
            'required' => true,
            'min' => 2,
            'max' => 50
        ),

            'form_surname' => array(
            'required' => true,
            'min' => 2,
            'max' => 50
        ),
        
            'form_email' => array(
            'required' => true,
            'min' => 2,
            'max' => 20,
            // 'unique' => 'nmc_users'
        ),
        
            'form_password' => array(
            'required' => true,
            'min' => 4
        ),
        
            'form_password_again' => array(
            'required' => true,
            'matches' => 'form_password'
        )

        ));

        // Checks if validation passed validate, passed.
        if ($validateRegister->passed())
        {
            try
            {
                // uses the hash class to generate a salt.
                $salt = HashGenerator::generateSalt(32);

                // Default role to be filled in whena  user creates an account.
                $defaultRole = "Please update!";

                // Default role to be filled in whena  user creates an account.
                $defaultImage = "images/user_images/default_user.png";

                // Default biography to be filled in whena  user creates an account.
                $defaultBiography = "A biography is simple an account of someone\'s life written by another person.";

                // Using createUser this creates a holiday
                // entry in the database table, users.
                $DBInteraction->createUser(array(
                    // Insert into users, nafirstnameme.
                    'firstname' => CheckInput::get('form_firstname'),

                    // Insert into users, surname.
                    'surname' => CheckInput::get('form_surname'),

                    // Insert into users, email.
                    'email' => CheckInput::get('form_email'),

                    // Insert into users, email.
                    'current_role' => $defaultRole,

                    // Insert into users, image.
                    'image' => $defaultImage,

                    // Insert into users, email.
                    'biography' => $defaultBiography,

                    // Insert into users, password and adds the salt and hashes the password.
                    'passwordHash' => HashGenerator::makeHash(CheckInput::get('form_password'), $salt),

                    // Insert into users, salt which is added to password.
                    'salt' => $salt,

                    // Insert into users, grouping for role specification.
                    'grouping' => 1
                ));
                // Sets $login equal to an instanited opbject of the database
                // wrapplet and calls the login functionality.
                $login = $DBInteraction->login(
                    // Checks the inputted username against the one held in the database.
                    CheckInput::get('form_email'),
                    // Checks the inputted password against the one helpd in the database I.e.
                    // it checks the salted and hashed version of the password.
                    CheckInput::get('form_password')
                );

            // If login I.e user is logged in
            if($login)
            {
                // Redirect to index.php or any file.
                Redirect::redirectTo('index.php');
            }else
            {
                // Redirect to 404.php or any file.
                print("Sorry you couldnt be logged in");
            }

            // Catch any thrown exceptions.
            }catch (Exception $e)
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
	<title>Hyldu - Signup</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="styles/util.css">
	<link rel="stylesheet" type="text/css" href="styles/main.css">

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" enctype="multipart/form-data" autocomplete="off">
					<span class="login100-form-logo">
                        <img src="images/logo/logo.png" alt="Logo">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Signup
                    </span>
                    
                    <div class="wrap-input100 validate-input" data-validate="Enter firstname">
                        
                        <input 
                                class="input100" 
                                type="text" 
                                name="form_firstname" 
                                id="form_firstname"
                                value="<?php
                                            // Gets the information inputted into the name field.
                                            echo escape(CheckInput::get('form_firstname'));
                                        ?>"
                                placeholder="Firstname">

						<span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>
                    
                    <div class="wrap-input100 validate-input" data-validate="Enter surname">
                        
                        <input 
                                class="input100" 
                                type="text" 
                                name="form_surname" 
                                id="form_surname"
                                value="<?php
                                            // Gets the information inputted into the name field.
                                            echo escape(CheckInput::get('form_surname'));
                                        ?>"
                                placeholder="Surname">

						<span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>
                    
                    <div class="wrap-input100 validate-input" data-validate="Enter email">
                        
                        <input 
                                class="input100" 
                                type="text" 
                                name="form_email" 
                                id="form_email"
                                value="<?php
                                            // Gets the information inputted into the name field.
                                            echo escape(CheckInput::get('form_email'));
                                        ?>"
                                placeholder="Email">

						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
                       
                        <input 
                                class="input100" 
                                type="password" 
                                name="form_password" 
                                id="form_password"
                                placeholder="Password">

						<span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                       
                        <input 
                                class="input100" 
                                type="password" 
                                name="form_password_again" 
                                id="form_password_again"
                                placeholder="Password Again">

						<span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>
                    
                    <div class="contact100-form-checkbox">
                       
                        <input 
                                class="input-checkbox100" 
                                id="ckb1" 
                                type="checkbox" 
                                name="show-pass"
                                onclick="myFunction()">

						<label class="label-checkbox100" for="ckb1">
							Show Password
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Signup
                        </button>
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="login.php">
							Have An Account?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="dropDownSelect1"></div>
	
    <script src="styles/bootstrap4/bootstrap.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>