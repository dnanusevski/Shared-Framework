<?php
namespace handler;


class contentHandler{
	private $menu;
	//public $form_array;
	
	function __construct($menu){
		$this->menu = $menu;
	}
	
	/*
	function inser_form_array($form_array){
		$this->form_array = $form_array;
	}

	function get_form_array(){
		return $this->form_array;
	}
	*/
	
	function page_uri(){
		if(isset($this->menu['base']))
			return $this->menu['base'];
		return false;
	}
	

	function make_head_section(){
		$this->place_favicon();
		$this->place_title();
		$this->include_main_css();
		$this->include_local_css();
		$this->include_main_js();
		$this->include_local_js();
	}
	
	function get_layout(){
		if(isset($this->menu['layout'])){
			if(is_file('./theme/'.$this->menu['layout']))
				return $this->menu['layout'];
		}
		return 'layout_default.html';
	}
	
	function place_favicon(){
		if(isset($this->menu['favicon']))
			echo '<link rel="icon"  href="/images/favicon/'.$this->menu['favicon'].'">';
	}
	
	
	function place_title(){
		if(isset($this->menu['title']))
			echo ' <title>'.$this->menu['title'].'</title>';
		else
			echo ' <title>default title</title>';
	}
	
	/*
	* Functio that will include main css
	* if menu holds main_css array
	* then we include only css taht is array
	* if no main_css key can be found
	* then we include all css from there
	*/
	
	function include_main_css(){
		
		if(isset($this->menu['main_css']) AND is_array($this->menu['main_css'])){
			foreach($this->menu['main_css'] as $file){
				$file = new \SplFileObject('.'.CSS.$file);
				 if($file->isFile() AND $file->getExtension() == 'css'){
					$this->echo_css_link($file,CSS);
				}
			}
		}
		else{
			//dir is automatic new SplFileObject
			$dir = new \DirectoryIterator('.'.CSS); //get all css from folder css
			foreach ($dir as $file) {
				if($file->isFile() AND $file->getExtension() == 'css'){
					$this->echo_css_link($file,CSS);
				}
			}
		}
	}
	
	/*
	* if local_css is found in menu 
	* we need to include that local css from
	* folder that is this active folder 
	* where menu key resides
	*/
	
	function include_local_css(){
		if( isset($this->menu['local_css']) 
			AND is_array($this->menu['local_css'])	
			AND isset($this->menu['base']) ){
			
			//base directoru takenb from __DIR__
			$base_dir = $this->menu['base']; 
			//get base url by removing durectory root from begimning
			$root_url = dir_to_url($base_dir); 

			foreach($this->menu['local_css'] as $css){

				if(file_exists($base_dir.'/css/'.$css)){
					//create file from base_dir to get direct acces to file
					$file = new \SplFileObject($base_dir.'/css/'.$css);
					//but create link using root_url so that html would work
					$this->echo_css_link($file,$root_url.'/css/');
				}
			}
		}
	}
	
	// this will only echo link of css file with version
	function echo_css_link($file,$pos){
		$base_name = $file->getBaseName();
		$date_modified = date ("Y_m_d_H_i_s", filemtime('.'.$pos.$base_name));
		$base_name = $pos.$base_name.'?v='.$date_modified;
		echo '<link rel="stylesheet" type="text/css" href="'.$base_name.'">';
	}
	
	
	//everything is the same as for css
	function include_main_js(){
		
		if(isset($this->menu['main_js']) AND is_array($this->menu['main_js'])){
			foreach($this->menu['main_js'] as $file){
				$file = new \SplFileObject('.'.JS.$file);
				 if($file->isFile() AND $file->getExtension() == 'js'){
					$this->echo_js_link($file,JS);
				}
			}
		}
		else{
			//dir is automatic new SplFileObject
			$dir = new \DirectoryIterator('.'.JS); //get all css from folder css
			foreach ($dir as $file) {
				if($file->isFile() AND $file->getExtension() == 'js'){
					$this->echo_js_link($file,JS);
				}
			}
		}
	}
	
		
	function include_local_js(){
		if( isset($this->menu['local_js']) 
			AND is_array($this->menu['local_js'])	
			AND isset($this->menu['base']) ){
			
			//base directoru takenb from __DIR__
			$base_dir = $this->menu['base']; 
			//get base url by removing durectory root from begimning
			$root_url = dir_to_url($base_dir); 

			foreach($this->menu['local_js'] as $js){

				if(file_exists($base_dir.'/js/'.$js)){
					//create file from base_dir to get direct acces to file
					$file = new \SplFileObject($base_dir.'/js/'.$js);
					//but create link using root_url so that html would work
					$this->echo_js_link($file,$root_url.'/js/');
				}
			}
		}
	}

	// this will only echo link of css file with version
	function echo_js_link($file,$pos){
		$base_name = $file->getBaseName();
		$date_modified = date ("Y_m_d_H_i_s", filemtime('.'.$pos.$base_name));
		$base_name = $pos.$base_name.'?v='.$date_modified;
		echo '<script type="text/javascript" src="'.$base_name.'"> </script>';
	}
	
	function insert_header(){
		if(isset($this->menu['header'])) {
			if(file_exists('./theme/'.$this->menu['header'])){
				include('./theme/'.$this->menu['header']);
			}
			else{
				include('./theme/header.php');
			}	
		}
		else{
			include('./theme/header.php');
		}
	}
	
	function get_view_adress($what){
		if(isset($this->menu[$what]) AND isset($this->menu['base'])) {
			$base_dir = $this->menu['base']; 
			if(is_file($base_dir.'/views/'.$this->menu[$what])){
				return $base_dir.'/views/'.$this->menu[$what];
			}else return false;
		}
		else return false;
	}
	
	
	function insert_footer(){
			if(isset($this->menu['footer'])) {
			if(file_exists('./theme/'.$this->menu['footer'])){
				include('./theme/'.$this->menu['footer']);
			}
			else{
				include('./theme/footer.php');
			}	
		}
		else{
			include('./theme/footer.php');
		}
	}
}