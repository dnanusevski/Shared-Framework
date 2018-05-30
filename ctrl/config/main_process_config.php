<?php
	/*
	* main process config file is included first on pages that 
	* are doing data processing
	* every form send form file location and form key token
	* both are crypted and needs to be decripted (using secret key defined in the system)
	* location gives us a file containing form array and that form array gets us exact fields
	*/

	require_once($_SERVER['DOCUMENT_ROOT'].'/ctrl/config/define.php');
	clear_report();
	
	//main class for processing forms
	$formHandlerServer = new handler\formHandlerServer();
	
	//if we are missing key so that we can get exact for marray
	if(!isset($_GET['key'])){
		add_report('Error occured, please click back and try again');
	}
	//if we are missing location of from file
	if(!isset($_GET['loc'])){
		add_report('Error occured, please click back and try again');
	}
	
	//get send array key
	//get sent file location
	if(isset($_GET['key']) AND isset($_GET['loc'])){
		$key = custom_decrypt($_GET['key'],true);
		$loc = custom_decrypt($_GET['loc'],true);	
	}
	else{
		$key = '';
		$loc = '';
	}
	

	//form array needs to be inside folder and named same as folder
	//but with addition of _forms.php
	
	
	//get name of folder from sent location
	$str =  substr(strrchr ( $loc , '/' ),1);
	if(!$str)
	$str =  substr(strrchr ( $loc , '\\' ),1);

	//include file thast holds form array
	if(file_exists($loc.'/'.$str.'_forms.php')){
		include($loc.'/'.$str.'_forms.php');
	}
	else{
		add_report('Error occured, please click back and try again');
	}

	
	
	//validate form token
	if(get_session('from_token') !== get_post('from_token')){
		add_report('Error occured, please click back and try again');
	}

	
	//if from array does not contains sent key
	if(!isset($form_array[$key])){
		add_report('Error occured, please click back and try again');
	}
	else{
		if(!isset($form_array[$key]['action'])){
			add_report('Error occured, please click back and try again');
		}
		else{
			$process = $form_array[$key]['action'];
			$formHandlerServer->validate_input_array($form_array[$key]);
		}
	}
	
	
	
