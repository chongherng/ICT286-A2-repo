var page = ["#home", "#about", "#products", "#help", "#login", "#register"];

var curPage = page[0];

$(document).ready(function()
	{
		var newPage = getPage(window.location.hash);
		
		addActiveClass();
		
		$('nav a').click(function(e)
			{
				e.preventDefault();
				var newPage = $(this).attr('href');
				window.location.hash = newPage;
			}
		);
		
		$(window).on('hashchange', function()
			{
				var newPage = getPage(window.location.hash);
			}
		);
		
		//Mobile nav bar animation
		$(".toggle").on("click", function()
			{
				if($(".nav-link").hasClass("toggled"))
				{
					$(".nav-link").removeClass("toggled");
				} 
				else
				{
					$(".nav-link").addClass("toggled");
				}
			}
		) 		
	}
);

function getPage(hash)
{
	var i = page.indexOf(hash);
	
	if (i == 3)
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("content").innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "help.html", true);
		xhttp.send();
	}
}

function addActiveClass()
{
	var navLinks = document.getElementsByClassName("nav-link");
	
	for (var i = 0; i < navLinks.length; i++)
	{
		navLinks[i].addEventListener("click", function() 
			{
				var current = document.getElementsByClassName("active");
				
				if (current.length > 0)
				{
					current[0].className = current[0].className.replace(" active", "");
				}
				
				this.className += " active";
			}
		)
	}
}