<?php

	include 'php/Parser.php';
	include 'php/Logger.php';

	// @TODO: These are duplicated
	header('Content-type: application/json');

	$clientId = '4134371454.278412442948';
	$clientSecret = 'd48eb9552f6b55df66b7a9be6a695d46';

	//OAuth Token
	$token = "xoxp-4134371454-4134371456-281904522710-e573dd392cbdc8e8d0f9e9063dd714bd";

	// To verify incoming messages are coming from Slack
	$verificationToken = 'xByEWF7zpp1EpjCyJSC0Mopj';

	// $expectedToken = 'RL7LayGC2YdJuVeU3FWQYlYu';
	$expectedToken = $verificationToken;

	$receivedToken = isset($_POST['token']) && $_POST['token'] == $expectedToken;

	// echo json_encode(['text' => 'African or European?']);

	writeInputLog("MESSAGE:");
	writeInputLog(json_encode($_POST));
