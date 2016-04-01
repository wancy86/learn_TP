<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传图片|<?php echo ($configcache['Title']); ?></title>
<link rel="stylesheet" type="text/css" href="__CSS__/content.css"  />
<link rel="stylesheet" type="text/css" href="__CSS__/public.css"  />
<link rel="stylesheet" type="text/css" href="__CSS__/uploadify.css"  />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/Public.js"></script>
<script type="text/javascript" src="__JS__/winpop.js"></script>
<script type="text/javascript" src="__JS__/jquery.uploadify.js"></script>
<script type="text/javascript">
<?php $timestamp = time();?>
$(function() {
	$('#file_upload').uploadify({
		'formData'     : {
			'timestamp'		: '<?php echo $timestamp;?>',
			'token'     	: '<?php echo md5($timestamp);?>',
			'dirName'		: 'Picture/',								//图片目录
			'Uid'			: "<?php echo $_SESSION['ThinkUser']['ID'];?>",
			'sid'			: '<?php echo ($sid); ?>',
		},
		'swf'			:	'__IMAGE__/uploadify.swf',					//swf文件（必选）
		'uploader'		:	'__APP__/Upload/picdo/',					//服务端脚本（必选）
		'method'		:	'post',
		//'buttonCursor'  :	'hand',										//设置的光标悬停在浏览按钮时显示。可能的值是'hand(手)'和'arrow(箭头)'
		'buttonText'	: 	'选择图片',
		//'debug'			: 	true,									//设置为true来打开SWFUpload的调试模式
		//'fileObjName'	:	'fileName',									//设置后台接收的值$_FILES['file_name']
		'fileSizeLimit'	:	'<?php echo ($filesize); ?>',								//允许的最大尺寸文件上传，默认单位是KB，0则没有限制
		'fileTypeDesc'	:	'Image Type',								//可选择的文件的描述。该字符串出现在浏览文件对话框的文件类型下拉
		'fileTypeExts'	:	'<?php echo ($filetype); ?>',					//设置允许上传的文件类型
		'width'			:	100,										//浏览器按钮的宽度
		'height'		:	30,											//浏览器按钮的高度。
		'multi'			:	true,										//是否允许选择多个文件
		'auto'			:	false,										//选择图片后是否自动上传
		'preventCaching':	false,										//是否缓存
		'progressData'	:	'percentage',								//数据文件上传进度更新时队列中的项目显示，这两个选项是“percentage(百分比)”或“speed(速度)”。
		//'queueID'		:	'queue',									//显示上传文件队列的元素id，可以简单用一个div来显示
		'queueSizeLimit':	50,											//队列允许文件的最大数量
		'uploadLimit'	:	900,										//允许的最大文件数量。当达到或超过此值时，onUploadError事件被触发
		//'cancelImage'	:	'uploadify-cancel.png',						//取消上传图片
		'removeCompleted':	true,										//上传成功后的文件，是否在队列中自动删除
		'removeTimeout'	:	1,											//几秒后删除
		'requeueErrors' :	false,										//如果设置为true，即在上传过程中返回错误文件被重新排队和上传反复尝试。
		'successTimeout':	30,											//几秒钟的时间来等待服务器的响应
		
		'onDialogClose'	: function(queueData) {
			$('.dlinfo').html('<strong>上传信息状态：</strong><br />添加至队列时有：<strong>'+queueData.filesErrored+'</strong>个文件发生错误<br />错误信息:'+queueData.errorMsg+'<br />选定的文件数:<strong>'+queueData.filesSelected+'</strong><br />成功添加至队列的文件数:<strong>'+queueData.filesQueued+'</strong><br />队列中的总文件数量:<strong>'+queueData.queueLength+'</strong><br />');
		},
		'onQueueComplete': function(queueData) {						//当队列中的所有文件全部完成上传时触发
			$('.dlinfo').append('成功上传的图片数: <strong>' + queueData.uploadsSuccessful + '</strong><br />');
		},
		'onUploadComplete' : function(file) {
			$('.dlinfo').append('图片：<strong>' + file.name + '</strong>上传完成<br />');
		},
		'onUploadProgress' : function(file, bytesUploaded, bytesTotal, totalBytesUploaded, totalBytesTotal) {
			$('#progress').html('已经上传：' + (totalBytesUploaded/1024).toFixed(2) + ' KB　　总大小' + (totalBytesTotal/1024).toFixed(2) + ' KB.');
		},																//引发文件上传的进度每次更新
		'onUploadSuccess' : function(file,data,response) {				//触发每个成功上传文件
			if (data.length>0) {
				alert(data);
				$('#file_upload').uploadify('cancel','*');
			}
		},
	});
	//快捷导航跳转
	$('.select').eq(0).change(function() {
		wintq('正在查询，请稍后...',4,20000,0,'');
		location.href = '__APP__/File/uploadpic?sid='+$(this).val();
	});
	//查看目录文件
	$('.select').eq(1).change(function() {
		wintq('正在跳转，请稍后...',4,20000,0,'');
		location.href = '__APP__/File/filelist?sid='+$(this).val();
	});
});
</script>
</head>
<body>
<div id="content">
	<h1>首页 > 云端文件 > 上传图片</h1>
    <h2>
    	<div class="h2_left">
        	<a href="javascript:;" class="f5" onclick="f5();">刷新</a>
            <a href="javascript:;" onclick="location.href='filelist'" class="ulist">列表</a>
            <a href="javascript:history.back();" class="Retreat">后退</a>
            <a href="javascript:history.go(1);" class="Advance">前进</a>
            &nbsp;&nbsp;&nbsp;&nbsp;当前上传目录：
            <select name="sid" class="select">
            	<option value="0">顶级目录</option>
            	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["ID"]); ?>" <?php if($vo["ID"] == $sid): ?>selected<?php endif; ?> ><?php if($vo["Sid"] != 0): ?>└<?php endif; echo ($vo["html"]); echo ($vo["classname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            （可以这里切换保存目录哦）
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;查看目录文件：
            <select name="sid" class="select">
            	<option value="0">==请选择==</option>
            	<option value="0">顶级目录</option>
            	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["ID"]); ?>"><?php if($vo["Sid"] != 0): ?>└<?php endif; echo ($vo["html"]); echo ($vo["classname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </h2>
    <h3>
    	<a href="__APP__/File/filelist">我的文件列表</a>
    	<a href="__APP__/File/uploadpic?sid=<?php echo ($sid); ?>" class="h3a">上传图片</a>
        <a href="__APP__/File/uploadfile?sid=<?php echo ($sid); ?>" >上传文件</a>
        <a href="__APP__/File/fileshare">共享文件</a>
    </h3>
    <dl id="cdl">
    	<dd><font>图片上传，简单、方便、快捷，可批量上传图片、设置文件名称，最多可同时上传50个图片</font></dd>
        <dd>允许上传的图片类型：<font><?php echo ($filetype); ?></font>&nbsp;&nbsp;&nbsp;&nbsp;单个图片大小限制：<font><?php echo ($filesize); ?> KB</font></dd>
        <dd>
        	<input id="file_upload" name="file_upload" type="file" multiple="true">
            <input type="button" value="开始上传" onclick="javascript:$('#file_upload').uploadify('upload', '*')" class="clearfile" />
            <input type="button" value="取消上传" onclick="javascript:$('#file_upload').uploadify('cancel', '*')" class="clearlist" />
            <div id="progress"></div>
        </dd>
        <dd><div id="queue"></div></dd>
        <div class="dlinfo"></div>
    </dl>
</div>
</body>
</html>