"use strict";
var menu_ids = ["t", "m", "g", "s", "w"];
var menus = [];
var page_ids = ["history", "mission", "glory", "support", "why"];
var pages = [];

var activePage = 0;

function init()
{
	for (var i = 0;i < menu_ids.length; i++)
	{
		menus[i] = document.getElementById(menu_ids[i]);
		SetupEventListener(menus[i], i);
	}
	
	for (var i = 0; i < page_ids.length; i++)
	{
		pages[i] = document.getElementById(page_ids[i]);
		pages[i].className = "page-inactive";
	}
	
	activate(activePage);
}

function SetupEventListener(obj, index)
{
	obj.addEventListener("click", function()
		{
			deactivate(activePage);
			activePage = index;
			activate(activePage);
		}
	)
}

function activate(index)
{
	menus[index].className = "sidebar-active";
	
	pages[index].className = "page-active";
}

function deactivate(index)
{
	menus[index].className = "sidebar-inactive";
	
	pages[index].className = "page-inactive";
}		