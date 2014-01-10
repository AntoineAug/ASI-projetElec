<?php

const INCLUDES_DIRECTORY = "includes";
const USER_DIRECTORY = "user";

require_once(INCLUDES_DIRECTORY. '/CronManager.php');
require_once(INCLUDES_DIRECTORY. '/Reveil.php');
require_once(INCLUDES_DIRECTORY. '/TCarHoursRetriever.php');

require_once(INCLUDES_DIRECTORY. '/head.php');
require_once(INCLUDES_DIRECTORY. '/header.php');




// Chargement de la configuration
$config = file_get_contents(USER_DIRECTORY. '/config.json');
if(!empty($config))
	$config = json_decode($config, true);
else
{
	$config = array(
		'metro_station' => 'technopole',
		'metro_direction' => 'boulingrin',
		'metro_limit' => 3,
		'weather_city' => 'rouen',
		'reddit_board' => 'worldnews'
	);

	// On écrit la configuration par défaut
	file_put_contents(USER_DIRECTORY. '/config.json', json_encode($config));
}

// print_r($config);
?>