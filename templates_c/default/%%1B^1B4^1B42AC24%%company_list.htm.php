<?php /* Smarty version 2.6.20, created on 2013-01-12 15:19:19
         compiled from company_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'company_list.htm', 53, false),array('insert', 'getUser', 'company_list.htm', 171, false),array('modifier', 'urlencode', 'company_list.htm', 87, false),array('function', 'html_image', 'company_list.htm', 105, false),array('function', 'geturl', 'company_list.htm', 112, false),)), $this); ?>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/<?php echo $this->_tpl_vars['config']['temp']; ?>
/company.css" rel="stylesheet" type="text/css" />
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=company'><?php echo $this->_tpl_vars['lang']['comcat']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['guide']; ?>

    </div>
    <div class="headtop_R"></div>		
</div>
<script>
function do_select()
{
	 var box_l = document.getElementsByName("inquery").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
		if(document.getElementsByName("inquery")[j].checked==true)
		  document.getElementsByName("inquery")[j].checked = false;
		else
		  document.getElementsByName("inquery")[j].checked = true;
	 }
}
function goto()
{
	window.location='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=company&s=company_list&ct='+$('companyType').value;
}
function get_inquery()
{	
	var pid='';
	var boxes = document.getElementsByName("inquery");   
	for (var i = 0; i < boxes.length; i++)  
	{  
		if(boxes[i].checked)  
		{  
			pid+=boxes[i].value+',';  
		} 
	}
	window.location='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/inquire.php?contype=3&userid='+pid;
}
</script> 
	<div id="mainbody1" class="m1">
   <div class="navigation">
<?php if ($this->_tpl_vars['subcat']['0']['cat']): ?>
			<div class="title4"><div class="title_left2 L2"><?php echo $this->_tpl_vars['lang']['com_nav']; ?>
</div></div>
				<div class="content4" >
					<ul class="nav_list" style="padding-left:10px;">
					 <?php $_from = $this->_tpl_vars['subcat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cList']):
?>
                      <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=company&s=company_list&id=<?php echo $this->_tpl_vars['cList']['catid']; ?>
"><?php echo $this->_tpl_vars['cList']['cat']; ?>
 (<?php echo $this->_tpl_vars['cList']['rec_nums']; ?>
)</a>
					<?php endforeach; endif; unset($_from); ?>
				   </ul>
                   <div class="clear"></div>
			    </div>
		<?php endif; ?>
  <div class="title4"><div class="title_left2 L2"><?php echo $this->_tpl_vars['lang']['province']; ?>
</div></div>
			<div class="content4 overflow">
            	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'province', 'temp' => 'province_company')), $this); ?>

				<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=20&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
            </div>
			
	
   </div>	
		<div class="leftbar">
		  
		<div class="title4 m1">
        <div class="title_left2 L2"><?php echo $this->_tpl_vars['lang']['user_list']; ?>
</div>
        <div class="lookmore">
            <?php if ($this->_tpl_vars['config']['domaincity'] && $this->_tpl_vars['config']['base_url']): ?>
                <a href="http://www.<?php echo $this->_tpl_vars['config']['base_url']; ?>
/?m=company&s=company_list&id=<?php echo $_GET['id']; ?>
/"><?php echo $this->_tpl_vars['lang']['lookmore']; ?>
<?php echo $this->_tpl_vars['current_cat']; ?>
</a>
            <?php endif; ?>
        </div>
        </div>
		<div class="content4 overflow">	   
			<div class="comlist">
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" style="border-bottom:1px dashed #DDDDDD; padding-left:10px;">
                      <?php if ($this->_tpl_vars['info']['list']['0']['userid']): ?>
                          <div style="padding:7px 7px 7px 0px;">
                          <input onclick="do_select();" name="" type="checkbox" value="" />&nbsp;
                          <input onclick="get_inquery();" name="" type="button" value="Связаться" />
                          <input onclick="add_inquery('com','<?php echo $this->_tpl_vars['config']['weburl']; ?>
','');" name="" type="button" value="Добавить в рассылку" />
                          </div>
                      <?php endif; ?>
                </td>
                <td align="right" style="border-bottom:1px dashed #DDDDDD; padding-right:40px;">
                
                <select id="companyType" onchange="goto();" name="companyType">
                <option value="">Все</option>
                <?php $_from = $this->_tpl_vars['companyType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['clist']):
?>
                <?php if ($_GET['ct'] == $this->_tpl_vars['clist']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['clist']; ?>
"><?php echo $this->_tpl_vars['clist']; ?>
<option <?php if ($_GET['ct'] == $this->_tpl_vars['clist']): ?>selected="selected"<?php endif; ?> value="<?php echo ((is_array($_tmp=$this->_tpl_vars['clist'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
"><?php echo $this->_tpl_vars['clist']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
                </select>
                </td>
              </tr>
            </table>
			<style>
			.comlist span{float:left;height:21px;overflow:hidden;width:200px;color:#737277;}
			.comlist .span1{}
			.comlist .span2{}
			.comlist .span3{}
			</style>
			
				<?php $_from = $this->_tpl_vars['info']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
				<div class="comdetail">
                    <div class="comright" style="padding-top:10px;"><input name="inquery" type="checkbox" value="<?php echo $this->_tpl_vars['list']['userid']; ?>
" /></div>
<div class="Lb1">
					     <?php $this->assign('img', $this->_tpl_vars['list']['logo']); ?>
                		 <?php echo smarty_function_html_image(array('file' => "uploadfile/userimg/".($this->_tpl_vars['img']),'width' => 85,'alt' => $this->_tpl_vars['list']['pname']), $this);?>

						 <br />
                         [<?php echo $this->_tpl_vars['list']['province']; ?>
-<?php echo $this->_tpl_vars['list']['city']; ?>
]<br />
						 
					</div>
					<div class="comright">
						<p class="com_name">
							<a target="_blank" href="<?php echo smarty_function_geturl(array('type' => '','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user'],'tid' => '','com' => $this->_tpl_vars['list']['company']), $this);?>
"><?php echo $this->_tpl_vars['list']['company']; ?>
</a>
							
							<?php if ($this->_tpl_vars['list']['country']): ?>
							<img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/cflag/<?php echo $this->_tpl_vars['list']['country']; ?>
.gif" />
							<?php endif; ?>
							
							<?php if ($this->_tpl_vars['list']['video']): ?>
							<img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/ico_video.gif" border="0" align="absmiddle" />
							<?php endif; ?>
							<?php echo $this->_tpl_vars['list']['user_type']; ?>

                        </p>


                

						<div class="comlist">
                                                
						<p>Вид деятельности: <?php echo $this->_tpl_vars['list']['ctype']; ?>
</p>
                                               <!--
						<p class="span1">Сотрудников: <?php echo $this->_tpl_vars['list']['staff_num']; ?>
</p>
						
						<?php if ($this->_tpl_vars['list']['registered_capital'] !== ''): ?>
						<pclass="span1">Уставный капитал: <?php echo $this->_tpl_vars['list']['registered_capital']; ?>
</p>
						<?php else: ?>
						Уставный капитал: 0
						<?php endif; ?>
                                               -->
						<p>Контактный телефон: <?php echo $this->_tpl_vars['list']['tel']; ?>
</p>
						<p class="span1">Контактное лицо: <?php echo $this->_tpl_vars['list']['contact']; ?>
</p>
						<p class="span1"></p>
						<p class="span2">Адрес компании: <?php echo $this->_tpl_vars['list']['addr']; ?>
</p>
						<p class="span3">Основная продукция: </p>
						<?php echo $this->_tpl_vars['list']['main_pro']; ?>
<br />
						<a href="<?php echo smarty_function_geturl(array('type' => 'prolist','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user']), $this);?>
"><?php echo $this->_tpl_vars['lang']['rel_pro']; ?>
</a> |
						<a href="<?php echo smarty_function_geturl(array('type' => 'mail','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user']), $this);?>
"><?php echo $this->_tpl_vars['lang']['email_requir']; ?>
</a>
						</div>
					</div>
                    </div>

				<?php endforeach; else: ?>
				  <div style="padding:20px; font-weight:bold">
				  <?php echo $this->_tpl_vars['lang']['no_cominfo']; ?>
 
				  <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/<?php echo $this->_tpl_vars['config']['regname']; ?>
">
				   <?php echo $this->_tpl_vars['lang']['reg_user']; ?>

				  </a>
				  </div>
				<?php endif; unset($_from); ?>
			   <div class="page"><?php echo $this->_tpl_vars['info']['pages']; ?>
</div>
		   </div>
		</div>
		</div>
		<!--  会员列表结束 -->
		<!--主体右侧开始 -->
		<div class="rightbar">
			<div class="right1">
				<div class="sectitle" ><div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['vip_user']; ?>
</div></div>
				 <div class="seccon">
					<ul class="li_list">
						<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=21&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
					 	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getUser', 'field' => 'company', 'filter' => 'star', 'leng' => '200', 'limit' => '12')), $this); ?>

				   </ul>
                   <div class="clear"></div>
			    </div>
				</div>
			<div class="right1 m1">
				<div class="sectitle"><div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['last_reg']; ?>
</div></div>
				<div class="seccon" >
					<ul class="li_list">
					 	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getUser', 'field' => 'company', 'leng' => '200', 'limit' => '12')), $this); ?>

				   </ul>
                   <div class="clear"></div>
			    </div>
				<div class="clear"></div>
			</div>
		</div>		
		<!--主体右侧结束 -->
</div>