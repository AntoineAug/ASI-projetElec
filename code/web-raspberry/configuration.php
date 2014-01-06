<?php 
	require_once('includes/includes.php');
?>

	<section id="content">
		
		<form action="programmer.php" method = "post">
			<?php
				// On récupère les réveils déjà programmés
				$reveilsSerialises = @file_get_contents('user/reveils.json');
				$reveilsSerialises = json_decode($reveilsSerialises);
				foreach ($reveilsSerialises as $reveil)
				{
					$reveil = unserialize($reveil);
					if($reveil->getDayName() == 'samedi')
						echo '<div class="clear"></div>'.PHP_EOL;
					$reveil->getForm();
				}
			?>
			<p>
				<input type="submit" value = "Enregistrer">
			</p>
		</form>

	</section>
	
<?php 
	require_once('includes/footer.php');
?>
