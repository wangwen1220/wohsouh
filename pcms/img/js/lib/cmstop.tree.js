(function(i){function m(a){a.removeClass(b.haschild).children("."+b.itemarea).removeClass(b.expandable).children("."+b.hitarea).unbind(".tree").removeClass(b.hitarea).addClass(b.bitarea)}var n={url:"?app=system&controller=index&action=menu&parent=%s",paramId:"id",paramHaschild:"hasChildren",async:true,expanded:false,renderTxt:function(a,g,d){return i("<span>"+d.text+"</span>")},active:function(){},click:function(){},prepared:function(){},itemReady:function(){}},b={expandable:"expandable",expanded:"expanded",
haschild:"haschild",itemarea:"itemarea",txtarea:"txtarea",hitarea:"hitarea",bitarea:"bitarea",active:"active",tree:"tree"},k=function(a,g){g=i.extend({},n,g||{});a.jquery||(a=i(a));this.container=a.addClass(b.tree);a.data("treeObj",this);this.actived=null;this.options=g;if(g.async)this.branches(a,g.prepared);else{var d=this;a.find("li").each(function(){d.prepareItem(i(this))})}};k.prototype={branches:function(a,g){var d=this,c=d.options;a.data("locked",true);i.ajax({url:c.url.replace("%s",encodeURIComponent(a.attr("idv"))),
success:function(f){if(!f||!f.length)m(a);else{for(var e=i(document.createElement("ul")).appendTo(a),h=0,j=f.length;h<j;++h)d.buildItem(f[h],e);e.show();a.children("."+b.itemarea).addClass(b.expanded);typeof g=="function"&&g.call(d)}},error:function(f,e){e=="parsererror"&&m(a)},complete:function(){a.data("locked",false)},dataType:"json"})},prepareItem:function(a){var g=this,d=g.options,c=i('<div class="'+b.itemarea+'"></div>'),f=a.children("ul");if(f.length){f.prevAll().appendTo(c);c.prependTo(a);
a.addClass(b.haschild).bind("expand.tree",function(){if(!a.data("locked"))if(!c.hasClass(b.expanded)){c.addClass(b.expanded);f.show()}});d.expanded&&a.triggerHandler("expand.tree");c.addClass(b.expandable);i('<b class="'+b.hitarea+'"></b>').prependTo(c).bind("click.tree",function(e){e.stopPropagation();e.preventDefault();if(c.hasClass(b.expanded)){c.removeClass(b.expanded);f.hide()}else{c.addClass(b.expanded);f.show()}})}else{a.children().appendTo(c);c.prependTo(a);c.prepend('<b class="'+b.bitarea+
'"></b>')}c.bind("active.tree",function(){g.actived&&g.actived.removeClass(b.active);g.actived=c.addClass(b.active);d.active.apply(g,[c])}).click(function(){c.triggerHandler("active.tree");a.triggerHandler("expand.tree");d.click.apply(g,[c])});a.bind("active.tree",function(){c.triggerHandler("active.tree")}).bind("clk.tree",function(){c.click()})},buildItem:function(a,g){var d=this,c=d.options,f=a[c.paramId],e=i('<li idv="'+f+'"></li>'),h=i('<div class="'+b.itemarea+'"></div>').appendTo(e);c.renderTxt(h,
f,a).addClass(b.txtarea).appendTo(h);if(a[c.paramHaschild]){e.addClass(b.haschild).bind("expand.tree",function(j,l){if(!e.data("locked")){var o=i(">ul",e);if(o.length){if(!h.hasClass(b.expanded)){h.addClass(b.expanded);o.show()}typeof l=="function"&&l.call(d)}else e.hasClass(b.haschild)&&d.branches(e,l)}});c.expanded&&e.triggerHandler("expand.tree");h.addClass(b.expandable);i('<b class="'+b.hitarea+'"></b>').prependTo(h).bind("click.tree",function(j){j.stopPropagation();j.preventDefault();if(!e.data("locked")){j=
i(">ul",e);if(j.length)if(h.hasClass(b.expanded)){h.removeClass(b.expanded);j.hide()}else{h.addClass(b.expanded);j.show()}else d.branches(e)}})}else h.prepend('<b class="'+b.bitarea+'"></b>');h.bind("active.tree",function(){d.actived&&d.actived.removeClass(b.active);d.actived=h.addClass(b.active);c.active.apply(d,[h,f,a])}).click(function(){h.triggerHandler("active.tree");e.triggerHandler("expand.tree");c.click.apply(d,[h,f,a])});e.bind("active.tree",function(){h.triggerHandler("active.tree")}).bind("clk.tree",
function(){h.click()});g.append(e);c.itemReady.apply(d,[e,g,a])},resetActive:function(){this.actived&&this.actived.removeClass(b.active);this.actived=null},open:function(a,g){typeof a=="string"&&(a=a.split(","));var d=0,c=a.length-1,f=this.container,e=function(){if(!(d>c)){f=f.find('li[idv="'+a[d]+'"]');if(f.length)d++==c?f.triggerHandler((g?"clk":"active")+".tree"):f.triggerHandler("expand.tree",[e])}};e()}};i.tree=k;i.fn.tree=function(a){if(typeof a=="string"){var g=i(this[0]).data("treeObj");return g[a].apply(g,
Array.prototype.slice.call(arguments,1))}else return this.each(function(){var d={},c=i(this);for(var f in n){var e=c.attr(f);e&&(d[f]=e)}new k(c,i.extend({},d,a||{}))})}})(jQuery);