<?php
	require_once('runtime.php');
	require_once('lib/api/main.class.php');
	require_once 'lib/extern/Zend/Json/Server.php';

	$server = new Zend_Json_Server();
	$server->setClass('Main');
	
	if ('GET' == $_SERVER['REQUEST_METHOD']) {
		// Indicate the URL endpoint, and the JSON-RPC version used:
		$server->setTarget('api_main.php')
			   ->setEnvelope(Zend_Json_Server_Smd::ENV_JSONRPC_2);
		
		// Grab the SMD
		$smd = $server->getServiceMap();
		
		// Return the SMD to the client
		header('Content-Type: application/json');
		echo $smd;
		return;
	}
	
	$server->handle();
?>