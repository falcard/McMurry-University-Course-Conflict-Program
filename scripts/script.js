// JavaScript Document
function() {
	var class = $('$class');
	
	$('department').change(function(e) {
		var sel = $(this).val();
		class.html('');
		if (sel != '0') {
			$.get('data/' + sel + '.txt', function(response) {
				class.html(response);
				class.removeAttr('disabled');
				$('option[value="0"]', e.target).remove();
			});
		}
	});
	
	class.change(function(e) {
		if ($(this).val() != '0') {
			$('option[value="0"]', e.target).remove();
		}
	});
};
