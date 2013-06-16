<?php /* Smarty version 2.6.20, created on 2013-01-12 18:00:27
         compiled from newspic.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'regex_replace', 'newspic.htm', 19, false),array('modifier', 'strip_tags', 'newspic.htm', 21, false),array('modifier', 'truncate', 'newspic.htm', 21, false),array('modifier', 'date_format', 'newspic.htm', 102, false),array('modifier', 'count', 'newspic.htm', 114, false),array('insert', 'readCount', 'newspic.htm', 104, false),array('insert', 'label', 'newspic.htm', 105, false),)), $this); ?>
<script type="text/javascript">
function showreview()
{
    document.getElementById("reviewt").style.display='block'; 
} 
function getfav()
{	
	var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
	var myurl=document.location.href;
	var u='<?php echo $_COOKIE['USER']; ?>
';
	if (u=='')
	{
	  alert('<?php echo $this->_tpl_vars['lang']['no_logo']; ?>
');
	  window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php';
	  return false;
	}
	var fu='<?php echo $this->_tpl_vars['de']['nid']; ?>
';
 	var typ='1';
	var ttil='<?php echo ((is_array($_tmp=$this->_tpl_vars['de']['title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\r\t\n\']/", "") : smarty_modifier_regex_replace($_tmp, "/[\r\t\n\']/", "")); ?>
';
	var mpic='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/news/<?php echo $this->_tpl_vars['de']['pic']; ?>
';
	var des='<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['de']['con'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\r\t\n\']/", "") : smarty_modifier_regex_replace($_tmp, "/[\r\t\n\']/", "")))) ? $this->_run_mod_handler('truncate', true, $_tmp, 100, "...", true) : smarty_modifier_truncate($_tmp, 100, "...", true)); ?>
';
    var pars = 'user='+u+'&fid='+fu+'&type='+typ+'&title='+ttil+'&url='+myurl+'&des='+des+'&picurl='+mpic;
	var myAjax = new Ajax.Request(url,{method: 'post', parameters: pars, onComplete: showResponse});
	function showResponse(originalRequest)
	{
	    if(originalRequest.responseText>1)
	       alert('<?php echo $this->_tpl_vars['lang']['fav_ok']; ?>
');
		else if (originalRequest.responseText>0)
	       alert('<?php echo $this->_tpl_vars['lang']['fav_isbing']; ?>
');
		else
	       alert('<?php echo $this->_tpl_vars['lang']['error']; ?>
');
	}
}
function printcontent()
{
	var printw = window.open('','','');
	printw.opener = null;
	printw.document.write('<div style="width:700px;">'+$('newscon').innerHTML+'</div>');
	printw.window.print();
}
function setfontsize(actions)
{
	var fsize=$('newscon').style.fontSize ? $('newscon').style.fontSize :'14px';
	var nsize = Number(fsize.replace('px', ''));
	nsize +=actions== 'B' ? 1 : -1;
	if(nsize<1)
		nsize =1;
	$('newscon').style.fontSize = nsize+'px';
}
function picwidth(pid, img)
{
	var img = img ? img : 665;
	var wid= pid.width;
	if(wid < img)
		return;
	else 
	{
		var hei = pid.height;
		pid.title = 'View Big';
		pid.onclick = function (e) {window.open(pid.src);}
		pid.height = parseInt(hei*img/wid);
		pid.width =img;
	}
}
window.onload = function(){
	var pics = document.getElementById('newscon').getElementsByTagName("img");
	for(var i=0;i<pics.length;i++)
	{
		picwidth(pics[i], 665);
	}
}
var num=0;
function setsTab(name,cursel,n)
{
	num=cursel;
	for(i=1;i<=n;i++)
	{
		var menu=document.getElementById(name+i);
		menu.className=i==cursel?"hover":"";
		var con=document.getElementById("con_"+name+"_"+i);
		con.style.display=i==cursel?"block":"none";
	}
}
</script>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/default/news.css" rel="stylesheet" type="text/css" />
<style>
.releatenews{width:600px;float:left;}
.releatenews li{width:600px;float:left;margin-left:5px;line-height:30px;}
</style>
<div class="menu_bottom L1">				
    <div class="headtop_L">
       <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <a href="?m=news&s=news_list&id=<?php echo $this->_tpl_vars['de']['classid']; ?>
"><?php echo $this->_tpl_vars['de']['cat']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['de']['title']; ?>

    </div>
    <div class="headtop_R"></div>		
</div>

<div id="mainbody1" class="m1">
<div class="newsbodyleft">
	<div class="newstitle"><?php if ($this->_tpl_vars['de']['subtitle']): ?><?php echo $this->_tpl_vars['de']['subtitle']; ?>
<?php else: ?><?php echo $this->_tpl_vars['de']['title']; ?>
<?php endif; ?></div> 
            <div class="newstime">
            <div style="float:left;">
                <?php echo $this->_tpl_vars['lang']['pubtime']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['de']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

                <?php echo $this->_tpl_vars['lang']['author']; ?>
<?php echo $this->_tpl_vars['de']['writer']; ?>

                <?php echo $this->_tpl_vars['lang']['read_count']; ?>
<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'readCount')), $this); ?>

                <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'statics', 'temp' => 'statics_default', 'ctype' => 1, 'id' => $this->_tpl_vars['de']['nid'])), $this); ?>

            </div>
            <!--<div style="float:right;width:60px;"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/zoombig.gif" width="16" height="16" alt="<?php echo $this->_tpl_vars['lang']['bigfont']; ?>
"  onclick="setfontsize('B');"/>&nbsp;&nbsp;<img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/zoomsmall.gif" width="16" height="16"  alt="<?php echo $this->_tpl_vars['lang']['smallfont']; ?>
"  onclick="setfontsize('S');"/></div>-->
			</div>
			
			<!--<hr size="1" width="98%"  noshade style="border:1px dotted #dddddd">-->
			<div id="news_con" class="newspic" style="padding-bottom:20px;"> 
      	<?php $_from = $this->_tpl_vars['newscon']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>
		      <div id="con_li_<?php echo $this->_foreach['name']['iteration']; ?>
" <?php if (! ($this->_foreach['name']['iteration'] <= 1)): ?>style="display:none"<?php endif; ?>>
              <p class="aaa"><a onclick="setsTab('li',<?php if ($this->_foreach['name']['iteration']+1 <= count($this->_tpl_vars['de']['imgs'])): ?><?php echo $this->_foreach['name']['iteration']+1; ?>
<?php else: ?>1<?php endif; ?>,<?php echo count($this->_tpl_vars['de']['imgs']); ?>
)""> <?php $_from = $this->_tpl_vars['de']['imgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['slist']):
        $this->_foreach['loop']['iteration']++;
?><?php if ($this->_foreach['name']['iteration'] == $this->_foreach['loop']['iteration']): ?><img src="<?php echo $this->_tpl_vars['slist']['name']; ?>
"><?php endif; ?><?php endforeach; endif; unset($_from); ?></a></p><?php echo ((is_array($_tmp=$this->_tpl_vars['list'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>

            </div>
			
         <?php endforeach; endif; unset($_from); ?>   
		 <i><?php echo $this->_tpl_vars['lang']['comer']; ?>
<?php echo $this->_tpl_vars['de']['source']; ?>
</i>
      </div>
      
      <div class="imgtab">
         	<table cellpadding="0" cellspacing="0" border="0" width="92%" style="margin:auto">
              <tr>
                <td><a id="pre" href="javascript:void(0)" ><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/btn_left.gif" /></a></td>
                <td>  
                    <div class="small_pic1">
                        <div class="small_pic_list1" id="imglist">
                            <ul>
                                <?php $_from = $this->_tpl_vars['de']['imgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>
                                    <li id="li<?php echo $this->_tpl_vars['list']['id']; ?>
" onclick="setsTab('li',<?php echo $this->_tpl_vars['list']['id']; ?>
,<?php echo count($this->_tpl_vars['de']['imgs']); ?>
)">
                                        <div>
                                            <a href="javascript:getinfo(<?php echo $this->_tpl_vars['list']['id']; ?>
)">
                                                <img src="<?php echo $this->_tpl_vars['list']['name']; ?>
">
                                                <span><?php echo $this->_tpl_vars['list']['id']; ?>
/<?php echo count($this->_tpl_vars['de']['imgs']); ?>
</span>
                                            </a>
                                        </div>
                                    </li>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                        </div>   
                    </div>
                </td>
                <td><a id="next" href="javascript:void(0);" ><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/btn_right.gif" /></a></td>
              </tr>
            </table>
       </div>
           

		    <!--新闻收藏等按钮-->
            <style>
			.commn{text-align:left; padding-left:220px; float:left; width:100%;padding-bottom:20px;}
			.commn a{width:120px;height:30px; float:left; padding-left:21px; line-height:20px;}
			</style>
			<div class="commn">
               <a style=" background:url(<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/fav.gif) no-repeat;" href="javascript:getfav();">&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['lang']['fav']; ?>
</a>
               <a style=" background:url(<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/print.gif) no-repeat;" href="javascript:printcontent();">&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['lang']['print']; ?>
&nbsp;</a>
			</div>
			<div style="clear:both;"></div>

            <?php if ($this->_tpl_vars['vote']): ?>
            <div class="vote bgw">
            <div class="vote_tit"><span><?php echo $this->_tpl_vars['lang']['survey']; ?>
</span></div>
            <div class="vote_con">
               <form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=vote&s=vote&id=<?php echo $_GET['id']; ?>
" method="post">
                <table width="100%" cellspacing="0" cellpadding="3" border="0" align="center">
                    <?php $_from = $this->_tpl_vars['vote']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>
                    <tr><td class="td1"><?php echo $this->_foreach['name']['iteration']; ?>
.<?php echo $this->_tpl_vars['list']['title']; ?>
 <?php if ($this->_tpl_vars['list']['end'] == 1): ?><font color="#FF0000">(<?php echo $this->_tpl_vars['lang']['closed']; ?>
)</font><?php endif; ?><?php if ($this->_tpl_vars['list']['ip'] == 1): ?><font color="#FF0000">(<?php echo $this->_tpl_vars['lang']['voted']; ?>
)</font><?php endif; ?></td></tr>
                    <?php $_from = $this->_tpl_vars['list']['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['slist']):
        $this->_foreach['loop']['iteration']++;
?>
                    <tr><td><?php if ($this->_tpl_vars['list']['end'] != 1 && $this->_tpl_vars['list']['ip'] != 1): ?><input type="<?php if ($this->_tpl_vars['list']['votetype'] == 0): ?>radio<?php else: ?>checkbox<?php endif; ?>" class="radio" value="<?php echo $this->_foreach['loop']['iteration']; ?>
" name="vote<?php echo $this->_tpl_vars['list']['id']; ?>
[]"><?php endif; ?><u><!--<?php echo $this->_foreach['loop']['iteration']; ?>
.--><?php echo $this->_tpl_vars['slist']['0']; ?>
</u></td></tr>
                    <?php endforeach; endif; unset($_from); ?>
                    <tr><td height="5"></td></tr>
                    <?php endforeach; endif; unset($_from); ?>
                    <tr><td class="td">
                        <input type="submit" value="<?php echo $this->_tpl_vars['lang']['vote']; ?>
" name="submit">&nbsp;&nbsp;
                        <input type="button" onClick="javascript:window.open('<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=vote&id=<?php echo $_GET['id']; ?>
')" value="<?php echo $this->_tpl_vars['lang']['view']; ?>
" name="button">
                    </td></tr>
                </table>
                </form>
            </div>
            </div>
            <?php endif; ?>  
       
       
			<?php if ($this->_tpl_vars['de']['ispl'] != 1): ?>
            <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'comment', 'ctype' => 1, 'cid' => $_GET['id'], 'temp' => 'comment_default')), $this); ?>

            <?php endif; ?>
</div>

<!--右边开始-->	

<div class="rightbar">
			<div class="right1">
				<div class="sectitle" >
					<div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['recread']; ?>
</div>
		        </div>
				 <div class="seccon">
					<ul class="ul1">
					  <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_default_list', 'rec' => 1, 'leng' => 100, 'limit' => 10)), $this); ?>

					  <div class="clear"></div>
				   </ul>
			    </div>
			  	<div class="bottom5"></div>
				</div>
			<div class="right1 m1">
				<div class="sectitle" ><div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['picnews']; ?>
</div></div>
				<div class="seccon" >
					   <ul class="ul1 pic_list">
					  <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_list_2', 'img' => 'true', 'leng' => 100, 'limit' => 10)), $this); ?>

					  <div class="clear"></div>
                    </ul> 
			    </div>
			  	<div class="bottom5"></div>
				<div class="clear"></div>
			</div>

</div>		
<!--右边结束-->
</div>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/Scroll1.js"></script>
<script language="javascript" type="text/javascript">
var Scroll= new Scroll("imglist","pre","next");
Scroll.Speed=50;
Scroll.IsSmoothScroll= false;
Scroll.PauseTime = 500000000;
Scroll.Direction = "E";
Scroll.Step =4;
Scroll.ControllerType = "click";
Scroll.BackCall = null;
Scroll.Init();
//Scroll.Start();
</script>