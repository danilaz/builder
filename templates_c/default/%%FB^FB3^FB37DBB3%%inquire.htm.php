<?php /* Smarty version 2.6.20, created on 2013-01-22 02:55:01
         compiled from inquire.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_select_date', 'inquire.htm', 54, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; Предложения
    </div>
    <div class="headtop_R"></div>		
</div>

<style>
.topm td{padding:5px; line-height:22px;}
</style>
<script type="text/javascript" src="script/Validator.js"></script>
<div id="mainbody1" class="topm">
  <form id="login" name="login" action="" method="post" onSubmit="return Validator.Validate(this,3)">
  <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#cfcfcf">

  <?php if ($_GET['type'] == 1): ?>
  <tr><td height="100" bgcolor="#FFFFFF">Сообщение успешно отправлено!</td></tr>
  <?php else: ?>
  <tr>
    <td width="14%" align="right" bgcolor="#FFFFFF"><strong>Получатель:</strong></td>
    <td width="86%" align="left" bgcolor="#FFFFFF">
    <?php $_from = $this->_tpl_vars['receive']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
    <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['user']; ?>
(<?php echo $this->_tpl_vars['list']['company']; ?>
)</a><br />
    <input name="toid[]" type="hidden" value="<?php echo $this->_tpl_vars['list']['userid']; ?>
" />
    <?php endforeach; endif; unset($_from); ?>    </td>
  </tr>
  <tr>
    <td height="24" align="right" bgcolor="#FFFFFF"><strong>* Название:</strong></td>
    <td align="left" bgcolor="#FFFFFF">
      <input name="contype" type="hidden" value="<?php echo $_GET['contype']; ?>
" />
      <input name="tid" type="hidden" value="<?php echo $_GET['pid']; ?>
" />
      <input style="width:300px;" type="text" name="sub" id="sub" dataType="Require" msg="Пожалуйста, укажите название сообщения" /></td>
  </tr>
  <tr>
    <td height="82" align="right" bgcolor="#FFFFFF"><strong>* Подробности:</strong></td>
    <td align="left" bgcolor="#FFFFFF">
      <span style="color:#999999">Characters Remaining: 0 / 2000 (Min. 20)</span><br />
      <textarea name="con" id="con" cols="45" rows="5" dataType="Require" msg="Пожалуйста, заполните содержание сообщения!" ></textarea>    </td>
  </tr>
  <tr>
    <td height="27" align="right" bgcolor="#FFFFFF"><strong>Содержание: </strong></td>
    <td align="left" bgcolor="#FFFFFF">
    <?php $_from = $this->_tpl_vars['receive_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
    <input name="receive_type[]" type="checkbox" value="<?php echo $this->_tpl_vars['list']; ?>
" /><?php echo $this->_tpl_vars['list']; ?>

    <?php if (( $this->_tpl_vars['num']+1 ) % 3 == 0): ?><br /><?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    </td>
  </tr>
  <tr>
    <td height="44" align="right" bgcolor="#FFFFFF"><strong>Срочность</strong></td>
    <td align="left" bgcolor="#FFFFFF">
    <input type="checkbox" name="ask_reply" value="1" id="checkbox" />
    Прошу ответить мне <?php echo smarty_function_html_select_date(array('end_year' => '2015','month_format' => '%m','field_order' => 'YMD','time' => $this->_tpl_vars['time']), $this);?>
</td>
  </tr>
  <tr>
    <td height="44" align="right" bgcolor="#FFFFFF"><strong>* Проверочный код:</strong></td>
    <td align="left" bgcolor="#FFFFFF">
    
    <input type='text' name='yzm' id="yzm"  size="25"  tabindex="3" height="50" class="tstyle" dataType="Require" msg="Пожалуйста, укажите проверочный код"  style="width:100px; <?php if ($_GET['etype'] == 1): ?>border:3px solid #FF0000<?php endif; ?>"/>
    <img onclick="get_randfunc(this);" style="padding-left:5px; cursor:pointer; vertical-align:middle;" src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/includes/rand_func.php'/>    </td>
  </tr>
  <?php if ($this->_tpl_vars['buid']): ?>
  <tr>
    <td height="23" align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="left" bgcolor="#FFFFFF">
    Убедитесь, что Ваша контактная информация верна. <a target="_blank" href="main.php?menu=user&action=myshop">Нажмите здесь, чтобы просмотреть или изменить</a>.
    </td>
  </tr>
  <?php else: ?>
  <tr>
      <td colspan="2" align="left">Для отправки сообщения необходимо авторизироваться на сайте!</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF">*Контактное лицо</td>
    <td align="left" bgcolor="#FFFFFF"><input dataType="Require" msg="Пожалуйста, заполните контактную информацию!"  style="width:200px;" type="text" name="name" id="name" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF">*Название компании</td>
    <td align="left" bgcolor="#FFFFFF"><input dataType="Require" msg="Пожалуйста, укажите название компании и заполните личные данные!"  style="width:300px;" type="text" name="company" id="company" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF">*Страна</td>
    <td align="left" bgcolor="#FFFFFF">
       <select name="country" id="country" class="input" style="width:300px;">
        <?php $_from = $this->_tpl_vars['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
        <option value="<?php echo $this->_tpl_vars['list']['name']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
      </select>
    </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF">*Область</td>
    <td align="left" bgcolor="#FFFFFF">
    <input dataType="Require" msg="Пожалуйста, укажите область!"  style="width:300px;" type="text" name="province" id="province" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF">*Город</td>
    <td align="left" bgcolor="#FFFFFF">
    <input dataType="Require" msg="Пожалуйста, укажите город!"  style="width:300px;" type="text" name="city" id="city" />
    </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF">*Адрес</td>
    <td align="left" bgcolor="#FFFFFF">
    <input dataType="Require" msg="Пожалуйста, укажите адрес!" style="width:300px;" type="text" name="addr" id="addr" />
    </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF">Почтовый индекс</td>
    <td align="left" bgcolor="#FFFFFF"><input name="post" type="text" id="post" size="8" /></td>
  </tr>
  <tr>
      <td align="right" bgcolor="#FFFFFF">*Телефон</td>
      <td align="left" bgcolor="#FFFFFF">
        <input style="width:300px;" dataType="Require" msg="Пожалуйста, укажите телефон!"  name="tell" type="text" id="tell" size="4" />
	 </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF">Факс</td>
    <td align="left" bgcolor="#FFFFFF">
    <input style="width:300px;"  name="fax" type="text" id="fax" />
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF">Мобильный</td>
    <td align="left" bgcolor="#FFFFFF"><input style="width:300px;" type="text" name="mobile" id="mobile" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF">*Email</td>
    <td align="left" bgcolor="#FFFFFF">
    <input  dataType="Require" msg="Пожалуйста, укажите email!" style="width:300px;" type="text" name="email" id="email" />
    </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF">Веб-сайт</td>
    <td align="left" bgcolor="#FFFFFF">
      <input style="width:300px;" name="url" type="text" id="url" value="http://" />
      </td>
  </tr>
  <?php endif; ?>

  <tr>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="left" bgcolor="#FFFFFF"><input type="submit" name="submit" id="button" value="Отправить " /></td>
  </tr>
  <?php endif; ?>
</table>
  </form>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>