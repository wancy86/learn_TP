<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>权限管理|<?php echo ($configcache['Title']); ?></title>
<link rel="stylesheet" type="text/css" href="__CSS__/content.css"  />
<link rel="stylesheet" type="text/css" href="__CSS__/public.css"  />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/Public.js"></script>
<script type="text/javascript" src="__JS__/winpop.js"></script>
<script type="text/javascript" src="__JS__/check.js"></script>
<script>
$(document).ready(function() {
    $('#content h2 .add').click(function() {
		popload('添加权限',600,300,'__APP__/Competence/cadd/');
		addDiv($('#iframe_pop'));
		popclose();
	});
	$('#content #table .tr .edit').click(function(event) {
		event.preventDefault();
		var id=$(this).attr('href');		
		if (id=='' || isNaN(id)) {
			wintq('ID参数不正确',3,1000,1,'');
			return false;
		}else {
			popload('修改权限信息',600,300,'__APP__/Competence/cedit/id/'+id);
			addDiv($('#iframe_pop'));
			popclose();
		}
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
				url:'__APP__/Competence/cdel/',
				dataType:'json',
				type:'POST',
				data:'post=ok&id='+id,
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
});
</script>
</head>
<body>
<div id="content">
	<h1>首页 > 用户管理 > 权限管理</h1>
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
        	<th>编号</th>
            <th>权限分类</th>
            <th>权限名称</th>
            <th>权限说明</th>
            <th>状态</th>
            <th>日期</th>
            <th>操作</th>
        </tr>
        <?php if($co == 0): ?><tr class="tr"><td class="tc" colspan="7">暂无数据，等待添加～！</td></tr><?php endif; ?>
        <!--顶级数据-->
        <?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr tr2">
            <td class="tc"><?php echo ($vo["ID"]); ?></td>
            <td class="tc"><?php echo ($vo["Cname"]); ?></td>
            <td><?php echo ($vo["Cname"]); ?></td>
            <td><?php echo ($vo["Description"]); ?></td>
            <td class="tc">
            <?php if($vo["Status"] == 0): ?><img src="__IMAGE__/yes.png" border="0" title="正常" />
            <?php else: ?>
            <img src="__IMAGE__/no.png" border="0" title="锁定" /><?php endif; ?>
            </td>
            <td class="tc"><?php echo ($vo["Dtime"]); ?></td>
            <td class="tc fixed_w"><a href="<?php echo ($vo["ID"]); ?>" class="edit"><img src="__IMAGE__/edit.png" border="0" title="修改" /></a><a href="<?php echo ($vo["ID"]); ?>" class="del"><img src="__IMAGE__/delete.png" border="0" title="删除" /></a></td>
        </tr>
        <!--二级数据-->
        <?php if(is_array($sidlist)): $i = 0; $__LIST__ = $sidlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if($s["Sid"] == $vo['ID']): ?><tr class="tr">
            <td class="tc"><?php echo ($s["ID"]); ?></td>
            <td></td>
            <td><?php echo ($s["Cname"]); ?></td>
            <td><?php echo ($s["Description"]); ?></td>
            <td class="tc">
            <?php if($s["Status"] == 0): ?><img src="__IMAGE__/yes.png" border="0" title="正常" />
            <?php else: ?>
            <img src="__IMAGE__/no.png" border="0" title="锁定" /><?php endif; ?>
            </td>
            <td class="tc"><?php echo ($s["Dtime"]); ?></td>
            <td class="tc fixed_w"><a href="<?php echo ($s["ID"]); ?>" class="edit"><img src="__IMAGE__/edit.png" border="0" title="修改" /></a><a href="<?php echo ($s["ID"]); ?>" class="del"><img src="__IMAGE__/delete.png" border="0" title="删除" /></a></td>
        </tr><?php endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <div id="page"><?php echo ($page); ?></div>
</div>
</body>
</html>