<?php
$lang_ext = array(
'tableoprep' => 'database table repair/optimization', 
'okmsg' => 'data sheets to operate success! Do not repeat the operation! ', 
'repairmsg' => 'data sheets to repair: the function of the database you use to repair the damaged file (the data is really destroyed is very small, mostly as a result of damage caused by the index files), so only if your damage database of the circumstances under which to run the function! In the use of this feature before you back up the database data! ', 
'optimizemsg' => 'data sheet optimization: the function of your choice to use the database tables to optimize the use of unused space, and data document fragments. In most cases, you do not need to run the function, even if you have a large number of data updates, you do not need to run, it is recommended once a week or once a month, or only to a specific table to run the function! ', 
'allch' => 'Select all', 
'tname' => 'table name', 
'repact' => 'data sheets to repair', 
'optact' => 'data sheet optimization', 
'isure' => 'determined',
);

$lang = array_merge($lang, $lang_ext);
?>