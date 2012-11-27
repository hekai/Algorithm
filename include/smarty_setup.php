<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

define('SMARTY_DIR','/home/hacklu/smarty/libs/');
define('SMARTY_WORK_DIR','/var/www/Algorithm/smarty/');

//load smarty library
require_once(SMARTY_DIR . 'Smarty.class.php');

class Algo extends Smarty {

	function __construct()
	{

		parent::__construct();

		$this->setTemplateDir(SMARTY_WORK_DIR . 'templates/');
		$this->setCompileDir(SMARTY_WORK_DIR . 'templates_c/');
		$this->setConfigDir(SMARTY_WORK_DIR . 'configs/');
		$this->setCacheDir(SMARTY_WORK_DIR . 'cache/');

		$this->caching = Smarty::CACHING_LIFETIME_CURRENT;
		$this->assign('app_name', 'Algorithm');

		$this->debugging = true;
	}
}

#echo "111";
/*
$smarty = new Smarty();
#$smarty->debuging= true;
$smarty->template_dir = '/home/USERNAME/smarty/templates';
$smarty->compile_dir = '/home/USERNAME/smarty/templates_c';
$smarty->cache_dir = '/home/USERNAME/smarty/cache';
$smarty->config_dir = '/home/USERNAME/smarty/configs';

$smarty->assign('test_var', 'It works!');
$smarty->display('index.tpl');
 */
?>

