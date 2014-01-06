(function($)
{
	jQuery(document).ready(function($)
	{
		init();
	});

	function init()
	{
		// Configuration du plugin Timeago
		$.timeago.settings.allowFuture = true;
		$.timeago.settings.strings =
		{
			// environ ~= about, it's optional
			// prefixAgo: "il y a",
			// prefixFromNow: "d'ici",
			// seconds: "moins d'une minute",
			// minute: "environ une minute",
			// minutes: "environ %d minutes",
			// hour: "environ une heure",
			// hours: "environ %d heures",
			// day: "environ un jour",
			// days: "environ %d jours",
			// month: "environ un mois",
			// months: "environ %d mois",
			// year: "un an",
			// years: "%d ans"
			prefixAgo: "il y a",
			prefixFromNow: "dans",
			seconds: "moins d'une minute",
			minute: "une minute",
			minutes: "%d minutes",
			hour: "une heure",
			hours: "%d heures",
			day: "un jour",
			days: "%d jours",
			month: "un mois",
			months: "%d mois",
			year: "un an",
			years: "%d ans"
		};
		// Assignation aux éléments porteurs d'une date
		$('.timeago').timeago();

		// On lance la mise à jour automatique de l'horloge
		setInterval(updateTime, 1000);

		// Configuration des horaires des réveils
		$('form .day input[type="checkbox"]').bind('click', function(e){
			var box = $(e.target);
			if(box.prop('checked'))
				box.parent('.day').removeClass('inactive');
			else
				box.parent('.day').addClass('inactive');
		});
	}


	function updateTime()
	{
		var d = new Date();

		// Clignottement du :
		var column = ':';
		var modulo = d.getSeconds() % 2;
		if(modulo == 1)
			column = ' ';

		// Ajout du zéro initial
		var minutes = d.getMinutes();
		if(minutes < 10)
			minutes = '0' + minutes;
		var heures = d.getHours();
		if(heures < 10)
			heures = '0' + heures;

		$('#heure').text(heures + column + minutes);
	}

})(jQuery);