<?php
//маршрутизация

namespace core\base\controllers;

use core\base\exceptions\RouteException;
use core\base\settings\Settings;
use core\base\settings\ShopSettings;
use mysql_xdevapi\Session;

class RouteController
{
    static private $_instance;
    protected $routes;
    protected $controller;
    protected $inputMethod;
    protected $outputMethod;
    protected $parameters;


    private function __clone()
    {
    }
    static public function getInstance(){   //маршрут синг-тон
        if (self::$_instance instanceof self){
            return self::$_instance;

        }
        return self::$_instance=new self;
    }
    private function __construct()
    {
        $address_str = $_SERVER['REQUEST_URI'];
        if (strrpos($address_str, '/') === srtlen($address_str)-1 && strrpos($address_str, '/')!==0){         // последнее вхождение в строку
            $this-> redirect(rtrim($address_str,'/'),301);  //obrez
    }
        $path = substr($_SERVER['PHP_SELF'],0, strrpos($_SERVER['PHP_SELF'],'index.php'));
        if ($path===PATH) {
            $this->routes =Settings::get('routes');
            if ($this->routes) throw new RouteException('сайт на тех обслуживание');
            if (strrpos($address_str,$this->routes['admin']['alias']) === strlen(PATH)){
                //работа с админ панелью
            }else {
                //работа с польз контролером
                $url= explode('/', substr($address_str,strlen(PATH)));//строка в массив, обрез с первого символа
                $hrUrl = $this-> routes['user']['hrUrl'];
                $this->controller = $this->routes['user']['path'];
                $route='user';
            }

            $this->createRoute($route,$url);
            exit();

        }else{
            try{
                throw new\Exception('не корректная директория сайта');
            }
            catch(\Exception $e){
                exit($e->getMessage());
            }
        }
    }
    private function createRoute ($var,$arr){
     $route =[];
         if(!empty($arr[0])) {
             if ($this->routes[$var]['routes'][$arr[0]]) {
                 $route = explode('/', $this->routes[$var]['routes'][$arr[0]]);
                 $this->controller .= ucfirst($route[0] . 'controller');
             } else {
                 $this->controller .= ucfirst($arr[0] . 'controller');
             }
         }else{
             $this->controller.= $this->routes['default']['controller'];
             }
         $this->inputMethod = $route[1] ? $route[1] : $this->routes['default']['inputMethod'];  //ifelse
         $this->outputMethod = $route[2] ? $route[2] : $this->routes['default']['outputMethod'];
         return;

    }
}