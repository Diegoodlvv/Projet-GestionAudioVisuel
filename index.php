<?php 
define ('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
session_start();

if(isset($_GET['action']) && !empty($_GET['action'])){
    $params = explode("/", $_GET['action']);

    if($params[0] != "") {
        $controller = $params[0];
        $action = isset($params[1]) ? $params[1] : 'library';
        $controllerFile = ROOT . 'Controllers/' . $controller . 'Controller.php';

        if(file_exists($controllerFile)) {
            require_once($controllerFile);

            if (class_exists($controller . 'Controller')) {
                $controllerClass = $controller . 'Controller';
                $controllerObject = new $controllerClass();

                if (method_exists($controllerObject, $action)) {

                    if (isset($params[2]) && isset($params[3])) {
                        $controllerObject->$action($params[2], $params[3]);
                    } else if (isset($params[2])) {
                        $controllerObject->$action($params[2]);
                    } else {
                        $controllerObject->$action();
                    }

                } else {
                    header('HTTP/1.0 404 Not Found');
                    require_once('views/errors/404.html');
                }

            }
        } else {
            header('HTTP/1.0 404 Not Found');
            require_once('views/errors/404.html');
        }
    }
} else {
    require_once('Controllers/MediaController.php');
    MediaController::library(); 
}