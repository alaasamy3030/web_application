<?php

	// Error Reporting

	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	include 'admin/connect.php';

	$sessionUser = '';
	
	if (isset($_SESSION['user'])) {
		$sessionUser = $_SESSION['user'];
	}
    

     /*Start Cart Cookie  For 30 days */
define('CART_COOKIE' , 'SBwi72UCKlwiqzz2') ;
define('CART_COOKIE_EXPIRE' , time() + (86400*30)) ;

$cart_id = '';
if(isset($_COOKIE['CART_COOKIE'])){
    $cart_id = $_COOKIE['CART_COOKIE'];
}

	// Routes

	$tpl 	= 'includes/templates/'; // Template Directory
	$lang 	= 'includes/languages/'; // Language Directory
	$func	= 'includes/functions/'; // Functions Directory
	$css 	= 'layout/assets/css/'; // Css Directory
	$js 	= 'layout/assets/js/'; // Js Directory

	// Include The Important Files

	include $func . 'functions.php';
	include $lang . 'english.php';
	include $tpl . 'header.php';
	if(!isset($nosidebar)){
	include $tpl . 'slider.php';
    }
	