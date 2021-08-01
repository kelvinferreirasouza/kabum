<?php

namespace Kabum\Controller;

use Kabum\Core\Controller;
use Kabum\libs\Util;
use Kabum\Model\Menu;
use Kabum\Model\Usuario;
use Kabum\Model\ModelGenerico;

class UsuariosController extends FrontController
{
    public $tabela = "usuarios";
    public $rota = "usuarios";
    public $dir = "usuarios";
    public $controller = "usuarios";

    public function __construct()
    {
        parent::__construct();
    }

    public function editar($id_usuario)
    {
        $menu = (new Menu())->getMenuByRota($this->rota);

        $usuario = (new Usuario())->getUsuarioById($id_usuario);

        require APP . 'view/_templates/header.php';
        require APP . 'view/' . $this->dir . '/editar.php';
        require APP . 'view/_templates/footer.php';
    }

    public function meuCadastro()
    {
        $id_usuario = $_SESSION["kabum"]["id"];
        $menu = (new Menu())->getMenuByRota($this->rota . "/meuCadastro");

        $usuario = (new Usuario())->getUsuarioById($id_usuario);

        $this->removeScript(URL . "js/" . VERSAO . "/toastr.min.js");

        require APP . 'view/_templates/header.php';
        require APP . 'view/' . $this->dir . '/meu_cadastro.php';
        require APP . 'view/_templates/footer.php';
    }

    public function editarCadatro()
    {
        if (isset($_POST["editar"])) {

            $id_usuario = $_SESSION["kabum"]["id"];

            $Usuario = new Usuario();
            $usuario = $Usuario->getUsuarioById($id_usuario);

            if (Util::validaCampos(['senha', 'confirmar_senha'], $_POST)) {
                if ($_POST["senha"] == $_POST["confirmar_senha"]) {
                    $senha = md5($_POST["senha"]);
                }
            } else {
                $senha = $usuario->senha;
            }

            if (Util::validaCampos(['email'], $_POST)) {
                if ($_POST['email'] == $usuario->email) {
                    $email = $usuario->email;
                } else {
                    if ($Usuario->getUsuarioByEmail($_POST['email']) != true) {
                        $email = $_POST['email'];
                    }
                }
            }

            $arrayDados = [];

            $arrayDados['id_usuario'] = $id_usuario;
            $arrayDados['nome'] = $_POST['nome'];
            $arrayDados['email'] = $email;
            $arrayDados['senha'] = $senha;
            $arrayDados['ativo'] = $usuario->ativo;

            header('location: ' . URL . $this->controller . '/meuCadastro?atualizado=true');
            exit;
        }

        header('location: ' . URL . $this->dir);
        exit;
    }

    public function desativarusuario($id_usuario)
    {
        if (isset($id_usuario)) {
            if (isset($_POST['desativar'])) {
                $Usuario = new Usuario();
                $Usuario->desativaUsuario($id_usuario);

                header('location: ' . URL . $this->dir . '?desativado=true');
                exit;
            }
        }

        header('location: ' . URL . $this->dir);
        exit;
    }

    public function ativarusuario($id_usuario)
    {
        if (isset($id_usuario)) {
            if (isset($_POST['ativar'])) {
                $Usuario = new Usuario();

                $Usuario->ativaUsuario($id_usuario);

                header('location: ' . URL . $this->dir . '?ativavo=true');
                exit;
            }
        }

        header('location: ' . URL . $this->dir);
        exit;
    }
}
