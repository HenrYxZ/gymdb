/* Spanish translation for the jQuery Timepicker Addon */
/* Written by Ianaré Sévi */
(function($) {
	$.timepicker.regional['es'] = {
		timeOnlyTitle: 'Elegir una hora',
		timeText: 'Hora',
		hourText: 'Horas',
		minuteText: 'Minutos',
		secondText: 'Segundos',
		millisecText: 'Milisegundos',
		timezoneText: 'Huso horario',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
		dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
		currentText: 'Ahora',
		closeText: 'Cerrar',
		timeFormat: 'hh:mm',
		amNames: ['a.m.', 'AM', 'A'],
		pmNames: ['p.m.', 'PM', 'P'],
		ampm: false
	};
	$.timepicker.setDefaults($.timepicker.regional['es']);
})(jQuery);