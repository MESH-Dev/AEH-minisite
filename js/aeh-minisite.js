jQuery(document).ready(function($){
	//Sitewide
	$panels = $('section.panel').size();
	i = $panels
	$('section.panel').each(function(){
		$(this).css('z-index',i);
		i--;
	});


	//Header Functions
	$('#header #main-nav li').wrapColumns(3, 'header-nav');
	$('a[href^="#"]').bind('click.smoothscroll',function (e) {
        e.preventDefault();

        var target = this.hash,
        $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top-30
        }, 500, 'swing', function () {
            window.location.hash = target;
        });
    });

	//Agenda
	$('ul.content-filter li').click(function(){
		$('.workshop-cont').slideUp(200).empty();
		if($(this).attr('data-filter') == 'extended'){
			$('ul.content-filter li').removeClass();
			$(this).addClass('active');
			$('.agenda-event-content').slideDown(200);

			$('.agenda-entry.workshop').each(function(){
				$panelCont = $(this).find('.agenda-event-tracks').html();
				$panelTitle = $(this).find('h3').html();
				$workshop = $(this).siblings('.workshop-cont');

				$(this).siblings('.workshop-cont').append('<div class="workshop-tracks-print"><div class="gutter"><h3>'+$panelTitle+'</h3><hr>'+$panelCont+'</div></div>').slideDown(200);
			});

		}else{
			$('ul.content-filter li').removeClass();
			$(this).addClass('active');
			$('.agenda-event-content').slideUp(200);

			$('.agenda-entry.workshop').each(function(){
				$panelCont = $(this).find('.agenda-event-tracks').html();
				$panelTitle = $(this).find('h3').html();
				$workshop = $(this).siblings('.workshop-cont');

				$(this).siblings('.workshop-cont').empty().slideUp(200);
			});
		}
	});


	$('.agenda-row').each(function(){
		$(this).children('.agenda-entry').wrapRows(4,'agenda-row-entry-wrap');
		$(this).children('.agenda-row-entry-wrap').last().addClass('first');
	});
	$('.agenda-row-entry-wrap').append('<div class="workshop-cont"><div class="gutter"></div></div>');

	$('.agenda-entry.workshop').click(function(){
		if($(this).hasClass('multiple')){
			$panelCont = $(this).find('.agenda-event-tracks').html();
			$workshop = $(this).siblings('.workshop-cont');

			if($('.content-filter li.active').attr('data-filter') == 'extended' && $workshop.is(':hidden')){
				$(this).parent().children('.agenda-entry').find('.agenda-event-content').slideToggle(200);
			}

			if($workshop.attr('data-index') == $(this).index()){

				$workshop.slideToggle(200,function(){
					$(this).empty();
				});
				$workshop.removeAttr('data-index');
				if($('.content-filter li.active').attr('data-filter') == 'extended'){
					$(this).parent().children('.agenda-entry').find('.agenda-event-content').slideToggle(200);
				}
			}else{
				if($workshop.is(':visible')){
					$workshop.empty().html('<div class="gutter">'+$panelCont+'</div>');
				}else{
					$workshop.empty().html('<div class="gutter">'+$panelCont+'</div>').slideToggle(200);
				}
				$workshop.attr('data-index',$(this).index());
			}

		}else{
			$(this).find('.agenda-event-content').slideDown(200);
		}
	});



	function unique(list) {
	  var result = [];
	  $.each(list, function(i, e) {
	    if ($.inArray(e, result) == -1) result.push(e);
	  });
	  return result.sort();
	}

	arr = [];
	$('.agenda-entry.workshop .agenda-event-tracks .agenda-entry-track').each(function(){
	    multi = $(this).attr('data-filter').split(' ');
	    $.each( multi, function( index, value ){
		    arr.push(value);
		});
	});

	arr = unique(arr);
	arr = $.grep(arr, function(value) {
	  return value != 0;
	});

	$.each(arr,function(index,value){
		dispVal = value.replace('-', ' ');

		$('<option data-filter="'+value+'">'+dispVal+'</option>').appendTo('.session-filter');
	});



	$('.session-filter').change(function(){
		$('.workshop-cont').removeAttr('data-pop').removeClass('pop');
		datafilter = $(this).children(':selected').attr('data-filter');

		$('.content-filter li[data-filter="short"]').click();
		$('.agenda-entry.workshop').has('.agenda-entry-track.'+datafilter).each(function(){
			$panelCont = $(this).find('.agenda-event-tracks').html();
			$panelTitle = $(this).find('h3').html();

			$(this).siblings('.workshop-cont').append('<div class="workshop-tracks"><div class="gutter"><h3>'+$panelTitle+'</h3><hr>'+$panelCont+'</div></div>').attr('data-pop',true).addClass('pop');
		});

		$('.workshop-cont.pop').each(function(){
			if($(this).attr('data-pop') == 'true'){
				$(this).slideToggle(200);
			}
		});

		$('.workshop-cont .agenda-entry-track').hide();
		$('.workshop-cont .agenda-entry-track.'+datafilter).show();
	});

	//Sticky header
	$hHeight = $('header#header').height();
	$('header#header').headroom({"offset":$hHeight});
	$('section#intro > .bg').css('padding-top',$hHeight);


	//Print Script
	$('#print.agenda .agenda-entry.workshop').each(function(){
		$panelCont = $(this).find('.agenda-event-tracks').html();
		$panelTitle = $(this).find('h3').html();
		$workshop = $(this).siblings('.workshop-cont');

		$(this).siblings('.workshop-cont').append('<div class="workshop-tracks-print"><div class="gutter"><h3>'+$panelTitle+'</h3><hr>'+$panelCont+'</div></div>');
	});


});


// Multiwrap Function
(function($){
  $.fn.wrapColumns = function(count,className) {
    var length = this.length;
	var count = Math.ceil(length/count);
    for(var i = 0; i < length ; i+=count) {
      this.slice(i, i+count).wrapAll('<div '+((typeof className == 'string')?'class="'+className+'"':'')+'/>');
    }
    return this;
  };
})(jQuery);

(function($){
  $.fn.wrapRows = function(count,className) {
    var length = this.length;
    for(var i = 0; i < length ; i+=count) {
      this.slice(i, i+count).wrapAll('<div '+((typeof className == 'string')?'class="'+className+'"':'')+'/>');
    }
    return this;
  };
})(jQuery);