(function(i){var f={isStep:false,stepConfig:null,minOffset:"0",maxOffset:"1",offset:"0",hwidth:"6px",onDragInit:function(){},onDragStart:function(){},onDrag:function(){},onDragEnd:function(){},handleBg:"#000000",cursor:"pointer",delay:100,pointWidth:"6px",pointHeight:"10px",pointBg:"#FF6600",appro:0.0050},a={handle:null,box:null,hWidth:0,bWidth:0,bHeight:0,roundset:null,defaultOffset:0,init:function(b){i.extend(f,b||{});b=i(this);var e=b.css("position"),d=f.stepConfig;a.defaultOffset=f.offset;a.box=
b;a.hWidth=a._getPxNum(f.hwidth);a.bWidth=a._getPxNum(b.css("width"));a.bHeight=a._getPxNum(b.css("height"));f.delay=parseInt(f.delay);b.css("position",e!="relative"&&e!="absolute"?"relative":e);b.append(i('<div style="position:absolute;z-index:10"></div>'));e=a.handle=b.children(0);e.css({background:f.handleBg,left:f.offset*a.bWidth-a.hWidth/2+"px",width:f.hwidth,height:a.bHeight,cursor:f.cursor});if(d){pw=a._getPxNum(f.pointWidth);pLeft=0;pobj=null;pstack=[];for(var g in d){pOffset=a.bWidth*g-pw/
2;pobj=i('<div style="position:absolute"></div>').css({left:pOffset,background:f.pointBg,width:f.pointWidth,height:f.pointHeight,cursor:f.cursor});b.append(pobj);pstack.push([pobj,g,d[g]])}}e.onDragInit=f.onDragInit;e.onDragStart=f.onDragStart;e.onDragEnd=f.onDragEnd;e.onDrag=f.onDrag;e.onDragInit(e,b,pstack,d);b.bind("mousedown",a.start).bind("click",a.clickMove);return this},start:function(b){var e=a.handle,d=e.position().left;e.lastMouseX=b.pageX;i(document).bind("mousemove",a.drag);i(document).bind("mouseup",
a.end);e.onDragStart(e,b,(d+a.hWidth/2)/a.bWidth);return false},drag:function(b){var e=a.handle,d=b.pageX,g=e.position().left+(d-e.lastMouseX),h=a.bWidth*f.maxOffset-a.hWidth/2,j=f.stepConfig;if(!(g<a.bWidth*f.minOffset-a.hWidth/2||g>h)){e.css("left",g);e.lastMouseX=d;d=(g+a.hWidth/2)/a.bWidth;e.onDrag(e,b,d,j[d]);return false}},end:function(b){var e=a.handle,d=e.position().left,g=a.box,h=f.stepConfig;i(document).unbind("mousemove");i(document).unbind("mouseup");if(!(b.target==g[0]||b.target.parentNode==
g[0])){if(h){h=a._fixOffset(d);d=h==d?d:h-a.hWidth/2;e.css("left",d)}if(f.isStep)a._stepDrop(e,b);else{h=f.stepConfig;d=(d+a.hWidth/2)/a.bWidth;e.onDragEnd(e,b,d,[d,h[d]])}}},clickMove:function(b){var e=a.handle,d=b.pageX-a.box.offset().left;if(c=f.stepConfig)d=a._fixOffset(d);f.isStep?a._stepDrop(e,b,d):e.animate({left:d-e.width()/2},f.delay,function(){var g=d/a.bWidth;e.onDragEnd(e,b,g,[g,f.stepConfig[g]])})},_stepDrop:function(b,e,d){var g=a.box.width(),h=f.stepConfig;d=d?d:b.position().left;var j=
0,m=0,k=0;for(var l in h){if(d>g*l)j=g*l;if(d<g*l){m=g*l;break}}k=d-j>m-d?m:j;b.animate({left:k-a.hWidth/2},f.delay);b.onDragEnd(b,e,k/g,h[k/g])},_getPxNum:function(b){return parseInt(b.substr(0,b.length-2))},_fixOffset:function(b){var e=f.stepConfig;for(var d in e){d=parseFloat(d);if(b>=a.bWidth*(d-f.appro)&&b<=a.bWidth*(d+f.appro)){b=a.bWidth*d;break}}return b},setPoint:function(b){var e=a.handle,d=f.stepConfig;e.animate({left:a.bWidth*b-a.hWidth/2},f.delay,function(){e.onDragEnd(e,"set",b,[b,d[b]])})},
reset:function(){this.setPoint(this.defaultOffset)}};i.fn.slider=a.init;i.slider=a})(jQuery);
