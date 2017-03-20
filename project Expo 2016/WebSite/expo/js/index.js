
var slides = $('#slideshow').find('li');
// move all to the right.
slides.addClass('in');

// move first one to current.
$(slides[0]).removeClass().addClass('current');

var currentIndex = 0;
  
// var minimumCount = 50;
// var maximumCount = 200;

var minimumCount = 40;
var maximumCount = 140;
var count = 0;

function nextSlide() {
  $('#again').attr('disabled','disabled');
  
  currentIndex += 1;
  if (currentIndex >= slides.length) {
    currentIndex = 0;
  }
  
  // move any previous 'out' slide to the right side.
  $('.out').removeClass().addClass('in');
  
  // move current to left.
  $('.current').removeClass().addClass('out');
  
  // move next one to current.
  $(slides[currentIndex]).removeClass().addClass('current');
  
  
  count += 1;
  if (count > maximumCount || (count > minimumCount && Math.random()>0.9) ) {
    clearInterval(interval);
    
    $('#again').removeAttr('disabled');
  }
}

// var interval = setInterval(nextSlide, 120);


$('#again').click(function(){  
  count = 0;
  interval = setInterval(nextSlide, 130);
});



