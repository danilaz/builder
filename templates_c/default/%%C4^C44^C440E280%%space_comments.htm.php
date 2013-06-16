<?php /* Smarty version 2.6.20, created on 2013-01-12 15:49:18
         compiled from space_comments.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'space_comments.htm', 121, false),)), $this); ?>
<script type="text/javascript">
function checkvalue()
{
	 if (document.fortopm.description.value=="")
		{ 
         alert("<?php echo $this->_tpl_vars['lang']['comments_nocontent']; ?>
") 
         return false;  
        }  
     else 
		 {return true;} 

}
</script>
<div class="common_box">
<?php if ($_GET['type'] == 1): ?>
	<div style="height:200px; padding:50px;"><?php echo $this->_tpl_vars['lang']['comments_msg']; ?>
</div>
<?php else: ?>
<form method="post" action="" name="fortopm">
 <?php if ($_COOKIE['USER']): ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
         <td class="guide_ba" colspan="3"><span><?php echo $this->_tpl_vars['lang']['comments_option']; ?>
</span></td>
          </tr>
         <?php $_from = $this->_tpl_vars['liebiao']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['lb']):
?>
        <tr>
          <td width="6%" height="20">&nbsp;</td>
          <td width="27%" height="20"><?php echo $this->_tpl_vars['key']+1; ?>
:<?php echo $this->_tpl_vars['lb']['name']; ?>
</td>
          <td width="67%">
          <?php if ($this->_tpl_vars['lb']['subcat']['0']['name'] == ''): ?>
                 <select name="point[<?php echo $this->_tpl_vars['lb']['id']; ?>
]" id="<?php echo $this->_tpl_vars['lb']['id']; ?>
">
				 <option value="0">0<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
				 <option value="10">10<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
				 <option value="20">20<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
				 <option value="30">30<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="40">40<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="50">50<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="60">60<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="70">70<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="80">80<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="90">90<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="100" selected>100<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 </select>
            <?php endif; ?>             </td>
          </tr>
            <?php $_from = $this->_tpl_vars['lb']['subcat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['zlb']):
?>
            <tr>
              <td height="20">&nbsp;</td>
              <td height="20" style="padding-left:20px;"><?php echo $this->_tpl_vars['zlb']['name']; ?>
</td>
              <td>
			     <select name="point[<?php echo $this->_tpl_vars['zlb']['id']; ?>
]" id="<?php echo $this->_tpl_vars['zlb']['id']; ?>
">
				 <option value="0">0<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
				 <option value="10">10<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
				 <option value="20">20<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
				 <option value="30">30<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="40">40<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="50">50<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="60">60<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="70">70<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="80">80<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="90">90<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 <option value="100" selected>100<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
</option>
                 </select>			  </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        <?php endforeach; endif; unset($_from); ?> 
        <tr>
          <td height="21" colspan="3"><?php echo $this->_tpl_vars['lang']['comments_descript']; ?>
</td>
          </tr>
        <tr>
        <td height="88">&nbsp;</td>
        <td height="88" colspan="2">
          <textarea name="description" id="description" cols="45" rows="5"></textarea>        </td>
        </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td height="20" colspan="2">
		  <input type="submit" name="submit" id="submit" value="<?php echo $this->_tpl_vars['lang']['comments_submit']; ?>
" onclick="return checkvalue();" <?php if ($this->_tpl_vars['uname']['user'] == $_COOKIE['USER']): ?>disabled<?php endif; ?>/>
		  <input type="hidden" name="touid" id="touid" value="<?php echo $_GET['uid']; ?>
" />		  </td>
        </tr>
    </table>
     <?php endif; ?>
     
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> <td class="guide_ba" colspan="3"><span><?php echo $this->_tpl_vars['lang']['comments_results']; ?>
</span></td></tr>
        <?php $_from = $this->_tpl_vars['liebiao']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['lb']):
?>
        <tr>
          <td width="6%" height="20">&nbsp;</td>
          <td width="25%" height="20"><?php echo $this->_tpl_vars['key']+1; ?>
:<?php echo $this->_tpl_vars['lb']['name']; ?>
</td>
          <td width="69%">
          <?php if ($this->_tpl_vars['lb']['subcat']['0']['name'] == ''): ?>
		       <?php if ($this->_tpl_vars['lb']['point'] == ''): ?>
               <?php echo $this->_tpl_vars['lang']['comments_noponit']; ?>

		       <?php else: ?>
               <?php echo $this->_tpl_vars['lb']['point']; ?>
<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>

			    <?php endif; ?>
            <?php endif; ?>          </td>
        </tr>
        <?php $_from = $this->_tpl_vars['lb']['subcat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['zlb']):
?>
        <tr>
          <td height="20">&nbsp;</td>
          <td height="20" style="padding-left:20px;"><?php echo $this->_tpl_vars['zlb']['name']; ?>
</td>
          <td>
          <?php if ($this->_tpl_vars['zlb']['point'] == ''): ?>
          <?php echo $this->_tpl_vars['lang']['comments_noponit']; ?>

		  <?php else: ?>
          <?php echo $this->_tpl_vars['zlb']['point']; ?>
<?php echo $this->_tpl_vars['lang']['comments_ponit']; ?>
 <?php endif; ?></td>
        </tr>
           <?php endforeach; endif; unset($_from); ?>
        <?php endforeach; endif; unset($_from); ?> 
        <tr>
          <td height="19" colspan="3"><strong><?php echo $this->_tpl_vars['lang']['all_comments']; ?>
</strong><hr/></td>
          </tr>
        <tr>
          <td height="56">&nbsp;</td>
          <td height="56" colspan="2" valign="top">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
            <?php $_from = $this->_tpl_vars['des']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['deslist']):
?>
              <tr>
                <th width="15%" scope="col" style="border-bottom: 1px dotted #999999;"><a href='shop.php?uid=<?php echo $this->_tpl_vars['deslist']['uid']; ?>
'><?php echo $this->_tpl_vars['deslist']['user']; ?>
</a> </th>
                <th width="70%" scope="col" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['deslist']['con']; ?>
</th>
                <th width="15%" scope="col" style="border-bottom: 1px dotted #999999;"><?php echo ((is_array($_tmp=$this->_tpl_vars['deslist']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</th>
              </tr>
              <?php endforeach; endif; unset($_from); ?> 
              <tr>
                <th colspan="3" align="right"><?php echo $this->_tpl_vars['des']['page']; ?>
</th>
                </tr>
            </table>            </td>
          </tr>
      </table>
</form>
<?php endif; ?> 
</div>