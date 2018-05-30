<?php
	namespace handler\db;
	require_once('dbHandler.php');
	
	/*
	* class dbRegisterHandler
	* takes values saved in session / email and pass
	* and uses them to create new user
	*/
	
	
	class dbRegisterHandler extends dbHandler{
		
		//insert mail and password in to trable
		function registerUser(){
			$inser_array = array(
				'mail' => get_session('register_mail'),
				'password' => blowfish(get_session('register_password')),
				'date' => date('Y-m-d'),
			);
			//if insert is ok
			
			if($this->insert_array('pat_account',$inser_array)){
				//echo "<br />| ID TO INSERETED ".$this->lastInsertId;
				//if inserted succesfuly get last id 
				//and return it so that user class can load it
				return $this->lastInsertId;
			}
			else return false;
		}
		
	}