<?php /* Smarty version 2.6.20, created on 2013-05-29 21:59:07
         compiled from job_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'job_detail.htm', 18, false),array('insert', 'label', 'job_detail.htm', 90, false),)), $this); ?>
<script src="script/my_lightbox.js" language="javascript"></script>
<div class="menu_bottom L1">				
    <div class="headtop_L"><a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=job"><?php echo $this->_tpl_vars['lang']['jobme']; ?>
</a> &raquo; <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=job&s=job_list'><?php echo $this->_tpl_vars['lang']['joblist']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['job']['title']; ?>

    </div>
    <div class="headtop_R"></div>		
</div>

<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/<?php echo $this->_tpl_vars['config']['temp']; ?>
/job.css" rel="stylesheet" type="text/css" />

<div id="mainbody1" class="m1">
    <div class="job_left">
      <div>
       <table cellpadding="0" cellspacing="0" width="100%" border="0" class="job">
         <tr class="tr1">
            <td colspan="2"><?php echo $this->_tpl_vars['job']['company']; ?>
</td>
         </tr>
         <tr class="tr2">
           <td class="td1" colspan=2><?php echo $this->_tpl_vars['job']['title']; ?>
 [<?php echo $this->_tpl_vars['lang']['dps']; ?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['job']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
]</td>
         </tr>
         <tr class="tr3">
          <td colspan="2"  class="td1"><div>
             <table cellpadding="0" cellspacing="0" width="100%" border="0">
               <tr>
                 <td width="9%" class="borderR"><?php echo $this->_tpl_vars['lang']['zwxz']; ?>
:</td><td width="14%" class="borderR"><?php $_from = $this->_tpl_vars['lang']['pro_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['job']['properties']): ?><?php echo $this->_tpl_vars['list']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
				</tr>
				<tr>
                 <td width="9%" class="borderR"><?php echo $this->_tpl_vars['lang']['gzdq']; ?>
:</td><td width="18%" class="borderR"><?php echo $this->_tpl_vars['job']['addr']; ?>
</td>
				</tr>
				<tr>				 
                 <td width="9%" class="borderR"><?php echo $this->_tpl_vars['lang']['zprs']; ?>
:</td><td width="19%" class="borderR"><?php echo $this->_tpl_vars['job']['num']; ?>
<?php echo $this->_tpl_vars['lang']['people']; ?>
</td>
				</tr>
				<tr>				 
                 <td width="9%" class="borderR"><?php echo $this->_tpl_vars['lang']['sbyq']; ?>
:</td><td width="13%" class="borderR"><?php $_from = $this->_tpl_vars['lang']['sex_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['job']['sex']): ?><?php echo $this->_tpl_vars['list']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
               </tr>
               <tr>
                 <td class="borderR"><?php echo $this->_tpl_vars['lang']['yxrq']; ?>
:</td><td class="borderR"><?php echo $this->_tpl_vars['job']['valid']; ?>
<?php echo $this->_tpl_vars['lang']['day']; ?>
</td>
				</tr>
				<tr>				 
                 <td class="borderR"><?php echo $this->_tpl_vars['lang']['gzjy']; ?>
:</td><td class="borderR"><?php $_from = $this->_tpl_vars['lang']['year_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['job']['experience_years']): ?><?php echo $this->_tpl_vars['list']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
				</tr>
				<tr>				 
                 <td class="borderR"><?php echo $this->_tpl_vars['lang']['xlyq']; ?>
:</td><td class="borderR"><?php $_from = $this->_tpl_vars['lang']['degree_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['job']['degree']): ?><?php echo $this->_tpl_vars['list']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
				</tr>
				<tr>				 
                 <td class="borderR"><?php echo $this->_tpl_vars['lang']['yyyq']; ?>
:</td><td class="borderR"><?php $_from = $this->_tpl_vars['lang']['language_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['job']['language']): ?><?php echo $this->_tpl_vars['list']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
               </tr>
               <tr>
                 <td class="borderR"><?php echo $this->_tpl_vars['lang']['szfw']; ?>
:</td><td class="borderR"><?php $_from = $this->_tpl_vars['hrmoney']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['job']['salary']): ?><?php echo $this->_tpl_vars['list']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
				</tr>
				<tr>				 
                 <td class="borderR"><?php echo $this->_tpl_vars['lang']['hylb']; ?>
:</td><td class="borderR"><?php echo $this->_tpl_vars['job']['ctype']; ?>
</td>
				</tr>
				<tr>				 
                 <td class="borderR"><?php echo $this->_tpl_vars['lang']['zwlb']; ?>
:</td><td class="borderR"><?php echo $this->_tpl_vars['job']['catname']; ?>
</td>
				</tr>
				<tr>				 
                 <td class="borderR"><?php echo $this->_tpl_vars['lang']['nlyq']; ?>
:</td><td class="borderR"><?php $_from = $this->_tpl_vars['lang']['age_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['job']['age']): ?><?php echo $this->_tpl_vars['list']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
               </tr>
             </table></div>
          </td>
         </tr>
         <tr class="tr4" valign="bottom">
           <td colspan="2"><?php echo $this->_tpl_vars['lang']['zwms']; ?>
</td>
         </tr>
          <tr class="tr5">
           <td colspan="2"><?php echo $this->_tpl_vars['job']['con']; ?>
</td>
         </tr>
		 <?php if ($_COOKIE['USER'] != ''): ?>
         <tr class="tr6">
           <td colspan="2"><a onclick="alertWin('<?php echo $this->_tpl_vars['lang']['xzjl']; ?>
','',350,130,'<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=job&s=resume&id=<?php echo $_GET['id']; ?>
');" ><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/job_btn.png" /></a></td>
         </tr>
		 <?php endif; ?>	
       </table>
       </div>
     </div>
    
    <div class="job_right">

         <div id="box" class="job_cat">
             				<div class="nav_w">
					<div id="navleft_w">
						<ul>
							<li class="nav_w"><a href="main.php?action=m&m=job&s=admin_job&menu=usershop"><?php echo $this->_tpl_vars['lang']['add_vacancy_w']; ?>
</a><li>
							
						</ul>
					</div>	
				</div>
			 <b><?php echo $this->_tpl_vars['lang']['jobcats']; ?>
</b>
             
             <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'jobcat', 'temp' => 'jobcat')), $this); ?>

         </div>
    </div>
    
    <div class="clear"></div>
    
 
</div>
