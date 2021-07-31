<?php

namespace Kabum\Controller;

use Kabum\Core\Controller;
use Kabum\Model\Usuario;
use Kabum\Model\Menu;

class HomeController extends FrontController
{

    public function index()
    {
        $Usuario = new Usuario();

        header('location: ' . URL . "home/usuario");
        exit;
    }

    public function usuario()
    {
        $menu = (new Menu())->getMenuByRota('home');

        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
