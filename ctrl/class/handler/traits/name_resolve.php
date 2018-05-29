<?php
namespace traits;

/*
* name resolv is a very simple trait
* it only appends php to the end of a file name so that wanted file can be executed
* it's purpose is found in process pages
*/
trait name_resolve{
	function safe_name($file,$to_change = true){
		if($to_change == false) return $file.".php";
		else{
			switch ($file) {
				case 'process_test':
					$file = 'process_test.php';
					break;
				default:
					$file = NULL;
			}
		}
		
		return $file;
	}
}