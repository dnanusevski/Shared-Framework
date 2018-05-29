<?php
	namespace handler\db;
	
	/*
	* Abstract class dbHandler
	* used to have elementar functions of inserting simple array
	* retriving data by some id
	/ inserting and on duplicate key updateing
	*/
	
	
	abstract class dbHandler{
		
		public $rowCount = null;
		public $lastInsertId = null;
		
		/*
		* insert array
		* array keys needs to correspond to values in database
		* array keys value hold bvalues to be inserted in database
		* al lvalues are automaticaly validated already
		*/
		
		public function insert_array($table,$array){

			//start generating query parts
			$query_part_vars = '(';
			$query_part_vars_vals = '(';
			
			//generate query parts like ('mail') VALUES (':mail')
			foreach($array as $key => $element){
				$query_part_vars .= $key.', ';
				$query_part_vars_vals .= ':'.$key.', ';
			}
			
			//we need to remove commas from the end
			$query_part_vars = rtrim($query_part_vars,', ');
			$query_part_vars_vals = rtrim($query_part_vars_vals,', ');
			
			//finish with query parst by adding )
			$query_part_vars.=')';
			$query_part_vars_vals.=')';
			
			//now we are ready to create whole query for inserting withoud merging
			$query = ' INSERT INTO '.$table.' '.$query_part_vars. ' VALUES '.$query_part_vars_vals;
		
			try{
				//get pod connection
				$pdo = \handler\db\db::getInstance();
				$stmt = $pdo->con->prepare($query);
				
				//binding parameters 
				foreach($array as $key => &$element){
					$par = ':'.$key;
					$stmt->bindParam($par, $element);
				}
				
				if($stmt->execute()){
					
					//if we did not getr inserted id something went wrong
					$this->lastInsertId = $pdo->con->lastInsertId();
					if(!is_numeric($this->lastInsertId)){
						return false;
					}
					
					//if there weer no rows affected there was no query
					$this->rowCount = $stmt->rowCount();
					if(!is_numeric($this->rowCount)){
						return false;
					}
					
					return true;
				}
				else {return false;}
			}
			catch(\PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}
		
		//function to select only one result from database, if there are no results or many get false
		public function select_one($table,$array){
			
	
			//start building query
			$query_part = '';
			
			//get keys and values paired up
			foreach($array as $key => $element){
				$query_part .= $key.'= :'.$key.' AND '; 
			}
			
			$query_part = rtrim($query_part,'AND ');

			$query = "SELECT * FROM ".$table." WHERE ".$query_part;
			
	
			try{
				$pdo = \handler\db\db::getInstance();
				$stmt = $pdo->con->prepare($query);
				
				//now to bind parameters
				foreach($array as $key => &$element){
					$par = ':'.$key;
					$stmt->bindParam($par, $element);
				}
				
				if($stmt->execute()){

					$this->rowCount = $stmt->rowCount();
					
					
					//no row count, then error
					if(!is_numeric($this->rowCount)){
						return false;
					}
					//if row count is 1 then success and return that one object
					if($this->rowCount == 1 ){
						return $stmt->fetchObject();
					}
					return false;
				}
				else {return false;}
			}
			catch(\PDOException $e){
				return false;
			}
		}
		
		//function to select many result from database, if there are no results or many get false
		public function select_many($table,$array){
			
			$query_part = '';
			//build query parts searchin by values
			foreach($array as $key => $element){
				$query_part .= $key.'= :'.$key.' AND '; 
			}
			
			$query_part = rtrim($query_part,'AND ');
			$query = "SELECT * FROM ".$table." WHERE ".$query_part;
			
			try{
				$pdo = \handler\db\db::getInstance();
				$stmt = $pdo->con->prepare($query);
				
				foreach($array as $key => &$element){
					$par = ':'.$key;
					$stmt->bindParam($par, $element);
				}
				
				if($stmt->execute()){
					
					$this->rowCount = $stmt->rowCount();
					$result_array=[];
					
					if($this->rowCount > 0 ){
						while($obj = $stmt->fetchObject()){
							$result_array[] = $obj;
						}
						return $result_array;
					}
					return true;
				}
				else {return false;}
			}
			catch(\PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}
		
		/*
		* Update function that recieves what array
		* What array holds key value pars. Keys are column names and values are future values
		* WHere array holds array that should give us condition for update (where id = 5)
		*/
		
		public function update($table,$what,$where){

			//start generating query parts
			$query_part = '';
			$query_where_part = '';
			
			
			//generate query parts like ('mail') VALUES (':mail')
			foreach($what as $key => $element){
				$query_part .= $key."= :$key, ";
				
			}
			foreach($where as $key => $element){
				$query_where_part .= $key."= :$key AND ";
			}
			
			//we need to remove commas from the end
			$query_part = rtrim($query_part,', ');
			$query_where_part = rtrim($query_where_part,'AND ');
			
			
			//now we are ready to create whole query for inserting withoud merging
			$query = ' UPDATE '.$table.' SET '.$query_part. ' WHERE '.$query_where_part ;
			echo $query;
			try{
				//get pod connection
				$pdo = \handler\db\db::getInstance();
				$stmt = $pdo->con->prepare($query);
				
				//binding parameters 
				foreach($what as $key => &$element){
					$par = ':'.$key;
					$stmt->bindParam($par, $element);
				}
				//binding parameters 
				foreach($where as $key => &$element){
					$par = ':'.$key;
					$stmt->bindParam($par, $element);
				}
				
				
				if($stmt->execute()){

					//if there weer no rows affected there was no query
					$this->rowCount = $stmt->rowCount();
					if(!is_numeric($this->rowCount)){
						return false;
					}
					
					return true;
				}
				else {return false;}
			}
			catch(\PDOException $e){
				
				return false;
			}
		}
		
		/*
		* delete_by function that recieves array and table name
		* 
		*/
		
		public function delete_by($table,$array){
			
	
			//start building query
			$query_part = '';
			
			//get keys and values paired up
			foreach($array as $key => $element){
				$query_part .= $key.'= :'.$key.' AND '; 
			}
			
			$query_part = rtrim($query_part,'AND ');

			$query = "DELETE FROM ".$table." WHERE ".$query_part;
			
	
			try{
				$pdo = \handler\db\db::getInstance();
				$stmt = $pdo->con->prepare($query);
				
				//now to bind parameters
				foreach($array as $key => &$element){
					$par = ':'.$key;
					$stmt->bindParam($par, $element);
				}
				
				if($stmt->execute()){

					$this->rowCount = $stmt->rowCount();
					
					
					//no row count, then error
					if(!is_numeric($this->rowCount)){
						return false;
					}
					//if row count is 1 then success and return that one object
					if($this->rowCount > 0 ){
						return true;
					}
					return false;
				}
				else {return false;}
			}
			catch(\PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}
	}