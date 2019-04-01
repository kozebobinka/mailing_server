"use strict";

bkLib.onDomLoaded(function() {
	new nicEditor({
		fullPanel: true, 
		iconsPath: '/assets/js/nicedit/nicEditorIcons.gif'
	}).panelInstance('message');
});

$(function(){
	
	window.n_attachment = 2;
	
	$('#city').autocomplete({
		source: function( request, response ) {
			$.ajax({
				type: "POST",
				url: "/mailing/autocomplete_city",
				dataType: "json",
				data: {
					city: request.term,
					region: $("#region").val(),
				},
				success: function( data ) {
					response(data)
				},
			});
		}
	});	

	$('.custom-control-input').click(function() {
		if ($("#target1").prop("checked")) {
			$("#target1_div").fadeIn();
		} else {
			$("#target1_div").fadeOut();
		}
	});
	
	$('#mailing_form').on('change', '.attachment', function() {
		if ($(this).val() != '') {
			var new_attachment = 
				'<div class="form-group row">' +
				'<label for="inputPassword" class="col-sm-2 col-form-label">Прикріпити файл:</label>' +
				'<div class="col-sm-10">' +
				'<input type="file" class="form-control attachment" name="attachment[' + window.n_attachment++ + ']">' +
				'</div>' +
				'</div>';
			$(new_attachment).insertAfter($(this).closest('.row'));
		}
	});
	
	$('#gen_news').click(function() {
		$.ajax({
			type: "POST",
			url: "/mailing/get_news_html",
			dataType: "html",
			success: function(data) {
				$(".nicEdit-main").html(data);
			},
		});		
	});	
	
	$('.ads').click(function() {
		$.ajax({
			type: "POST",
			url: "/mailing/get_letter_html",
			data: { 
				letter_name: event.target.id,
			},
			dataType: "html",
			success: function(data) {
				$(".nicEdit-main").html(data);
			},
		});		
	});	
});