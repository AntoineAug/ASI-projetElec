<?php 
	require_once('includes/includes.php');
?>

	<section id="content" class = "home">
		
		<section id = "message" class="module">
			<?php
				include('includes/widgetMessage.php');
			?>
		</section>

		<section id="date" class = "module">
			<p>
				<span class="date">
					<span id="jourDeLaSemaine"><?php echo strftime('%A'); ?></span>
					<span id="jour"><?php echo strftime('%e'); ?></span>
					<span id="mois"><?php echo strftime('%B'); ?></span>
				</span>
				<span id="heure"><?php echo date('H:m') ?></span>
			</p>
		</section>
		
		<section id="horairesMetro" class = "module">
			<h3>Prochains métros</h3>
			<ul>
			<?php
				$retriever = new TCarHoursRetriever($config['metro_station'], $config['metro_direction'], $config['metro_limit']);
				$hours = $retriever->getHours();

				foreach ($hours as $hour)
				{
					// On prépare la date au format ISO-8601
					// pour que le plugin timeago puisse les convertir
					$dateIso = date('c', strtotime($hour));

					echo '<li>',
							'<abbr class = "timeago" title ="', $dateIso, '">',
								$hour, 
							'</abbr>',
						'</li>', PHP_EOL;
				}

				if(empty($hours))
				{
					echo "<li>Aucun</li>";
				}
			?>
			</ul>
		</section>

		<section id = "meteo" class="module">
			<h3>Météo</h3>
			<?php
				include('includes/widgetMeteo.php');
			?>
		</section>

		<section id = "news" class="module">
			<h3>News</h3>
			<?php
				include('includes/widgetReddit.php');
			?>
		</section>

	</section>

<?php 
	require_once('includes/footer.php');
?>