<?php
namespace menu;


class ctrlMenu{
	private $menu_get_holder = [];
	private $menu_key;
	private $get_vars = ['a','b','c','d','e','f','g','h'];

	
	function __construct(&$menu){

	
		//collect all get vars from URL and build up array
		//containing get vars
		foreach($this->get_vars as $get){
			if (isset($_GET[$get])) { $this->menu_key[] = $_GET[$get];}
		}
		
	
		//wanted menu variable will hold wanted menu key
		//hits will help us determinate what key most
		//corresponds to current url get variables
		$wanted_menu = ['wanted_menu_key' => '','hits' => 0];
		//go throw all menu (possible URLS) entries that we collected
		foreach($menu as $key => $item){
			

			
			//explode menu entrie to see get variables
			$cur_menu_array = explode('/',$key); 
			
			
			//if number of get variables of current menu key
			//corresponds to number of get vatriables of url
			//if(count($cur_menu_array) == count($this->menu_key)){
				$hits = 0;
				//compare get variables
				//if they are same increase hits for current menu entrie
				for($x = 0; $x < count($this->menu_key); $x++){

					if(in_array($this->menu_key[$x],$cur_menu_array)){
						$hits++;
					}
				}
				//if we have hits	
				if($hits != 0){
					//if number of current hits is larger then alredy noted
					if($hits > $wanted_menu['hits']){
						$wanted_menu['wanted_menu_key'] = $key ;
						$wanted_menu['hits'] = $hits ;
					}
				}
			//}//if(count($cur_menu_array) == count($this->menu_key)){
		}//foreach($menu as $key => $item){
	
		//if there are no GET variables in URL then we have INDEX PAGE
		if(count($this->menu_key) == 0){
			$this->menu_key = $menu[l('index')];
		}
		//if we have not found nothing that corresponds
		else if(!isset($menu[$wanted_menu['wanted_menu_key']])){
			$this->menu_key = $menu[l('404')];
		}
		//if ther is something in menu array that corresponds	
		else{
			$this->menu_key = $menu[$wanted_menu['wanted_menu_key']];
		}
	}
	
	public function get_menu_key(){
		return $this->menu_key;
	}
		
}