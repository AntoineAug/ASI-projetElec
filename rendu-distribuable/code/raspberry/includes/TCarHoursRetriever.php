<?php

// Récupération des prochains horaires de passage du métro
// via parsing de la version mobile du site du réseau Astuce.
// mob.crea-astuce.fr

class TCarHoursRetriever
{
	const DIV_CONTAINER_ID = "monitoringHour";

	protected
		$ligne, $sens, $stationDepart,
		$limite;

	// Constructeur
	public function __construct($station = 'technopole', $direction = 'boulingrin', $limite = 3)
	{
		// La ligne choisie : la ligne de métro
		$this->ligne = 6;

		$this->setLimit($limite);
		$this->setDirection($direction);
		$this->setStationDepart($station);
	}

	// Limiter le nombre de résultats à afficher
	public function setLimit($limite)
	{
		$this->limite = $limite;
	}

	public function getNomDirection($id)
	{
		switch ($id)
		{
			case 2:
				return 'Boulingrin';
				break;
			case 1:
				return 'Technopôle';
				break;
		}
	}

	// Choix de la direction
	// 'technopole' ou 'boulingrin'
	public function setDirection($direction)
	{
		switch ($direction)
		{
			case 'boulingrin':
				$this->sens = 2;
				break;

			case 'technopole':
			default:
				$this->sens = 1;
				break;
		}
	}
	// Choix de la station de départ
	// Exemples : 'technopole', 'boulingrin', 'garerueverte', ...
	// Ou bien : 1591, 11192, ...
	public function setStationDepart($station)
	{
		if(is_numeric($station))
			// On nous a directement donné le bon identifiant
			$this->stationDepart = $station;
		else
		{ // On nous a donné un nom en toutes lettres
			switch ($station)
			{
				case 'boulingrin':
					if($this->sens == 1)
						$this->stationDepart = 12754;
					else
						$this->stationDepart = 12754;
					break;

				case 'technopole':
				default:
					if($this->sens == 1)
						$this->stationDepart = 11638;
					else
						$this->stationDepart = 11635;
					break;
			}
		}
	}


	// ----------------
	// ANALYSE DE L'URL
	// On a de la chance : tous les paramètres sont passés en GET
	// Pour créer une requête, on n'a donc qu'à générer une string.
	// Exemple pour le Technopôle direction Boulingrin :
	// http://mob.crea-astuce.fr/horaires/index.asp?rub_code=6&lign_id=6&sens=2&part_id=&network_id=&typeSearch=line&pa_id=&nexthours=1&stopPoint=11635$Technop%F4le$0
	protected function craftRequest($station, $ligne, $sens)
	{
		$requestString = "http://mob.crea-astuce.fr/horaires/index.asp?rub_code=6&typeSearch=line&nexthours=1";
		$requestString .= "&lign_id=". $ligne;
		$requestString .= "&sens=". $sens;
		$requestString .= "&stopPoint=". $station;

      		return $requestString;
	}


	// ----------------
	// RÉCUPÉRATION DE LA PAGE
	protected function retrievePage($url)
	{
		return @file_get_contents($url);
	}


	// ----------------
	// PARSING
	// Le passage qui nous intéresse :
	/*
	<div id="monitoringHour">
		<div id="monitoringHourTitle">
			Prochains passages&nbsp;:
		</div>
		<ul>
			
			<li>
				<span>17:38</span> (...) vers <span>Boulingrin</span></li>
			<li><span>17:44</span> (...) vers <span>Boulingrin</span></li>
			<li><span>17:50</span> (...) vers <span>Boulingrin</span></li>
			<li><span>17:57</span> (...) vers <span>Boulingrin</span></li>
			<li><span>18:03</span> (...) vers <span>Boulingrin</span></li>
			<li><span>18:09</span> (...) vers <span>Boulingrin</span></li>
		</ul>
		horaires théoriques
	</div>
	*/
	public function getHoursFromPage($html, $limite)
	{
		// On désactive temporairement la gestion d'erreur
		$previous_value = libxml_use_internal_errors(TRUE);
		// Chargement d'un objet DOM
		$htmlDocument = new DOMDocument();
		$htmlDocument->strictErrorChecking = FALSE;
		$htmlDocument->loadHTML(($html));
		// Réactivation de la gestion d'erreur avec le niveau précédent
		libxml_clear_errors();
		libxml_use_internal_errors($previous_value);
		
		$theDiv = $htmlDocument->getElementById(self::DIV_CONTAINER_ID);
		$hours = array();
		if(!empty($theDiv))
		{
			foreach ($theDiv->getElementsByTagName('span') as $span)
			{
				$value = $span->nodeValue;
				// Si c'est un horaire (forme HH:MM)
				if(preg_match("/\d\d:\d\d/", $value))
				{
					array_push($hours, $value);
				}
				elseif ($value != $this->getNomDirection($this->sens))
				{
					array_pop($hours);
				}
			}
		}

		if($limite > 0)
			$hours = array_slice($hours, 0, $limite);
		return $hours;
	}


	// ----------------
	// UTILISATION
	// Retourne un array d'horaires
	public function getHours()
	{
		$request = $this->craftRequest($this->stationDepart, $this->ligne, $this->sens);
		$page = $this->retrievePage($request);

		if(!empty($page) && $page !== false)
			return $this->getHoursFromPage($page, $this->limite);
		else
			return array();
	}
}


?>