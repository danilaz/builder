<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/".$sctiptName);
include_once("auth.php");
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
</HEAD>
<body>
<script type="text/javascript">
function checkm()
{
	 if (document.mailsend.subject.value==""||document.mailsend.mes.value==""||document.mailsend.mtype.value=="")
		{ 
         alert("<?php echo lang_show('isnullmsg');?>") 
         return false;  
        }  
     else 
		 {return true;} 

}
function show()
{
	var d=document.getElementById ("addsend").style.display = "block";
	var d=document.getElementById ("addsend1").style.display = "block";
}
function hid(n)
{
	var d=document.getElementById ("addsend").style.display = "none";
	var d=document.getElementById ("addsend1").style.display = "none";

}
</script>
<link href="main.css" rel="stylesheet" type="text/css" />
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('send_mail_multiply');?></div>
<div class="bigboxbody">
  <table width="100%" border="0" cellspacing="1" cellpadding="0" height="460">
    <tr>
      <td width="20%" valign="top">
      <div style="border-right: 1px solid #999999; height:400px; line-height:23px; overflow-y:scroll;">
        <strong><?php echo lang_show('please_select_mail_tpl');?></strong><br>
        <?php
        $db->query("select * from ".MAILMOD." order by id desc");
        while($db->next_record())
        {
        $id=$db->f('id');
        $subject=$db->f('subject');
        echo " &raquo; <a href=massmail.php?modid=$id>$subject</a><br>";
        }
        ?>
    </div>
    </td>
      <td width="75%" height="460" valign="top">
		<form method="post" action="mail_send.php" name="mailsend">
        <table width="100%" height="683" border="0" cellpadding="0" cellspacing="0">
            <tr> 
              <td width="5%" ><?php echo lang_show('send_to');?>:</td>
              <td  >
			  
			  <TABLE width="100%" cellpadding=0 cellspacing=0>
			  					 
<TR>
							<TD align="center"><?php echo lang_show('industry');?></TD>
						    <TD align="center"><?php echo lang_show('area');?></TD>
						    <TD align="center"><?php echo lang_show('usergroup');?></TD>
						    <TD align="center"><?php echo lang_show('logotimes');?></TD>
					</TR>
					<TR>
						<TD width="118" style="border-bottom:none">
						<select name="catid[]" size="10" multiple style="width:100px;">
						<option value=""><?php echo lang_show('all_industry');?></option>
                          <?php
							$db->query("select catid,cat from ".COMPANYCAT." where catid<9999");
							while($db->next_record())
							{
								$datacatid=$db->f("catid");
								$datacat=$db->f("cat");
								echo "<option value=$datacatid>&nbsp;&nbsp;$datacat</option>"; 
							}
							?>
                      </select>	</TD>
                <TD width="119" style="border-bottom:none"><select name="province[]" size="10" multiple style="width:100px;">
                            <option value=""><?php echo lang_show('all_area');?></option>
                            <?php
							$sql="select province from ".PROVINCE;
							$db->query($sql);
							while($db->next_record())
							{
								$provinces=$db->f("province");
							?>
                            <option value="<?php echo $provinces;?>"> &nbsp;&nbsp;<?php echo $provinces;?></option>
                            <?php }?>
                      </select>                      </TD>
			          <TD width="121" style="border-bottom:none"><select name="usergroup[]" size="10" multiple style="width:100px;">
                          <option value=""><?php echo lang_show('all_group');?></option>
                          <?php
							$sql="select name,group_id from ".USERGROUP;
							$db->query($sql);
							while($db->next_record())
							{
								$groupname=$db->f("name");
                                $groupid=$db->f("group_id");
							?>
                          <option value="<?php echo $groupid;?>"> &nbsp;&nbsp;<?php echo $groupname;?></option>
                          <?php }?>
                        </select>                      </TD>
			          <TD width="115" style="border-bottom:none">
						<select name="unlogotime" size="10" style="width:100px;">
						<option value=""><?php echo lang_show('alllogot');?></option>
                          <option value="7"><?php echo lang_show('owunlogo');?></option>
                          <option value="14"><?php echo lang_show('twunlogo');?></option>
                          <option value="30"><?php echo lang_show('omunlogo');?></option>
                          <option value="60"><?php echo lang_show('tmunlogo');?></option>
                          <option value="90"><?php echo lang_show('thmunlogo');?></option>
                          <option value="180"><?php echo lang_show('sixmunlogo');?></option>
                          <option value="360"><?php echo lang_show('oyunlogo');?></option>
                      </select>						</TD>
					</TR>
				</TABLE>
                </td>
            </tr>
            <tr>
              <td height="26" ><?php echo lang_show('mtype');?></td>
              <td >
                <input type="radio" name="mtype" id="radio" value="1" onClick="hid();">
              <?php echo lang_show('mmail');?>
              <input type="radio" name="mtype" id="radio2" value="2" onClick="hid();">
              <?php echo lang_show('msms');?>
              <input type="radio" name="mtype" id="radio3" value="3" onClick="show();">
              <?php echo lang_show('mmsg');?></td>
            </tr>
            <tr> 
              <td> 
			    <?php
			if(!empty($_GET['modid']))
			{
				$modid=$_GET['modid'];
				$db->query("select * from ".MAILMOD." where id='$modid'");
				$re=$db->fetchRow();
			}
			else
				$re=NULL;
			?>  
				<div id="addsend1" style="display:none;">
				Отправитель
				</div></td>
              <td>
                <div id="addsend" style="display:none;">
				<?php echo lang_show('contact');?>:<input name="contact" type="text"  value="" style="width:410px;"><br />
				<?php echo lang_show('email');?>:<input name="email" type="text"  value="" style="width:410px;"><br />
				<?php echo lang_show('tel');?>:<input name="tel" type="text"  value="" style="width:410px;"><br />
				(Если отправитель информации не указан, сообщение будет отправлено, как от администратора в "Системных сообщениях")
				</div>
                </td>
            </tr>
            <tr>
              <td height="23" valign="top" > <?php echo lang_show('mail_subject');?>: </td>
              <td valign="top" ><input name="subject" type="text"  value="<?php echo $re["subject"]; ?>" style="width:500px;"></td>
            </tr>
            <tr> 
              <td width="16%" height="281" valign="top" > <?php echo lang_show('mail_content');?>:</td>

              <td width="84%" valign="top" > 
                <textarea name="mes" style="width:500px; height:400px; padding:3px;"><?php echo $re["message"]; ?></textarea>              </td>
            </tr>
            <tr> 
              <td width="16%" height="37" style="border-bottom:none;">&nbsp; </td>
              <td width="84%" style="border-bottom:none;"> 
                <input class="btn" type="submit" name="submit" value="<?php echo lang_show('send_mail');?>" onClick="return checkm();">
                <input name="action" type="hidden" id="action" value="send"></td>
            </tr>
        </table>
        </form>
      </td>
    </tr>
  </table>
  </div>
  </div>
</body>
</html>