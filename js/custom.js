(function ($) {

  "use strict";

    // PRE LOADER
    window.addEventListener('load', function () {
      const preloader = document.getElementById('main-loader');
      if (preloader) {
        preloader.style.transition = 'opacity 0.1s ease';
        preloader.style.opacity = '0';
        setTimeout(() => {
          preloader.style.display = 'none';
        }, 100); // ← ESTE NÚMERO ES EL TIEMPO TOTAL EN MILISEGUNDOS
      }
    });


    // MENU
    $('.navbar-collapse a').on('click',function(){
      $(".navbar-collapse").collapse('hide');
    });

   $(window).on("scroll", function () {
     var triggerPoint = $("#feature").offset().top - $(".navbar").outerHeight();
   
     if ($(window).scrollTop() >= triggerPoint) {
       $(".navbar-fixed-top").addClass("top-nav-collapse");
     } else {
       $(".navbar-fixed-top").removeClass("top-nav-collapse");
     }
   });

   
   

    // PARALLAX EFFECT
    $.stellar({
      horizontalScrolling: false,
    }); 


    // ABOUT SLIDER
    $('.owl-carousel').owlCarousel({
      animateOut: 'fadeOut',
      items: 1,
      loop: true,
      autoplayHoverPause: false,
      autoplay: true,
      smartSpeed: 1000,
    });


    // SMOOTHSCROLL
    $(function() {
      $('.custom-navbar a').on('click', function(event) {
        var $anchor = $(this);
          $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 49
          }, 1000);
            event.preventDefault();
      });
    });  

})(jQuery);

    document.addEventListener("DOMContentLoaded", function () {
        const tabLaptops = document.querySelector('a[href="#tab01"]');
        const tabSmartphones = document.querySelector('a[href="#tab02"]');

        const imgLaptop = document.getElementById("img-laptop");
        const imgSmartphone = document.getElementById("img-smartphone");

        tabLaptops.addEventListener("click", function () {
          imgLaptop.style.display = "block";
          imgSmartphone.style.display = "none";
        });

        tabSmartphones.addEventListener("click", function () {
          imgLaptop.style.display = "none";
          imgSmartphone.style.display = "block";
        });
    });
      
    document.addEventListener("DOMContentLoaded", function () {
     const secciones = document.querySelectorAll("section[id]");
     const navItems = document.querySelectorAll(".navbar-nav > li > a[href^='#']");
   
     function resaltarItemActivo() {
       let scroll = window.scrollY + 100;
   
       let seccionActiva = null;
       secciones.forEach(seccion => {
         if (scroll >= seccion.offsetTop) {
           seccionActiva = seccion.getAttribute("id");
         }
       });
       if (!seccionActiva && secciones.length > 0) {
       seccionActiva = secciones[0].getAttribute("id");
      }
       navItems.forEach(link => {
         const parentLi = link.parentElement;
         parentLi.classList.remove("active");
         const targetId = link.getAttribute("href").substring(1);
         if (targetId === seccionActiva) {
           parentLi.classList.add("active");
         }
       });
     }
   
     window.addEventListener("scroll", resaltarItemActivo);
     resaltarItemActivo(); // Ejecutar al cargar
   });

