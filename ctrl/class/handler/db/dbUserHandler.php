<?php
	namespace handler\db;
	require_once('dbHandler.php');
	
	/*
	* class dbRegisterHandler
	* takes values saved in session / email and pass
	* and uses them to create new user
	*/
	
	
	class dbUserHandler extends dbHandler{
		function get_user_by_id($id){
			$select_array = array(
				'id' => $id,
			);
			
			if($user = $this->select_one('pat_account',$select_array)){
				return $user;
			}
			else{
				return false;
			}
		}
		
		function get_user_by_username($name){
			$select_array = array(
				'mail' => $name,
			);
			
			if($user = $this->select_one('pat_account',$select_array)){
				return $user;
			}
			else{
				return false;
			}
		}
		
		function reset_password($email,$password){
			$what = array(
				'password' => blowfish($password), 
			);
			
			$where = array(
				'mail' => $email,
			);
			
			if($user = $this->update('pat_account',$what,$where)){
				return $user;
			}
			else{
				return false;
			}
		}
		
	}