<?php /* Smarty version 2.6.20, created on 2013-05-29 15:49:50
         compiled from resume_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'resume_list.htm', 31, false),array('insert', 'label', 'resume_list.htm', 79, false),)), $this); ?>
<div class="menu_bottom L1">				
    <div class="headtop_L">
       <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=job'><?php echo $this->_tpl_vars['lang']['jobme']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['lang']['resumelist']; ?>

    </div>
    <div class="headtop_R"></div>		
</div>

<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/<?php echo $this->_tpl_vars['config']['temp']; ?>
/job.css" rel="stylesheet" type="text/css" />

<div id="mainbody1" class="m1">
    <div class="job_left">
    	<div class="bottom">
            <div id="tits">
            <div><h3><?php echo $this->_tpl_vars['lang']['resumelist']; ?>
</h3></div>
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
             <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>	
             <tr>
                <td><a target="_blank"  href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=job&s=resume_detail&id=<?php echo $this->_tpl_vars['list']['rid']; ?>
"><?php echo $this->_tpl_vars['list']['uname']; ?>
</a></td>
                <td><?php echo $this->_tpl_vars['list']['catname']; ?>
</td>
                <td align="center"><?php echo $this->_tpl_vars['list']['experience_years']; ?>
</td>
                <td align="center"><?php $_from = $this->_tpl_vars['hrmoney']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['val']):
?><?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['list']['money']): ?><?php echo $this->_tpl_vars['val']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
                <td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
             </tr>  
             <?php endforeach; endif; unset($_from); ?>
            </table>
           <div class="page"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>
           <div class="clear"></div>
            </div>
        </div>
    </div>  
    
    <div class="job_right">
					<div class="nav_w">
					<div id="navleft_w">
						<ul>
							
							<li class="nav_w"><a href="main.php?action=m&m=job&s=admin_resume&menu=user"><?php echo $this->_tpl_vars['lang']['add_resume_w']; ?>
</a><li>
						</ul>
					</div>	
				</div>
		    <div class="job_cat">
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
:</td><td><select name="degree" id="degree" style="font-size:11px;"><option value="-1" style="font-size:11px;"><?php echo $this->_tpl_vars['lang']['all']; ?>
</option><?php $_from = $this->_tpl_vars['degree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><option <?php if ($_GET['degree'] == $this->_tpl_vars['num']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['num']; ?>
" ><?php echo $this->_tpl_vars['list']; ?>
</option>
<?php endforeach; endif; unset($_from); ?></select></td></tr>
                  <tr><td class="td1"><?php echo $this->_tpl_vars['lang']['date']; ?>
:</td><td><select name="jobdate" id="jobdate" style="font-size:11px;"> <?php $_from = $this->_tpl_vars['hrdropdate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><option value="<?php echo $this->_tpl_vars['num']; ?>
" <?php if ($this->_tpl_vars['num'] == $_GET['jobdate']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['list']; ?>
</option>
<?php endforeach; endif; unset($_from); ?></select></td></tr>
				  <tr><td class="td1"><?php echo $this->_tpl_vars['lang']['nature']; ?>
:</td><td><?php $_from = $this->_tpl_vars['job_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><input type="radio" class="radio" value="<?php echo $this->_tpl_vars['num']; ?>
" name="pro" <?php if ($this->_tpl_vars['num'] == $_GET['pro']): ?>checked="checked"<?php endif; ?> /><u><?php echo $this->_tpl_vars['list']; ?>
</u><br /><?php endforeach; endif; unset($_from); ?></td></tr>
                   <tr><td class="td1"><?php echo $this->_tpl_vars['lang']['sex']; ?>
:</td><td>
                   <input type="radio" name="sex" class="radio" <?php if ($_GET['sex'] == 0): ?> checked="checked"<?php endif; ?> value="0" /><u><?php echo $this->_tpl_vars['lang']['male']; ?>
</u>
                   <input type="radio" name="sex" class="radio" <?php if ($_GET['sex'] == 1): ?> checked="checked"<?php endif; ?> value="1" /><u><?php echo $this->_tpl_vars['lang']['female']; ?>
</u></td></tr>
                   <tr height="28" valign="bottom"><td></td><td><input type="submit" value="<?php echo $this->_tpl_vars['lang']['search']; ?>
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