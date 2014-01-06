<?php
	require_once('includes/includes.php');


	// TRAITEMENT DU FORMULAIRE
	if(isset($_POST) && !empty($_POST))
	{
		$config = array();
		foreach ($_POST as $key => $value)
		{
			$config[$key] = addslashes($value);
		}

		// On récupère l'id de la station de métro sélectionnée, en fonction de la direction
		include_once(INCLUDES_DIRECTORY. '/stationsDisponibles.php');
		if(isset($config['metro_station']) && !empty($config['metro_station']))
		{
			// Récupérons maintenant le bon ID
			// Dans le formulaire, on a encodé les stations selon leur position dans la liste direction Technopole
			// Si on va vers Boulingrin, l'ordre dans la liste est inversé
			$numero = $config['metro_station'] - 1;

			if($config['metro_direction'] == 'technopole')
			{ // Direction Technopôle (stations en ordre direct)
				$liste = array_keys($stationsDisponibles[1]);
				$liste = array_slice($liste, 0);

				$config['metro_station'] = $liste[$numero];
			}
			else if($config['metro_direction'] == 'boulingrin')
			{// Direction Boulingrin (stations en ordre inverse)
				$liste = array_keys($stationsDisponibles[2]);
				$liste = array_slice($liste, 0);
				$liste = array_reverse($liste); // Pour repasser en ordre direct

				$config['metro_station'] = $liste[$numero];
			}

		}

		// On enregistre le message dans un fichier séparé
		$message = "";
		if(isset($config['message']) && !empty($config['message']))
		{
			$message = $config['message'];
			unset($config['message']);	
		}
		@file_put_contents(USER_DIRECTORY. '/message.txt', $message);

		$json = json_encode($config);
		@file_put_contents(USER_DIRECTORY. '/config.json', $json);

		echo '<p class = "success">Vos préférences ont bien été enregistrées.</p>';
	}
?>
	<section id="content">
		
		<form action="preferences.php" method = "post">
			
			<div class="bloc">
				<h3>Message</h3>
				<p>
					<!-- Message -->
					<?php
						$message = @file_get_contents(USER_DIRECTORY. '/message.txt');
					?>

					<label for="message">Message personnalisé à afficher</label>
					<textarea name="message" id="message" cols="30" rows="10"><?php echo $message; ?></textarea>
				</p>
			</div>
			
			<!-- Métro -->
			<div class="bloc">
				<h3>Métro</h3>
				<?php
					require_once('includes/stationsDisponibles.php');
				?>
				<p>
					<!-- Choix de la station de départ -->
					<label for="metro_station">Votre station</label>
					<select name="metro_station" id="metro_station">
						<?php 
							$autreListe = array_keys($stationsDisponibles[2]);
							$autreListe = array_slice($autreListe, 0);
							$autreListe = array_reverse($autreListe);

							$i = 1;
							foreach ($stationsDisponibles[1] as $id => $nom)
							{

								if($id == $config['metro_station'] || $autreListe[$i-1] == $config['metro_station'])
									$selected = 'selected="selected"';
								else
									$selected = '';

								echo '<option value="'. $i .'" '. $selected .'>';
								echo $nom;
								echo '</option>';

								$i++;
							}
						?>
					</select>
				</p>
				<p>
					<!-- Choix de la direction -->
					<label for="metro_direction">Direction</label>
					<select name="metro_direction" id="metro_direction">
						<option value="technopole" <?php echo $config['metro_direction'] == 'technopole' ? 'selected="selected"' : ''; ?>>Vers Technopôle</option>
						<option value="boulingrin" <?php echo $config['metro_direction'] == 'boulingrin' ? 'selected="selected"' : ''; ?>>Vers Boulingrin</option>
					</select>
				</p>

				<p>
					<label for="metro_limit">Nombre d'horaires à afficher</label>
					<input name="metro_limit" id="metro_limit" type="number" min = "1" max = "10" value = "<?php echo $config['metro_limit'] ?>">
				</p>
			</div>

			
			<div class="bloc">
				<h3>Météo</h3>
				<p>
					<!-- Météo -->
					<label for="weather_city">Votre ville</label>
					<select name="weather_city" id="weather_city">
						<!-- À COMPLÉTER -->
						<?php
							$villesDisponibles = array(
								'rouen',
								'paris',
								'lyon'
							);

							foreach ($villesDisponibles as $ville)
							{
								if($ville == $config['weather_city'])
									$selected = 'selected="selected"';
								else
									$selected = '';

								echo '<option value="'. $ville .'" '. $selected .'>';
								echo ucwords($ville);
								echo '</option>';
							}
						?>
					</select>
				</p>
			</div>


			<div class="bloc">
				<h3>News</h3>
				<p>
					<!-- News -->
					<label for="reddit_board">Nom de la rubrique Reddit (voir <a href="http://www.reddit.com/subreddits/" target="_blank">la liste</a>)</label>
					<input type="text" name="reddit_board" id="reddit_board" value="<?php echo $config['reddit_board'] ?>">
				</p>
			</div>


			<p>
				<input type="submit" value = "Enregistrer">
			</p>
		</form>

	</section>
	
<?php 
	require_once('includes/footer.php');
?>
