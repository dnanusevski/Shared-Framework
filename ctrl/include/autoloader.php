<?php
	function class_loader($class) {
		require_once(CLASS_F.'/' . str_replace('\\', '/', $class)  . '.php');
	}
	spl_autoload_register ('class_loader');