<?php
	
	require_once('D:\WebProjects\keys.php');
	
	
	isset($_SERVER['HTTPS'])? $http = "https://" : $http = "http://";
	
	define('SECRET_KEY', 'secret_key');
	define('ROOT_URI', $_SERVER['DOCUMENT_ROOT']);
	define('ROOT_URL', $http.$_SERVER['SERVER_NAME']);
	

	define('CTRL',ROOT_URI.'/ctrl');
	define('CLASS_F', CTRL.'/class/');
	define('INCLUDE_F', CTRL.'/include/');
	define('PROCESS_FILES', ROOT_URI.'/process/process_files/');
	define('PROCESS_F', '/process/main_process.php?');

	define('PROCESS_AJAX_F', '/process/main_ajax_process.php?process=');
	define('LANG_F', CTRL.'/language/');
	define('CSS','/css/');
	define('JS','/js/');
	
	//Load language function before anything
	require_once(LANG_F.'/lang.php'); 
	
	//get all neccecery functions
	require_once(INCLUDE_F.'/functions.php'); 
	
	//create autoloader function to instantiate classes easy
	require_once(INCLUDE_F.'/autoloader.php');
	
	
	session_start();
	
	$user = new \handler\userHandler();
	
	
	
