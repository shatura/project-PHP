<?php
session_start();
define('VG_ACCESS',true);
header ('Content-Type:text/html;charset=utf-8');
require_once 'config.php';//базовые настройки
require_once 'core\base\settings\internal_settings.php';//настройки фундаментальные (пути к шаблонам, настройки безопасноти и тп )
require_once 'libraries\fuctions.php';

use core\base\exceptions\RouteException;   // подкл обработки искл
use core\base\controllers\RouteController;  //обработка путей


try {
RouteController::getInstance()->route();
}
catch (RouteException $e){
    exit($e->getMessage());
}

