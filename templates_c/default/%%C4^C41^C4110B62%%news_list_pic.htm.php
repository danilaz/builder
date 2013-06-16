<?php /* Smarty version 2.6.20, created on 2013-01-12 19:52:51
         compiled from news_list_pic.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'news_list_pic.htm', 21, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>

<div class="div1">

    <div>

    <a target="_blank"  title="<?php echo $this->_tpl_vars['list']['title']; ?>
" href="<?php echo $this->_tpl_vars['list']['url']; ?>
">

        <img width="40" height="40" src="<?php echo $this->_tpl_vars['list']['pic']; ?>
" />

    </a>

    </div>

    <dl style="padding-top:5px;">

        <dt><a target="_blank" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" <?php echo $this->_tpl_vars['list']['style']; ?>
  href="<?php echo $this->_tpl_vars['list']['url']; ?>
"><?php echo $this->_tpl_vars['list']['ftitle']; ?>
</a></dt>

        <dd>

            <!-- <?php echo ((is_array($_tmp=$this->_tpl_vars['list']['smalltext'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 80) : smarty_modifier_truncate($_tmp, 80)); ?>
 <a target="_blank" style="font-size:10px;"  title="<?php echo $this->_tpl_vars['list']['title']; ?>
" href="<?php echo $this->_tpl_vars['list']['url']; ?>
">&gt;&gt;</a> -->

        </dd>

    </dl>

</div>

<?php endforeach; endif; unset($_from); ?>