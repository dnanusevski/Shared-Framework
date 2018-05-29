<?php
namespace handler;
require_once('traits/validators.php');
require_once('traits/name_resolve.php');
class formHandlerServer{
	
	use \traits\validators;
	use \traits\name_resolve;
	/*
	*  function validate_input_array
	*  go throw input fields of an php form array
	*  and check every field by its values
	*
	*/
	function validate_input_array($input_array){
		
		
		foreach($input_array['input'] as $input){
			
			if(is_array($input)){
				
				// pick up necessary values for validation
				
				//get info on what to validate
				if(isset($input['validate']))
					$validate = $input['validate'];
				else $validate = '';
				
				//get name of POST variable
				if(isset($input['name']))
					$post_name = $input['name'];
				else $post_name = '';
				
				//get report string
				if(isset($input['report']))
					$report = $input['report'];
				else $report = ''; 
				
				//get if post variable is required
				if(isset($input['required']))
					$required = $input['required'];
				else $required = false;	
				
				if(isset($input['format']))
					$format = $input['format'];
				else $format = ''; 
				
				//get if post variable is required
				if(isset($input['length']) AND is_numeric($input['length']) )
					$length = $input['length'];
				else $length = '';	

			
				
				if($validate == 'numeric'){
					if(!$this->check_numeric(get_post($post_name),$required))
						add_report($report);
				}
				else if($validate == 'string' || $validate == 'password'){
					if(!$this->check_string(get_post($post_name),$required,$length))
						add_report($report);
				}
				
				else if($validate == 'date'){
					if(!$this->validate_date(get_post($post_name), $required, $length, $format))
						add_report($report);
				}
				
				
				else if($validate == 'email'){
					if(!$this->validate_email(get_post($post_name), $required, $length))
						add_report($report);
				}
				
				
				// radio if required check if atr least one is checked and if value is in array 
				// of allowed values
				else if($validate == 'radio'){
					if(isset($input['buttons'])){

						$allowed_values = [];
						foreach($input['buttons'] as $button){
							$allowed_values[] = $button['value'];
						}
						
						if(!$this->validate_radio(get_post($post_name), $required, $allowed_values))
							add_report($report);
					}
				}
				// similar thing goes for checkbox, if it is required then value must be from array
				// else if it is not empty then value must be from array
				else if($validate == 'checkbox'){
					if(isset($input['buttons'])){
						$allowed_checkbox_values = [];
						if(isset($input['name']) AND ($pos = strpos($input['name'],'[]'))){
							
							$input['name'] = substr($input['name'],0,$pos);
					
							foreach($input['buttons'] as $button_array){
								$allowed_checkbox_values[] = $button_array['value'];
							}
							$sent_array = get_post($input['name']);
							
							
							if(!$this->validate_checkbox_array($sent_array,$allowed_checkbox_values, $required))
								add_report($report);
							/*
							foreach($sent_array as $sent){
								if(!in_array($sent,$allowed_checkbox_values))
									add_report($report);
							}
							*/
						}
						//every button must have his own name
						else{
							foreach($input['buttons'] as $button_array){
								$post_name = isset($button_array['name']) ?  
									$button_array['name'] : exit('bad form array') ;
								$post_value = isset($button_array['value']) ?  
									$button_array['value'] : exit('bad form array') ;
								$allowed_checkbox_values[$post_name] = $post_value;
							}
							
							if(!$this->validate_checkbox($allowed_checkbox_values, $required))
								add_report($report);
						}
					}
				}
				// self explanatory
				else if($validate == 'select'){
					if(isset($input['options'])){
						$options = $input['options'];
						
						$sent_val = get_post($post_name);
						if($required){
							if(!$sent_val) add_report($report);
						}
						if($sent_val){
							if(!array_key_exists($sent_val,$options))
								add_report($report);
						}
					}
					else{
						exit('bad form array');
					}	
				}
				
				else if($validate == 'file'){
					
					$length = $input['length'];
					$allowed = $input['allowed'];
					$file_types = $this->get_file_types();
					
					if($required){
						if(!isset($_FILES[$post_name])){
							
							add_report($report);
							continue;
						}
					}

					if(isset($_FILES[$post_name]) AND 
							file_exists($_FILES[$post_name]['tmp_name'])){
						if(!$this->validate_file($_FILES[$post_name],$length,$allowed,$file_types))
							add_report($report);
					}
				}
			}
		}
	
	}//end of function validate_input_array
	
}//end of class definition