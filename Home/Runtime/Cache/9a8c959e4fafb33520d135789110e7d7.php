<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($configcache['Title']); ?></title>
<link rel="stylesheet" type="text/css" href="__CSS__/public.css"  />
<link rel="stylesheet" type="text/css" href="__CSS__/content.css"  />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/winpop.js"></script>
</head>
<body>
<div id="content">
	<div id="con1">
    	<h6>系统信息</h6>
        <ul>
        	<li><span>ThinkPHP框架版本：</span><?php echo ($info['THINK_VERSION']); ?></li>
            <li><span>服务器操作系统：</span><?php echo ($info['PHP_OS']); ?></li>
            <li><span>运行环境：</span><?php echo ($info['SERVER_SOFTWARE']); ?></li>
            <li><span>Mysql版本：</span><?php echo ($info['mysql']); ?></li>
            <li><span>云端总容量：</span><font><?php echo ($info['core']['UPLOAD_CAPACITY']); ?> M</font></li>
            <li><span>用户空间分配：</span><font><?php echo ($info['core']['UPLOAD_USER_CAPACITY']); ?> M</font></li>
            <li><span>图片大小限制：</span><font><?php echo ($info['core']['UPLOAD_FILE_PIC_SIZE']); ?> KB</font></li>
            <li><span>图片类型限制：</span><?php echo ($info['core']['UPLOAD_FILE_PIC_TYPE']); ?></li>
            <li><span>文件大小限制：</span><font><?php echo ($info['core']['UPLOAD_FILE_FILE_SIZE']); ?> KB</font></li>
            <li><span>文件类型限制：</span><?php echo ($info['core']['UPLOAD_FILE_FILE_TYPE']); ?></li>
            <li><span>在线人数：</span><font><?php echo ($usercount); ?> 人</font></li>
        </ul>
    </div>
	<div id="con2">
    	<h6>基本信息</h6>
        <ul>
        	<dt><strong>客户信息</strong></dt>
        	<li><span>客户总数：</span><strong><?php echo ($info['clientcount']); ?></strong> 位</li>
            <li><span>正在跟进客户：</span><strong><?php echo ($info['clientcount2']); ?></strong> 位</li>
            <li><span>待跟进客户：</span><strong><?php echo ($info['clientcount3']); ?></strong> 位</li>
            <li><span>完成跟进数：</span><strong><?php echo ($info['clientcount4']); ?></strong> 位</li>
            <li><span>联系人总数：</span><strong><?php echo ($info['contactcount']); ?></strong> 位</li>
            <dt><strong>其它信息</strong></dt>
            <li><span>用户总数：</span><strong><?php echo ($info['user']); ?></strong> 位</li>
            <li><span>云端文件总数：</span><strong><?php echo ($info['file']); ?></strong> 个</li>
            <li><span>新闻总数：</span><strong><?php echo ($info['news']); ?></strong> 篇</li>
            <li><span>系统设计和维护：</span><a href="http://www.web-fish.com" target="_blank">小峰（博客：WEB鱼）</a></li>
        </ul>
    </div>
    <div id="con3">
    	<h6><span>最新动态</span><a href="__APP__/News/news">更多>></a></h6>
        <ul>
        	<?php if(is_array($newslist)): $i = 0; $__LIST__ = $newslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span><?php echo ($vo["Dtime"]); ?></span><a href="__APP__/News/article?id=<?php echo ($vo["ID"]); ?>"><?php echo ($vo["Title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>
</body>
</html>