<?php

class Reveil
{
	private
	$day, $hour, $minute,
	$activated;
	const PATH_TO_SCRIPT = "/var/www/P6-raspy/sonnerie.sh";

	public

	function __construct($day = '', $hour = 0, $minute = 0, $activated = true)
	{
		$this->day = $day;
		$this->hour = $hour;
		$this->minute = $minute;
	}

	function hydrateFromForm($data)
	{
		$this->activated = $data['activated'];
		$this->day = $data['dayName'];

		//On parse l'heure
		$time = explode(':', $data['time']);
		$this->hour = $time[0];
		$this->minute = $time[1];
		//À FAIRE : SUPPORTER AM/PM
	}

	function getDayName()
	{
		return $this->day;
	}
	function getDayNumeric()
	{
		$dayNames = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
		$dayNumbers = array_flip($dayNames);
		return 1 + $dayNumbers[$this->day];
	}

	function display()
	{
		if($this->activated)
			echo 'Ce réveil sonnera tous les '. $this->day .' à '. $this->hour .':'. $this->minute .'.<br/>';
		else
			echo 'Aucun réveil ne sonnera le '. $this->day .'.<br/>';
	}

	function getCron()
	{
		/* Syntaxe d'une tâche CRON :
			Minutes [0-59]
			|	Hours [0-23]
			|	|	Days [1-31]
			|	|	|	Months [1-12]
			|	|	|	|	Days of the Week [Numeric, 0-6]
			|	|	|	|	|
			*	*	*	*	* home/path/to/command/the_command.sh
			
			(source http://net.tutsplus.com/tutorials/php/managing-cron-jobs-with-php-2/)
		*/
		$job = '';

		if($this->activated)
		{
			$job = $this->minute .' '. $this->hour;
			$job .= ' * * '. $this->getDayNumeric();
			$job .= ' '. self::PATH_TO_SCRIPT;
		}

		return $job;
	}

	function getForm()
	{
		$checked = '';
		$inactive = 'inactive';
		if($this->activated)
		{
			$checked = 'checked="checked"';
			$inactive = '';
		}
		?>
		
		<p class = "day <?php echo $inactive ?>">
			<input type="checkbox" name = "<?php echo $this->day; ?>" id = "<?php echo $this->day; ?>" <?php echo $checked ?>>
			<label for="<?php echo $this->day; ?>" class = "dayName"><?php echo ucfirst($this->day); ?></label>
			<span class="clear"></span>
			
			<label for="<?php echo $this->day; ?>Reveil"></label>
			<input type="time" name = "<?php echo $this->day; ?>Reveil" id = "<?php echo $this->day; ?>Reveil" value = "<?php echo $this->hour, ':', $this->minute ?>">
		</p>
		<?php
	}
}

?>
