<?php
namespace traits;

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