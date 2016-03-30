<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>核心配置|<?php echo ($configcache['Title']); ?></title>
<link rel="stylesheet" type="text/css" href="__CSS__/content.css"  />
<link rel="stylesheet" type="text/css" href="__CSS__/public.css"  />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/Public.js"></script>
<script type="text/javascript" src="__JS__/winpop.js"></script>
<script type="text/javascript" src="__JS__/check.js"></script>
<script>
function check() {
	var UPLOAD_CAPACITY = $('#cdl .qtext').eq(0).val();
	var UPLOAD_USER_CAPACITY = $('#cdl .qtext').eq(1).val();
	var UPLOAD_FILE_PIC_SIZE = $('#cdl .qtext').eq(2).val();
	var UPLOAD_FILE_PIC_TYPE = $('#cdl .qtext').eq(3).val();
	var UPLOAD_FILE_FILE_SIZE = $('#cdl .qtext').eq(4).val();
	var UPLOAD_FILE_FILE_TYPE = $('#cdl .qtext').eq(5).val();
	//验证并判断
	if (!tcheck(UPLOAD_CAPACITY,'','云空间大小不能为空')) { return false; }
	if (!tcheck(UPLOAD_CAPACITY,'number','云空间大小必须是数字')) { return false; }
	if (!tcheck(UPLOAD_USER_CAPACITY,'','请给用户分配空间容量')) { return false; }
	if (!tcheck(UPLOAD_USER_CAPACITY,'number','空间大小必须是数字')) { return false; }
	if (!tcheck(UPLOAD_FILE_PIC_SIZE,'','图片大小限制必须是数字')) { return false; }
	if (!tcheck(UPLOAD_FILE_PIC_SIZE,'number','图片大小限制必须是数字')) { return false; }
	if (!tcheck(UPLOAD_FILE_PIC_TYPE,'2,100','图片类型长度不符合','length')) { return false; }
	if (!tcheck(UPLOAD_FILE_PIC_TYPE,/^([a-zA-Z0-9]{2,6}\|)*([a-zA-Z0-9]{2,6})$/g,'图片类型填写不正确，多种类型请用“|”隔开','regexp')) { return false; }
	if (!tcheck(UPLOAD_FILE_FILE_SIZE,'','文件大小限制必须是数字')) { return false; }
	if (!tcheck(UPLOAD_FILE_FILE_SIZE,'number','文件大小限制必须是数字')) { return false; }
	if (!tcheck(UPLOAD_FILE_FILE_TYPE,'2,100','文件类型长度不符合','length')) { return false; }
	if (!tcheck(UPLOAD_FILE_FILE_TYPE,/^([a-zA-Z0-9]{2,6}\|)*([a-zA-Z0-9]{2,6})$/g,'文件类型填写不正确，多种类型请用“|”隔开','regexp')) { return false; }
	return true;
}
</script>
</head>
<body>
<div id="content">
	<h1>首页 > 系统管理 > 核心配置</h1>
    <h2>
    	<div class="h2_left">
        	<a href="javascript:;" class="f5" onclick="f5();">刷新</a>
            <a href="javascript:history.back();" class="Retreat">后退</a>
            <a href="javascript:history.go(1);" class="Advance">前进</a>
        </div>
    </h2>
    <h3>
    	<a href="__APP__/System/systemwebsite">网站设置</a>
    	<a href="__APP__/System/systemconfig">系统配置</a>
        <a href="__APP__/System/systemcore" class="h3a">核心配置</a>
    </h3>
    <form action="__APP__/System/systemcore_do" method="post" id="form" onsubmit="return check();">
    <dl id="cdl">
    	<dd>
        	<span class="dd_left">云端总容量：</span>
            <span class="dd_right">
            	<input type="text" name="UPLOAD_CAPACITY" class="qtext" value="<?php echo ($config['UPLOAD_CAPACITY']); ?>" />
                <font>网站总空间，单位M（兆）</font>
            </span>
        </dd>
    	<dd>
        	<span class="dd_left">用户空间分配：</span>
            <span class="dd_right">
            	<input type="text" name="UPLOAD_USER_CAPACITY" class="qtext" value="<?php echo ($config['UPLOAD_USER_CAPACITY']); ?>" />
                <font>给每个用户分配的空间大小，单位M（兆）</font>
            </span>
        </dd>
    	<dd>
        	<span class="dd_left">图片大小限制：</span>
            <span class="dd_right">
            	<input type="text" name="UPLOAD_FILE_PIC_SIZE" class="qtext" value="<?php echo ($config['UPLOAD_FILE_PIC_SIZE']); ?>" />
                <font>单位为KB</font>
            </span>
        </dd>
    	<dd>
        	<span class="dd_left">图片类型限制：</span>
            <span class="dd_right">
            	<input type="text" name="UPLOAD_FILE_PIC_TYPE" class="qtext" value="<?php echo ($config['UPLOAD_FILE_PIC_TYPE']); ?>" />
                <font>多个后缀请用“ | ”分隔开</font>
            </span>
        </dd>
    	<dd>
        	<span class="dd_left">文件大小限制：</span>
            <span class="dd_right">
            	<input type="text" name="UPLOAD_FILE_FILE_SIZE" class="qtext" value="<?php echo ($config['UPLOAD_FILE_FILE_SIZE']); ?>" />
                <font>单位为KB</font>
            </span>
    	<dd>
        	<span class="dd_left">文件类型限制：</span>
            <span class="dd_right">
            	<input type="text" name="UPLOAD_FILE_FILE_TYPE" class="qtext" value="<?php echo ($config['UPLOAD_FILE_FILE_TYPE']); ?>" />
                <font>多个后缀请用“ | ”分隔开</font>
            </span>
        </dd>
        <dd><input type="submit" value="提交" class="submit"/></dd>
    </dl>
    </form>
</div>
</body>
</html>