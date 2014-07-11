(function($){

//adding .touch .no-touch classes
document.documentElement.className +=
    (("ontouchstart" in document.documentElement) ? ' touch' : ' no-touch');


$(document).ready(function() {
  var stg = $('.side-top-toggle'),
      srg = $('.side-recent-toggle'),
      spw = $('.side-post-wrap'),
      check = $('.checkbox');

  srg.click(function(e) {
    e.preventDefault();
    spw.addClass('toggle-side');
  });

  stg.click(function(e) {
    e.preventDefault();
    spw.removeClass('toggle-side');
  });
  check.click(function(){
    $(this).toggleClass('checkbox is-checked');
  });
  //dropdown menu
  $("#dropdown").on("click", function(e){
    if($(this).hasClass("open")) {
      $(this).removeClass("open");
      $(this).children("ul").slideUp("fast");
    } else {
      $(this).addClass("open");
      $(this).children("ul").slideDown("fast");
    }
  });
});

}(jQuery));