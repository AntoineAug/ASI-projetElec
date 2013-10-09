
<!-- Météo fournie par meteorama.fr, Foreca -->
<?php
$cityIds = array(
	'rouen' => '723454d0f1985cd0f1d390dac049210d',
	'paris' => 'a72a8beecd9713ec279a615f30e971bb',
	'lyon'	=> '8025b05bdd94579d483bc2cc55bb3f50'
);
?>


<div id="c_<?php echo $cityIds[$config['weather_city']]; ?>" class = "meteoContainer">

	<div id="w_<?php echo $cityIds[$config['weather_city']]; ?>"></div>

</div>

<script type="text/javascript" src="http://www.meteorama.fr/widget/loader/<?php echo $cityIds[$config['weather_city']] ?>"></script>



<!-- Rouen -->
<!-- <div id="c_3c442ba701124b84211452d33e9b1c79" class="normal"><h2 style="color: #000000; margin: 0 0 3px; padding: 2px; font: bold 13px/1.2 Verdana; text-align: center; width=100%"><a href="http://www.meteorama.fr/m%C3%A9t%C3%A9o-rouen.html" style="color: #000000; text-decoration: none; font: bold 13px/1.2 Verdana;">Météo Rouen</a></h2><div id="w_3c442ba701124b84211452d33e9b1c79" class="normal" style="height:100%"></div></div><script type="text/javascript" src="http://www.meteorama.fr/widget/loader/3c442ba701124b84211452d33e9b1c79"></script> -->


<!-- Lyon -->
<!-- <div id="c_8025b05bdd94579d483bc2cc55bb3f50" class="normal"><h2 style="color: #000000; margin: 0 0 3px; padding: 2px; font: bold 13px/1.2 Verdana; text-align: center; width=100%"><a href="http://www.meteorama.fr/m%C3%A9t%C3%A9o-lyon.html" style="color: #000000; text-decoration: none; font: bold 13px/1.2 Verdana;">Météo Lyon</a></h2><div id="w_8025b05bdd94579d483bc2cc55bb3f50" class="normal" style="height:100%"></div></div><script type="text/javascript" src="http://www.meteorama.fr/widget/loader/8025b05bdd94579d483bc2cc55bb3f50"></script> -->