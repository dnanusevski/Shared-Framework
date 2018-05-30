<?php
	
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/ctrl/config/main_process_config.php');

		
	if(cont_report() > 0){
		location_referer();
		exit();
	}
	else{
		//get safe nam of process file, or leave it the same, functio nwill add .php
		//we got $process var using file main_process_config,
		//$process var is name of the file that wil be executed
		// it is not client defined and can not bee seen
		$process = $formHandlerServer->safe_name($process,false);
		//if ifle is found i process_file folder it will be included
		try{
			if(file_exists(PROCESS_FILES.$process)){}
				include(PROCESS_FILES.$process);
		}
		catch (Exception $e){
			location_referer();
			exit();
		}
	
		location_referer();
		exit();
	}
	

?>