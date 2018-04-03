<?php
namespace Core\Components;

/**
 * Клас Router - компонент для роботи зі шляхами(роутами)
 */
final class Router
{
    /** @var string Шлях до обробника помилок(контроллера) */
    private static $ERROR_CONTROLLER="\\Core\\Controllers\\ErrorController";
    /** @var string Назва методу обронкиа помилок(контроллера) */
    private static $ERROR_ACTION="actionIndex";
    /** @var Router Містить екземпляр класу */
    private static $instance=null;
    /** @var array[] Масив шляхів(роутів) */
    private $routes;
    /** Не використовується @deprecated */
    private function __clone()
    {
    }
    /** Створуює екземпляр класу. Призначає $routes */
    private function __construct()
    {
        /** @var string Шлях до конфігурації роутів */
        $routesPath=CONFIG.'/routes.php';
        $this->routes=include($routesPath);
        self::$instance=$this;
    }

    /** Повертає екземпляр класу @return Router */
    public static function getInstance()
    {
        if (self::$instance==null) {
              $instance=new Router();
        }
        return self::$instance;
    }
    /** Повертає рядок параметрів(запит) @return string */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    /**
     * Оброблює запит браузера. Знаходить внутрішній шлях та викликає метод контроллера.
     * Викликає обробник помилок (404)
     */
    public function run()
    {
        /** @var string Рядок параметрвів() запит */
        $uri=$this->getURI();
        /** @var bool */
        $result=null;
        /** Перевіряємо routes.php на наявність такого шляху */
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~^$uriPattern$~", $uri)) {
                /** @var string внутрішній шлях */
                $internalRoute=preg_replace("~$uriPattern~", $path, $uri);
                $segments=explode('/', $internalRoute);
                /** @var string Назва контроллеру */
                $controllerName=array_shift($segments)."Controller";
                $controllerName=ucfirst($controllerName);
                /** @var string Назва методу */
                $actionName="action".ucfirst(array_shift($segments));
                /** @var array Параметри методу */
                $parameters=$segments;
                $controller="\\App\\Controllers\\".$controllerName;
                $controllerObject=new $controller();
                /** Виклик методу контроллера */
                $result=call_user_func_array(
                    array($controllerObject,$actionName),
                    $parameters
                );

                if ($result!=null) {
                    self::logFile("ok");
                    break;
                }
            }
        }
        /** Якщо шляху не існує */
        if ($result==null) {
            try {
                self::logFile("fls");
                http_response_code(404);
                /** @var string Шлях до оброника помилок(контроллера) */
                $controller=self::$ERROR_CONTROLLER;
                $controllerObject=new $controller();
                /** @var string Назва методу обронкиа помилок(контроллера) */
                $actionName=self::$ERROR_ACTION;
                /** Виклик методу контроллера */
                $result=call_user_func_array(array($controllerObject,$actionName), [404]);
            } catch (Exception $e) {
                return -1;
            }
        }
    }
    /////////////////////////////////////
    /////////////////////////////////////
    ////////////////////////////////////
    /**
     * Сеттер для Router::$ERROR_CONTROLLER
     * @param string $path Шлях до обробника помилок(контроллера)
     * @return void
     */
    public static function setErController($path)
    {
        self::$ERROR_CONTROLLER = $path;
    }
    /**
     * Геттер для Router::$ERROR_CONTROLLER
     * @return string
     */
    public static function getErController()
    {
        return self::$ERROR_CONTROLLER;
    }
    /**
     * Сеттер для Router::$ERROR_ACTION
     * @param string $name Назва методу обробника помилок(контроллера)
     * @return void
     */
    public static function setErAction($name)
    {
        self::$ERROR_ACTION = $name;
    }
    /**
     * Геттер для Router::$ERROR_ACTION
     * @return string
     */
    public static function getErAction()
    {
        return self::$ERROR_ACTION;
    }

    public function logFile($res)
    {
        $path=ROOT."/log/";
        @mkdir($path, 0777);
        // $myfile = fopen(ROOT."/log/request.log", "w") or die("Unable to open file!");
        // fclose($myfile);
        $myfile = fopen(ROOT."/log/request.log", "a") or die("Unable to open file!");
        $txt="REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR']." SERVER_PROTOCOL: ".$_SERVER['SERVER_PROTOCOL'].
        " REQUEST_METHOD: ".$_SERVER['REQUEST_METHOD']." REQUEST_URI: ".$_SERVER['REQUEST_URI']." RESULT_U: ".$res."  CONTENT_TYPE:".$_SERVER['CONTENT_TYPE']."\n" ;
        fwrite($myfile, $txt);
    }
}
