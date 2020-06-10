$(document).ready(function(){
  ////////////////// SIDE NAV BAR CODE /////////////////////

  function openNav() {
    $("#mySidenav").css("width", '100%');
    $("#main").css("margin-left", 160);
  };

  function closeNav() {
    $("#mySidenav").css("width", 0);
    $("#main").css("margin-left", 0);
  };

  $("#mySidenav").click(function() {
    closeNav();
    $('#bg').removeClass("show");
    var imageNo = Math.floor((Math.random()*12)+1);
  });

  $(".closebtn").click(function(e) {
    e.preventDefault();
    closeNav();
    $('#bg').removeClass("show");
  });

  $(".navbutton").click(function(e) {
    e.preventDefault();
    openNav();
    $('#bg').toggleClass("show");
    var imageNo = Math.floor((Math.random()*12)+1);
  });

  // slider

  $('.home-slider').slick({
    infinite: true,
    dots: true,
    speed: 300,
    slidesToShow: 1,
    arrows: false,
  });


});

// Preloader Code /*
$(window).bind("load", function () {
	$('body').addClass('loaded').scrollTop(0);
});
