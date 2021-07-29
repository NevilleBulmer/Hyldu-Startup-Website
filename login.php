<?php
// Require and includes

// This holds the database information.
require_once($_SERVER['DOCUMENT_ROOT'] . '/HylduThree/lib/PHP/core/Initialization.php');

// Instantiated object of DBWrapplet.php
$DBInteraction = new DBWrapplet();

// Instantiated object of validate.php
$validateLogin = new Validation();

// Checks if input inputExists using CheckInput.php, inputExists.
if(CheckInput::inputExists())
{
    if(Token::check(CheckInput::get('token')))
    {
        $validateLogin->validateCheck($_POST, array(
            // Validation for username
            'form_email' => array(
            'required' => true
        ),
            // Validation for password
            'form_password' => array(
            'required' => true
        )
        ));

        var_dump($_POST);

        if($validateLogin->passed())
        {
            try
            {
                $login = $DBInteraction->login(
                    CheckInput::get('form_email'),
                    CheckInput::get('form_password')
                );

                    // If login I.e user is logged in
                    if($login)
                    {
                        Session::sessionFlashMessage('Validate', 'You logged in');
                        // Redirect to index.php or any file.
                        Redirect::redirectTo('index.php');
                    }else
                    {
                        // Redirect to 404.php or any file.
                        Redirect::redirectTo(404);
                    }

            // catch any thrown exceptions.
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
	<title>Hyldu - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
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
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter Email">
                       
                        <input 
                                class="input100" 
                                type="text"
                                name="form_email"
                                id="form_email"
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
						<button class="login100-form-btn">
							Login
                        </button>
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="reset.php">
							Forgot Password?
                        </a>

                        <hr>
                        
                        <a class="txt1" href="signup.php">
                            Need An Account?
                        </a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
	<script src="styles/bootstrap4/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>