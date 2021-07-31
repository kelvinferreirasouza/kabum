<?php

namespace Kabum\Controller;

use Kabum\Core\Controller;
use Kabum\Model\Menu;
use Kabum\Model\GerenciaPost;
use Kabum\Model\ModelGenerico;
use Kabum\Model\Pessoa;
use Kabum\Model\Estado;
use Kabum\Model\Usuario;
use Kabum\Model\Cliente;

use Kabum\libs\Util;

class ClientesController extends FrontController
{
    public $tabela = "cliente";
    public $dir = "clientes";
    public $rota = "clientes";
    public $controller = "clientes";

    public function __construct()
    {
        parent::__construct();

        $this->addScript(URL . "js/" . VERSAO . "/cep.js");
        $this->addScript(URL . "js/" . VERSAO . "/estado-cidade.js");
        $this->addScript(URL . "js/" . VERSAO . "/cadastro_cliente.js");
        $this->addScript(URL . "js/" . VERSAO . "/cnpj.js");
        $this->addScript(URL . "js/" . VERSAO . "/ajax-email-usuario.js");
    }

    public function index()
    {
        parent::secure_admin();

        $Menu = new Menu();
        $Estado = new Estado();

        $menu = $Menu->getMenuByRota($this->rota);
        $paginacao = (new ModelGenerico())->paginacao();

        $clientes = (new Pessoa())->getPessoas(10, $paginacao, $_GET);
        $paginacao_proximo = (new Pessoa())->getPessoas(10, $paginacao + 1, $_GET);

        require APP . 'view/_templates/header.php';
        require APP . 'view/' . $this->dir . '/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function adicionar()
    {
        parent::secure_admin();

        $Menu = new Menu();

        $menu = $Menu->getMenuByRota($this->rota);
        $estados = (new Estado())->getEstados();
        $cidades = (new ModelGenerico())->getAllItensSemAtivo('cidade');
        $tiposCliente = (new Pessoa())->getTiposCliente();

        require APP . 'view/_templates/header.php';
        require APP . 'view/' . $this->dir . '/adicionar.php';
        require APP . 'view/_templates/footer.php';
    }

    public function editar($id)
    {
        parent::secure_admin();

        $Menu = new Menu();
        $menu = $Menu->getMenuByRota($this->rota);
        $estados = (new Estado())->getEstados();

        $obj = (new Pessoa())->getPessoaById($id);
        $uf_estado = (new Estado())->getEstadoByID($obj->id_estado);
        $tiposCliente = (new Pessoa())->getTiposCliente();

        require APP . 'view/_templates/header.php';
        require APP . 'view/' . $this->dir . '/adicionar.php';
        require APP . 'view/_templates/footer.php';
    }

    public function meuCadastro()
    {
        $Menu = new Menu();
        $id = $_SESSION["ops"]["id_pessoa"];
        $menu = $Menu->getMenuByRota($this->rota . '/meuCadastro');
        $estados = (new Estado())->getEstados();
        $tiposCliente = (new Pessoa())->getTiposCliente();

        $obj = (new Pessoa())->getPessoaById($id);

        require APP . 'view/_templates/header.php';
        require APP . 'view/' . $this->dir . '/adicionar.php';
        require APP . 'view/_templates/footer.php';
    }

    public function adicionarCliente()
    {
        if (isset($_POST['nome']) && $_POST['nome'] != "" || isset($_POST['nome_empresa']) && $_POST['nome_empresa']) {
            (new Cliente())->insertCliente($_POST);
        }

        header('location: ' . URL . $this->rota);
        exit;
    }

    public function editarCliente($id)
    {
        $Obj = new ModelGenerico();
        $obj = $Obj->getItemByID($id, $this->tabela);

        if ($_POST['nome'] != "" || isset($_POST['nome_empresa']) && $_POST['nome_empresa']) {

            $_POST['id'] = $id;

            (new Cliente())->updateCliente($_POST);
        }

        header('location: ' . URL . $this->rota);
        exit;
    }

    public function desativar($id)
    {
        parent::secure_admin();

        if (isset($id)) {

            if (isset($_POST['desativar'])) {

                (new ModelGenerico())->desativarItem($id, $this->tabela);

                header('location: ' . URL . $this->rota . '?desativado=true');
                exit;
            }
        }
        header('location: ' . URL . $this->rota);
        exit;
    }


    public function ativar($id)
    {
        parent::secure_admin();

        if (isset($id)) {
            if (isset($_POST['ativar'])) {

                (new ModelGenerico())->ativarItem($id, $this->tabela);

                header('location: ' . URL . $this->rota . '?ativado=true');
                exit;
            }
        }
        header('location: ' . URL . $this->rota);
        exit;
    }
}
