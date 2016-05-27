<?php
	
	/**
	 * 
	 * ================ TRIGGER PHP FRAMEWORK =================
	 *
	 * @author Leandro Ungari Cayres <leandroungari@gmail.com>
	 * 
	 */



	require_once 'system/core/System.php';
	require_once 'system/config/constant.php';



	$system = new System(isset($_GET['key']) ? $_GET['key'] : "index/index");
	$system->loadLibrary();
	$system->run();
