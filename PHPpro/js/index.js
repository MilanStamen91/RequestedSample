/**
 * How to play mp3
 */
// var soundEffect = new Audio("./putanja-do-mp3.mp3");
// soundEffect.play();

/**
 * Razlika PHP / JS
 */
// $mojTekst = "Nesto...";
// var mojTekst = "Nesto...";

// var_dump($mojTekst);
// console.log(mojTekst);

// $p->all();
// p.all();

/**
 * Pronadji svaki naslov na stranici i promeni
 * mu sadrzaj...
 */
// $('h1').text('Samo text');
// $('h1').html('<i>Novi tekst</i>');

/**
 * Koriscenje .text() funkcije da procita tekst
 * umesto da ga promeni
 */
// var tekstIzH1 = $('h1').text();
// console.log(tekstIzH1);


// setTimeout(function() {
//   var ukucanaVrednost = prompt("Nesto...?");
//   $('h1').text(ukucanaVrednost);
// }, 3000);

/**
 * Vezivanje input polja i nekog elementa
 */
// $('input[name="search"]').on('input', function() {
//   var vrednostInputPolja = $('input[name="search"]').val();
//   $('.card-title').text( vrednostInputPolja );
// });

/**
 * Alert
 */
setTimeout(function() {
    $('.alert').slideUp();
  }, 5000);
  
  
  $('.show-p').click(function() {
    $('.moj-p').slideDown();
  });
  
  $('.hide-p').click(function() {
    $('.moj-p').slideUp();
  });
  
  
  $('.druga').click(function() {
    if( $('.druga2').is(':visible') ) {
      $('.druga2').slideUp();
    } else {
      $('.druga2').slideDown();
    }
  });
  