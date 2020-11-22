var page = ["#home", "#about", "#products", "#help", "#login", "#register", "#profile", "#manage"];

var curPage = page[0];

$(document).ready(function(){
   var newPage = getPage(window.location.hash);
   render(newPage);

   addActiveClass();
   

   $(window).on('hashchange', function(){
       var newPage = getPage(window.location.hash);
       render(newPage);
   });

   //mobile nav bar animation
   $(".toggle").on("click", function(){
    if($(".nav-link").hasClass("toggled")){
      $(".nav-link").removeClass("toggled");
      $(".mobile-only").removeClass("toggled");
    } else{
      $(".nav-link").addClass("toggled");
      $(".mobile-only").addClass("toggled");
    }
   }) 



});


function render(newPage){
    if (newPage == curPage) return;
    $(curPage).hide();
    $(newPage).show();
    curPage = newPage; 
}

function getPage(hash){
   var i = page.indexOf(hash);
   if (i<0 && hash != "") window.location.hash=page[0]; 
   return i < 1 ? page[0] : page[i];
}

function addActiveClass(){
  var navLinks = document.getElementsByClassName("nav-link");
  for(var i = 0; i < navLinks.length; i++){
    navLinks[i].addEventListener("click", function() {
      var current = document.getElementsByClassName("active");

      if(current.length > 0) {
        current[0].className = current[0].className.replace(" active", "");
      }

      this.className += " active";
    }
    )}
}
