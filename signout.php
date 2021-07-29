<?php
// This holds the database information.
require_once($_SERVER['DOCUMENT_ROOT'] . '/HylduThree/lib/PHP/core/Initialization.php');

// Instantiated object of DBWrapplet.php.
$DBInteraction = new DBWrapplet();

// Logs you out by deleting the current sesison.
$DBInteraction->logout();

// Redirect to index.php or any file.
Redirect::redirectTo('index.php');

?>

