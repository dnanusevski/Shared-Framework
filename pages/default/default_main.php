<?php

	$menu[l('index')] = array(
		/* neccecery for getting local directory */
		'base' => __DIR__,
		
		/* if ommited no favicon will be used */
		'favicon' => 'indexfavicon.png',
		
		/* if omited default title will be used */
		'title' => l('site_main_title'),
		
		/* if ommited all css from css folder wil be loaded */
		'main_css' => array('main.css'), 
		
		/* if ommited all js from js folder wil be loaded */
		'main_js' => array('main.js'), 
		
		/* asking for local css from css folder inside this active folder */
		'local_css' => array('local.css'),
		
		/* asking for local js from js folder inside this active folder */
		'local_js' => array('local.js'),
	
		/* if ommited layout_default.html will be used */
		//'layout' => 'layout_default.html',

		/* if ommited default header.php will be used from folder theme */
		//'header' => 'header.php',
		
		/* if ommited default footer.php will be used from folder theme */
		'footer' => 'footer.php',
		
		//MIDDLE SECTION LOCAL VIEWS
		
		/* what to place in main section on main theme from folder views */
		'main_section' => 'index.html',
		
		/* what to place in first side section on main theme  from folder views*/
		'aside_first' => 'index_first_aside.html',
		
		/* what to place in second side section on main theme  from folder views*/
		'aside_second' => 'index_second_aside.html',
	);
	

	
	$menu[l('404')] = array(
		/* neccecery for getting local directory */
		'base' => __DIR__,
		
		/* if ommited no favicon will be used */
		'favicon' => 'indexfavicon.png',
		
		/* if omited default title will be used */
		'title' => l('site_main_title'),
		
		/* if ommited all js from js folder wil be loaded */
		'main_css' => array('main.css'), 
		
		/* if ommited layout_default.html will be used */
		'layout' => 'layout_404.html',
		
		
		/* if ommited default header.php will be used from folder theme */
		//'header' => 'header.php',
		
		/* if ommited default footer.php will be used from folder theme */
		'footer' => 'footer.php',
		
		/* what to place in main section on main theme from folder views */
		'main_section' => '404.html',
	);
	
	$menu['mail'] = array(
		/* neccecery for getting local directory */
		'base' => __DIR__,
		
		/* if ommited no favicon will be used */
		'favicon' => 'indexfavicon.png',
		
		/* if omited default title will be used */
		'title' => l('site_main_title'),
		
		/* if ommited all js from js folder wil be loaded */
		'main_css' => array('main.css'), 
		
		/* if ommited layout_default.html will be used */
		//'layout' => 'layout_default.html',
		
		
		/* if ommited default header.php will be used from folder theme */
		//'header' => 'header.php',
		
		/* if ommited default footer.php will be used from folder theme */
		'footer' => 'footer.php',
		
		/* what to place in main section on main theme from folder views */
		'main_section' => 'mail.html',
	);
	
	$menu['form'] = array(
		/* neccecery for getting local directory */
		'base' => __DIR__,
		
		/* if ommited noe favicon will be used */
		'favicon' => 'indexfavicon.png',
		
		/* if omited default title will be used */
		'title' => l('form_example'),
		
		/* if ommited all css from css folder wil be loaded */
		//'main_css' => array('main.css'), 
		
		/* if ommited all js from js folder wil be loaded */
		//'main_js' => array('main.js','form.js'), 
		
		/* asking for local css from css folder inside this active folder */
		//'local_css' => array('local.css'),
		
		/* asking for local js from js folder inside this active folder */
		'local_js' => array('local.js'),
	
		/* if ommited default_layout.html will be used */
		//'layout' => 'layout_index.html',

		/* if ommited default header.php will be used from folder theme */
		//'header' => 'header_index.php',
		
		/* if ommited default header.php will be used from folder theme */
		//'footer' => 'footer.php',
		
		//MIDDLE SECTION LOCAL VIEWS
		
		/* what to place in main section on main theme from folder views */
		'main_section' => 'form_main_section.html',
		
		/* what to place in first side section on main theme  from folder views*/
		'aside_first' => 'form_first_aside.html',
		
		/* what to place in second side section on main theme  from folder views*/
		'aside_second' => 'form_second_aside.html',
		
	);
	
	
	