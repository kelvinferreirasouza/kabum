<?php

namespace Kabum\Controller;

use Kabum\libs\Util;
use Kabum\Model\Cliente;
use Kabum\Model\Usuario;
use Kabum\Model\Estado;
use Kabum\Model\ModelGenerico;

class AjaxController
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        date_default_timezone_set('America/Sao_Paulo');
    }

    public function validaRequisicaoPost()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode(['error' => true, 'code' => '00', 'message' => 'método não aceito.']);
            exit;
        }

        return true;
    }

    public function getUsuarioByEmail()
    {
        if (isset($_POST['email'])) {

            $Usuario = new Usuario();

            if ($Usuario->getUsuarioByEmail($_POST['email']) != false) {
                echo 'true';
            } else {
                echo 'false';
            };
        }
    }

    public function getClienteByCpf()
    {
        if (isset($_POST['cpf'])) {

            $Cliente = new Cliente();

            if ($Cliente->getClienteByCpf(Util::formataLimpaString($_POST['cpf'])) != false) {
                echo 'true';
            } else {
                echo 'false';
            };
        }
    }

    public function getCidadesSelects($id)
    {
        $Estado = new Estado();

        $estados = $Estado->getCidadesByEstado($id);

        echo json_encode($estados);
    }

    public function excluirEnderecoCliente()
    {
        if (isset($_POST['id'])) {

            (new ModelGenerico())->deletarRegistroById($_POST['id'], 'cliente_endereco');

            echo json_encode(['error' => false, 'message' => 'Endereço excluído com sucesso.']);
            exit;
        }

        echo json_encode(['error' => true, 'message' => 'Informe um endereço válido.']);
        exit;
    }

    public function adicionarEnderecoCliente()
    {
        $this->validaRequisicaoPost();

        if (Util::validaCampos(['cep', 'estado', 'cidade', 'endereco', 'numero_endereco', 'bairro', 'id_cliente'], $_POST)) {

            $id_endereco = (new Cliente())->insertClienteEndereco($_POST);

            $cliente_endereco = (new Cliente())->getEnderecoClienteById($id_endereco);

            echo json_encode(['error' => false, 'message' => 'Endereço cadastrado com sucesso.', 'endereco_cadastrado' => $cliente_endereco]);
            exit;
        }

        echo json_encode(['error' => true, 'message' => 'Informe todos os campos.']);
        exit;
    }

    public function getEnderecoClienteById()
    {
        $this->validaRequisicaoPost();

        if (Util::validaCampos(['id_endereco'], $_POST)) {

            $cliente_endereco = (new Cliente())->getEnderecoClienteById($_POST['id_endereco']);

            echo json_encode(['error' => false, 'endereco_cadastrado' => $cliente_endereco]);
            exit;
        }

        echo json_encode(['error' => true, 'message' => 'Informe todos os campos.']);
        exit;
    }

    public function updateEnderecoClienteById()
    {
        $this->validaRequisicaoPost();

        if (Util::validaCampos(['cep', 'estado', 'cidade', 'endereco', 'numero_endereco', 'bairro', 'id_endereco'], $_POST)) {

            (new Cliente())->updateEnderecoClienteById($_POST);

            $cliente_endereco = (new Cliente())->getEnderecoClienteById($_POST['id_endereco']);

            echo json_encode(['error' => false, 'message' => 'Endereço atualizado com sucesso.', 'endereco_cadastrado' => $cliente_endereco]);
            exit;
        }

        echo json_encode(['error' => true, 'message' => 'Informe todos os campos.']);
        exit;
    }
}
