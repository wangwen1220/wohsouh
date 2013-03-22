<form>
<table class="table_form" cellspacing="0" cellpadding="0" border="0" width="95%">
	<tr>
	    <th width="80">模型：</th>
	    <td>
	        <select name="model">
	            <?php foreach ($model as $m):?>
	            <option value="<?=$m['modelid']?>"><?=$m['name']?></option>
	            <?php endforeach;?>
	        </select>
	    </td>
	</tr>
    <tr>
	    <th>栏目：</th>
	    <td>
		    <input name="category" class="suggest" width="300" value="" type="text"
				url="?app=system&controller=category&action=search&keyword=%s"
				listUrl="?app=system&controller=category&action=cate&catid=%s"
				listBridge="tree"
				paramVal="catid"
				paramTxt="name"
			/>
	    </td>
	</tr>
    <tr>
        <th>来源：</th>
        <td>
        	<input name="source" class="suggest" width="300" value="" type="text"
				url="?app=system&controller=template&action=suggestSource&keyword=%s"
				listUrl="?app=system&controller=template&action=pageSource&page=%s"
			/>
        </td>
	</tr>
    <tr>
        <th>创建人：</th>
        <td>
        	<input name="createdby" class="suggest" width="300" value="" type="text"
				url="?app=system&controller=template&action=suggestUser&keyword=%s"
				listUrl="?app=system&controller=template&action=pageUser&page=%s"
			/>
        </td>
    </tr>
    <tr>
        <th>权重：</th>
        <td>
            <input name="weight" size="4" type="text" />
            <label style="display:none">
                <span style="margin:0 5px;">~</span>
                <input name="weight" size="4" type="text" />
            </label>
            <input type="checkbox" class="checkbox_style" onclick="$(this).prev('label')[this.checked ? 'show' : 'hide']()" name="weight_range"/> 范围
            (<em>1~100数字</em>)
        </td>
    </tr>
    <tr>
        <th>发布时间：</th>
        <td>
            <select name="published">
				<option value="0">全部时间</option>
				<option value="1">1 天</option>
				<option value="1">2 天</option>
				<option value="7">1 周</option>
				<option value="31">1 个月</option>
				<option value="93">3 个月</option>
				<option value="186">6 个月</option>
				<option value="366">1 年</option>
			</select> 以内
        </td>
    </tr>
    <tr>
        <th><?=element::tips('多个关键词用半角逗号‘,’分隔')?> 关键词：</th>
        <td>
            <input type="text" name="tag" style="width:300px" /></b>
        </td>
    </tr>
    <tr>
        <th>排序：</th>
        <td id="orderby">
            <div>
                <select>
                    <?php foreach ($sortset as $f=>$n):?>
                    <option value="<?=$f?>"><?=$n?></option>
                    <?php endforeach;?>
                </select>
                <input type="checkbox" checked="checked"  class="checkbox_style" value="1" /> 降序
                <a href="javascript:;" onclick="$(this).parent().remove()">删除</a>
            </div>
            <a href="javascript:;" onclick="var a = $(this);a.before(a.next('div').clone().show());return false;">增加</a>
            <div style="display:none">
                <select>
                    <?php foreach ($sortset as $f=>$n):?>
                    <option value="<?=$f?>"><?=$n?></option>
                    <?php endforeach;?>
                </select>
                <input type="checkbox"  class="checkbox_style" value="1" /> 降序
                <a href="javascript:;" onclick="$(this).parent().remove()">删除</a>
            </div>
        </td>
    </tr>
    <tr>
        <th>条数：</th>
        <td>
            <input name="size" size="4" value="12" />
        </td>
    </tr>
</table>
</form>