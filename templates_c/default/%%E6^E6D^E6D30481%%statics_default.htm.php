<?php /* Smarty version 2.6.20, created on 2013-01-12 15:02:59
         compiled from statics_default.htm */ ?>
<?php echo $this->_tpl_vars['lang']['favs']; ?>
<?php echo $this->_tpl_vars['statics']['fas']; ?>

<?php echo $this->_tpl_vars['lang']['rewiews']; ?>
<?php if ($this->_tpl_vars['statics']['revs'] > 0): ?>
        <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/rewiew_detail.php?ctype=<?php echo $this->_tpl_vars['statics']['ctype']; ?>
&conid=<?php echo $this->_tpl_vars['statics']['id']; ?>
">
        <?php echo $this->_tpl_vars['statics']['revs']; ?>

        </a>
        <?php else: ?>
        	<?php echo $this->_tpl_vars['statics']['revs']; ?>

        <?php endif; ?>