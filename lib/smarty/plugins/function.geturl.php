<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_function_geturl($params, &$smarty)
{
	return geturl($params['type'],$params['uid'],$params['user'],$params['tid'],$params['com'],$params['m']);
}

?>