<?php
namespace handler;


/*
* Intended to insert a nwe user in database
* it uses email token to insert an ew one
*/
class registerUserHandler{
	private $session_token;
	private $url_token;
	private $registration_start;
	private $operation;
	
	function __construct($start = "register"){
	  if($start == "register"){
		$this->operation = gget(2);
	    $this->url_token = gget(3);
	    $this->retrieved_token = get_session('register_token');
	    $this->registration_start = get_session('register_time_init');
	  }
	  else if($start = "reset"){
		$this->operation = gget(1);
	    $this->url_token = gget(2);
	    $this->retrieved_token = get_session('reset_token');
	    $this->registration_start = get_session('reset_time_init'); 
	  }
	  
	}
	
	function validate_register_token(){

		//operation needed to work
		if($this->operation === null || $this->url_token === null){
			//echo "ERROR 1";
			return false;
		}
		//operation needs to be register or reset
		if($this->operation != 'register' AND $this->operation != 'reset'){
			//echo "ERROR 2";
			return false;
		}
		//we need to have a token already in session
		if(!$this->retrieved_token || $this->retrieved_token == ''){
			//echo "ERROR 3";
			return false;
		}
		//required from url
		if(!$this->url_token || $this->url_token == ''){
			echo "ERROR 4";
			return false;
		}
		//both tokens need to match
		if($this->retrieved_token != $this->url_token){
			echo "ERROR 5";
			return false;
		}
		
		//some time diference between registration needs to be there
		$time_dif = time() - $this->registration_start;
		
		if($time_dif > 33600){
			echo "ERROR 6";
			return false;
		}
		return true;
	}
	
	function process(){
		if($this->operation == 'register' ){
			$dbRegisterHandler = new \handler\db\dbRegisterHandler();
			return $dbRegisterHandler->registerUser(); //returns user id or false
		}
		//for later dono
		else if($this->operation == 'reset' ){
			
		}
	}
}