<object classid="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95" class="OBJECT" width="500" height="430">
<param name="ShowStatusBar" value="true">
<param name="transparentatstar" value="true">
<param name="DisplaySize" value="100%"> 
<param name="animationatstart" value="true">
<param name="volume" value="100">
<param name="showstatusbar" value="true">
<param name="showaudiocontrols" value="true">
<param name="showpositioncontrols" value="true">
<param name="Filename" value="<?=$video?>">
<param name="autostart" value="<?=$autostart?>">
<embed width="500" height="400" transparentatstart="true" animationatstart="false" DisplaySize="100%" autostart="<?=$autostart?>" volume="100" type="application/x-mplayer2" showstatusbar="true" showaudiocontrols="true"  showpositioncontrols="true" src="<?=$video?>">
</embed>
</object>