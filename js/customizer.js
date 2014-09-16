jQuery(document).ready(function($){
	$cont = $('#customize-control-color_scheme > label');

	$('<div id="colorSwatch"></div>').appendTo($cont);
	$classVal = $('#customize-control-color_scheme select option:selected').val();
	$('#colorSwatch').removeClass().addClass($classVal);
	$('#customize-control-color_scheme select').change(function(){
		$classVal = $(this).val();
		$('#colorSwatch').removeClass().addClass($classVal);
	});

	$url = document.URL.split('customize.php')[0];

	$('.back.button').attr('href',$url);

	$('#accordion-section-colors h3').text('Color Scheme');
});