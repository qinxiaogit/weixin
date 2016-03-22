$(function(){
	var yzm = $('#yzm') ;
	var yzml = yzm.attr("src");	
	yzm.click(function(){
		console.log(yzml);
		if(yzml.indexOf("?")>0){
			$(this).attr("src",yzml+'&random='+Math.random());	
		}else{
			$(this).attr("src",yzml.replace(/\?.*/,'')+'?'+Math.random());
		}
	});
});

