<?php

abstract class Controller{

//    public function model($model){
//        require_once "./mvc/models/".$model.".php";
//        return new $model;
//    }


    public function error(): void
    {
        $this->view("default", [
            "Page" => "error"
        ]);
    }

    abstract function index():void;

    public function model(string $model): Model
    {
        require_once __DIR__."/../Models/".$model.".php";
        return new $model;
    }

    public function view($template, $data): void
    {

        if (!isset($data)) {
            $data = ["Page"=>"error", "View"=>""];
        }

//        Kiểm tra Page xem coi nó ở đâu nếu chưa được đặt
        if (!isset($data["Page"])) {
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 3);

            $i = $backtrace[2]["function"];

            if ($i == "__construct") {
                $i = $backtrace[1]["function"];
            }
            if ($i != null) {
                $data["Page"] = $i;
            }
            else {
                $data["Page"] = "error";
                $data["View"] = "";
            }
        }

//        Kiểm tra View
        if (!isset($data["View"])) {
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $defaultView = explode("Controller",$backtrace[1]["class"])[0];
            $data["View"] = $defaultView."/";
        }

        require_once __DIR__."/../Views/Template/".$template.".php";
    }

}
