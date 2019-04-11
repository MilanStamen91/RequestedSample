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
 $('#cont').load('../index.php');

 $('ul#nav li a').click(function() {
  var page = $(this).attr('href');
  $('#cont').load('../' + page + '.php');
 });
});


