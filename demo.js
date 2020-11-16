var page = ["#home", "#about", "#products", "#help"];
var curPage = page[0];

$(document).ready(function(){
	
	var newPage = getPage(window.location.hash);
	render(newPage);
	
	$('div a').click(function(e){
		e.preventDefault();
		
		//Adds active class to clicked link
	    var current = document.getElementsByClassName("active");
		current[0].className = current[0].className.replace("active", "");
		this.className += " active";
		
		var newPage = $(this).attr('href');
		window.location.hash = newPage;
	});
	
	$(window).on('hashchange', function(){
		var newPage = getPage(window.location.hash);
		render(newPage);
	});
	
});

function render(newPage){
    if (newPage == curPage) return;
    $(curPage).hide();
    $(newPage).show();
    curPage = newPage;
}

function getPage(hash){
	var i = page.indexOf(hash);
	if (i < 0 && hash != "") window.location.hash = page[0]; 
	return i < 1 ? page[0] : page[i];
}