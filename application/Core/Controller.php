<?php

namespace Kabum\Core;

use Kabum\Model\Usuario;
use Kabum\Model\Menu;
use Kabum\Model\ConfigSistema;

class Controller
{
    public $menu = null;
    public $paginas = null;
    public $config_sistema = null;

    public function __construct()
    {
        $this->menu = new Menu();
        $this->config_sistema = (new ConfigSistema())->getConfigs();

        $Usuario = new Usuario();

        $Usuario->checaSessao();

        $this->paginas = $this->menu->getMenu();
    }
}
