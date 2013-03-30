/*
Copyright 2012, KISSY UI Library v1.30rc
MIT Licensed
build time: Jul 5 23:55
*/
KISSY.add("tree/base",function(f,d,c,e,a){return c.extend([d.DelegateChildren,a],{expandAll:function(){return c.prototype.expandAll.apply(this,arguments)}},{ATTRS:{xrender:{value:e}}},{xclass:"tree",priority:30})},{requires:["component","./basenode","./treeRender","./treemgr"]});
KISSY.add("tree/basenode",function(f,d,c,e){function a(i){var a=i.get("parent"),a=(a=a&&a.get("children"))&&a[a.length-1];return!a||a==i}function b(a){var h=a.get("isLeaf");return!(!1===h||void 0===h&&a.get("children").length)}function g(a){var h=a.get("children");return!a.get("expanded")||!h.length?a:g(h[h.length-1])}function k(i){i.get&&i.get("view")&&i.get("view").refreshCss(a(i),b(i))}function n(a){var h=a.get("children"),b=a.get("children").length;k(a);f.each(h,function(a,i){if(a.get){k(a);var h=
a.get("el");h.attr("aria-posinset",i+1);h.attr("aria-setsize",b)}})}var m=d.all,j=d.KeyCodes,l=c.Controller.extend([c.DecorateChild],{initializer:function(){function a(i,h,b){i[b](h);var d=h.get("children"),g,f;for(g=0;g<d.length;g++)f=d[g],"_register"==b&&f.set("depth",h.get("depth")+1),i[b](f)}var h=this;h.on("addChild",function(b){var b=b.child,g=h.get("tree");b.set("depth",h.get("depth")+1);g&&a(g,b,"_register");n(h)});h.on("removeChild",function(b){var g=h.get("tree");g&&a(g,b.child,"_unRegister");
n(h)})},bindUI:function(){var a=this.get("parent");a&&(this.addTarget(a),this.publish("click expand collapse",{bubbles:1}))},syncUI:function(){k(this)},_keyNav:function(a){var b=!0,d=this.get("tree"),f=this.get("expanded"),c,k=this.get("isLeaf"),e=this.get("children");switch(a.keyCode){case j.HOME:c=d;break;case j.END:c=g(d);break;case j.UP:c=a=(a=this.prev())?g(a):this.get("parent");break;case j.DOWN:a=this.get("children");if(this.get("expanded")&&a.length)c=a[0];else{a=this.next();for(d=this;!a&&
(d=d.get("parent"));)a=d.next();c=a}break;case j.LEFT:f&&(e.length||!1===k)?this.set("expanded",!1):c=this.get("parent");break;case j.RIGHT:if(e.length||!1===k)f?c=e[0]:this.set("expanded",!0);break;default:b=!1}c&&c.select();return b},next:function(){var a=this.get("parent"),b;if(!a)return null;a=a.get("children");b=f.indexOf(this,a);return b==a.length-1?null:a[b+1]},prev:function(){var a=this.get("parent"),b;if(!a)return null;a=a.get("children");b=f.indexOf(this,a);return 0===b?null:a[b-1]},select:function(){this.get("tree").set("selectedItem",
this)},performActionInternal:function(a){var b=m(a.target),a=a.type,g=this.get("expanded");this.get("tree").get("el")[0].focus();b.equals(this.get("expandIconEl"))?"dblclick"!=a&&this.set("expanded",!g):"dblclick"==a?this.set("expanded",!g):(this.select(),this.fire("click"))},decorateChildrenInternal:function(a,b){this.addChild(new a({srcNode:b,prefixCls:this.get("prefixCls")}))},removeChild:function(a){var b=this.get("tree");b._unRegister(a);f.each(a.get("children"),function(a){b._unRegister(a)});
l.superclass.removeChild.apply(this,f.makeArray(arguments));n(this)},_uiSetExpanded:function(a){this.get("tree");this.get("rendered")&&(k(this),this.fire(a?"expand":"collapse"))},expandAll:function(){this.set("expanded",!0);f.each(this.get("children"),function(a){a.expandAll()})},collapseAll:function(){this.set("expanded",!1);f.each(this.get("children"),function(a){a.collapseAll()})}},{ATTRS:{xrender:{value:e},handleMouseEvents:{value:!1},isLeaf:{view:1},expandIconEl:{view:1},iconEl:{view:1},selected:{view:1},
expanded:{view:1},tooltip:{view:1},tree:{getter:function(){for(var a=this;a&&!a.__isTree;)a=a.get("parent");return a}},depth:{view:1},focusable:{value:!1},decorateChildCls:{value:"ks-tree-children"}}},{xclass:"treeitem",priority:10});return l},{requires:["node","component","./basenodeRender"]});
KISSY.add("tree/basenodeRender",function(f,d,c){var e=d.all;return c.Render.extend({refreshCss:function(a,b){var g=this.get("expanded"),d=this.get("iconEl"),c,e=this.get("expandIconEl"),j=this.get("childrenEl");b?(g="ks-tree-icon ks-tree-file-icon ks-inline-block",c="ks-tree-icon ks-tree-expand-icon ks-inline-block ks-tree-expand-icon-{t}"):g?(g="ks-tree-icon ks-tree-expanded-folder-icon ks-inline-block",c="ks-tree-icon ks-tree-expand-icon ks-inline-block ks-tree-expand-icon-{t}minus"):(g="ks-tree-icon ks-tree-collapsed-folder-icon ks-inline-block",
c="ks-tree-icon ks-tree-expand-icon ks-inline-block ks-tree-expand-icon-{t}plus");d.attr("class",g);e.attr("class",f.substitute(c,{t:a?"l":"t"}));j&&j.attr("class",a?"ks-tree-lchildren":"ks-tree-children")},createDom:function(){var a=this.get("el"),b,g,c,d,m=this.get("contentEl");g=e("<div class='ks-treeitem-row'/>");(b=m.attr("id"))||m.attr("id",b=f.guid("ks-treeitem"));c=e("<div>").appendTo(g);d=e("<div>").appendTo(g);m.appendTo(g);a.attr({role:"treeitem","aria-labelledby":b}).prepend(g);this.__set("rowEl",
g);this.__set("expandIconEl",c);this.__set("iconEl",d)},_uiSetExpanded:function(a){var b=this.get("childrenEl");if(b)b[a?"show":"hide"]();this.get("el").attr("aria-expanded",a)},_uiSetSelected:function(a){this.get("rowEl")[a?"addClass":"removeClass"]("ks-treeitem-selected");this.get("el").attr("aria-selected",a)},_uiSetDepth:function(a){this.get("el").attr("aria-level",a)},_uiSetTooltip:function(a){this.get("el").attr("title",a)},getContentElement:function(){var a;if(a=this.get("childrenEl"))return a;
a=e("<div "+(this.get("expanded")?"":"style='display:none'")+" role='group'></div>").appendTo(this.get("el"));this.__set("childrenEl",a);return a}},{ATTRS:{childrenEl:{},expandIconEl:{},tooltip:{},iconEl:{},expanded:{value:!1},rowEl:{},depth:{value:0},contentEl:{valueFn:function(){return e("<span id='"+f.guid("ks-treeitem")+"' class='ks-treeitem-content'/>")}},isLeaf:{},selected:{}},HTML_PARSER:{childrenEl:function(a){return a.children(".ks-tree-children")},contentEl:function(a){return a.children(".ks-treeitem-content")},
isLeaf:function(a){if(a.hasClass(this.getCssClassWithPrefix("treeitem-leaf")))return!0;if(a.hasClass(this.getCssClassWithPrefix("treeitem-folder")))return!1},expanded:function(a){a=a.one(".ks-tree-children");return!a?!1:"none"!=a.css("display")}}})},{requires:["node","component"]});
KISSY.add("tree/checknode",function(f,d,c,e){var a=d.all,b=c.extend({expandAll:function(){return b.superclass.expandAll.apply(this,arguments)},performActionInternal:function(b){var c=this.get("expanded"),d=this.get("expandIconEl"),f=this.get("tree"),e=a(b.target);f.get("el")[0].focus();if("dblclick"==b.type){if(e.equals(d)||e.equals(this.get("checkIconEl")))return;this.set("expanded",!c)}e.equals(d)?this.set("expanded",!c):(b=this.get("checkState"),this.set("checkState",1==b?0:1),this.fire("click"))},
_uiSetCheckState:function(a){var b=this.get("parent"),c,d,e,l;(1==a||0==a)&&f.each(this.get("children"),function(b){b.set("checkState",a)});if(b){c=0;l=b.get("children");for(d=0;d<l.length;d++){e=l[d];e=e.get("checkState");if(2==e){b.set("checkState",2);return}1==e&&c++}0===c?b.set("checkState",0):c==l.length?b.set("checkState",1):b.set("checkState",2)}}},{ATTRS:{checkIconEl:{view:1},checkState:{view:1},xrender:{value:e}}},{xclass:"check-treeitem",priority:20});f.mix(b,{PARTIAL_CHECK:2,CHECK:1,EMPTY:0});
return b},{requires:["node","./basenode","./checknodeRender"]});
KISSY.add("tree/checknodeRender",function(f,d,c){var e=d.all;return c.extend({createDom:function(){var a=this.get("expandIconEl");this.__set("checkIconEl",e("<div class='ks-tree-icon ks-inline-block'/>").insertAfter(a))},_uiSetCheckState:function(a){this.get("checkIconEl").removeClass("ks-treeitem-checked0 ks-treeitem-checked1 ks-treeitem-checked2").addClass("ks-treeitem-checked"+a)}},{ATTRS:{checkIconEl:{},checkState:{value:0}}})},{requires:["node","./basenodeRender"]});
KISSY.add("tree/checktree",function(f,d,c,e,a){var b=c.extend([d.DelegateChildren,a],{expandAll:function(){return b.superclass.expandAll.apply(this,arguments)},_uiSetFocused:function(){}},{ATTRS:{xrender:{value:e}}},{xclass:"check-tree",priority:40});return b},{requires:["component","./checknode","./checktreeRender","./treemgr"]});KISSY.add("tree/checktreeRender",function(f,d,c){return d.extend([c])},{requires:["./checknodeRender","./treemgrRender"]});
KISSY.add("tree",function(f,d,c,e,a){d.Node=c;d.CheckNode=e;d.CheckTree=a;return d},{requires:["tree/base","tree/basenode","tree/checknode","tree/checktree"]});KISSY.add("tree/treeRender",function(f,d,c){return d.extend([c])},{requires:["./basenodeRender","./treemgrRender"]});
KISSY.add("tree/treemgr",function(f,d){function c(){}function e(a){var a=a.get("el"),b=a.attr("id");b||a.attr("id",b=f.guid("tree-node"));return b}c.ATTRS={showRootNode:{value:!0,view:1},selectedItem:{},focusable:{value:!0}};f.augment(c,{__isTree:1,__getAllNodes:function(){this._allNodes||(this._allNodes={});return this._allNodes},_register:function(a){this.__getAllNodes()[e(a)]=a},_unRegister:function(a){delete this.__getAllNodes()[e(a)]},handleKeyEventInternal:function(a){var b=this.get("selectedItem");
return a.keyCode==d.KeyCodes.ENTER?b.performActionInternal(a):b._keyNav(a)},getOwnerControl:function(a){for(var b,c=this.__getAllNodes(),d=this.get("el")[0];a&&a!==d;){if(b=c[a.id])return b;a=a.parentNode}return this},_uiSetSelectedItem:function(a,b){b.prevVal&&b.prevVal.set("selected",!1);a.set("selected",!0)},_uiSetFocused:function(a){a&&!this.get("selectedItem")&&this.select()}});return c},{requires:["event"]});
KISSY.add("tree/treemgrRender",function(f){function d(){}d.ATTRS={showRootNode:{}};f.augment(d,{__renderUI:function(){this.get("el").attr("role","tree")[0].hideFocus=!0;this.get("rowEl").addClass("ks-tree-row")},_uiSetShowRootNode:function(c){this.get("rowEl")[c?"show":"hide"]()}});return d});