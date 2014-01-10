<?php

class CronManager
{
	const DELIMITER = "REVEILS";
	const PATH_TO_TMP_FILE = "tmp/newCron.txt";

	static public function getCrons()
	{
		$output = '';
		exec('crontab -l', $output);
		$output = implode(PHP_EOL, $output);
		return $output;
	}

	static public function replaceCrons($crons)
	{
		//On récupère les tâches précédemment en place
		$previous = self::getCrons();

		//On prépare la string à écrire à partir du tableau donné
		$toAdd = '';
		foreach ($crons as $cron)
		{
			$toAdd .= $cron . PHP_EOL;
		}

		//On ne remplace que les tâches contenues entre les commentaires
		// # REVEILS et # /REVEILS
		$begin = "# ". self::DELIMITER;
		$end = "# /". self::DELIMITER;
		//On découpe le contenu du fichier crontab
		$before = explode($begin, $previous);
		$after = explode($end, $before[count($before)-1]);

		$output = $before[0]; //Tout ce qui est avant nos réveils
		$output .= $begin . PHP_EOL; //On commence nos réveils
		$output .= $toAdd;
		$output .= $end; //On finit nos réveils
		$output .= $after[count($after)-1]; //Tout ce qui est après nos réveils

		//On écrit le tout dans un fichier temporaire
		file_put_contents(self::PATH_TO_TMP_FILE, $output);

		//Et on demande à crontab de le prendre
		exec('sudo -u www-data crontab '. self::PATH_TO_TMP_FILE);

	}
}

?>
