<?php /* Smarty version 2.6.20, created on 2012-10-29 21:28:30
         compiled from /var/www/ekolobok/data/www/ekolobok.com/templates/default/space_company.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'getUserPlayer', '/var/www/ekolobok/data/www/ekolobok.com/templates/default/space_company.htm', 13, false),array('insert', 'getOffers', '/var/www/ekolobok/data/www/ekolobok.com/templates/default/space_company.htm', 84, false),array('insert', 'getDemands', '/var/www/ekolobok/data/www/ekolobok.com/templates/default/space_company.htm', 103, false),array('insert', 'getNews', '/var/www/ekolobok/data/www/ekolobok.com/templates/default/space_company.htm', 125, false),array('function', 'geturl', '/var/www/ekolobok/data/www/ekolobok.com/templates/default/space_company.htm', 160, false),array('function', 'html_image', '/var/www/ekolobok/data/www/ekolobok.com/templates/default/space_company.htm', 162, false),)), $this); ?>
<div id="company">
<div class="common_box">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="guide_ba"><span><?php echo $this->_tpl_vars['lang']['company_des']; ?>
</span></td>
                </tr>
                <tr>
                    <td class="com_intro">
                            <?php if ($this->_tpl_vars['com']['img'] != ""): ?>
                           	 <img src="<?php echo $this->_tpl_vars['com']['img']; ?>
" style="float:right; width:250px; border:1px solid #CCCCCC;margin-left:10px;">
                            <?php endif; ?>
                            <div style="padding:10px;"><?php echo $this->_tpl_vars['com']['intro']; ?>
</div>
							<!-- <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getUserPlayer', 'height' => '211', 'width' => '300', 'userid' => $this->_tpl_vars['com']['userid'])), $this); ?>
 -->
                            <br>
                        <?php if ($this->_tpl_vars['business_validate_statu'] == 1): ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="2" class="guide_ba">&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['lang']['business_info']; ?>
</td>
                      </tr>
                      <tr>
                        <td width="15%"><?php echo $this->_tpl_vars['lang']['com_reg_name']; ?>
</td>
                        <td width="85%"><?php echo $this->_tpl_vars['bus']['com_reg_name']; ?>
 </td>
                      </tr>
                      <tr>
                        <td><?php echo $this->_tpl_vars['lang']['com_reg_id']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['bus']['com_reg_id']; ?>
</td>
                      </tr>
                      <tr>
                        <td><?php echo $this->_tpl_vars['lang']['com_reg_add']; ?>
 </td>
                        <td><?php if ($this->_tpl_vars['bus']['com_reg_add_protect'] == 1): ?><?php echo $this->_tpl_vars['lang']['statu_protect']; ?>
<?php else: ?><?php echo $this->_tpl_vars['bus']['com_reg_add']; ?>
<?php endif; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->_tpl_vars['lang']['com_deputy']; ?>
 </td>
                        <td><?php if ($this->_tpl_vars['bus']['com_deputy_protect'] == 1): ?><?php echo $this->_tpl_vars['lang']['statu_protect']; ?>
<?php else: ?><?php echo $this->_tpl_vars['bus']['com_deputy']; ?>
<?php endif; ?></td>
                      </tr>
                          <tr>
                        <td><?php echo $this->_tpl_vars['lang']['com_reg_capital']; ?>
 </td>
                        <td><?php if ($this->_tpl_vars['bus']['com_reg_capital_protect'] == 1): ?><?php echo $this->_tpl_vars['lang']['statu_protect']; ?>
<?php else: ?><?php echo $this->_tpl_vars['bus']['com_reg_capital']; ?>
<?php endif; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->_tpl_vars['lang']['com_reg_type']; ?>
 </td>
                        <td><?php echo $this->_tpl_vars['bus']['com_reg_type']; ?>
</td>
                      </tr>
                      <tr>
                        <td><?php echo $this->_tpl_vars['lang']['com_reg_time']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['bus']['com_reg_time']; ?>
</td>
                      </tr>
                      <tr>
                        <td><?php echo $this->_tpl_vars['lang']['com_reg_time_ex']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['bus']['com_reg_time_ex']; ?>
</td>
                      </tr>
                      <tr>
                        <td><?php echo $this->_tpl_vars['lang']['com_reg_area']; ?>
 </td>
                        <td><?php echo $this->_tpl_vars['bus']['com_reg_area']; ?>
 </td>
                      </tr>
                      <tr>
                        <td><?php echo $this->_tpl_vars['lang']['com_reg_unit']; ?>
 </td>
                        <td><?php echo $this->_tpl_vars['bus']['com_reg_unit']; ?>
 </td>
                      </tr>
                      <tr>
                        <td><?php echo $this->_tpl_vars['lang']['com_check']; ?>
 </td>
                        <td><?php echo $this->_tpl_vars['bus']['com_check']; ?>
 </td>
                      </tr>
                    </table>
                    <?php endif; ?>
                    </td>
                 </tr>
             </table>
        </div>
</div>
<div class="m1">
<?php if ($this->_tpl_vars['shopconfig']['home_newoffer_show'] == '1'): ?>
<div id="supply">
	<div class="common_box">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                    <td class="guide_ba">
                        <span><?php echo $this->_tpl_vars['shopconfig']['home_newoffer_name']; ?>
</span>
                        <a href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=offer_list&m=offer"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/moretu.jpg" /></a>
    				</td>	
                </tr>
                <tr>
                	<td class="com_intro" style="padding:10px;">
           				 <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getOffers', 'leng' => '50', 'col_count' => '3', 'limit' => $this->_tpl_vars['shopconfig']['home_news_nums'], 'userid' => $this->_tpl_vars['com']['userid'])), $this); ?>

                    </td>
                 </tr>
     </table>
    </div>
</div>
<?php endif; ?>

<div id="supply" style="margin-left:8px;" >
	<div class="common_box">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                    <td class="guide_ba">
                        <span><?php echo $this->_tpl_vars['shopconfig']['home_newdemand_name']; ?>
</span>
                        <a href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=demand_list&m=demand"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/moretu.jpg" /></a>
    				</td>	
                </tr>
                <tr>
                	<td class="com_intro" style="padding:10px;">
           				 <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getDemands', 'leng' => '50', 'col_count' => '3', 'limit' => $this->_tpl_vars['shopconfig']['home_news_nums'], 'userid' => $this->_tpl_vars['com']['userid'])), $this); ?>

                    </td>
                 </tr>
     </table>
    </div>
</div> 

<div class="clear"></div>
</div>

<?php if ($this->_tpl_vars['shopconfig']['home_news_show'] == '1'): ?>
    <div style="margin-top:10px;" >
    		<div class="common_box">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
					<tr>
						<td class="guide_ba">
							<span><?php echo $this->_tpl_vars['shopconfig']['home_news_name']; ?>
</span>
							<a href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=news_list&m=news"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/moretu.jpg" /></a>
						 </td>
					</tr>
					<tr>
						<td class="com_intro" style="padding:10px;">
							<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getNews', 'leng' => '50', 'limit' => $this->_tpl_vars['shopconfig']['home_news_nums'], 'user' => 'true', 'userid' => $this->_tpl_vars['com']['userid'])), $this); ?>

						</td>
					 </tr>
                 </table>
          </div>
    </div>
    <div class="clear"></div> 
<?php endif; ?>

<!--
//<?php if ($this->_tpl_vars['shopconfig']['home_contact_show'] == '1'): ?>
    //<div id="product" class="m1">
    	  //<div class="common_box">
            //<table width="100%" border="0" cellspacing="0" cellpadding="0" >
                            //<tr>
                                //<td class="guide_ba">
                                    //<span>Рекомендуемые продукты</span>
                                    //<a href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=product_list&m=product"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/moretu.jpg" /></a>
                            	//</td>
                           //</tr>
                            //<tr>
                                //<td class="com_intro">
								
//<style>
//.blk_29 { OVERFLOW: hidden; ZOOM: 1; POSITION: relative}
//.blk_29 .LeftBotton{ BACKGROUND: url(image/default/leftarraw.jpg) no-repeat 0px 0px; LEFT: 5px; FLOAT: left; WIDTH: 25px; CURSOR: pointer;  HEIGHT: 100px;margin-top:50px;}
//.blk_29 .RightBotton { RIGHT: 5px; BACKGROUND: url(image/default/rightarraw.jpg) no-repeat; FLOAT: right; WIDTH: 30px; CURSOR: pointer;  HEIGHT: 100px;margin-right:-10px;margin-top:50px;}
//.blk_29 .Cont { MARGIN: 0px auto; OVERFLOW: hidden; WIDTH: 670px; PADDING-TOP: 5px; float:left;}
//.blk_29 .box { FLOAT: left; WIDTH: 120px; TEXT-ALIGN: center; border:1px solid #CCCCCC; height:100px; margin:3px;}
//</style>
//<div class="blk_29">
	//<div class="LeftBotton" id="LeftArr"></div>
	//<div class="Cont" id="ISL_Cont_1">
		//<?php $_from = $this->_tpl_vars['rec_pro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
		//<div class="box">
			//<a href="<?php echo smarty_function_geturl(array('type' => 'product_detail','uid' => $this->_tpl_vars['com']['userid'],'user' => $this->_tpl_vars['com']['user'],'tid' => $this->_tpl_vars['list']['id'],'open' => 1), $this);?>
" target="_blank">
			//<?php $this->assign('imgs', $this->_tpl_vars['list']['id']); ?>
			//<?php echo smarty_function_html_image(array('file' => "uploadfile/comimg/big/".($this->_tpl_vars['imgs']).".jpg",'width' => 100,'alt' => $this->_tpl_vars['list']['pname']), $this);?>

			//</a>
		//</div>
		//<?php endforeach; endif; unset($_from); ?>
	//</div>
	//<div class="RightBotton" id="RightArr"></div>
//</div>
//<script src="script/flow.js"></script>
//<script language=javascript type=text/javascript>
 // var scrollPic_02 = new ScrollPic();
 // scrollPic_02.scrollContId   = "ISL_Cont_1"; //内容容器ID
 // scrollPic_02.arrLeftId      = "LeftArr";//左箭头ID
//  scrollPic_02.arrRightId     = "RightArr"; //右箭头ID
 // scrollPic_02.frameWidth     = 670;//显示框宽度
 // scrollPic_02.pageWidth      = 110; //翻页宽度
//  scrollPic_02.speed          = 10; //移动速度(单位毫秒，越小越快)
//  scrollPic_02.space          = 10; //每次移动像素(单位px，越大越快)
 // scrollPic_02.autoPlay       = false; //自动播放
//  scrollPic_02.autoPlayTime   = 3; //自动播放间隔时间(秒)
//  scrollPic_02.initialize(); //初始化
//</script>

  //                              </td>
  //                              </tr>
             //              </table>
      //      </div>
   // </div>
//<?php endif; ?>
-->