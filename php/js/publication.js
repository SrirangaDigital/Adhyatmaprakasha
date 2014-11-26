var id;
var flag=0;

//~ $(document).ready(function(){
	//~ $("li.top").click(function(){
		//~ 
		//~ id = $(this).attr("id");
		//~ 
		//~ var str= "#" + id + " .rest";
	//~ $(str).slideToggle(750);
	//~ });
//~ });

$(document).ready(function(){
	$("span.top").click(function(){
		var pele = this.parentNode;
		id = $(pele).attr("id");
		var str= "#" + id + " .rest";
		$(str).slideToggle(750);
	});
});
