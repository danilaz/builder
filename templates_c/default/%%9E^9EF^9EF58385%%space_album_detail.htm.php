<?php /* Smarty version 2.6.20, created on 2013-01-13 05:59:35
         compiled from space_album_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_image', 'space_album_detail.htm', 7, false),)), $this); ?>
<div class="common_box" style="height:800px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr align="left"><td colspan="2" class="guide_ba"><?php echo $this->_tpl_vars['lang']['album_detail']; ?>
</td></tr>
    <tr>
      <td width="12%" height="40"> 
          <?php $this->assign('imgs', $this->_tpl_vars['de']['album_detail']['id']); ?>
          <?php echo smarty_function_html_image(array('file' => "uploadfile/catimg/size_small/".($this->_tpl_vars['imgs']).".jpg",'width' => 100,'alt' => ($this->_tpl_vars['de']).".album_detail.name"), $this);?>

      </td>
      <td width="88%" valign="top">
      <strong><?php echo $this->_tpl_vars['de']['album_detail']['name']; ?>
</strong><br />
      <?php echo $this->_tpl_vars['de']['album_detail']['des']; ?>

      </td>
    </tr>
  </table>
  <br />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" style="background-color:#CCCCCC">
        <link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/sho_cover.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/cover.js"></script>
        <script type="text/javascript"> 
        imf.create("imageFlow", 0.15, 1.5, 10);
        </script>
        <div style="float:left; height:700px;width:100%;">
        <div id="imageFlow">
            <div class="bank">
                <?php $_from = $this->_tpl_vars['de']['pic_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
              <a rel="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/zsimg/<?php echo $this->_tpl_vars['list']['id']; ?>
.jpg" title="<?php echo $this->_tpl_vars['list']['con']; ?>
" href="#"><?php echo $this->_tpl_vars['list']['zname']; ?>
</a>
                <?php endforeach; endif; unset($_from); ?>
            </div>
            <div class="text">
                <div class="title">Loading</div>
                <div class="legend">Please wait...</div>
            </div>
            <div class="scrollbar">
                <img class="track" src="image/default/08081201sb.gif" alt="">
                <img class="arrow-left" src="image/default/08081201sl.gif" alt="">
                <img class="arrow-right" src="image/default/08081201sr.gif" alt="">
                <img class="bar" src="image/default/08081201sc.gif" alt=""> </div>
        </div>
        </div>
      </td>
      </tr>
  </table>
</div>