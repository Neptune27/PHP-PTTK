<?php

class App
{

    protected mixed $controller = "HomeController";
    protected string $action = "index";
    protected array $params = [];

    function __construct()
    {

        $arr = $this->UrlProcess();

        // Controller
        if (isset($arr[0])) {
            if (file_exists(__DIR__."/../Controllers/".$arr[0] . "Controller.php")) {
                $this->controller = $arr[0] . "Controller";
                unset($arr[0]);
            }
        }

        require_once __DIR__ . "/../Controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        // Action
        if (isset($arr[1])) {
            if (method_exists($this->controller, $arr[1])) {
                $this->action = $arr[1];
            } else {
                $this->action = "error";
            }
            unset($arr[1]);
        }

        // Params
        $this->params = $arr ? array_values($arr) : [];
        call_user_func_array([$this->controller, $this->action], [$this->params]);

    }

    function UrlProcess()
    {
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
    }

}

?>