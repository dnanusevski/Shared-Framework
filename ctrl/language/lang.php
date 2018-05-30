<?php
	function l($key,$echo = 0){
		//URL ADRESSES
		$l['404'] = '404';
		$l['index'] = 'home';
		$l['site_main_title'] = 'Site main title';
		$l['form_example'] = 'Form example';
		
		if(isset($l[$key])){
			if($echo == 0)
				return $l[$key];
			else if($echo == 1)
				echo $l[$key];
		}
		else{
			if($echo == 0)
				return '<strong> Lang key not found </strong>';
			else if($echo == 1)
				echo '<strong> Lang key not found </strong>';
		}
	}