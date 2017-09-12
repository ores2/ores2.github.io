function err_email(id)
{
$(id).css({"border": "1px solid #f00" });
}

function good_email(id){
$(id).css({"border": "1px solid #ccc" });
}

function chm(m){var regm=/^[\.\-_A-Za-z0-9]+?@[\.\-A-Za-z0-9]+?\.[A-Za-z0-9]{2,6}$/;
var email=$(m).attr("value");
if (!regm.test(email)) {	err_email(m);
	$("#err").html("<div align=center style='background-color: #FFF0BB; vertical-align:middle height: 20px; width: 100%; border: 1px solid #611A01;'>"+
	"проверь все"+
	"</div><br>");
	$('#err').show("medium");
	setTimeout("$('#err').hide(300)",3000);  return false;}                  else{good_email(m); return true;}
}


function ch(){var f=document.forma;
var _to=f.to.value;
var _fromname=f.fromname.value;
var _frommail=f.frommail.value;
var _tema=f.tema.value;
var _tip=f.tip.value;
var _mes=f.mes.value;
var regm=/^([a-zA-Z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/;
if (_mes=="") {	$("#err").html("<div align=center style='background-color: #FFF0BB; vertical-align:middle height: 20px; width: 100%; border: 1px solid #611A01;'>"+
	"нельзя оставить пустым поле текста"+
	"</div><br>");
	$('#err').show("medium");
	setTimeout("$('#err').hide(300)",3000);
	return false;
}
if (_tema=="") {
	$("#tema").css({"border": "1px solid #f00" });
	$("#err").html("<div align=center style='background-color: #FFF0BB; vertical-align:middle height: 20px; width: 100%; border: 1px solid #611A01;'>"+
	"нельзя оставить пустым поле темы"+
	"</div><br>");
	$('#err').show("medium");
	setTimeout("$('#err').hide(300)",3000); return false;
}        else {$("#tema").css({"border": "1px solid #ccc" });}

if(!chm("#to")) {return false;}
if (!chm("#frommail")) {return false;}

//f.submit();
$("#zzz").click();
alert(10);

}
