<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站配置|<?php echo ($configcache['Title']); ?></title>
<link rel="stylesheet" type="text/css" href="__CSS__/content.css"  />
<link rel="stylesheet" type="text/css" href="__CSS__/public.css"  />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/Public.js"></script>
<script type="text/javascript" src="__JS__/winpop.js"></script>
<script type="text/javascript" src="__JS__/check.js"></script>
<script>
function check() {
	/*var UPLOAD_CAPACITY = $('#cdl .qtext').eq(0).val();*/
	return true;
}
</script>
</head>
<body>
<div id="content">
	<h1>首页 > 系统管理 > 网站设置</h1>
    <h2>
    	<div class="h2_left">
        	<a href="javascript:;" class="f5" onclick="f5();">刷新</a>
            <a href="javascript:history.back();" class="Retreat">后退</a>
            <a href="javascript:history.go(1);" class="Advance">前进</a>
        </div>
    </h2>
    <h3>
    	<a href="__APP__/System/systemwebsite" class="h3a">网站设置</a>
    	<a href="__APP__/System/systemconfig">系统配置</a>
        <a href="__APP__/System/systemcore">核心配置</a>
    </h3>
    <form action="__APP__/System/systemwebsite_do" method="post" id="form" onsubmit="return check();">
    <dl id="cdl">
    	<dd>
        	<span class="dd_left">网站标题：</span>
            <span class="dd_right">
            	<input type="text" name="Title" class="qtext" value="<?php echo ($config['Title']); ?>" />
            </span>
        </dd>
    	<dd>
        	<span class="dd_left">缓存时长：</span>
            <span class="dd_right">
            	<input type="text" name="DataCache" class="dtext" value="<?php echo ($config['DataCache']); ?>" />
            </span>
            <font>* 单位（小时）可将常用数据进行缓存以提高性能</font>
        </dd>
        <dd><input type="submit" value="提交" class="submit"/></dd>
    </dl>
    </form>
</div>
</body>
</html>