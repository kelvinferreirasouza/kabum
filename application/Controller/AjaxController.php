<?php

namespace Kabum\Controller;

use Kabum\libs\Util;
use Kabum\Model\Estado;
use Kabum\Model\Usuario;
use Kabum\Model\ModelGenerico;
use Kabum\Model\Pessoa;
use Kabum\Model\Profissional;
use Kabum\Model\SubCategoria;
use Kabum\Model\Cidade;
use Kabum\Model\Bairro;
use Kabum\Model\Categoria;
use Kabum\Model\Filial;
use Kabum\Model\Bot;
use Kabum\Model\GerenciaPost;

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

    public function getUsuarioByEmail($email)
    {
        $Usuario = new Usuario();

        if ($Usuario->getUsuarioByEmail($email) != false) {
            echo 'false';
        } else {
            echo 'true';
        };
    }

    public function getUsuarioByCpf($cpf)
    {
        $Usuario = new Usuario();

        if ($Usuario->getUsuarioByCpf(Util::formataLimpaString($cpf)) != false) {
            echo 'false';
        } else {
            echo 'true';
        };
    }

    public function getCidades($id)
    {
        $Estado = new Estado();

        $estado = (new ModelGenerico())->getItemByID($id, 'estado');

        $cidades = $Estado->getCidadesByEstado($estado->uf);

        echo json_encode($cidades);
    }

    public function getCidadesSelects($id)
    {
        $Estado = new Estado();

        $estados = $Estado->getCidadesByEstado($id);

        echo json_encode($estados);
    }

    public function getDadosEstadoCidade()
    {
        $this->validaRequisicaoPost();

        $estados = (new Estado())->getEstados();

        $_POST['cidade'] = Util::removerAcentos($_POST['cidade']);

        $cidade_franquia = (new Estado())->getCidadeByNome($_POST['cidade']);
        $estado_franquia = (new Estado())->getEstadoByUf($_POST['uf']);

        $cidadesUf = (new Estado())->getCidadesByEstado($_POST['uf']);

        if ($cidade_franquia || $estado_franquia) {
            echo json_encode([
                'error' => false,
                'estados' => $estados,
                'cidades' => $cidadesUf,
                'cidade_franquia' => $cidade_franquia,
                'estado_franquia' => $estado_franquia
            ]);
            exit;
        } else {
            echo json_encode(['error' => false, 'franquia' => 'true']);
            exit;
        }
    }

    public function existePessoaByCpfCnpj()
    {
        $cliente = (new Pessoa())->getPessoaByCpfCnpj($_POST['cpf_cnpj']);

        if ($cliente) {
            $retorno = true;
        } else {
            $retorno = false;
        }

        echo json_encode($retorno);
        exit;
    }

    public function getCategoriasByProfissional()
    {
        $this->validaRequisicaoPost();

        $subcategorias = [];
        $categorias_profissional = [];
        $categorias_select = [];

        if (isset($_POST["id_profissional"])) {
            $categorias_profissional = (new Profissional())->getCategoriasByProfissional($_POST["id_profissional"]);
            $categorias_select = (new Profissional())->getSelectCategoriasByProfissional($_POST["id_profissional"]);

            if (isset($categorias_select[0]->id)) {
                $subcategorias = (new Profissional())->getSubCategoriasByCategoria($_POST["id_profissional"], $categorias_select[0]->id);
            }

            $tipos_negociacao = (new ModelGenerico())->getAllItens("tipo_negociacao");

            echo json_encode([
                'error' => false,
                'categorias_profissional' => $categorias_profissional,
                'categorias_select' => $categorias_select,
                'subcategorias' => $subcategorias,
                'tipos_negociacao' => $tipos_negociacao
            ]);
            exit;
        } else {
            echo json_encode([
                'error' => true,
                'categorias_profissional' => $categorias_profissional,
                'categorias_select' => $categorias_select,
                'subcategorias' => $subcategorias,
            ]);
            exit;
        }
    }

    public function getSubCategoriasByCategoria()
    {
        $this->validaRequisicaoPost();

        $subcategorias = [];

        if (isset($_POST["id_profissional"])) {
            $subcategorias = (new Profissional())->getSubCategoriasByCategoria($_POST["id_profissional"], $_POST["id_categoria"]);

            echo json_encode(['error' => false, 'subcategorias' => $subcategorias]);
            exit;
        } else {
            echo json_encode(['error' => true, 'subcategorias' => $subcategorias]);
            exit;
        }
    }

    public function deleteCategoriaProfissional()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST["id_categoria_desativar"])) {
            (new Profissional())->deleteCategoriaProfissional($_POST["id_categoria_desativar"]);

            echo json_encode(['error' => false]);
            exit;
        } else {
            echo json_encode(['error' => true]);
            exit;
        }
    }

    public function getDocumentosByProfissional()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST["id_profissional"])) {
            $documentos_anexados = (new Profissional())->getImagensByProfissional($_POST["id_profissional"]);

            echo json_encode(['error' => false, 'documentos_anexados' => $documentos_anexados,]);
            exit;
        } else {
            echo json_encode(['error' => true, 'documentos_anexados' => []]);
            exit;
        }
    }

    public function getRegioesAtendidasByProfissional()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST["id_profissional"])) {

            $paginacao = (new ModelGenerico())->paginacao();

            $regioes_atendidas = (new Profissional())->getRegioesAtendidasByProfissional(10, $paginacao, $_POST['filtros'], $_POST["id_profissional"]);
            $paginacao_proximo = (new Profissional())->getRegioesAtendidasByProfissional(10, $paginacao + 1, $_POST['filtros'], $_POST["id_profissional"]);
            $estados = (new Estado())->getEstados();

            echo json_encode([
                'error' => false,
                'regioes_atendidas' => $regioes_atendidas,
                'paginacao_proximo' => $paginacao_proximo,
                'estados' => $estados
            ]);
            exit;
        } else {
            echo json_encode(['error' => true, 'message' => 'Deve ser informado um profissional válido.']);
            exit;
        }
    }

    public function deleteDocumentoProfissionalById()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST["id_profissional"]) && isset($_POST["id_imagem_delete"])) {

            $doc = (new ModelGenerico())->getItemByID($_POST['id_imagem_delete'], 'profissional_arquivos');
            @unlink("../public/documentos/profissional/" . $doc->nome_salvo);

            (new Profissional())->deleteDocumentoProfissionalById($_POST["id_imagem_delete"]);

            echo json_encode(['error' => false]);
            exit;
        } else {
            echo json_encode(['error' => true]);
            exit;
        }
    }

    public function desativaVendedorFilialById()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST["id_vendedor"])) {
            (new ModelGenerico())->desativarItemByCampoGenerico($_POST['id_vendedor'], 'usuarios', 'id_usuario');

            echo json_encode(['error' => false]);
            exit;
        } else {
            echo json_encode(['error' => true]);
            exit;
        }
    }

    public function ativaVendedorFilialById()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST["id_vendedor"])) {
            (new ModelGenerico())->ativarItemByCampoGenerico($_POST['id_vendedor'], 'usuarios', 'id_usuario');

            echo json_encode(['error' => false]);
            exit;
        } else {
            echo json_encode(['error' => true]);
            exit;
        }
    }

    public function desativaSubCategoriaById()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST["id_subcategoria"])) {

            (new ModelGenerico())->desativarItem($_POST['id_subcategoria'], 'categoria');

            echo json_encode(['error' => false]);
        } else {
            echo json_encode(['error' => true]);
        }
    }

    public function desativaRegiaoById()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST["id_profissional"]) && isset($_POST["id_cidade"])) {

            (new Profissional())->deletelAllBairrosByIdProfissionalAndCidade($_POST["id_profissional"], $_POST["id_cidade"]);

            echo json_encode(['error' => false]);
        } else {
            echo json_encode(['error' => true]);
        }
    }

    public function ativaSubCategoriaById()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST["id_subcategoria"])) {

            (new ModelGenerico())->ativarItem($_POST["id_subcategoria"], 'categoria');

            echo json_encode(['error' => false]);
        } else {
            echo json_encode(['error' => true]);
        }
    }

    public function getSubCategoriasByCategoriaId()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST['id_categoria']) && $_POST['id_categoria'] != '') {

            $paginacao = (new ModelGenerico())->paginacao();

            if (!isset($_POST['filtros'])) {
                $_POST['filtros'] = false;
            }

            $subcategorias = (new SubCategoria())->getSubCategoriasByCategoria(10, $paginacao, $_POST['filtros'], $_POST['id_categoria']);
            $paginacao_proximo = (new SubCategoria())->getSubCategoriasByCategoria(10, $paginacao + 1, $_POST['filtros'], $_POST['id_categoria']);

            echo json_encode(['error' => false, 'subcategorias' => $subcategorias]);
            exit;
        } else {
            echo json_encode(['error' => true, 'message' => 'Deve ser informado uma categorias válida.']);
            exit;
        }
    }

    public function adicionaRegraNegociacao()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST['id_categoria']) && $_POST['id_categoria'] != '') {
            $ID_TIPO_VALOR_FIXO = 1;
            $ID_TIPO_COMISSAO = 2;

            $id_servico = $_POST["id_servico"];

            $arrayPost = array();

            $arrayPost["id_categoria"] = $_POST["id_categoria"];
            $arrayPost["id_profissional"] = $_POST["id_profissional"];
            $arrayPost["id_sub_categoria"] = $_POST["id_sub_categoria"];
            $arrayPost["id_tipo_negociacao"] = $_POST["id_tipo_negociacao"];

            if ($ID_TIPO_COMISSAO == $_POST["id_tipo_negociacao"]) {
                $arrayPost["percentual_comissao"] = $_POST["percentual"];
                $arrayPost["valor_minimo"] = Util::unmaskMoney($_POST["valor_minimo"]);

                $arrayPost["valor_comissao"] = 0;
                $arrayPost["valor_venda"] = 0;
                $arrayPost["quantidade"] = 0;
            } else {
                $arrayPost["valor_comissao"] = Util::unmaskMoney($_POST["valor_comissao"]);
                $arrayPost["valor_venda"] = Util::unmaskMoney($_POST["valor_venda"]);
                $arrayPost["quantidade"] = $_POST["quantidade"];

                $arrayPost["percentual_comissao"] = 0;
                $arrayPost["valor_minimo"] = 0;
            }


            if ($_POST["id_servico"] == 0 || $_POST["id_servico"] == "") {
                $id_servico = (new GerenciaPost())->insert($arrayPost, "profissional_servico", true);
            } else {
                (new GerenciaPost())->update($arrayPost, "profissional_servico", "id", $_POST["id_servico"]);
            }

            echo json_encode(['error' => false, 'id_servico' => $id_servico]);
            exit;
        }
        echo json_encode(['error' => true, 'id_servico' => null]);
        exit;
    }

    public function getServicoProfissionalById()
    {

        $this->validaRequisicaoPost();
        $servico = null;

        if (isset($_POST['id_servico']) && $_POST['id_servico'] != '') {
            $servico = (new ModelGenerico())->getItemByID($_POST['id_servico'], "profissional_servico");
        }

        echo json_encode([
            'error' => false,
            'servico' => $servico
        ]);
        exit;
    }

    public function getCidadeByCodigoIbge()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST["codigo"])) {

            $cidade = (new ModelGenerico())->getItemByCampoGenericoAndItemAtivo($_POST['codigo'], 'cidade', 'codigo');

            echo json_encode(['error' => false, 'cidade' => $cidade]);
            exit;
        } else {
            echo json_encode(['error' => true, 'message' => 'Deve ser informado um código IBGE válido.']);
            exit;
        }
    }

    public function getBairrosByIdCidade()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST['id_cidade']) && $_POST['id_cidade'] != '') {
            $bairros = (new Bairro())->getBairrosByIdCidadeSemFiltro($_POST['id_cidade']);

            echo json_encode($bairros);
            exit;
        } else {
            echo json_encode(['error' => true, 'message' => 'Deve ser informado uma cidade válida.']);
            exit;
        }
    }

    public function getBairrosAndCidadeByIdCidade()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST['id_cidade']) && $_POST['id_cidade'] != '') {
            $bairros = (new Bairro())->getBairrosByIdCidadeSemFiltro($_POST['id_cidade']);
            $cidade = (new Cidade())->getCidadeById($_POST['id_cidade']);

            echo json_encode(['error' => false, 'bairros' => $bairros, 'cidade' => $cidade]);
            exit;
        } else {
            echo json_encode(['error' => true, 'message' => 'Deve ser informado uma cidade válida.']);
            exit;
        }
    }

    public function getBairrosAtendidoByIdCidadeAndProfissional()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST['id_cidade']) && $_POST['id_cidade'] != '' && isset($_POST['id_profissional']) && $_POST['id_profissional'] != '') {

            $cidade = (new Cidade())->getCidadeById($_POST['id_cidade']);
            $bairros = (new Bairro())->getBairrosAndBairrosAtendidosByCidadeAndProf($_POST['id_cidade'], $_POST['id_profissional']);

            echo json_encode(['error' => false, 'cidade' => $cidade, 'bairros' => $bairros]);
            exit;
        } else {
            echo json_encode(['error' => true, 'message' => 'Deve ser informado uma cidade válida.']);
            exit;
        }
    }

    public function getCamposListagemBairros()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST['id_cidade']) && $_POST['id_cidade'] != '') {

            $paginacao = (new ModelGenerico())->paginacao();

            $BairroModel = new Bairro();

            if (isset($_POST['filtros']) && $_POST['filtros'] != 'false') {
                $filtros = $_POST['filtros'];
            } else {
                $filtros = '';
            }

            $bairros = $BairroModel->getBairrosByIdCidade(10, $paginacao, $_POST['id_cidade'], $filtros);
            $paginacao_proximo = $BairroModel->getBairrosByIdCidade(10, $paginacao + 1, $_POST['id_cidade'], $filtros);

            echo json_encode(['error' => false, 'bairros' => $bairros, 'paginacao_proximo' => $paginacao_proximo]);
            exit;
        } else {
            echo json_encode(['error' => true, 'message' => 'Deve ser informado uma rota válida.']);
            exit;
        }
    }

    public function desativaBairroById()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST["id_bairro"])) {

            (new ModelGenerico())->desativarItem($_POST['id_bairro'], 'bairro');

            echo json_encode(['error' => false]);
        } else {
            echo json_encode(['error' => true]);
        }
    }

    public function ativaBairroById()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST["id_bairro"])) {

            (new ModelGenerico())->ativarItem($_POST["id_bairro"], 'bairro');

            echo json_encode(['error' => false]);
        } else {
            echo json_encode(['error' => true]);
        }
    }

    public function getSubcategoriasByIdCategoria()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST['id_categoria']) && $_POST['id_categoria'] != '') {

            $subcategorias = (new Categoria())->getAllSubcategoriasByCategoria($_POST['id_categoria']);

            echo json_encode(['error' => false, 'subcategorias' => $subcategorias]);
            exit;
        } else {
            echo json_encode(['error' => true, 'message' => 'Deve ser informado uma categoria.']);
            exit;
        }
    }

    public function getFiliaisByIdFranquia()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST['id_franquia']) && $_POST['id_franquia'] != '') {

            $filiais = (new Pessoa())->getPessoasByTipoAndIdPai($id_tipo = 3, $_POST['id_franquia']);

            echo json_encode(['error' => false, 'filiais' => $filiais]);
            exit;
        } else {
            echo json_encode(['error' => true, 'message' => 'Deve ser informado uma franquia.']);
            exit;
        }
    }

    public function chatbot()
    {
        $celular = '554891467457'; //A API IRA RECEBER NESSE FORMATO
        $bot = new Bot($_POST['message'], $celular);
        $response = $bot->getResposta();

        echo json_encode($response);
        exit;
    }

    public function getDadosCidadeByCodigoIbge()
    {
        $this->validaRequisicaoPost();

        if (isset($_POST['cod_ibge']) && $_POST['cod_ibge'] != '') {

            $cidade = (new ModelGenerico())->getItemByCampoGenericoUnico($_POST['cod_ibge'], 'cidade', 'codigo');
            $estado = (new Estado())->getEstadoByCidade($cidade->id);
            $bairros = (new Bairro())->getBairrosByIdCidadeSemFiltro($cidade->id);

            echo json_encode(['error' => false, 'cidade' => $cidade, 'estado' => $estado, 'bairros' => $bairros]);
            exit;
        } else {
            echo json_encode(['error' => true, 'message' => 'Deve ser informado um código ibge.']);
            exit;
        }
    }
}
