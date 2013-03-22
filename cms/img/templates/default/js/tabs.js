(function($){

    $(document).ready(function(){var a={interval:4E3,fadeInTime:300,fadeOutTime:200},b=$(".mode-flash-1 .thumb ul li"),e=$(".mode-flash-1 .big-pic a"),f=b.length,c=0,g=null,d=function(){window.clearInterval(g)},i=function(h){c=h?h.current||0:c>=f-1?0:++c;e.filter(":visible").fadeOut(a.fadeOutTime,function(){e.eq(c).fadeIn(a.fadeInTime);e.removeClass("cur").eq(c).addClass("cur")});b.removeClass("cur").eq(c).addClass("cur")},j=function(){d();g=window.setInterval(function(){i()},a.interval)};b.hover(function(){if($(this).attr("class")!=
                "cur"){d();var h=$.inArray(this,b);i({current:h})}else d()},j);e.hover(d,j);j()});


    window.pos = function (a){a=a.offset();return{l:a.left,t:a.top}};

    function menuEffect(a,b){$(a).find("li").hover(function(){$(this).addClass(b)},function(){$(this).removeClass(b)})};
    menuEffect("#common-menu","nav-cur");

    window.cmstopTabs = function (a){var b=$(a.title),e=$(a.cont),f=a.tabStyle,c=b.find("li a"),g=e.find(">div");c.mouseover(function(){var d=this,i=c.index($(d));setTimeout(function(){$(d).addClass(f).parent().siblings().find("a").removeClass(f);$(g[i]).show().siblings().hide()},60)})};

    cmstopTabs({tabStyle:"tabs-focus",title:"#tab-title-1",cont:"#tab-cont-1"});
    cmstopTabs({tabStyle:"tabs-focus",title:"#tab-title-2",cont:"#tab-cont-2"});
    cmstopTabs({tabStyle:"maga-curr",title:"#tab-title-3",cont:"#tab-cont-3"});
    cmstopTabs({tabStyle:"tabs-focus",title:"#tab-title-4",cont:"#tab-cont-4"});

})(jQuery);


