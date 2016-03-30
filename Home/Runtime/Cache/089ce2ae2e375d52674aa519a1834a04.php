<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>发布文章|<?php echo ($configcache['Title']); ?></title>
<link rel="stylesheet" type="text/css" href="__CSS__/content.css"  />
<link rel="stylesheet" type="text/css" href="__CSS__/public.css"  />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/Public.js"></script>
<script type="text/javascript" src="__JS__/winpop.js"></script>
<script type="text/javascript" src="__JS__/check.js"></script>
<script type="text/javascript" src="__ROOT__/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__ROOT__/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" src="__ROOT__/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
$(document).ready(function() {
	UE.getEditor('editor');
	//获取内容
    function getContent() {
        return UE.getEditor('editor').getContent();
    }
	var $dldd = $('#cdl dd');
	//标题限制
	$dldd.find('.qtext').keyup(function() {
		le=$(this).val();
		if (le.length>80) {
			$(this).val(le.substr(0,80));
			$dldd.find('font span').eq(0).text(0);
		}else {
			$dldd.find('font span').eq(0).text(80-le.length);
		}
	});
	//描述限制
	$dldd.find('.textarea').keyup(function() {
		le=$(this).val();
		if (le.length>200) {
			$(this).val(le.substr(0,200));
			$dldd.find('font span').eq(1).text(0);
		}else {
			$dldd.find('font span').eq(1).text(200-le.length);
		}
	});
	$('.submit').click(function() {
		var 
			sid = $dldd.find('.select').val(),
			title = $dldd.find('.qtext').eq(0).val(),
			sortid = $dldd.find('.dtext').val(),
			description = $dldd.find('.textarea').val();
		var content = getContent();
		if (!tcheck(sid,'','分类ID获取失败')) { return false; }
		if (!tcheck(title,'','请填写标题')) { return false; }
		if (!tcheck(title,'1,80','标题请在80个字符以内','length')) { return false; }
		if (!tcheck(sortid,'','请填写排序ID')) { return false; }
		if (!tcheck(sortid,'number','排序ID必须是数字')) { return false; }
		if (!tcheck(description,'0,200','描述请在200个字符以内','length')) { return false; }
		wintq('正在处理，请稍后...',4,20000,0,'');
		$('form').submit();
	});
});
</script>
</head>
<body>
<div id="content">
	<h1>首页 > 新闻管理 > 发布文章</h1>
    <h2>
    	<div class="h2_left">
        	<a href="__ACTION__" class="whole">全部</a>
        	<a href="javascript:;" class="f5" onclick="f5();">刷新</a>
            <a href="javascript:;" onclick="location.href='__APP__/News/news'" class="uclass">列表</a>
            <a href="javascript:;" onclick="location.href='__APP__/News/classindex'" class="uclass">分类</a>
            <a href="javascript:history.back();" class="Retreat">后退</a>
            <a href="javascript:history.go(1);" class="Advance">前进</a>
        </div>
    </h2>
    <form action="__APP__/News/add_do/" method="post">
    <dl id="cdl">
    	<dd>
        	<span class="dd_left">所属分类：</span>
            <span class="dd_right">
            	<select class="select" name="Sid">
                	<?php if(is_array($clist)): $i = 0; $__LIST__ = $clist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["ID"]); ?>"><?php echo ($vo["ClassName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <font>选择栏目分类</font>
            </span>
        </dd>
        <dd>
        	<span class="dd_left">标题：</span>
            <span class="dd_right">
            	<input type="text" class="qtext" name="Title" /><font>* 你还可以输入<span>80</span>个字符</font>
            </span>
        </dd>
        <dd>
        	<span class="dd_left">排序ID：</span>
            <span class="dd_right">
            	<input type="text" class="dtext" name="Sortid" value="<?php echo ($Sortid); ?>" /><font>* 排序ID，请填写数字</font>
            </span>
        </dd>
        <dd>
        	<span class="dd_left">描述：</span>
            <span class="dd_right">
            	<textarea class="textarea" name="Description"></textarea>
            </span>
            <font>* 你还可以输入<span>200</span>个字符</font>
        </dd>
        <dd>
        	<span class="dd_left">内容：</span>
            <span class="dd_right"><script id="editor" name="Content" type="text/plain" style="width:1000px;height:400px;"></script></span>
        </dd>
    	<dd><input type="submit" name="submit" value="提交" class="submit" /></dd>
    </dl>
    </form>
</div>
</body>
</html>