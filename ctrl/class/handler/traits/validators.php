<?php
namespace traits;
trait validators{
	 
	
	function check_numeric($post_value,$required = false) { 
		//echo "<br /> CHECKING NUMERIC VALUE: ".$post_value ;
		if($required){
			if($post_value == NULL){
				return false;
			}
		}

		if($post_value != NULL){
			if(!is_numeric($post_value)){
				return false;
			}
		}
	
		return true;
	}
	
	function check_string($post_value, $required = false, $length = '') { 
		//echo "<br /> CHECKING text or textarea STRING VALUE: ".$post_value ;

		if($required){
			if($post_value == NULL) {
				return false;
			}
		}
		if($post_value != NULL) {
			if(mb_strlen($post_value, 'UTF-8') > $length){
				return false;
			}
		}
		return true;
	}
	
	function validate_date($post_value, $required = false, $length = '', $format = ''){
		//echo "<br /> CHECKING DATE VALUE: ".$post_value ;
		if($length == '') return false;
		if($format == '') return false;
		
		if($required){
			if($post_value == NULL) 
				return false;
		}
		
		if($post_value != NULL) {
			if(mb_strlen($post_value, 'UTF-8') > $length)
				return false;
			if(!validate_date($post_value, $format)) 
				return false;
		}
		
		return true;
	}
	
	function validate_email($post_value, $required = false, $length = ''){
		//echo "<br /> CHECKING EMAIL VALUE: ".$post_value ;

		if($required){
			if($post_value == NULL){
				return false;
			} 
		}
		if($post_value != NULL) {
			if(mb_strlen($post_value, 'UTF-8') > $length){
				return false;
			}
			if(!filter_var($post_value, FILTER_VALIDATE_EMAIL)) 
				return false;
		}
		return true;
	}
	
	
	function validate_radio($post_value, $required, $allowed_values){
		//echo "<br /> CHECKING RADIO: ".$post_value ;
		if($required){
			if($post_value == NULL) 
				return false;
		}
	
		if($post_value != NULL) {
			if(!in_array($post_value, $allowed_values)) 
				return false;
		}
		
		return true;
	}
	
	function validate_checkbox($allowed_checkbox_values, $required){
		//echo "<br /> CHECKING CHECKBOX: " ;
		if($required){
			$one_set = false;
			foreach($allowed_checkbox_values 
						as $post_name => $allowed_value){
				if(get_post($post_name) != NULL){
					$one_set = true;
				}
				
				if(get_post($post_name) != NULL 
						AND get_post($post_name) !=  $allowed_value){
					return false;
				}
			}
			if(!$one_set) {
				return false;
			}
		}
		else{
			foreach($allowed_checkbox_values as $post_name => $allowed_value){
				if(get_post($post_name) != NULL 
						AND get_post($post_name) !=  $allowed_value){
					return false;
				}
			}
		}
		return true;
	}
	
	function validate_checkbox_array($sent_array,$allowed_checkbox_values, $required){
		//echo "<br /> CHECKING CHECKBOX ARRAY: " ;
		if($required){
			if($sent_array == NULL)
				return false;
		}
		if($sent_array != NULL AND is_array($sent_array)){
			foreach($sent_array as $sent){
				if(!in_array($sent,$allowed_checkbox_values))
					return false;
			}
		}
		else {
			return false;
		}
		return true;
	}
	
	
	function validate_file($file, $length, $allowed, $system_allowed){
		//echo "<br />VALIDATING FILE" ;

		foreach($allowed as $cur_type){
			if(!in_array($cur_type, $system_allowed)) {
				return false;
			}
		}

		if(!file_exists($file['tmp_name']) || 
				!is_uploaded_file($file['tmp_name'])) {	
			return false;
		}
	
		
		if(!file_exists($file['size']) > intval($length) ) {
			return false;
		}
		
		
		$type_found = false;
		$type_check = false;
		
		foreach ($system_allowed as $key => $value){
			if($key == $file['type']){
				$type_found = true;
			}	
		}
		
		if(!$type_found) { return false; }
		$type_found = false;
		
		$file_type = $system_allowed[$file['type']];
		
		foreach ($system_allowed as $key => $value){
			if($value == $file_type)
				$type_found = true;
		}
		if(!$type_found) {return false; }
		return true;
	}
	
	function get_file_types() { 
		$photo_types = array(    
		  'image/pjpeg' => 'jpg',   
		  'image/jpeg' => 'jpg',   
		  'image/jpeg' => 'jpeg',
		  'image/gif' => 'gif',   
		  'image/bmp' => 'bmp',   
		  'image/x-png' => 'png',
		  'image/png' => 'png',
		  'application/pdf'=> 'pdf'
		);
		return $photo_types;
	}
	
	function process_name_resolve(){
		
	}
	
}