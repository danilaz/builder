<?php /* Smarty version 2.6.20, created on 2013-01-12 19:22:10
         compiled from feedback.htm */ ?>

	<?php if ($_GET['stype'] == 1): ?>
			<div style="height:300px; text-align:center; font-weight:600; color:green; font-size:14px; padding-top:100px;">
				<?php echo $this->_tpl_vars['lang']['mes_suc']; ?>

			</div>
		<?php else: ?>
    <script type="text/javascript" src="script/Validator.js"></script>
	<form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/aboutus.php" method="post" onSubmit="return Validator.Validate(this,3)">
	<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#F2F9FF">
      <tr >
        <td width="17%" height="30" align="left" bgcolor="#FFFFFF"  ><?php echo $this->_tpl_vars['lang']['com_name']; ?>
</td>
        <td width="83%" height="30" bgcolor="#FFFFFF">
		<input type="text" name="company" value="<?php echo $this->_tpl_vars['com']['company']; ?>
<?php echo $_POST['company']; ?>
" style="width:300px;" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['pls_com_name']; ?>
" /></td>
      </tr>
      <tr >
        <td width="17%" height="30" align="left" bgcolor="#FFFFFF"  ><?php echo $this->_tpl_vars['lang']['conect_name']; ?>
</td>
        <td height="30" bgcolor="#FFFFFF" ><input type="text" name="contact" value="<?php echo $this->_tpl_vars['com']['contact']; ?>
" style="width:300px;" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['pls_name']; ?>
" />        </td>
      </tr>
      <tr >
        <td width="17%" height="30" align="left" bgcolor="#FFFFFF"  ><?php echo $this->_tpl_vars['lang']['email']; ?>
</td>
        <td height="30" bgcolor="#FFFFFF" ><input type="text" name="email" value="<?php echo $this->_tpl_vars['com']['email']; ?>
"  style="width:300px;" dataType="Email" msg="<?php echo $this->_tpl_vars['lang']['pls_email']; ?>
" />        </td>
      </tr>
      <tr >
        <td height="26" align="left" bgcolor="#FFFFFF"  ><?php echo $this->_tpl_vars['lang']['tell']; ?>
</td>
        <td bgcolor="#FFFFFF" >
          <input type="text" name="tell" id="tell" value="<?php echo $this->_tpl_vars['com']['tell']; ?>
" style="width:300px;" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['pls_tell']; ?>
"/>        </td>
      </tr>
      <tr >
        <td height="27" align="left" bgcolor="#FFFFFF"  ><?php echo $this->_tpl_vars['lang']['addr']; ?>
</td>
        <td bgcolor="#FFFFFF" ><input type="text" name="addr" value="<?php echo $this->_tpl_vars['com']['addr']; ?>
" id="addr" style="width:300px;" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['pls_addr']; ?>
"/></td>
      </tr>
      <tr >
        <td width="17%" align="left" bgcolor="#FFFFFF"  ><?php echo $this->_tpl_vars['lang']['you_qus']; ?>
</td>
        <td bgcolor="#FFFFFF" ><textarea name="mes" style="width:400px;" rows="12" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['pls_qus']; ?>
"></textarea>        </td>
      </tr>
      <tr >
        <td height="30" align="left" bgcolor="#FFFFFF"  ><?php echo $this->_tpl_vars['lang']['rand_func']; ?>
</td>
        <td height="30" bgcolor="#FFFFFF" ><img src='includes/rand_func.php'/>
          <input dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['pls_rand']; ?>
" name="yzm" type="text" id="yzm" size="4" />
		  <?php if ($_GET['stype'] == 2): ?><font color="red"><?php echo $this->_tpl_vars['lang']['err_rand']; ?>
</font><?php endif; ?>
	    </td>
      </tr>
	  <?php if ($this->_tpl_vars['config']['user_reg_verf']): ?>
      <tr >
        <td align="left" bgcolor="#FFFFFF">Проверочный вопрос</td>
        <td bgcolor="#FFFFFF">
		<?php echo $this->_tpl_vars['qut']; ?>
<br />
		<input name="ckyzwt" type="text" id="ckyzwt" class="input" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['pls_qus']; ?>
" />
		<?php if ($_GET['stype'] == 3): ?><br /><font color="red"><?php echo $this->_tpl_vars['lang']['err_randqut']; ?>
</font><?php endif; ?>
		</td>
      </tr>
	  <?php endif; ?>
      <tr >
        <td width="17%" bgcolor="#FFFFFF"  ></td>
        <td bgcolor="#FFFFFF" ><input type="submit" name="cc" value="<?php echo $this->_tpl_vars['lang']['submit']; ?>
" />
          <input name="submit" type="hidden" id="submit" value="submit" /></td>
      </tr>
    </table>
	</form>
	<?php endif; ?>