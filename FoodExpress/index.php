<?php


	require_once "system/core/System.php";

	$system = new System(isset($_GET['key']) ? $_GET['key'] : "index/index");
	$system->loadLibrary();
	$system->run();
