<?php /* Smarty version 2.6.20, created on 2012-10-27 18:45:31
         compiled from space_company.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'getUserPlayer', 'space_company.htm', 35, false),array('function', 'geturl', 'space_company.htm', 65, false),array('function', 'html_image', 'space_company.htm', 67, false),array('modifier', 'urlencode', 'space_company.htm', 102, false),)), $this); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">

    <div class="common_box2">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="guide_ba2"><td><span><?php echo $this->_tpl_vars['shopconfig']['home_news_name']; ?>
</span> 
			<a href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=news_list&m=news"><img src="<?php echo $this->_tpl_vars['img']; ?>
/more.jpg" /></a></td>
			
        </tr>
      <tr>
        <td height="100">
        <?php if ($this->_tpl_vars['com']['img'] != ""): ?>
		 <img src="<?php echo $this->_tpl_vars['com']['img']; ?>
" style="float:right; width:190px; border:1px solid #CCCCCC;margin-left:10px;">
		<?php endif; ?>
        <div style="padding:20px;">
		<?php echo $this->_tpl_vars['com']['intro']; ?>

        </div>
		</td>
      </tr>
    </table>
</div>



</td>
    <td valign="top">
    <div>
    	<div class="com_contact">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr class="item">
                    <td colspan="2"><span>Видео</span></td>
                  </tr>
                  <tr>
                    <td><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getUserPlayer', 'height' => '163', 'width' => '215', 'userid' => $this->_tpl_vars['com']['userid'])), $this); ?>
</td>
                  </tr>
                </table>
        </div>
    </div>
</td>
  </tr>
  <tr>
    <td valign="top">

<div class="common_box2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr  class="guide_ba2">
    <td>
      <span><?php echo $this->_tpl_vars['shopconfig']['home_recpro_name']; ?>
</span>      <a href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=product_list&m=product"><img src="<?php echo $this->_tpl_vars['img']; ?>
/more.jpg" /></a></td>
     </tr>
  <tr>
  	<td>
    	<style>
.blk_29 { OVERFLOW: hidden; ZOOM: 1; POSITION: relative}
.blk_29 .LeftBotton{ BACKGROUND: url(<?php echo $this->_tpl_vars['img']; ?>
left.jpg) no-repeat 0px 0px; LEFT: 5px; FLOAT: left; WIDTH: 17px; CURSOR: pointer;  HEIGHT: 100px;margin-top:50px;}
.blk_29 .RightBotton { RIGHT: 5px; BACKGROUND: url(<?php echo $this->_tpl_vars['img']; ?>
right.jpg) no-repeat; FLOAT: right; WIDTH: 17px; CURSOR: pointer;  HEIGHT: 100px;margin-right:-10px;margin-top:50px;}
.blk_29 .Cont { MARGIN: 0px auto; OVERFLOW: hidden; WIDTH: 450px; PADDING-TOP: 5px; float:left;}
.blk_29 .box { FLOAT: left; WIDTH: 120px; TEXT-ALIGN: center; border:1px solid #CCCCCC; height:100px; margin:3px;}
</style>
<div class="blk_29">
	<div class="LeftBotton" id="LeftArr"></div>
	<div class="Cont" id="ISL_Cont_1">
		<?php $_from = $this->_tpl_vars['rec_pro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
		<div class="box">
			<a href="<?php echo smarty_function_geturl(array('type' => 'prod','uid' => $this->_tpl_vars['com']['userid'],'user' => $this->_tpl_vars['com']['user'],'tid' => $this->_tpl_vars['list']['id'],'open' => 1), $this);?>
" target="_blank">
			<?php $this->assign('imgs', $this->_tpl_vars['list']['id']); ?>
			<?php echo smarty_function_html_image(array('file' => "uploadfile/comimg/big/".($this->_tpl_vars['imgs']).".jpg",'width' => 100,'alt' => $this->_tpl_vars['list']['pname']), $this);?>

			</a>
		</div>
		<?php endforeach; endif; unset($_from); ?>
	</div>
	<div class="RightBotton" id="RightArr"></div>
</div>
<script src="<?php echo $this->_tpl_vars['img']; ?>
flow.js"></script>
<script language=javascript type=text/javascript>
  var scrollPic_02 = new ScrollPic();
  scrollPic_02.scrollContId   = "ISL_Cont_1"; //内容容器ID
  scrollPic_02.arrLeftId      = "LeftArr";//左箭头ID
  scrollPic_02.arrRightId     = "RightArr"; //右箭头ID
  scrollPic_02.frameWidth     = 450;//显示框宽度
  scrollPic_02.pageWidth      = 110; //翻页宽度
  scrollPic_02.speed          = 10; //移动速度(单位毫秒，越小越快)
  scrollPic_02.space          = 10; //每次移动像素(单位px，越大越快)
  scrollPic_02.autoPlay       = false; //自动播放
  scrollPic_02.autoPlayTime   = 3; //自动播放间隔时间(秒)
  scrollPic_02.initialize(); //初始化
</script>
     </td>
  </tr>
</table>
</div>

</td>
    <td valign="top">
    <div>
    	<div style="margin-top:10px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr class="item">
                    <td colspan="2"><span><?php echo $this->_tpl_vars['shopconfig']['home_contact_name']; ?>
</span></td>
                  </tr>
                  <tr>
                    <td class="padding10"><?php echo $this->_tpl_vars['lang']['addr']; ?>
<br /> <a onclick="alertWin('Map','',500,300,'<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/default/map.php?addr=<?php echo ((is_array($_tmp=$this->_tpl_vars['com']['addr'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
');" href="#"><?php echo $this->_tpl_vars['com']['addr']; ?>
</a></td>
                  </tr>
                  <tr>
                    <td class="padding10"><?php echo $this->_tpl_vars['lang']['conetct_name']; ?>
<br /> <?php echo $this->_tpl_vars['com']['contact']; ?>
(<?php echo $this->_tpl_vars['com']['position']; ?>
)</td>
                  </tr>
                  <tr>
                    <td class="padding10"><?php echo $this->_tpl_vars['lang']['tel']; ?>
:<br /> <?php echo $this->_tpl_vars['com']['tel']; ?>
</td>
                  </tr>
                  <?php if ($this->_tpl_vars['com']['mobile']): ?>
                  <tr>
                    <td class="padding10"><?php echo $this->_tpl_vars['lang']['mobile']; ?>
:<br /><?php echo $this->_tpl_vars['com']['mobile']; ?>
</td>
                  </tr>
                  <?php endif; ?>
                  <tr>
                    <td class="padding10"><?php echo $this->_tpl_vars['lang']['fax']; ?>
:<br /><?php echo $this->_tpl_vars['com']['fax']; ?>
</td>
                  </tr>
                </table>
        </div>
    </div>
</td>
  </tr>
</table>