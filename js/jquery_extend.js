jQuery(document).ready(function($){
    $("div.entry-content .tabs").tabs();    
    
    $("div.entry-content #nav #nav-title").after('<span>[<a id="nav-link" href="#">隐藏</a>]</span>');
    $("div.entry-content #nav-link").click(function(){
        var tmp = $('div.entry-content #nav ul');
    	if(tmp .css('display') == 'none'){
			$(this).text("隐藏");
		}
		else{
			$(this).text("显示");
		}
     	tmp.toggle();
    });
});
