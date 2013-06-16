<?php /* Smarty version 2.6.20, created on 2013-05-29 16:27:38
         compiled from job_index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'job_index.htm', 14, false),array('function', 'geturl', 'job_index.htm', 36, false),array('modifier', 'truncate', 'job_index.htm', 36, false),array('modifier', 'date_format', 'job_index.htm', 39, false),)), $this); ?>
<div class="menu_bottom L1">				
    <div class="headtop_L">
       <?php echo $this->_tpl_vars['lang']['you_are_here']; ?>
<a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['lang']['jobme']; ?>
</a>
    </div>
    <div class="headtop_R"></div>		
</div>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/<?php echo $this->_tpl_vars['config']['temp']; ?>
/job.css" rel="stylesheet" type="text/css" />
<div id="mainbody1" class="m1">
    <div class="job_left">
    	<div class="topleft">
           <div class="i_top"></div>
           <div class="i_bottom">
              <b><?php echo $this->_tpl_vars['lang']['newsjob']; ?>
</b>
              <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'job', 'temp' => 'job_index_list', 'limit' => 5)), $this); ?>

           </div>
        </div>
        <div class="topright">
        <script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=34&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
        </div>
        <div id="box" class="bottom">
            <div id="tits">
            <div><h3><?php echo $this->_tpl_vars['lang']['recjob']; ?>
</h3><a target="_blank"  href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=job&s=job_list"><?php echo $this->_tpl_vars['lang']['more']; ?>
</a></div>
            </div>
            <div id="cons">
            <table cellpadding="0" cellspacing="0" border="0">
             <tr id="tr">
                <td align="left"><?php echo $this->_tpl_vars['lang']['jobname']; ?>
</td>
                <td width="32%" align="left"><?php echo $this->_tpl_vars['lang']['comname']; ?>
</td>
                <td width="18%"><?php echo $this->_tpl_vars['lang']['address']; ?>
</td>
                <td width="16%"><?php echo $this->_tpl_vars['lang']['salary']; ?>
</td>
                <td width="14%"><?php echo $this->_tpl_vars['lang']['time']; ?>
</td>
             </tr>
             <?php $_from = $this->_tpl_vars['rechrlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>	
             <tr>
                <td class="borderC"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=job&s=job_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['list']['title']; ?>
</a></td>
                <td class="borderC"><a href="<?php echo smarty_function_geturl(array('type' => '','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user']), $this);?>
" target="_blank"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['company'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 24) : smarty_modifier_truncate($_tmp, 24)); ?>
</a></td>
                <td class="borderC" align="center"><?php echo $this->_tpl_vars['list']['province']; ?>
-<?php echo $this->_tpl_vars['list']['city']; ?>
</td>
                <td class="borderC" align="center"><?php $_from = $this->_tpl_vars['hrmoney']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['val']):
?><?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['list']['money']): ?><?php echo $this->_tpl_vars['val']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
                <td class="borderC" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
             </tr>  
             <?php endforeach; endif; unset($_from); ?>
            </table>
            </div>
         </div>
        
        <div id="box" class="bottom">
            <div id="tits">
            <div><h3><?php echo $this->_tpl_vars['lang']['recres']; ?>
</h3><a target="_blank"  href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=job&s=resume_list"><?php echo $this->_tpl_vars['lang']['more']; ?>
</a></div>
            </div>
             <div id="cons">
            <table cellpadding="0" cellspacing="0" border="0">
             <tr id="tr">
                <td align="left"><?php echo $this->_tpl_vars['lang']['name']; ?>
</td>
                <td width="32%" align="left"><?php echo $this->_tpl_vars['lang']['ep']; ?>
</td>
                <td width="18%"><?php echo $this->_tpl_vars['lang']['we']; ?>
</td>
                <td width="16%"><?php echo $this->_tpl_vars['lang']['qs']; ?>
</td>
                <td width="14%"><?php echo $this->_tpl_vars['lang']['time']; ?>
</td>
             </tr>
             <?php $_from = $this->_tpl_vars['resume']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>	
             <tr>
                <td class="borderC"><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=job&s=resume_detail&id=<?php echo $this->_tpl_vars['list']['rid']; ?>
"><?php echo $this->_tpl_vars['list']['uname']; ?>
</a></td>
                <td class="borderC"><?php echo $this->_tpl_vars['list']['catname']; ?>
</td>
                <td class="borderC" align="center"><?php echo $this->_tpl_vars['list']['experience_years']; ?>
<?php echo $this->_tpl_vars['lang']['year']; ?>
</td>
                <td class="borderC" align="center"><?php $_from = $this->_tpl_vars['hrmoney']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['val']):
?><?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['list']['money']): ?><?php echo $this->_tpl_vars['val']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
                <td class="borderC" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
             </tr>  
             <?php endforeach; endif; unset($_from); ?>
            </table></div>
        </div>
    </div>
	
	

    <div class="job_right">
				<div class="nav_w">
					<div id="navleft_w">
						<ul>
							<li class="nav_w"><a href="main.php?action=m&m=job&s=admin_job&menu=usershop"><?php echo $this->_tpl_vars['lang']['add_vacancy_w']; ?>
</a><li>
							<li class="nav_w"><a href="main.php?action=m&m=job&s=admin_resume&menu=user"><?php echo $this->_tpl_vars['lang']['add_resume_w']; ?>
</a><li>
						</ul>
					</div>	
				</div>
		    <div>
         	<div class="sectitle">
                 <h2><?php echo $this->_tpl_vars['lang']['jobvac']; ?>
</h2>
             </div>
             <div class="seccon">
               <form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/" method="get">
               <input type="hidden" name="m" value="<?php echo $_GET['m']; ?>
" />
               <input type="hidden" name="s" value="job_list" />
              <table cellpadding="0" cellspacing="0" border="0">
                  <tr><td width="28%" class="td1"><?php echo $this->_tpl_vars['lang']['industry']; ?>
</td><td><select name="comcat" id="comcat" style="font-size:11px;"><option value=""><?php echo $this->_tpl_vars['lang']['all']; ?>
</option><?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><option value="<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td></tr>
                  <tr><td class="td1"><?php echo $this->_tpl_vars['lang']['date']; ?>
</td><td><select name="jobdate" id="jobdate" style="font-size:11px;"> <?php $_from = $this->_tpl_vars['hrdropdate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><option value="<?php echo $this->_tpl_vars['num']; ?>
" <?php if ($this->_tpl_vars['num'] == $_GET['jobdate']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['list']; ?>
</option>
<?php endforeach; endif; unset($_from); ?></select></td></tr>
				  <tr><td class="td1"><?php echo $this->_tpl_vars['lang']['nature']; ?>
</td><td><?php $_from = $this->_tpl_vars['job_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
				  <input name="pro" type="radio" class="radio" value="<?php echo $this->_tpl_vars['num']; ?>
"/><u><?php echo $this->_tpl_vars['list']; ?>
</u><br /><?php endforeach; endif; unset($_from); ?></td></tr>
                   <tr><td class="td1"><?php echo $this->_tpl_vars['lang']['keyword']; ?>
</td><td><input type="text" name="keyword" class="input"/></td></tr>
                   <tr height="28" valign="bottom"><td></td><td><input style="font-size:11px;width:80px;" type="submit" value="<?php echo $this->_tpl_vars['lang']['search']; ?>
" /></td></tr>
               </table>
               </form>
            </div>
			
			
            <div class="b"></div>
         </div>


		    <div id="box">
			<div class="sectitle">
                 <h2><?php echo $this->_tpl_vars['lang']['jobres']; ?>
</h2>
             </div>
             <div class="seccon">
                 <form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/" method="get">
                 <input type="hidden" name="m" value="<?php echo $_GET['m']; ?>
" />
                 <input type="hidden" name="s" value="resume_list" />
               <table cellpadding="0" cellspacing="0" border="0">
                  <tr><td width="28%" class="td1"><?php echo $this->_tpl_vars['lang']['education']; ?>
</td><td><select name="degree" id="degree" style="font-size:11px;">
                  <option value="-1" ><?php echo $this->_tpl_vars['lang']['all']; ?>
</option><?php $_from = $this->_tpl_vars['degree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><option value="<?php echo $this->_tpl_vars['num']; ?>
" ><?php echo $this->_tpl_vars['list']; ?>
</option>
<?php endforeach; endif; unset($_from); ?></select></td></tr>
                  <tr><td class="td1"><?php echo $this->_tpl_vars['lang']['date']; ?>
</td><td><select name="jobdate" id="jobdate" style="font-size:11px;"> <?php $_from = $this->_tpl_vars['hrdropdate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><option value="<?php echo $this->_tpl_vars['num']; ?>
" <?php if ($this->_tpl_vars['num'] == $_GET['jobdate']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['list']; ?>
</option>
<?php endforeach; endif; unset($_from); ?></select></td></tr>
				  <tr><td class="td1"><?php echo $this->_tpl_vars['lang']['nature']; ?>
</td><td><?php $_from = $this->_tpl_vars['job_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                  <input type="radio" class="radio" value="<?php echo $this->_tpl_vars['num']; ?>
" name="pro"/><u><?php echo $this->_tpl_vars['list']; ?>
</u><br /><?php endforeach; endif; unset($_from); ?></td></tr>
                   <tr><td class="td1"><?php echo $this->_tpl_vars['lang']['sex']; ?>
</td><td>
                   <input type="radio" name="sex" class="radio" value="0" /><u><?php echo $this->_tpl_vars['lang']['male']; ?>
</u>
                   <input type="radio" name="sex" class="radio" value="1" /><u><?php echo $this->_tpl_vars['lang']['female']; ?>
</u></td></tr>
                   <tr height="28" valign="bottom"><td></td><td><input style="font-size:11px;width:80px;" type="submit" value="<?php echo $this->_tpl_vars['lang']['search']; ?>
" /></td></tr>
               </table>
               </form>
            </div>
			
            <div class="b"></div>
         </div>
         <div id="box" class="job_cat">
         	<div class="sectitle">
                 <h2><?php echo $this->_tpl_vars['lang']['jobcats']; ?>
</h2>
                 
             </div>
             <div class="seccon">
             	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'jobcat', 'temp' => 'jobcat')), $this); ?>

             </div>
         </div>
    </div>	
	
    
</div>