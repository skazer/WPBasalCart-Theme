function justifyMenu() {
    var headerHeight = parseInt($('#header').outerHeight(true)+20);
	$('#header').css({ 'height' : headerHeight+'px' });
	var top = $('#nav-menu').offset().top - parseFloat($('#nav-menu').css('marginTop').replace(/auto/, 0));
	$(window).scroll(function (event) {
		var y = $(this).scrollTop();
		if (y >= top) {
		  $('#nav-menu').addClass('fixed');
		} else {
		  $('#nav-menu').removeClass('fixed');
		}
	});
	
}

function showProductBoxes(id) {
	var productWrap = $('#wp_basalcart_product_wrap_'+id);
	var mainImage = productWrap.children('.main-image');
	var moveRight = productWrap.children('.move-right');
	var productInfo = productWrap.children('.product-info');
	var productRating = productWrap.children('.product-rating-container');
	
	if(moveRight.css('display')=='block' && productInfo.css('display')=='block' && productRating.css('display')=='block') {
		mainImage.removeClass('main-image-selected');
		moveRight.css({ 'display' : 'none' });
		productInfo.css({ 'display' : 'none' });
		productRating.css({ 'display' : 'none' });
	} else {
		mainImage.removeClass('main-image-selected');
		moveRight.css({ 'display' : 'none' });
		productInfo.css({ 'display' : 'none' });
		productRating.css({ 'display' : 'none' });
		
		mainImage.addClass('main-image-selected');
		
		moveRight.css({ 'display' : 'block' });
		var moveRightWidth = moveRight.outerWidth(true);
		moveRight.css({ 'width' : '0'});
		
		productInfo.css({ 'display' : 'block' });
		var productInfoHeight = productInfo.outerHeight(true);
		productInfo.css({ 'height' : '0'});
		
		productRating.css({ 'display' : 'block' });
		var productRatingHeight = productInfo.outerHeight(true);
		productRating.css({ 'height' : '0'});
		
		$(moveRight).animate({ 'width' : moveRightWidth+'px' }, { duration:300, queue:false, complete:function(){} } );
		$(productInfo).animate({ 'height' : productInfoHeight+'px' }, { duration:300, queue:false, complete:function(){} } );
		$(productRating).animate({ 'height' : productRatingHeight+'px' }, { duration:300, queue:false, complete:function(){} } );
	}
}

$().ready(function() {
	$(".secondary-image").hover(
		function () {
			var moveLeftPx = parseInt(($(this).index() + 1) * 300);
			if(typeof moveLeftPx !== 'undefined' && typeof moveLeftPx === 'number') {
				$(".slide-wrapper").animate({ 'margin-left' : '-'+moveLeftPx }, { duration:300, queue:false, complete:function(){} } );
			}
		},
		function () {
			$(".slide-wrapper").animate({ 'margin-left' : '0' }, { duration:300, queue:false, complete:function(){} } );
		}
	);
	justifyMenu();
});
