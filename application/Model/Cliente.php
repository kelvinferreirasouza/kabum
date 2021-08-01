<?php

namespace Kabum\Model;

use Kabum\Core\Model;
use Kabum\libs\Util;

class Cliente extends Model
{
    public function getClientes($qtd, $pagina, $filtros = false)
    {
        $filtros_query = "";
        $parameters = array();

        if (isset($filtros['buscar']) && $filtros['buscar'] != '') {
            $filtros_query .= "AND ucase(nome) LIKE ucase(:buscar)";
            $parameters[':buscar'] = "%{$filtros['buscar']}%";
        }

        if (isset($filtros['cpf']) && $filtros['cpf'] != '') {
            $filtros_query .= "AND cpf = :cpf";

            $parameters[':cpf'] = Util::formataLimpaString($filtros['cpf']);
        }

        if (isset($filtros['ativo']) && $filtros['ativo'] != '') {
            $filtros_query .= "AND ativo = :ativo";
            $parameters[':ativo'] = $filtros['ativo'];
        } else {
            $filtros_query .= "AND ativo = 1";;
        }

        $offset = ($pagina - 1) * $qtd;

        $sql = "SELECT 
                    *
                FROM 
                    cliente
                WHERE 
                    TRUE {$filtros_query} 
                ORDER BY
                    nome ASC
                LIMIT
                    $qtd OFFSET $offset";

        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getClienteByCpf($cpf)
    {
        $sql = "SELECT * FROM cliente WHERE cpf = :cpf";

        $query = $this->db->prepare($sql);

        $parameters = array(':cpf' => $cpf);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function insertCliente($dados)
    {
        $arrayInsert = [];

        $arrayInsert['nome'] = $dados['nome'];
        $arrayInsert['cpf'] = $dados['cpf'];
        $arrayInsert['rg'] = $dados['rg'];
        $arrayInsert['telefone'] = $dados['telefone'];
        $arrayInsert['data_nascimento'] = $dados['data_nascimento'];

        $id_cliente = (new GerenciaPost())->insert($arrayInsert, 'cliente', $retorna_id = true);

        return $id_cliente;
    }

    public function getEnderecosByCliente($id_cliente)
    {
        $filtros_query = "";
        $parameters = array();

        $filtros_query .= "AND ce.id_cliente = :id_cliente";
        $parameters[':id_cliente'] = $id_cliente;

        $sql = "SELECT 
                    ce.*, e.uf AS uf_estado, c.nome AS nome_cidade
                FROM 
                    cliente_endereco ce
                LEFT JOIN
                    estado e
                ON
                    e.id = ce.id_estado
                LEFT JOIN
                    cidade c
                ON
                    c.id = ce.id_cidade
                WHERE 
                    TRUE {$filtros_query} 
                ORDER BY
                    ce.endereco ASC";

        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getEnderecoClienteById($id_endereco)
    {
        $filtros_query = "";
        $parameters = array();

        $filtros_query .= "AND ce.id = :id_endereco";
        $parameters[':id_endereco'] = $id_endereco;

        $sql = "SELECT 
                    ce.*, e.uf AS uf_estado, c.nome AS nome_cidade
                FROM 
                    cliente_endereco ce
                LEFT JOIN
                    estado e
                ON
                    e.id = ce.id_estado
                LEFT JOIN
                    cidade c
                ON
                    c.id = ce.id_cidade
                WHERE 
                    TRUE {$filtros_query} 
                ORDER BY
                    ce.endereco ASC";

        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function insertClienteEndereco($dados)
    {
        $estado = (new Estado())->getEstadoByUf($dados['estado']);

        $arrayInsert = [];

        $arrayInsert['id_cliente'] = $dados['id_cliente'];
        $arrayInsert['cep'] = $dados['cep'];
        $arrayInsert['id_estado'] = $estado->id;
        $arrayInsert['id_cidade'] = $dados['cidade'];
        $arrayInsert['endereco'] = $dados['endereco'];
        $arrayInsert['numero'] = $dados['numero_endereco'];
        $arrayInsert['complemento'] = $dados['complemento'];
        $arrayInsert['bairro'] = $dados['bairro'];

        $id_endereco = (new GerenciaPost())->insert($arrayInsert, 'cliente_endereco', $retorna_id = true);

        return $id_endereco;
    }

    public function updateEnderecoClienteById($dados)
    {
        $estado = (new Estado())->getEstadoByUf($dados['estado']);

        $arrayUpdate = [];

        $arrayUpdate['id_cliente'] = $dados['id_cliente'];
        $arrayUpdate['cep'] = $dados['cep'];
        $arrayUpdate['id_estado'] = $estado->id;
        $arrayUpdate['id_cidade'] = $dados['cidade'];
        $arrayUpdate['endereco'] = $dados['endereco'];
        $arrayUpdate['numero'] = $dados['numero_endereco'];
        $arrayUpdate['complemento'] = $dados['complemento'];
        $arrayUpdate['bairro'] = $dados['bairro'];

        (new GerenciaPost())->update($arrayUpdate, 'cliente_endereco', 'id', $dados['id_endereco']);
    }
}
