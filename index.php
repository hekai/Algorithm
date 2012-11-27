<?php
require_once('include/smarty_setup.php');


$smarty = new Algo();

$smarty->assign('name','TJ');

$smarty->display('index.tpl');

?>
