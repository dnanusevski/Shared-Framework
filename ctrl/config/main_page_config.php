<?php
	/*
	* This file is intended for all client seen pages
	* it resolvs url to get array key
	* that array key will retrieve specific page URI 
	* from meny array that is collected from all folders inside pages
	*/
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/ctrl/config/define.php');
	//PAGE SPECIFIC CONFIGURATION
	
	//collect all menu entries from within page folder
	require_once(INCLUDE_F.'/collectMenu.php');
	
	//now we gave $menu array
	$ctrlMenu = new menu\ctrlMenu($menu);

	$contentHandler = new handler\contentHandler($ctrlMenu->get_menu_key());

	unset($ctrlMenu);
	
	$page_uri = $contentHandler->page_uri();
	
	define('PAGE_URI',$page_uri);
	define('PAGE_URI_PARTS',$page_uri.'/views/parts/');
	define('PAGE_URI_TEMPLATES',$page_uri.'/views/templates/');