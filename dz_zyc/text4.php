<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN" “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd“>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="auther" content="fq" />
<title>监听输入框值的即时变化 onpropertychange  oninput</title>
<script type="text/javascript">
function immediately(){
var element = document.getElementById("mytext");
if("\v"=="v") {
element.onpropertychange = webChange;
}else{
element.addEventListener("input",webChange,false);
}
function webChange(){
if(element.value){document.getElementById("test").innerHTML = element.value};
}
}
</script>
</head>
<body>
直接写在页面中的示例：
<input type="text" name="textfield" oninput="document.getElementById('webtest').innerHTML=this.value;" onpropertychange="document.getElementById('webtest').innerHTML=this.value;" />
<div>您输入的值为：<span id="webtest">还未输入</span></div>
<br /><br /><br /><br /><br />
写在JS中的示例：
<input type="text" name="textfield" id="mytext" />
<div>您输入的值为：<span id="test">还未输入</span></div>
<script type="text/javascript">
immediately();
</script>
</body>
</html>