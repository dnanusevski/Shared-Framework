<?php
namespace handler;
require_once('traits/photo_types.php');



class imageHandler{
	
	use \traits\photo_types;

	private $_folder;
	private $photo;

	public $img_name_hash='';
	public $img_tb_name_hash='';
	public $img_real_name;
	function __construct($_folder,$patid,$photo){
		$this->_folder = $_folder;
		$this->photo = $photo;
		$this->img_real_name = $photo['name'];
		$this->hash_name($patid);
	}
	
	private function hash_name($patid){
		$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
		$pos = strpos($time, ".");
		$time = substr($time,$pos+1,strlen($time));
		$date = date("YmdHis".$time);
		
		$to_hash = 	$patid.$date;
			
		$bytes = openssl_random_pseudo_bytes(32, $cstrong);
		$hex = bin2hex($bytes);
	
		$this->img_name_hash =  md5($to_hash);
		$this->img_name_hash.= $hex;
		$this->img_tb_name_hash = $this->img_name_hash."_tb";
		$this->set_ext();	
	}
	
	private function set_ext(){
		$type = $this->photo['type'];
	
		$photo_types = $this->get_photo_types();
		$type_found = false;
		
		//check to see if type is found in ouer types
		foreach($photo_types as $cur_type=>$cur_ext)
			if($cur_type == $type) $type_found = true;
		if(!$type_found)  return false;
		
		$ext = $photo_types[$type];
		$this->img_name_hash.='.'.$ext;
		$this->img_tb_name_hash.='.'.$ext;
	}
	public function save_img(){
		//echo "<br>".$this->_folder;
		if(!file_exists($this->_folder) )
			mkdir($this->_folder,0744,true); 
		
		$size = GetImageSize($this->photo['tmp_name']);
		if(!$size) return false;
		
		//PREPARE IMAGES FOR SAVING AND FUNCTINS
		//ARRAY NECCECERU FOR CREATING FUNCTION NAMES
		$gd_function_suffix = array(      
		  'image/pjpeg' => 'JPEG',     
		  'image/jpeg' => 'JPEG',     
		  'image/gif' => 'GIF',     
		  'image/bmp' => 'WBMP',     
		  'image/x-png' => 'PNG',
		  'image/png' => 'PNG'   
		);
		
		
		$new_height = 100;
		$new_width = intval($size[0]*$new_height/$size[1]);
		
		//// GET SUFIX OF SO THAT WSE CAN CREATE ADEQUATE FUNCTION
		$function_suffix = $gd_function_suffix[$this->photo['type']];
			
		////CREATE FUNCTION NAME USING  $function_suffix
		// you will get ImageCreateFromJPEG in most cases
		$function_to_read = 'ImageCreateFrom' . $function_suffix;

		// Build Function name for ImageSUFFIX   
		// you will get ImageJPEG in most cases
		$function_to_write = 'Image' . $function_suffix;
		
		$source_handle = $function_to_read($this->photo['tmp_name']);      

		if ($source_handle) {
			//SAVE IMAGE THUMBNAIL TO DEST FOLDER
			$destination_handle = ImageCreateTrueColor($new_width, $new_height);   
			ImageCopyResampled($destination_handle, $source_handle,  0, 0, 0, 0, $new_width, $new_height,  $size[0], $size[1]); 					
			$function_to_write($destination_handle, $this->_folder."/".$this->img_tb_name_hash);     	
			ImageDestroy($destination_handle);
			
			//CHECK IF IMAGE IS TO BIG, OVER 1 MB, IF IT IS CHENGE SIZE OF IMAGE IN TMP FOLDER
			
			if($this->photo['size']>1048576 ){
				//set new dimensions to be not above 1500
				$set_width = 1500;
				$set_height = intval($size[1] * $set_width/$size[0]);
				if($set_height>1500){
					$set_height=1500;
					$set_width=intval($size[0]*$set_height/$size[1]);
				}
				//THIS WILL OVERWRITE IOMAGE IN TEMP FOLDER AND MAKE IT SMALLER THEN 1 MB
				$destination_handle = ImageCreateTrueColor($set_width, $set_height);   
				ImageCopyResampled($destination_handle, $source_handle,  0, 0, 0, 0, $set_width, $set_height,  $size[0], $size[1]); 					
				$function_to_write($destination_handle, $this->photo['tmp_name']);     
				ImageDestroy($destination_handle);
			}
			//MOVE TEMP FILE TO DEST FOLDER
			if(move_uploaded_file($this->photo['tmp_name'], $this->_folder."/".$this->img_name_hash))
				return true;
			return false;
		}
		else return false;
	}
}