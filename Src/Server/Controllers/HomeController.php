<?php

class HomeController extends Controller
{
    public string $homeTemplate = "Home/_default";
    public string $signTemplate = "signDefault";



    function index() : void
    {
        header("Location: /Home/Home");
    }

    function Home() {
        $this->view($this->homeTemplate, []);
    }

    function SignIn()
    {
        if (isset($_GET["mssv"]) && isset($_GET["pass"])) {
            $model = $this->model("UserModel");
            $res = $model->getUser($_GET["mssv"], $_GET["pass"]);
            if (isset($res[0])) {
                $_SESSION["user"] = $res[0];
            }
        }

        if (isset($_SESSION["user"])) {
            header("Location: /");
            return;
        }

        $this->view($this->signTemplate, []);
    }

    public function SignOut() {
        unset($_SESSION["user"]);
        header("Location: /");
    }


}