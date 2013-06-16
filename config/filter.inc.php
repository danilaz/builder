<?php
	$find= array('/скотина/i','/идиот/i');
	$replace=array('животное','**');
	$banned='/(член|гавно|сука|блять|пизда|тварь)/i';
	$_CACHE['word_filter'] = Array
	(
		'filter' => Array
		(
			'find' => &$find,
			'replace' => &$replace
		),
		'banned' => &$banned
	);
	?>