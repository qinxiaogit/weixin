
//window.onload = function (){
	//document.getElementById('a1').addEventListener('click',function(e){
	//document.getElementById('form').submit();
	//return false;
//});

//document.getElementById('a2').addEventListener('click',function(){
//	alert("要安装此系统，你必须同意该协议");
//});
$(function(){

$('#a1').hover(
	//鼠标移入该元素产生效果
	function(){
		$('#a1').removeClass('btn_old');
		$('#a1').toggleClass('btn');
	},function(){
		$('#a1').removeClass('btn');
		$('#a1').toggleClass('btn_old');
	});

$('#a2').hover(
	//鼠标移入该元素产生效果
	function(){
		$('#a2').removeClass('btn_old');
		$('#a2').toggleClass('btn');
	},function(){
		$('#a2').removeClass('btn');
		$('#a2').toggleClass('btn_old');
	});
$('#checknEvBt1').hover(
	//鼠标移入该元素产生效果
	function(){
		$('#checknEvBt1').removeClass('btn_old');
		$('#checknEvBt1').toggleClass('btn');
	},function(){
		$('#checknEvBt1').removeClass('btn');
		$('#checknEvBt1').toggleClass('btn_old');
	});
$('#checknEvBt2').hover(
	//鼠标移入该元素产生效果
	function(){
		$('#checknEvBt2').removeClass('btn_old');
		$('#checknEvBt2').toggleClass('btn');
	},function(){
		$('#checknEvBt2').removeClass('btn');
		$('#checknEvBt2').toggleClass('btn_old');
	});
//点击同意，提交表单数据
$('#a1').click(function(e) {
		$('#form').submit();
		return true ;
	});
//不同意时
$('#a2').click(function(e){
		alert('要安装此系统，你必须同意该协议');
	});

});
