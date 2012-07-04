$(document).ready(function() {
	
	//scrolling &highlighting specified id
	var hash = window.location.hash;
	if(hash){
			$(hash).css('background','#e9ffd6').animate({ backgroundColor: '#e7f6fd'}, 2000);
			$('html, body').animate({ scrollTop: $(hash).offset().top-100/*100px space to the header id*/ });
		}
		
	$('input').focus(function(){$(this).select()});
	
	//caching obj for panel
	var searchbar=$('.searchbar .search-query');
	var login=$('.login');
	var p_right=$('.p-right');
	var p_left=$('.p-left');
	var overlay=$('.overlay');
	var loginoverlay=$('.login-overlay');
	
	//show panel
	searchbar.focus(function() {panelshow(p_left,'left');$(this).animate({width:'185px'},100)});
	login.click(function() {panelshow(p_right,'right');loginoverlay.show()});
	
	//hide panel
	overlay.click(function() {panelhide(p_right,'right'); panelhide(p_left,'left'); })
	loginoverlay.click(function() {panelhide(p_right,'right')})
	
	//hide/show functions
	function panelshow(name,vanishpoint){
		var anim = {}; //to make sure passed vanishpoint parameter is not just placeholder
		anim[vanishpoint]='0px'; //we create anonymous object &assign dynamic prop
		$(name).animate(anim, 200);
		overlay.show();} //add clickable area to close panel
		
	function panelhide(name,vanishpoint){
		var anim = {}; 
		anim[vanishpoint]='-300px';
		$(name).animate(anim, 200);
		overlay.hide(); //hide overlay
		loginoverlay.hide(); //hide overlay yg di login button
		searchbar.animate({width:'90px'},200);
		} 
	
	
	//caching obj for categories
	var $outer = $('.categ_wrapper');
	var $inner = $('.categories');
	var extra 			= 50; //define unscrollable area (left & right)
	var innerlength = $inner.find('li').length;
	
	//calculate the inner width
	var finalW=0;
	for(i=0; i<innerlength; i++){finalW += $inner.find('li a').eq(i).width()+20;}
	$inner.css('width',finalW + 'px');
	
	//Get menu width
	var divWidth = $outer.width();
	
	//Find last li in container
	var lastElem = $inner.find('li:last');
	$outer.scrollLeft(0);
	
	//When user move mouse over menu
	$outer.unbind('mousemove').bind('mousemove',function(e){
		var containerWidth = lastElem[0].offsetLeft + lastElem.outerWidth() + 2*extra;
		var left = (e.pageX - $outer.offset().left) * (containerWidth-divWidth) / divWidth - extra;
		$outer.scrollLeft(left);
	});
	
	//check all /* DISINI GW UBAH */
	var tag=$('.tag');
	$('#checkall').click(function(){tag.attr('checked','checked')});
	$('#checknone').click(function(){tag.removeAttr('checked')});
	
});
