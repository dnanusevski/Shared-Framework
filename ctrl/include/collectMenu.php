<?php
	//we need to collect all menu's from page subfolders
	//list all folder inside folder pages
	//and if you find a file that corresponds to folder name plus _main.php
	// include it becouse menu entries are inside
	//NOW WE HAVE $menu VARIABLE !
	$dir = new DirectoryIterator('./pages');
	foreach ($dir as $item) {
	  if($item->isDir()){
		$base_name = $item->getBasename();
		
		if($base_name != '.' AND $base_name != '..'){
		  if(file_exists(ROOT_URI.'/pages/'.$base_name.'/'.$base_name.'_main.php')){
			require_once(ROOT_URI.'/pages/'.$base_name.'/'.$base_name.'_main.php');
		  }
		}		
	  }
	}