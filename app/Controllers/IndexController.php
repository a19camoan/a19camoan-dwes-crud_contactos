<?php
    namespace App\Controllers;

    class IndexController extends BaseController
    {
        public function indexAction()
        {
            $data = array("message" => "Hola mundo!");
            $this->renderHTML("../views/index_view.php", $data);
        }

        public function saludaAction($request)
        {
            $urlDecode = explode("/", $request);
            $data = array("message" => "Saludos " . end($urlDecode));
            $this->renderHTML("../Views/index_view.php", $data);
        }
    }
