<?php
defined ('VG_ACCESS') or die('Access denied');

const TEMPLATE = 'core/templates/default';// шаблоны сайта
const ADMIN_TEMPLATE = 'core/admin/views';// пути к административной панели сайта
const COOKIE_VERSION= '1.0.0';// конст безопасности//
const CRYPT_KEY = '';
const COOKIE_TME = 60;//время бездействия
const BLOCK_TIME=3;//perebor paroli

const QTY=8;    //страничная навигация
const QTY_LINKS=3;

const ADMIN_CSS_JS=[
    'styles' => [],
    'scipts' => []
];

use core\base\exceptions\RouteException;

function autoloadMainClasses($class_name){
    $class_name = str_replace( '\\', '/', $class_name);
    if(!@include_once $class_name . 'php'){         //исключения
        throw new RouteException('не верное имя файла для подключения - ' .$class_name);
     }
}
spl_autoload_register('function autoloadMainClasses');