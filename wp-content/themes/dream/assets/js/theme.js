jQuery.noConflict()(function($) {
  $(document).ready(function() {  

    function backToTopButton() {
      var
        $scrollTopBtn = $('#back_top');
      if ($scrollTopBtn.hasClass('visible-button')) {
        $scrollTopBtn.removeClass('visible-button');
      }
      $(window).scroll(function() {
        if ($(window).scrollTop() > 0) {
          $scrollTopBtn.addClass('visible-button');
        } else {
          $scrollTopBtn.removeClass('visible-button');
        }
      });
      $scrollTopBtn.on('click', function() {
        $('html:not(:animated), body:not(:animated)').animate({scrollTop: 0}, 0);
        return false;
      });
    }
    backToTopButton(); 

    $('.slider-cycle').owlCarousel({
      singleItem: true,
      slideSpeed : 600,
      paginationSpeed: 600,
      rewindSpeed: 1000,
      autoPlay: 5000,
      stopOnHover: true,
      navigation : true,
      navigationText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      pagination: true,
    });
  });
});
