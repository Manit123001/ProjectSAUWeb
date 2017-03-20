$(document).ready(function() {
  $('input,textarea').not('input[type=submit],input[type=radio]').addClass(
    'form-control');
  $('textarea').addClass('textareamin');
  $('table').addClass('table-hover');

  $('.edit-customer').click(function() {

    // get data from edit btn
    var id = $(this).attr('data-id');
    var title = $(this).attr('data-title');
    var name = $(this).attr('data-name');
    // set value to modal
    $('#id').val(id);
    $('#f1').val(title);
    $('#f2').val(name);


    // open Modal
    $('#formEditCustomer').modal('show');
  });
});

$(document).ready(function() {

  $('.edit-customer2').click(function() {

    // get data from edit btn
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    var position = $(this).attr('data-position');

    // set value to modal
    $('#id').val(id);
    $('#f1').val(name);
    $('#f2').val(position);
    $('#f3').val(name);
    $('#f4').val(name);
    $('#f5').val(name);

    // open Modal
    $('#formEditCustomer').modal('show');

  });

});

// .modal-backdrop classes

$(".modal-transparent").on('show.bs.modal', function() {
  setTimeout(function() {
    $(".modal-backdrop").addClass("modal-backdrop-transparent");
  }, 0);
});
$(".modal-transparent").on('hidden.bs.modal', function() {
  $(".modal-backdrop").addClass("modal-backdrop-transparent");
});

$(".modal-fullscreen").on('show.bs.modal', function() {
  setTimeout(function() {
    $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
  }, 0);
});
$(".modal-fullscreen").on('hidden.bs.modal', function() {
  $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
});



(function($) {
  // Owl carousel 2.0
  $('.owl-carousel').owlCarousel({
    loop: true,
    items: 3,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 1500,
    autoplayHoverPause: true,
    // nav: true,
    // autoplaySpeed: 500,
    smartSpeed: 200,
    // dotsContainer: true,
    responsive: {
      0: {
        items: 1
      },
      750: {
        item: 3,
        margin: 10
      },
      992: {
        items: 4,
        margin: 10
      }
    }
  });
})(jQuery);


// back-top
jQuery(document).ready(function() {
  $("#back-top").hide();
  // fade in #back-top
  $(function() {
    $(window).scroll(function() {
      var self = $(this),
        height = self.height(),
        top = self.scrollTop();

      if (top > height) {
        $('#back-top').fadeIn();
      } else {
        $('#back-top').fadeOut();
      }
    });

    // scroll body to 0px on click
    $('#back-top a').click(function() {
      $('body,html').animate({
        scrollTop: 0
      }, 500);

      return false;
    });

  });
});

// จัดเรียงข้อมูล blog
(function($) {
  var $container = $('.masonry-container');
  $container.imagesLoaded(function() {
    $container.masonry({
      columnWidth: '.masonry-item',
      itemSelector: '.masonry-item'
    });
  });

})(jQuery);

$(window).scroll(function() {
  var navTop = $(window).scrollTop();
  $('.model-0').css("top", navTop + 50);
});



alsolike(
  "GJpxoQ", "Simple Spinners",
  "XJyqQr", "Loading",
  "VYRzaV", "open close"
);
