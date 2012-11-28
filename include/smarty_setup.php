<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

define('SMARTY_DIR','/home/hacklu/smarty/libs/');
define('SMARTY_WORK_DIR','/var/www/Algorithm/smarty/');
define('CSS_DIR','/Algorithm/include/css/');

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
		$this->assign('CSS_DIR',CSS_DIR);

		$this->debugging = true;
		$this->force_compile = true;
	}
}

#echo "111";
?>

