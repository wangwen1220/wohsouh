(function(){function q(h){var e=h.find("form");$([e[0].dsnid,e[0].table]).change(function(){var g="dsnid="+e[0].dsnid.value+"&table="+encodeURIComponent(e[0].table.value);h.load("?app=system&controller=template&action=tag_db",g,function(){q(h)})})}var r=/\*/g;$.editplus.setPlugin("db",function(h,e){var g=this.textarea;ct.ajax("\u6570\u636e\u5e93\u8c03\u7528\u6807\u7b7e","?app=system&controller=template&action=tag_db",650,400,q,function(d){var a="{db",b=d.find("form")[0];if(b.dsnid.value!="0")a+=' dsn="'+
b.dsnid.options[b.dsnid.selectedIndex].text+'"';var c=[],f=[],i=[],p=[];d.find("table.table_list>tbody>tr").each(function(){var j=$(this),k="`"+this.cells[0].innerHTML+"`";f.push(k);j.find("input:checked").length&&c.push(k);var l=j.find("select[name=condition]").val(),n=j.find("input:text").val();if(l=="IS NULL"||l=="IS NOT NULL")i.push(k+" "+l);else if(n&&n.length)r.test(l)?i.push(k+" "+l.replace(r,n)):i.push(k+" "+l+" '"+n+"'");j=j.find("select[name=sort]").val();if(j=="asc"||j=="desc")p.push(k+
" "+j)});c.length&&(f=c);for(var o=[],m=0,s;s=f[m++];o.push("{$r["+s.replace(/`/g,"")+"]}"));o=o.join(", ");m="SELECT "+(c.length?c.join(","):"*")+" FROM `"+b.table.value+"`";i.length&&(m+=" WHERE "+i.join(" AND "));p.length&&(m+=" ORDER BY "+p.join(","));a+=' sql="'+m+'"';if(b=parseInt(b.size.value))a+=' size="'+b+'"';a+="}\n"+o+"\n"+e.text+"\n{/db}";g.insertSection(a,e.selection);d.dialog("close")},function(d){d.dialog("close")})},{desc:"\u6570\u636e\u6e90"}).setPlugin("content",function(h,e){var g=
this.textarea;ct.ajax("\u5185\u5bb9\u6a21\u578b\u8c03\u7528\u6807\u7b7e","?app=system&controller=template&action=tag_content",460,380,function(d){d.find("input.suggest").suggest();d.find("img.tips").attrTips("tips","tips_green",200,"top")},function(d){var a=d.find("form")[0],b="{content",c=$(a.category).val();c&&(b+=' catid="'+c+'"');(c=$(a.model).val())&&(b+=' modelid="'+c+'"');(c=$(a.source).val())&&(b+=' sourceid="'+c+'"');(c=$(a.createdby).val())&&(b+=' createdby="'+c+'"');var f=a.weight;c=f[0].value||
"";f=f[1].value||"";if(a.weight_range.checked&&(c.length||f.length))c+=","+f;c.length&&(b+=' weight="'+c+'"');if(a.published.value&&a.published.value!="0")b+=' published="'+a.published.value+'"';(c=a.tag.value)&&c.length&&(b+=' tags="'+c+'"');var i=[];$("#orderby>div:visible").each(function(){i.push($(">select",this).val()+" "+($("input:checkbox",this)[0].checked?"desc":"asc"))});i.length&&(b+=' orderby="'+i+'"');if(a=parseInt(a.size.value))b+=' size="'+a+'"';b+='}\n{$r[title]},{$r[color]},{$r[thumb]},{$r[url]},{date("Y-m-d H:i", $r[published])}\n'+
e.text+"\n{/content}";g.insertSection(b,e.selection);d.dialog("close")},function(d){d.dialog("close")})},{desc:"\u5185\u5bb9"}).setPlugin("discuz",function(h,e){var g=this.textarea;ct.ajax("Discuz!\u8c03\u7528\u6807\u7b7e","?app=system&controller=template&action=tag_discuz",530,430,function(d){var a=d.find("form")[0],b=d.find("tbody:last");d=$(a.dsnid).change(function(){$.getJSON("?app=system&controller=template&action=load_discuz&dsnid="+this.value,function(c){if(c.state){b.html(c.html);b.find("input.suggest").suggest();
b.find("img.tips").attrTips("tips","tips_green",200,"top")}else b.html('<tr><td colspan="2">'+c.error+"</td></tr>")});$.post("?app=system&controller=template&action=memdiscuzdsn","dsnid="+this.value)});a.dsnid.value&&a.dsnid.value!="0"&&d.change()},function(d){var a=d.find("form")[0],b="{discuz";if(a.dsnid.value&&a.dsnid.value!="0")b+=' dsn="'+a.dsnid.options[a.dsnid.selectedIndex].text+'"';if(a.discuzX.value=="1")b+=' discuzX="1"';b+=' prefix="'+a.prefix.value+'"';b+=' filter="'+$(a.filter).filter(":checked").val()+
'"';var c=[];$(a.special).each(function(){this.checked&&c.push(this.value)});if(c.length)b+=' special="'+c+'"';if(a.published.value&&a.published.value!="0")b+=' published="'+a.published.value+'"';b+=' orderby="'+a.orderby.value+" "+$(a.ascdesc).filter(":checked").val()+'"';var f=$(a.fid).val();if(f&&f.length&&f.indexOf("all")==-1)b+=' fid="'+f+'"';if(a.author.value)b+=' uid="'+a.author.value+'"';if(a.keywords.value)b+=' keywords="'+a.keywords.value+'"';if(a=parseInt(a.size.value))b+=' size="'+a+'"';
b+="}\n"+e.text+"\n{/discuz}";g.insertSection(b,e.selection);d.dialog("close")},function(d){d.dialog("close")})},{text:"discuz!",desc:"discuz!\u8bba\u575b\u4e3b\u9898"}).setPlugin("phpwind",function(h,e){var g=this.textarea;ct.ajax("phpwind\u8c03\u7528\u6807\u7b7e","?app=system&controller=template&action=tag_phpwind",530,430,function(d){var a=d.find("form")[0],b=d.find("tbody:last");d=$(a.dsnid).change(function(){$.getJSON("?app=system&controller=template&action=load_phpwind&dsnid="+this.value,function(c){if(c.state){b.html(c.html);
b.find("input.suggest").suggest();b.find("img.tips").attrTips("tips","tips_green",200,"top")}else b.html('<tr><td colspan="2">'+c.error+"</td></tr>")});$.post("?app=system&controller=template&action=memphpwinddsn","dsnid="+this.value)});a.dsnid.value&&a.dsnid.value!="0"&&d.change()},function(d){var a=d.find("form")[0],b="{phpwind";if(a.dsnid.value&&a.dsnid.value!="0")b+=' dsn="'+a.dsnid.options[a.dsnid.selectedIndex].text+'"';b+=' prefix="'+a.prefix.value+'"';b+=' filter="'+$(a.filter).filter(":checked").val()+
'"';var c=[];$(a.special).each(function(){this.checked&&c.push(this.value)});if(c.length)b+=' special="'+c+'"';if(a.published.value&&a.published.value!="0")b+=' published="'+a.published.value+'"';b+=' orderby="'+a.orderby.value+" "+$(a.ascdesc).filter(":checked").val()+'"';var f=$(a.fid).val();if(f&&f.length&&f.indexOf("all")==-1)b+=' fid="'+f+'"';if(a.author.value)b+=' uid="'+a.author.value+'"';if(a.keywords.value)b+=' keywords="'+a.keywords.value+'"';if(a=parseInt(a.size.value))b+=' size="'+a+'"';
b+="}\n"+e.text+"\n{/phpwind}";g.insertSection(b,e.selection);d.dialog("close")},function(d){d.dialog("close")})},{text:"phpwind",desc:"phpwind\u8bba\u575b\u4e3b\u9898"}).setPlugin("shopex",function(h,e){var g=this.textarea;ct.ajax("shopex\u8c03\u7528\u6807\u7b7e","?app=system&controller=template&action=tag_shopex",500,400,function(d){var a=d.find("form")[0],b=d.find("tbody:last");d=$(a.dsnid).change(function(){$.getJSON("?app=system&controller=template&action=load_shopex&dsnid="+this.value,function(c){if(c.state){b.html(c.html);
b.find("input.suggest").suggest();b.find("img.tips").attrTips("tips","tips_green",200,"top")}else b.html('<tr><td colspan="2">'+c.error+"</td></tr>")});$.post("?app=system&controller=template&action=memshopexdsn","dsnid="+this.value)});a.dsnid.value&&a.dsnid.value!="0"&&d.change()},function(d){var a=d.find("form")[0],b="{shopex";if(a.dsnid.value&&a.dsnid.value!="0")b+=' dsn="'+a.dsnid.options[a.dsnid.selectedIndex].text+'"';b+=' prefix="'+a.prefix.value+'"';var c=[];$(a.tagid).each(function(){this.checked&&
c.push(this.value)});if(c.length)b+=' tagid="'+c+'"';if(a.published.value&&a.published.value!="0")b+=' published="'+a.published.value+'"';b+=' orderby="'+a.orderby.value+" "+$(a.ascdesc).filter(":checked").val()+'"';var f=$(a.catid).val();if(f&&f.length&&f.indexOf("all")==-1)b+=' catid="'+f+'"';if(a.brand.value)b+=' bid="'+a.brand.value+'"';if(a.keywords.value)b+=' keywords="'+a.keywords.value+'"';if(a=parseInt(a.size.value))b+=' size="'+a+'"';b+="}\n"+e.text+"\n{/shopex}";g.insertSection(b,e.selection);
d.dialog("close")},function(d){d.dialog("close")})},{text:"shopex",desc:"shopex"}).setPlugin("loop",function(h,e){this.textarea.insertSection("{loop $array $k $v}\n"+e.text+"\n{/loop}",e.selection)},{desc:"\u5faa\u73af"}).setPlugin("ifelse",function(h,e){this.textarea.insertSection("{if condition}\n"+e.text+"\n{else}\n\t\n{/if}",e.selection)},{text:"if else",desc:"\u5206\u652f\u8bed\u53e5"}).setPlugin("elseif",function(h,e){this.textarea.insertSection("{elseif condition}\n"+e.text,e.selection)},{text:"elseif",
desc:"\u5206\u652f\u8bed\u53e5"}).setPlugin("preview",function(h,e){var g=ct.dialog("\u9884\u89c8","preview_code",500,300);$.post("?app=system&controller=template&action=preview",{code:e.text},function(d){g.html(d)})},{text:"\u9884\u89c8\u9009\u4e2d",desc:"\u9884\u89c8\u9009\u4e2d\u90e8\u5206"})})(jQuery);
