<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻管理|<?php echo ($configcache['Title']); ?></title>
<link rel="stylesheet" type="text/css" href="__CSS__/content.css"  />
<link rel="stylesheet" type="text/css" href="__CSS__/public.css"  />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/Public.js"></script>
<script type="text/javascript" src="__JS__/winpop.js"></script>
<script type="text/javascript" src="__JS__/check.js"></script>
<script>
$(document).ready(function() {
	//删除
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
				url:'__APP__/News/newsdel/',
				dataType:'json',
				type:'POST',
				data:'id='+id,
				success: function(data) {
					if (data.s=='ok') {
						wintq('删除成功',1,1500,1,'?');
					}else {
						wintq(data.s,3,1500,1,'');
					}
				}
			});
		}
	});
	//批量删除
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
				url:'__APP__/News/newsindel/',
				dataType:'JSON',
				type:'POST',
				data:'delid='+delid,
				success: function(data) {
					if (data.s=='ok') {
						wintq('删除成功',1,1500,0,'?');
					}else {
						wintq(data.s,3,1500,1,'');
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
	<h1>首页 > 新闻管理 > 文章管理</h1>
    <h2>
    	<div class="h2_left">
        	<a href="javascript:;" class="f5" onclick="f5();">刷新</a>
            <a href="javascript:history.back();" class="Retreat">后退</a>
            <a href="javascript:history.go(1);" class="Advance">前进</a>
        </div>
    </h2>
    <h4>
    	<a href="javascript:;" class="list">分类筛选：</a>
    	<?php if(is_array($clist)): $i = 0; $__LIST__ = $clist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="<?php if($vo["ID"] == $result['Sid']): ?>lista<?php else: ?>list<?php endif; ?>" href="__APP__/News/news/sid/<?php echo ($vo["ID"]); ?>"><?php echo ($vo["ClassName"]); ?></a>
        </if><?php endforeach; endif; else: echo "" ;endif; ?>
    </h4>
    <div id="article">
    	<div class="title"><?php echo ($result['Title']); ?><div class="all">作者：<?php echo ($result['Username']); ?> | 浏览数：<?php echo ($result['View']+1); ?></div></div>
        <div class="article"><?php echo ($result['Content']); ?></div>
    </div>
</div>
</body>
</html>