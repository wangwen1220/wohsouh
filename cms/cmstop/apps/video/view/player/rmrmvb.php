<center>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><object id="RVOCX" classid="CLSID:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" width="500" height="350" >
 <param name="SRC" value="<?=$video?>">
 <param name="CONTROLS" value="ImageWindow">
 <param name="CONSOLE" value="cons">
 <param name="autostart" value="<?=$autostart?>">
 <embed autostart="<?=$autostart?>" src="<?=$video?>" type="audio/x-pn-realaudio-plugin" width="500" height="350" controls="ImageWindow" console="cons"> </embed>
</object></td>
  </tr>
  <tr>
    <td><object id="RVOCX2" classid="CLSID:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA" width="500" height="30" >
   <param name="SRC" value="<?=$video?>">
   <param name="CONTROLS" value="ControlPanel">
   <param name="CONSOLE" value="cons">
   <param name="autostart" value="<?=$autostart?>">
   <embed autostart="<?=$autostart?>" src="<?=$video?>" type="audio/x-pn-realaudio-plugin" width="500" height="30" controls="ControlPanel" console="cons" > </embed>
 </object></td>
  </tr>
</table></center>