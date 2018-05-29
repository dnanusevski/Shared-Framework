<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/ctrl/config/define.php');
	//PAGE SPECIFIC CONFIGURATION
	
	//collect all menu entries from within page folder
	require_once(INCLUDE_F.'/collectMenu.php');
	

	$ctrlMenu = new menu\ctrlMenu($menu);

	$contentHandler = new handler\contentHandler($ctrlMenu->get_menu_key());

	unset($ctrlMenu);
	
	$page_uri = $contentHandler->page_uri();
	
	define('PAGE_URI',$page_uri);
	define('PAGE_URI_PARTS',$page_uri.'/views/parts/');
	define('PAGE_URI_TEMPLATES',$page_uri.'/views/templates/');
