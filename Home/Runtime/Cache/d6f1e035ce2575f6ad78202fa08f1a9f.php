<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>信息提示<?php echo ($configcache['Title']); ?></title>
<link rel="stylesheet" type="text/css" href="__CSS__/public.css"  />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script>
$(function() {
	$('#with li .load').click(function() {
		location.reload();
	});
	$('#with li .hr').click(function() {
		window.parent.frames['c'].location.href='__APP__/With/with';
	});
});
</script>
</head>
<body>
<div id="with">
    <ul>
    	<li><a href="javascript:;" class="load">刷新</a>　　<a href="javascript:;" class="hr">去完成</a></li>
    	<li>当前需跟单数：<strong><?php echo ($withcount); ?></strong> 单　　　已完成：<strong><?php echo ($withcomplete); ?></strong> 单　　　还剩：<strong><?php echo ($withcount-$withcomplete); ?></strong> 单没完成</li>
        <li><strong>客户列表</strong></li>
        <?php if(is_array($withlist)): $i = 0; $__LIST__ = $withlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span class="s1">客户名称：</span><?php echo ($vo["CompanyName"]); ?>&nbsp;&nbsp;&nbsp;—>&nbsp;&nbsp;&nbsp;<span class="s2">联系人：</span><?php echo ($vo["ContactName"]); ?>&nbsp;&nbsp;&nbsp;—>&nbsp;&nbsp;&nbsp;<span class="s3">状态：</span><?php if($vo["Remind"] == 0): ?><span class="s4">未完成</span><?php else: ?><img src="__IMAGE__/yes.png" border="0" title="已完成" /><?php endif; ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
    	<li></li>
    	<li></li>
    </ul>
</body>
</html>