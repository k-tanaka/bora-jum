<?php

//define('CURRY_PATH', realpath(dirname(__FILE__) . '/../../curry'));
define('CURRY_PATH', realpath(dirname(__FILE__) . '/../lib/curry'));
define('SITE_PATH', realpath(dirname(__FILE__) . '/..'));

// Add framework path to include path of php.
set_include_path(implode(PATH_SEPARATOR, array(
	CURRY_PATH,
	get_include_path(),
)));

// Set autoloader.
require_once CURRY_PATH . '/core/loader.php';
spl_autoload_register('Loader::autoload');
//require_once CURRY_PATH . '/load_core.php';

// Set directory settings.
PathManager::setFrameworkRoot(CURRY_PATH);
PathManager::setSystemRoot(SITE_PATH);
PathManager::setHtdocsDirectory(SITE_PATH . '/web');

// Execute dispatch process.
require_once SITE_PATH . '/library/validator_ex.php';

$dispatcher = new Dispatcher();
$dispatcher->setValidatorClass('ValidatorEx');
$dispatcher->setAppEnv(getenv('APP_ENV'));
$dispatcher->dispatch();
