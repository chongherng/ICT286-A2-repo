var page = ["#page1", "#page2", "#page3", "#page4", "#page5"];

var curPage = page[0];

$(document).ready(function()
	{
		var newPage = getPage(window.location.hash);
		
		$('div a').click(function(e)
			{
				var current = document.getElementsByClassName("active");
				current[0].className = current[0].className.replace("active", "");
				this.className += "active";
				
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
	}
);

function getPage(hash)
{
	var i = page.indexOf(hash);
	
	if (i == 1) //Pagination doesn't work yet
	{ //Untested code for displaying data received from database
		obj = { table: "products", limit: 5 }; //Supposed to display 5 products per page
		dbParam = JSON.stringify(obj);
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				myObj = JSON.parse(this.responseText);
				txt += '<ul class="products">'
				for (x in myObj) {
					txt += '<img src="' + myObj[x].image + ' />'
					+ '<h4>' + myObj[x].name + '</h4>' //Note: Have it link to product page later
					+ '<span id="price">' + myObj[x].price + '</span>'
					+ '<br />'
					+ '<span id="stock">' + myObj[x].stock + '</span>'
					+ '</li>';
				}
				txt += "</ul>"
				document.getElementById("content").innerHTML = txt;
			}
		}
		xmlhttp.open("POST", "products.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("x=" + dbParam);
	}
}