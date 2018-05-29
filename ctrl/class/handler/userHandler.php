<?php

	namespace handler;
	
	class userHandler{
		public $id;
		public $mail;
		public $is_logged_in;
		
		function __construct(){
			if(session_id() == ""){
				session_start();
			}
			
			$user = get_session('pat_account');
			if($user AND gettype($user) == 'object'){
				$this->_initUser($user);
			}
		}
		
		//initialise object userHandler using session pat_account
		protected function _initUser($user){
			if(is_numeric($user->id)){
				$this->id = $user->id;
				$this->mail = $user->mail;
				$this->is_logged_in = $user->is_logged_in;
			}
		}
		
		
		//load user using id
		public function load_by_id($id){
			//instantiate class for db user staff :D
			$dbUserHandler = new \handler\db\dbUserHandler();
			
			//get user by provided id !
			if($user = $dbUserHandler->get_user_by_id($id)){
				//set user data and set session
				$this->id = $user->id;
				$this->mail = $user->mail;
				$this->is_logged_in = true;
				set_session('pat_account',$this);
				return true;
			}
			return false;
		}
		
		public function require_user(){
			if(!$this->is_logged_in){
				redirect_home();
				exit();
			}
		}
		
		public function require_user_ajax(){
			if(!$this->is_logged_in){
				exit('error');
			}
		}
		
		function authenticate($uname,$password){
			$dbUserHandler = new \handler\db\dbUserHandler();
			//get user by provided id !
			if($user = $dbUserHandler->get_user_by_username($uname)){
				if(password_verify($password,$user->password) == false){
					return false;
				}
				else{
					//set user data and set session
					$this->id = $user->id;
					$this->mail = $user->mail;
					$this->is_logged_in = true;
					set_session('pat_account',$this);
					return true;
				}
			}
			return false;
		}
	}