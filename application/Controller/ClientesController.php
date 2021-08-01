<?php

namespace Kabum\Controller;

use Kabum\Core\Controller;
use Kabum\Model\Menu;
use Kabum\Model\GerenciaPost;
use Kabum\Model\ModelGenerico;
use Kabum\Model\Estado;
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
    }

    public function index()
    {
        $Menu = new Menu();

        $menu = $Menu->getMenuByRota($this->rota);
        $paginacao = (new ModelGenerico())->paginacao();

        $clientes = (new Cliente())->getClientes(10, $paginacao, $_GET);
        $paginacao_proximo = (new Cliente())->getClientes(10, $paginacao + 1, $_GET);

        require APP . 'view/_templates/header.php';
        require APP . 'view/' . $this->dir . '/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function adicionar()
    {
        $Menu = new Menu();
        $menu = $Menu->getMenuByRota($this->rota);
        $estados = (new Estado())->getEstados();

        $this->addScript(URL . 'js/' . VERSAO . '/cliente.js');
        $this->addScript(URL . 'js/' . VERSAO . '/validacoes.js');

        require APP . 'view/_templates/header.php';
        require APP . 'view/' . $this->dir . '/adicionar.php';
        require APP . 'view/_templates/footer.php';
    }

    public function editar($id_cliente)
    {
        $Menu = new Menu();
        $menu = $Menu->getMenuByRota('#clientes');

        $cliente = (new ModelGenerico())->getItemByID($id_cliente, $this->tabela);
        $cliente_enderecos = (new Cliente())->getEnderecosByCliente($id_cliente);

        $estados = (new Estado())->getEstados();

        $this->addScript(URL . 'js/' . VERSAO . '/cliente.js');
        $this->addScript(URL . 'js/' . VERSAO . '/validacoes.js');

        require APP . 'view/_templates/header.php';
        require APP . 'view/' . $this->dir . '/editar.php';
        require APP . 'view/_templates/footer.php';
    }

    public function adicionarCliente()
    {
        if (Util::validaCampos(['nome', 'cpf', 'rg', 'telefone', 'data_nascimento'], $_POST)) {

            $id_cliente = (new Cliente())->insertCliente($_POST);

            header('location: ' . URL . $this->rota . "/editar/" . $id_cliente);
            exit;
        }
    }

    public function desativar($id)
    {
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
