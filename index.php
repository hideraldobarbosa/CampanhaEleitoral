<?php 

session_start();

require('bootstrap.php');

    if (isset($_GET['view'])) {
        $view = new View;
		$view->load($_GET['view']);
	}

	if ((!isset($_GET['controller'])) && (!isset($_GET['action']))) { 
		$view = new View;
		$view->load("Login");
 
	}

	if (!isset($_GET['controller'])) {
//		$_GET['controller'] = "home";
		$_GET['action'] = "Index";

	}

	if (!isset($_GET['action'])) {
		$_GET['action'] = "Index";
	}

new Controller();


?>