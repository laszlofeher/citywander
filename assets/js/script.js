$(document).ready(function() {
	
	$('.slideshow').owlCarousel({
		loop: true,
		margin: 0,
		items: 1,
		nav: false,
		dots: false,
		autoplay: true,
		autoplayTimeout: 4000,
		autoplaySpeed: 1000,
        thumbs: false
	});
    
    var productSlide = $('.product-slide');
    productSlide.owlCarousel({
        loop:true,
        items: 1,
        thumbs: false,
        thumbImage: true,
        thumbContainerClass: 'owl-thumbs',
        thumbItemClass: 'owl-thumb-item'
    });
    
    $('.product-carousel-holder .next').click(function(e){
        productSlide.trigger('next.owl.carousel');
        e.preventDefault();
    });
    $('.product-carousel-holder .prev').click(function(e){
        productSlide.trigger('prev.owl.carousel');
        e.preventDefault();
    });
	
	$('.box-carousel-noloop').owlCarousel({
		loop: false,
		margin: 14,
		items: 2,
		nav: true,
        navText: ['<i class="fa fa-chevron-circle-left fa-3x" aria-hidden="true"></i>','<i class="fa fa-chevron-circle-right fa-3x" aria-hidden="true"></i>'],
		dots: false,
		center: false,
        thumbs: false,
		responsive: {
			768: {
				items: 4,
                margin: 30
			}
		}
	});
	$('.box-carousel').owlCarousel({
		loop: true,
		margin: 14,
		items: 2,
		nav: true,
        navText: ['<i class="fa fa-chevron-circle-left fa-3x" aria-hidden="true"></i>','<i class="fa fa-chevron-circle-right fa-3x" aria-hidden="true"></i>'],
		dots: false,
		center: false,
        thumbs: false,
		responsive: {
			768: {
				items: 4,
                margin: 30
			}
		}
	});
    
    $('.drp').daterangepicker({
		locale: {
			format: 'YYYY-MM-DD'
		},
		autoApply: true
	});
	
	$('.input-rating').rating({
		hoverOnClear: false,
		theme: 'ratings',
		showClear: false,
		showCaption: false,
		filledStar: '<i class="fa fa-star"></i>',
        emptyStar: '<i class="fa fa-star-o"></i>',
        clearButton: '<i class="fa fa-lg fa-minus-circle"></i>'
    });
	
	$('.scroll-to-btn').on('click', function(e) {
		e.preventDefault();
		
		var hash = $(this).attr('href'),
			scrollPx = $(hash).position().top;
		
		$('html, body').stop().animate({
			scrollTop: scrollPx - 34
		}, 500);
	});
	
	$('.media-box-like,.product-like').on('click', function(e) {
		e.preventDefault();
		
		$(this).find('i').toggleClass('cw-heart cw-heart-f');
	});
	
	$('.form-list-toggle').parent().on('click', function(e) {
		e.preventDefault();
		
		$(this).parent().find('ul').slideToggle();
	});
	
	$('.sb-filter-btn').on('click', function(e) {
		e.preventDefault();
		
		$('.sb-filter').slideToggle();
	});
    
    $('.dropdown-wishlist .fa-times-circle').on('click',function (e){
        e.preventDefault();
    });
    
    $('#open-note').on('click', function (e){
        e.preventDefault();
        $('#toggle-note').slideToggle("slow");
    });
    
    $(window).scroll(function (event) {
        loadList();
    });
    
    $('.activityOptions').on('click',function (){
        $('.activityOptions').each(function (){
            $(this).removeClass('checked');
        });
        $(this).find('input[type=radio]').prop('checked', true);
        $(this).addClass('checked');
    });
	
});

function loadList(){
    var l = $('#loadList');
    var w = $(window);
    if(l.length>0 && w.width()<=767){
        var gt = parseInt(l.offset().top);
        var gh = parseInt(l.height());
        var i = gt + gh;
        var bbp = w.scrollTop() + w.height();
        $('#pozicio').css('margin-top',(i-20)+'px');
        $('#pozicio').html(i);
        if(bbp >= i){
            $.ajax({
                type: "POST",
                url: 'ajax_list.php',
                data: ""
            }).done(function(data){
                l.append(data);
            });
        }
    }
}