(function(i){i.fn.extend({imgSlide:function(a){if(a.auto==undefined)a.auto=true;if(a.type==undefined)a.type="click";if(a.speed==undefined)a.speed=3E3;var e=this,m=this.children(".image"),f=this.children(".number"),n=this.children(".title"),j=i("#"+a.data+" > li > a"),d=j.length;if(d==0)return this;var l=d/2,g,c=0;d="";for(var k=1;k<l+1;k++)d+='<span class="">'+k+"</span>";f.html(d);var h=function(b){m.html(j.eq(c*2));n.html(j.eq(c*2+1));f.children("span.this").removeClass("this");f.children("span").eq(c).addClass("this");
a.auto!=false&&c++;if(c==l)c=0;if(b!=true)g=setTimeout(h,a.speed)};f.children("span").each(function(b){i(this).bind(a.type,function(){clearTimeout(g);c=b;h(true);return false})});this.mouseover(function(){clearTimeout(g);e.mouseout(function(b){e.unbind("mouseout");var o=e.find("*");b=b.relatedTarget;o.index(b)!=-1&&b!=e[0]||(g=setTimeout(h,a.speed))})});h();return this}})})(jQuery);