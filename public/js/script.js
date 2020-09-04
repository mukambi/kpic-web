$(function () {
  'use strict';

  $('#navbarToggler').on('click', function() {
    $('#navbarMenu').toggleClass('show');
    $('body').toggleClass('navbar-open');
  });


  var previousScroll = 0;

  window.onscroll = function () {
    var body = document.querySelector('body');
    if (window.pageYOffset > 1) {
        body.classList.add('scrolling-up');
    } else {
        body.classList.remove('scrolling-up');
    }
  };

  $('[data-toggle="tooltip"]').tooltip()
});