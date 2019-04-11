// People section

// shows and hides filtered items
$(".filter-simple-button").click(function() {
  var value = $(this).attr('data-filter');
  if(value === "all") {
    $('.filter-simple-item').show('1000');
  } else {
    $(".filter-simple-item").not('.'+value).hide('3000');
    $('.filter-simple-item').filter('.'+value).show('3000');
  }
});

// changes active class on filter buttons
$('.filter-simple-button').click(function () {
  $(this).siblings().removeClass('is-active');
  $(this).addClass('is-active');
});


// Ajax nav


$(document).ready(function(){
  // Set trigger and container variables
  var trigger = $('#nav ul li a'),
      container = $('#content');
  
  // Fire on click
  trigger.on('click', function(){
    // Set $this for re-use. Set target from data attribute
    var $this = $(this),
      target = $this.data('target');       
    
    // Load target page into container
    container.load(target + '.php');
    
    // Stop normal link behavior
    return false;
  });
});


