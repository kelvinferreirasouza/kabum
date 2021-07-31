<?php

namespace Kabum\Controller;

use Kabum\Model\Usuario;
use Kabum\Model\ModelGenerico;

use Kabum\libs\Util;

class LoginController
{
    public $tabela = "usuario";
    public $dir = "login";
    public $rota = "login";
    public $controller = "login";

    public function verificaSession()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function index()
    {
        $this->verificaSession();

        require APP . "view/{$this->dir}/index.php";
    }

    public function recuperarsenha()
    {
        $this->verificaSession();

        require APP . "view/{$this->dir}/recuperar_senha.php";
    }

    public function logar()
    {
        $this->verificaSession();

        if (isset($_POST['login'])) {

            if ($_POST['senha'] != "" && $_POST['email'] != "") {

                $_POST['email'] = strtolower($_POST['email']);

                $Usuario = new Usuario();

                if ($Usuario->getUsuarioByEmail($_POST['email']) == true) {

                    $usuario = $Usuario->getUsuarioByEmail($_POST['email']);

                    if (md5($_POST['senha']) == $usuario->senha && $usuario->ativo == 1) {
                        $_SESSION['kabum']['id'] = $usuario->id;
                        $_SESSION['kabum']['email'] = $usuario->email;
                        $_SESSION['kabum']['nome'] = $usuario->nome;

                        header('location: ' . URL . "/home");
                        exit;
                    } else {
                        header('location: ' . URL . 'login/index?dadosincorretos=true');
                    }
                } else {
                    header('location: ' . URL . 'login/index?dadosincorretos=true');
                }
            } else {
                header('location: ' . URL . 'login/index?dadosincorretos=true');
            }
        } else {
            header('location: ' . URL . 'login/index');
        }
    }

    public function logout()
    {
        session_start();

        unset($_SESSION['kabum']);

        header('location: ' . URL . 'login/index');
    }
}
