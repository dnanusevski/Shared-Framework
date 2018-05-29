<?php
namespace traits;

trait photo_types{
	function get_photo_types() { 
		$photo_types = array(    
		  'image/pjpeg' => 'jpg',   
		  'image/jpeg' => 'jpg',   
		  'image/gif' => 'gif',   
		  'image/bmp' => 'bmp',   
		  'image/x-png' => 'png',
		  'image/png' => 'png'   
		);
		return $photo_types;
	}	
}