<?php
	//PROGRAMMER L'HEURE DU RÉVEIL
	//via crontab
	require_once('includes/Reveil.php');
	require_once('includes/CronManager.php');
	
	if(isset($_POST) && !empty($_POST))
	{
		$dayNames = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
		$reveils = array();

		//Pour chaque jour de la semaine
		foreach ($dayNames as $name)
		{
			//On instancie un objet Reveil à partir des données récupérées
			$activated = (isset($_POST[$name]) && $_POST[$name] == 'on');
			$data = array(
				'dayName' => $name,
				'time' => $_POST[$name.'Reveil'],
				'activated' => $activated
			);

			$reveil = new Reveil();
			$reveil->hydrateFromForm($data);
			array_push($reveils, $reveil);
		}


		//On prépare l'ajout des tâches CRON
		$reveilsSerialises = array();
		$crons = array();
		foreach ($reveils as $reveil)
		{
			//$reveil->display();

			$cron = $reveil->getCron();
			if(!empty($cron))
				array_push($crons, $cron);

			array_push($reveilsSerialises, serialize($reveil));
		}

		//echo '<br/><br/>'.PHP_EOL;
		//On ajoute les tâches CRON
		CronManager::replaceCrons($crons);

		//On sauvegarde les objets réveil sous forme sérialisée
		//pour permettre de facilement hydrater le formulaire avec ces données

		@file_put_contents('user/reveils.json', json_encode($reveilsSerialises));
		
	}

	// On redirige vers la page de configuration
	header('Location: configuration.php');
?>