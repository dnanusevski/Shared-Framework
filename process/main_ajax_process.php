<?php


	require_once($_SERVER['DOCUMENT_ROOT'].'/ctrl/config/main_process_config.php');


	if(cont_report() > 0){
		$report = get_report();
		echo json_encode(array('error'=>$report));
		exit();
	}
	else{
		//get safe nam of process file, or leave it the same, function will add .php
		//we got $process var using file main_process_config,
		//$process var is name of the file that wil be executed
		// it is not client defined and can not bee seen
		$process = $formHandlerServer->safe_name($process,false);
	
		//if ifle is found i process_file folder it will be included
		if(file_exists(PROCESS_FILES.$process)){}
			include(PROCESS_FILES.$process);
		
		//if included file has not done anything
		if(isset($report)){
			echo json_encode($report);
		} else {
			echo json_encode(array('error'=>'no output'));
		}

		exit();
	}	
		



?>