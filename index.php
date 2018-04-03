<?php

/** Front controller */
/**Загальні налаштування */
ini_set("display_errors", 1);
error_reporting(E_ALL);
/** Файл з глобальними константами */
require_once(dirname(__FILE__).'/globals.php');
/** Шлях до файлу автозавантаження */
require_once(ROOT.'/core/components/Autoload.php');
/** Конфігурація автозавантаження */
$loader=new \Core\Components\Psr4AutoloaderClass;
$loader->register();
$loader->addNamespace('Core\Components', ROOT.'/core/components/');
$loader->addNamespace('Core\Controllers', ROOT.'/core/controllers/');
$loader->addNamespace('App\Controllers', APP.'/controllers/');
$loader->addNamespace('App\Models', APP.'/models/');
/** Запуск роутінгу */
$router=Core\Components\Router::getInstance();
//phpinfo();
$router->run();
