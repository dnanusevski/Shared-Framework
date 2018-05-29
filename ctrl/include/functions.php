<?php

	function gget($num){
		$gget = array(1=>"a",2=>"b",3=>"c",4=>"d",5=>"e",6=>"f",7=>"g",8=>"h");
		if(isset($_GET[$gget[$num]]))
			return $_GET[$gget[$num]];
		return null;
	}

	
	//use current page directorium to get current page URL
	function dir_to_url($page_dir){
		$count = strlen(ROOT_URI);
		$url = substr($page_dir, $count, strlen($page_dir));
		$url = str_replace('\\','/',$url);
		return $url;
	}
	
	function a($link,$text,$active_class = "a_reg_active"){
		
		$class = '';
		if(strpos($_SERVER['REQUEST_URI'], $link)){
			$class = $active_class;
		}
		echo '<a class = "'.$class.'"  href = "/'.$link.'">'.$text.'</a>';
	}
	
	//add value to session report so that we can display if necessary
	function add_report($report,$error = 'error'){
		if(!isset($_SESSION['report']))
			$_SESSION['report'] = [];
		if($error == 'error'){
			$_SESSION['report']['error'][] = $report;
		}
		else{
			$_SESSION['report']['success'][] = $report;
		}
	}

	function read_report(){
		if(!isset($_SESSION['report']))
			return false;
		else{
			foreach($_SESSION['report'] as $key => $report){
				foreach($report as $cur_report){
					if($key == 'success'){
						echo "<br /> <div class = 'report_success'> *$key $cur_report </div>";
					}
					else{
						echo "<br /> <div class = 'report_error'> *$key $cur_report </div>";
					}
				}
			}
		}
	}
	
	function cont_report(){
		$count = 0;
		
		if(isset($_SESSION['report']['error']))
			$count ++;
		
		if(isset($_SESSION['report']['success']))
			$count ++;
		
		return $count;
	}
	
	function get_report($type = "error"){
		if($type == 'error'){
			if(isset($_SESSION['report']['error']))
				return $_SESSION['report']['error'];
		}
		else{
			if(isset($_SESSION['report']['success']))
				return $_SESSION['report']['success'];
		}
		return false;
	}
	
	
	function clear_report(){
		$_SESSION['report'] = [];
		unset($_SESSION['report']);
		$_SESSION['report'] = [];
	}

	//get value in post variable 
	function get_post($name){
		if(!isset($_POST[$name]) OR empty($_POST[$name]))
			return NULL;
		else
			return $_POST[$name];
	}
	
	//Set header with location contained in referer
	//used after form validation to return to a page where form was submited
	// if addres was given inside, it will go to that location
	function location_referer($referrer_override = ''){
		if(isset($_SERVER['HTTP_REFERER'])){
			$referer = $_SERVER['HTTP_REFERER'];
			if($referrer_override !=''){
				isset($_SERVER['HTTPS'])? $http = "https://" : $http = "http://";
				$start = $http.$_SERVER['SERVER_NAME'];
				$referer = $start.'/'.$referrer_override;
			}
			die(header("Location:$referer"));
		}
		else{
			isset($_SERVER['HTTPS'])? $http = "https://" : $http = "http://";
			$start = $http.$_SERVER['SERVER_NAME'];
			die(header("$start"));
		}
	}
	
	
	//redirect a script to a new location
	//same thing with location_refrer but with override
	function redirect($addr,&$connection){
		isset($_SERVER['HTTPS'])? $http = "https://" : $http = "http://";
		$start = $http.$_SERVER['SERVER_NAME'];
		$addr = $start."/".$addr;
		die(header("Location: $addr"));
	}
	
	//redirect to start page
	function redirect_home(){
		isset($_SERVER['HTTPS'])? $http = "https://" : $http = "http://";
		$start = $http.$_SERVER['SERVER_NAME'];
		die(header("Location: $start"));
	}
	
	
	function validate_date($date, $format = 'Y-m-d H:i:s'){
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}

	function set_cookie($name, $val, $time = NULL){
		if($time == NULL) 
			$time = time() + (10 * 365 * 24 * 60 * 60);
		setcookie($name,$val,$time);
	}
	
	function get_cookie($name){
		if(isset($_COOKIE[$name]))
			return $_COOKIE[$name];
		return NULL;
	}
	
	function set_session($name, $val){
		$_SESSION[$name] = $val;
	}
	
	function get_session($name){
		if(!isset($_SESSION[$name])) 
			return NULL;
		return $_SESSION[$name];
	}
	

	function rand_str($length = 64){
		$bytes = openssl_random_pseudo_bytes($length, $cstrong);
		$hex = bin2hex($bytes);
		return $hex;
	}
	
	
	//TAKEN FROM OFFICIAL  https://secure.php.net/openssl_encrypt
	//PHP.NET


	function custom_crypt($string,$encode_url = false){

		$ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
		$iv = openssl_random_pseudo_bytes($ivlen);
		$ciphertext_raw = openssl_encrypt($string, $cipher, SECRET_KEY, $options=OPENSSL_RAW_DATA, $iv);
		$hmac = hash_hmac('sha256', $ciphertext_raw, SECRET_KEY, $as_binary=true);
		$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
		if($encode_url == true)
			return urlencode($ciphertext);
		return $ciphertext;
	}

	function custom_decrypt($string,$decode_url = false){
		
		if($decode_url)
			$c = base64_decode($string);
		$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
		$iv = substr($c, 0, $ivlen);
		$hmac = substr($c, $ivlen, $sha2len=32);
		$ciphertext_raw = substr($c, $ivlen+$sha2len);
		$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, SECRET_KEY, $options=OPENSSL_RAW_DATA, $iv);
		$calcmac = hash_hmac('sha256', $ciphertext_raw, SECRET_KEY, $as_binary=true);
		if (hash_equals($hmac, $calcmac)){//PHP 5.6+ timing attack safe comparison
			return $original_plaintext;
		}
	}
	
	function blowfish($pass){
		$pass = password_hash($pass, PASSWORD_BCRYPT);
		return $pass;
	}
	
	function check_pass($str,$hash){
		if(password_verify($str,$hash)){
			return true;
		}
		return false;
	}
	