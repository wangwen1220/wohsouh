(function(f){var o={focus:"focus",hover:"hover",error:"vali_error",pass:"vali_pass",verifing:"vali_verifing",infobox:"infobox",tips:"tooltips",ignore:"ignore"},z={xmlPath:"/",submitHandler:null,infoHandler:null},v=function(a,b){return a.removeClass(o.error+" "+o.pass+" "+o.verifing).addClass(o[b])},D=function(a){a=a.jquery?a:f(a);return function(b,c,d){c&&c.length?v(a,d).html(c).show():a.hide();v(b,d)}},r=function(a,b,c,d){a.data("handler")(a,b,c,d)},w=function(a){var b=a[0].type;if(b=="radio"){b=
0;for(var c=a.length;b<c;b++)if(a[b].checked)return a[b].value;return""}if(b=="checkbox"){var d=[];b=0;for(c=a.length;b<c;b++)a[b].checked&&d.push(a[b].value);return d}return a.val()||""},k={email:/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/,username:/^[a-z]\w{3,19}$/i,password:/^[^\s\$]{6,20}$/,telephone:/^(86)?(\d{2,5}-)?(\d{7,8})$/,mobile:/^1\d{10}$/,url:/^[a-zA-z]{2,5}:\/\/(\w+(-\w+)*)(\.(\w+(-\w+)*))*(\?\S*)?\/?$/,ip:/^((2[0-4]\d|25[0-5]|[01]?\d\d?)\.){3}(2[0-4]\d|25[0-5]|[01]?\d\d?)$/,id:/^(?:\d{14}|\d{17})[\dxX]$/,
qq:/^[1-9]\d{4,20}$/,date:/^(\d{4})(-|\/)(\d{1,2})\2(\d{1,2})$/,datetime:/^(\d{4})(-|\/)(\d{1,2})\2(\d{1,2})\s(\d{1,2}):(\d{1,2}):(\d{1,2})$/,zipcode:/^[1-9]\d{5}$/,currency:/^\d+(\.\d+)?$/,number:/^\d+$/,english:/^[A-Za-z]+$/,chinese:/^[\u4e00-\u9fa5]+$/,integer:/^[-\+]?\d+$/,"float":/^[-\+]?\d+(\.\d+)?$/},E=/^([\/|#])(.*)\1([gim]*)$/,A={required:function(a){return w(a).length>0},not:function(a,b){var c=w(a);b=","+b+",";if(f.isArray(c)){for(var d=0,g=c.length;d<g;d++)if(b.indexOf(","+c[d]+",")!=
-1)return false;return true}return!!c&&b.indexOf(","+c+",")==-1},min:function(a,b){return w(a).length>=parseInt(b)},max:function(a,b){return w(a).length<=parseInt(b)},ajax:function(a,b){var c=a.val();if(!c.length)return true;var d=a.data("lastvalid");d&&d.val==c?setTimeout(function(){r(a,d.info,d.state)},1):f.ajax({dataType:"json",url:b,data:a[0].name+"="+c,success:function(g){g={state:g.state?"pass":"error",info:g.state?g.info:g.error};r(a,g.info,g.state);a.data("lastvalid",g)}})},eq:function(a,
b){a.val();return f(b).val()==a.val()},regex:function(a,b){var c=a.val();if(!c.length)return true;if(E.exec(b))return RegExp(RegExp.$2,RegExp.$3).test(c);return false},email:function(a){a=a.val();return!a.length||k.email.test(a)},username:function(a){a=a.val();return!a.length||k.username.test(a)},password:function(a){a=a.val();return!a.length||k.password.test(a)},ip:function(a){a=a.val();return!a.length||k.ip.test(a)},id:function(a){a=a.val();return!a.length||k.id.test(a)},date:function(a){a=a.val();
return!a.length||k.date.test(a)},datetime:function(a){a=a.val();return!a.length||k.datetime.test(a)},qq:function(a){a=a.val();return!a.length||k.qq.test(a)},mobile:function(a){a=a.val();return!a.length||k.mobile.test(a)},telephone:function(a){a=a.val();return!a.length||k.telephone.test(a)},msn:function(a){a=a.val();return!a.length||k.email.test(a)},url:function(a){a=a.val();return!a.length||k.url.test(a)},zipcode:function(a){a=a.val();return!a.length||k.zipcode.test(a)},currency:function(a){a=a.val();
return!a.length||k.currency.test(a)},number:function(a){a=a.val();return!a.length||k.number.test(a)},english:function(a){a=a.val();return!a.length||k.english.test(a)},chinese:function(a){a=a.val();return!a.length||k.chinese.test(a)},integer:function(a){a=a.val();return!a.length||k.integer.test(a)},"float":function(a){a=a.val();return!a.length||k["float"].test(a)}},F=function(a){var b={},c=f("root",a).attr("box");f("root>*",a).each(function(){var d={};b[this.nodeName]=d;d.tips=this.getAttribute("tips");
d.pass=this.getAttribute("pass");d.box=this.getAttribute("box")||c;var g=[];d.rule=g;f(">*",this).each(function(){g.push({name:this.nodeName,args:this.getAttribute("args"),event:this.getAttribute("event"),text:f(this).text()})})});return b},
  
  
  u=function(a, b){
    b=f.extend({} ,z,b||{});
    var c=f(a), d=c.attr("name")||c[0].getAttribute("id");
    if(!d){
      c.submit(function(){
        if(typeof b.submitHandler=="function"){
          b.submitHandler(c);
          return false;
        }
        return true;
      });
      return c;
    }
    var g = f.data(window,d);
    var x=f('<div class="'+o.tips+ '"/>');
    x.css({position:"absolute","z-index":99,visibility:"hidden",display:"block"}); 
    var B=function(){x.css("visibility","hidden")};
    q=b.infoHandler;
    G=q?typeof q==="function"?q:D(q):function(e, i, h){
      var j=e.data("infobox");
      if(!j){
        j=f('<div class="'+o.infobox+'"/>');
        j.css({position:"absolute", "z-index":100, visibility:"hidden", display:"block"});
        j.appendTo(e.offsetParent());
        e.data("infobox",j);
      }
      if(i&&i.length){
        v(j,h).html(i);
        i=e.position();
        var n;
        n=j.outerHeight(true);
        if(i.top>n){
          n=i.top-n-2;
          i=i.left+25;
        }else{
          n=i.top;
          i=i.left+e.outerWidth()+10;
        }
        j.css({top:n,left:i}).css("visibility","visible");
        e.data("tipsClosed", true);
        B();
      }
      else{
        j.css("visibility","hidden");
        e.data("tipsClosed",false)
      }
      v(e,h);
    };

    var y=function(e,i,h){
      var j=e.attr("name").replace(/[^\w]/g,""),n;
      if(g&&g[j]&&(n=g[j].rule)){
        typeof e.data("handler")!="function"&&e.data("handler",G);
        for(var m=0,p=n.length; m<p; m++){
          var l=n[m];
          l.event===null&&(l.event="blur submit");
          if(!(l.event!="*"&&(" "+l.event+" ").indexOf(" "+i+" ")==-1)){var s;
            if(s=A[l.name]){
              s=s(e,l.args);
              if(s===undefined){
                r(e,l.text,"verifing",h);
                return true;
              }
              if(!s){
                r(e,l.text,"error",h);
                return false;
              }
            }
          }
        }
        r(e,g[j].pass,"pass",h);
      }
      return true;
    };

    var t=[];
    var C={radio:{}, checkbox:{}};


    //q=f("input,textarea,select",a).not(":button,:submit,:image,:reset,[type=hidden],[disabled]");
    q=f("input,textarea,select", a);
    q.filter("[name]").each(function(){
      var e=this.type, i=this.nodeName.toLowerCase(), h=f(this), j, n=h.attr("name").replace(/[^\w]/g, '');
      if(e==='button' || e==='submit' || e==='image' || e==='reset' || e==='hidden')return;
      if(!h.hasClass(o.ignore)){
        if(e==="radio"||e==="checkbox"){
          if(j=C[e][n]){
            j.push(this);
          }else{
            j=C[e][n]=h;
            t.push(h);
          }
        }else{
          j=h;
          t.push(h);
        }
        h.focus(function(){
          var m=h.addClass(o.focus);
          if(!m.data("tipsClosed")){
            var p=m.attr("name").replace(/[^\w]/g,""),l;
            if(g&&g[p]&&(l=g[p].tips)&&l.length){
              x.html("<span></span>"+l).appendTo(m.offsetParent());
              p=m.position();
              l=x.outerHeight(true);
              if(p.top>l){
                l=p.top-l-2;
                m=p.left+25
              }else{
                l=p.top;
                m=p.left+m.outerWidth()+10;
              }
              x.css({top:l,left:m }).css("visibility","visible");
            }
          }
        }).blur(function(m){
          B();
          f(this).removeClass(o.focus);
          y(j,"blur",m);
        }).hover(function(){
          f(this).addClass(o.hover);
        }, function(){
          f(this).removeClass(o.hover);
        });
        h.bind((e=="radio"||e=="checkbox")&&"click"||i=="select"&&"change"||"keyup",function(m){
          y(j,"change",m);
        });
      }
    });
    window.inputs=t;


    if(!g){
      g=null;
      f.ajax({dataType:"xml",url:b.xmlPath+d+".xml",type:"GET",success:function(e){g=F(e); f.data(window,d,g);}});
    }
    c.submit(function(e){
      for(var i=[],h=0,j=t.length; h<j; h++) y(t[h],"submit",e)||i.push(t[h]);
      if(i.length){
        i[0].focus();
        return false;
      }
      if(typeof b.submitHandler=="function"){
        b.submitHandler(c);
        return false;
      }
      return true;
    });
  };

u.setRules = function(a){f.extend(A,a)};
u.setConfigs=function(a){f.extend(z,a)};
u.setClasses=function(a){f.extend(o,a)};
f.validate=u;
f.fn.validate=function(a){
  return this.each(function(){
    u(this,a);
  });
};

})(jQuery);
