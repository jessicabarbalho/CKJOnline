$(document).ready(function(){
	$("#add-more").click(function(){
		$(this).before("<input type='text' name='photo'>");
		$(this).before("<input type='button' value='Upload'>");
	});
});