<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录限制管理|<?php echo ($configcache['Title']); ?></title>
<link rel="stylesheet" type="text/css" href="__CSS__/content.css"  />
<link rel="stylesheet" type="text/css" href="__CSS__/public.css"  />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/Public.js"></script>
<script type="text/javascript" src="__JS__/winpop.js"></script>
<script>
$(document).ready(function() {
    $('#content h2 .add').click(function() {
		popload('添加封禁IP',600,350,'__APP__/System/ipadd/');
		addDiv($('#iframe_pop'));
		popclose();
	});
	$('#content #table .tr .del').click(function(event) {
		event.preventDefault();
		if (!confirm('确定要删除该数据吗？')) {
			return false;
		}
		var id=$(this).attr('href');
		if (id=='' || isNaN(id)) {
			wintq('ID参数不正确',3,1000,1,'');
			return false;
		}else {
			wintq('正在删除，请稍后...',4,20000,0,'');
			$.ajax({
				url:'__APP__/System/del/',
				dataType:'json',
				type:'POST',
				data:'post=ok&id='+id,
				success: function(data) {
					if (data.s=='ok') {
						wintq('删除成功',1,1000,0,'?');
					}else {
						wintq(data.s,3,1000,1,'');
					}
				}
			});
		}
	});
	$('#dely').click(function(event) {
		event.preventDefault();
		if (!confirm('确定要删除选择项吗？')) {
			return false;
		}
		var delid='';
		for (i=0; i<$('#table .delid').size(); i++) {
			if (!$('#table .delid').eq(i).attr('checked')==false) {
				delid=delid+$('#table .delid').eq(i).val()+',';
			}
		}
		if (delid=='') {
			wintq('请选中后再操作',2,1500,1,'');
		}else {
			wintq('正在删除，请稍后...',4,20000,0,'');
			$.ajax({
				url:'__APP__/System/indel/',
				dataType:'JSON',
				type:'POST',
				data:'delid='+delid,
				success: function(data) {
					if (data.s=='ok') {
						wintq('删除成功',1,1000,0,'?');
					}else {
						wintq(data.s,3,1000,1,'');
					}
				}
			});
		}
	});
});
</script>
</head>
<body>
<div id="content">
	<h1>首页 > IP封禁管理</h1>
    <h2>
    	<div class="h2_left">
        	<a href="__ACTION__" class="whole">全部</a>
        	<a href="javascript:;" class="f5" onclick="f5();">刷新</a>
            <a href="javascript:;" class="add">新增</a>
            <a href="javascript:history.back();" class="Retreat">后退</a>
            <a href="javascript:history.go(1);" class="Advance">前进</a>
        </div>
        <div class="search">
        	<form action="__ACTION__" method="get">
        	<input type="text" name="keyword" class="text" value="<?php echo ($keyword); ?>" />
            <input type="submit" class="so" value="搜 索" />
            </form>
        </div>
    </h2>
    <table id="table" border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0">
    	<tr>
        	<th><input type="checkbox" class="indel" value="del" /></th>
        	<th>编号</th>
            <th>操作用户</th>
            <th>封锁IP</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>永久封禁</th>
            <th>操作时间</th>
            <th>操作</th>
        </tr>
        <?php if($co == 0): ?><tr class="tr"><td class="tc" colspan="9">暂无被封禁的IP，等待添加～！</td></tr><?php endif; ?>
        <!--顶级数据-->
        <?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr <?php if(($mod) == "1"): ?>tr2<?php endif; ?>">
        	<td class="tc"><input type="checkbox" class="delid" value="<?php echo ($vo["ID"]); ?>" /></td>
            <td class="tc"><?php echo ($vo["ID"]); ?></td>
            <td class="tc"><?php echo ($vo["Username"]); ?></td>
            <td class="tc"><?php echo ($vo["Ip"]); ?></td>
            <td class="tc"><?php echo ($vo["StartTime"]); ?></td>
            <td class="tc"><?php echo ($vo["EndTime"]); ?></td>
            <td class="tc">
            <?php if($vo["Status"] == 1): ?><img src="__IMAGE__/yes.png" border="0" title="是" />
            <?php else: ?>
            <img src="__IMAGE__/no.png" border="0" title="否" /><?php endif; ?>
            </td>
            <td class="tc"><?php echo ($vo["Dtime"]); ?></td>
            <td class="tc fixed_w"><a href="<?php echo ($vo["ID"]); ?>" class="del"><img src="__IMAGE__/delete.png" border="0" title="删除" /></a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <div id="page"><a href="javascript:;" class="selbox">全选</a><a href="javascript:;" class="anti">反选</a><a href="javascript:;" class="unselbox">全不选</a>&nbsp;&nbsp;对选中项进行&nbsp;&nbsp;<a href="javascript:;" id="dely">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($page); ?></div>
</div>
</body>
</html>