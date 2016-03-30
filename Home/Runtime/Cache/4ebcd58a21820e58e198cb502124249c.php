<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改客户信息|<?php echo ($configcache['Title']); ?></title>
<link rel="stylesheet" type="text/css" href="__CSS__/content.css"  />
<link rel="stylesheet" type="text/css" href="__CSS__/public.css"  />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/Public.js"></script>
<script type="text/javascript" src="__JS__/winpop.js"></script>
<script type="text/javascript" src="__JS__/check.js"></script>
<script>
$(document).ready(function() {
	var $client = $('#client');
	$('.submit').click(function() {
		var 
			CompanyName = $client.find('.ctext').eq(0).val(),
			ContactName = $client.find('.dtext').val(),
			Address = $client.find('.ctext').eq(1).val(),
			ZipCode = $client.find('.ctext').eq(2).val(),
			WebUrl = $client.find('.ctext').eq(3).val(),
			MainItems = $client.find('.textarea').eq(0).val(),
			Message = $client.find('.textarea').eq(1).val();
					
		if (!tcheck(CompanyName,'','请填写公司/客户名称')) { return false; }
		if (!tcheck(ContactName,'','请填写联系人')) { return false; }
		if (!tcheck(CompanyName,'1,60','公司名称请在60个字符以内','length')) { return false; }
		if (!tcheck(Address,'0,100','详细地址请在100个字符以内','length')) { return false; }
		if (!tcheck(ZipCode,'0,10','邮政编码请在10个字符以内','length')) { return false; }
		if (!tcheck(WebUrl,'0,60','网站地址请在60个字符以内','length')) { return false; }
		if (!tcheck(MainItems,'0,200','主营项目请在200个字符以内','length')) { return false; }
		if (!tcheck(Message,'0,1000','备注请在1000个字符以内','length')) { return false; }
		wintq('正在处理，请稍后...',4,20000,0,'');
		$('form').submit();
	});
});
</script>
</head>
<body>

<div id="content" style="padding-bottom:20px;">
    <h3>
    	<a href="javascript:;" onclick="location.reload();">刷新</a>
    	<a href="__APP__/Client/clientedit?id=<?php echo ($result['ID']); ?>" class="h3a">客户资料</a>
    	<a href="__APP__/Client/wincontact?Cid=<?php echo ($result['ID']); ?>">联系人</a>
        <a href="__APP__/With/winwith?Cid=<?php echo ($result['ID']); ?>">跟单记录</a>
    </h3>
    <form action="__APP__/Client/clientedit_do" method="post">
    <table id="client" border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0">
    	<tr class="tr">
        	<td class="left">客户/公司：</td>
        	<td><input name="CompanyName" type="text" class="ctext" size="30" value="<?php echo ($result['CompanyName']); ?>" /><font>* 填写公司名称或客户名称</font></td>
            <td class="left">联系人：</td>
        	<td><input name="ContactName" type="text" class="dtext" size="20" value="<?php echo ($result['ContactName']); ?>" /></td>
        </tr><input type="hidden" name="Cid" value="<?php echo ($result['Cid']); ?>" />
    	<tr class="tr">
        	<td class="left">详细地址：</td>
        	<td><input name="Address" type="text" class="ctext" size="40" value="<?php echo ($result['Address']); ?>" /><font>* 客户详细地址</font></td>
            <td class="left">邮编：</td>
            <td><input name="ZipCode" type="text" class="ctext" size="20" value="<?php echo ($result['ZipCode']); ?>" /><font>* 只能是数字</font></td>
        </tr>
    	<tr class="tr">
        	<td class="left">网站地址：</td>
        	<td><input name="WebUrl" type="text" class="ctext" size="40" value="<?php echo ($result['WebUrl']); ?>" /><font>* 公司网址</font></td>
            <td class="left">从事行业：</td>
            <td>
            	<select name="Industry" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 26): ?><option value="<?php echo ($vo["ID"]); ?>" <?php if($vo["ID"] == $result['Industry']): ?>selected<?php endif; ?> ><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        </tr>
    	<tr class="tr">
        	<td class="left">客户类型：</td>
        	<td>
            	<select name="ClientType" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 1): ?><option value="<?php echo ($vo["ID"]); ?>" <?php if($vo["ID"] == $result['ClientType']): ?>selected<?php endif; ?>><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
            <td class="left">客户级别：</td>
            <td>
            	<select name="ClientLevel" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 3): ?><option value="<?php echo ($vo["ID"]); ?>" <?php if($vo["ID"] == $result['ClientLevel']): ?>selected<?php endif; ?>><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        </tr>
    	<tr class="tr">
        	<td class="left">客户来源：</td>
        	<td>
            	<select name="ClientSource" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 2): ?><option value="<?php echo ($vo["ID"]); ?>" <?php if($vo["ID"] == $result['ClientSource']): ?>selected<?php endif; ?>><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
            <td class="left">跟进情况：</td>
            <td>
            	<select name="FollowUp" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 54): ?><option value="<?php echo ($vo["ID"]); ?>" <?php if($vo["ID"] == $result['FollowUp']): ?>selected<?php endif; ?>><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        </tr>
    	<tr class="tr">
        	<td class="left">跟单类型：</td>
        	<td>
            	<select name="Wast" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 5): ?><option value="<?php echo ($vo["ID"]); ?>" <?php if($vo["ID"] == $result['Wast']): ?>selected<?php endif; ?>><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
            <td class="left">客户意向：</td>
            <td>
            	<select name="Intent" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 57): ?><option value="<?php echo ($vo["ID"]); ?>" <?php if($vo["ID"] == $result['Intent']): ?>selected<?php endif; ?>><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        </tr>
    	<tr class="tr">
        	<td class="left">主营项目：</td>
        	<td colspan="3"><textarea name="MainItems" class="textarea" style="width:600px; height:60px; margin:6px 0px;"><?php echo ($result['MainItems']); ?></textarea></td>
        </tr>
    	<tr class="tr">
        	<td class="left">其它/备注：</td>
        	<td colspan="3"><textarea name="Message" class="textarea" style="width:600px; height:60px; margin:6px 0px;"><?php echo ($result['Message']); ?></textarea></td>
        </tr>
    	<tr class="tr">
        	<td class="left">录入时间：</td>
        	<td><?php echo ($result['Dtime']); ?></td>
            <td class="left">最后更新：</td>
        	<td><?php echo ($result['FinalTime']); ?></td>
        </tr>
    </table><input type="hidden" name="ID" value="<?php echo ($result['ID']); ?>" />
    <input type="submit" class="submit" value="提交" style="margin:20px 0 0 30px;" />
    </form>
</div>
</body>
</html>