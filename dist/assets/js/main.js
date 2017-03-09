// Ativa e desativa o menu mobile

$('.btn-menu-mobile').on('click', function(){

	$(this).toggleClass('btn-menu-inactive btn-menu-active');
	$('.mobile-menu ').toggleClass('mobile-menu-inactive mobile-menu-active');

});

// Click scroll Down.

jQuery(document).ready(function($) {

  $(".scroll a").click(function(event){

    event.preventDefault();

    $('html,body').animate({scrollTop:$(this.hash).offset().top}, 900);

  });

});


// Logo Adjustment on scroll

$(window).scroll(function () {

  var xAxis = $(this).scrollTop();

  var scrollSize = 50;

  var btnUp = 250;

  var windowWidth = $(window).width();

  $('.menu-desktop').addClass('transition');

  if (xAxis > scrollSize) {

    $('.menu-desktop-logo').addClass('menu-desktop-logo-small');

    $('.menu-desktop').addClass('bg-opacity');

  }else {

   $('.menu-desktop-logo').removeClass('menu-desktop-logo-small');

   $('.menu-desktop').removeClass('bg-opacity');

 }

});