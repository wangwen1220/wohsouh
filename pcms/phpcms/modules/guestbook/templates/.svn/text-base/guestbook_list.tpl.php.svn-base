<?php
defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header', 'admin');
?>
	
<?php
if(is_array($infos)){
foreach($infos as $info){
?>
<tr>
<td align="center" width="35"><input type="checkbox" name="gid[]" value="<?php echo $info['gid']?>"></td>
<td align="left"><?php echo $info['title']?></td>
<td align="left" width="30%"><?php echo $info['content']?></td>
<td align="center" width="100"><?php echo $info['username'];?></td>
<td align="center" width="120"><?php echo date('Y-m-d H-i-s',$info['addtime']);?></td>
<td align="center" width="10%">
<?php if($info['reply']==''){echo '<font color=red>未回复</font>';}else{echo '已回复';}?></td>
<td align="center" width="12%">
<a href="###" onclick="reply(<?php echo $info['gid']?>,
‘<?php echo new_addslashes($info['title'])?>')" title="回复留言">回复
</a> |
<a href='?m=guestbook&c=guestbook&a=delete&gid=<?php echo $info['gid']?>'
 onClick="return confirm('<?php echo L('confirm', 
array('message' => new_addslashes($info['title'])))?>')"><?php echo L('delete')?></a>		</td></tr>
<?php } } ?>
	
	<div id="pages"><?php echo $pages?></div>