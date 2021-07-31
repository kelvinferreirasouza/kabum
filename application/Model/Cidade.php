<?php

namespace Kabum\Model;

use Kabum\Core\Model;

class Cidade extends Model
{
    public function getCidades($qtd, $pagina, $filtros)
    {
        $filtros_query = "";
        $parameters = array();

        if (isset($filtros['nome']) && $filtros['nome'] != "") {
            $filtros_query .= " AND ucase(c.nome) LIKE ucase('%{$filtros['nome']}%')";
        }

        if (isset($filtros['ativo']) && $filtros['ativo'] != "") {
            $filtros_query .= " AND c.ativo = :ativo";
            $parameters[':ativo'] = $filtros['ativo'];
        } else {
            $filtros_query .= " AND c.ativo = 1";
        }

        if (isset($filtros['id_estado']) && $filtros['id_estado'] != "") {
            $filtros_query .= " AND e.id = :id_estado";
            $parameters[':id_estado'] = $filtros['id_estado'];
        }

        $offset = ($pagina - 1) * $qtd;

        $sql = "SELECT
                    c.*, e.nome AS nome_estado
                FROM
                    cidade c, estado e
                WHERE
                    c.uf = e.uf
                AND
                    TRUE $filtros_query
                ORDER BY
                    c.uf ASC, c.nome ASC
                LIMIT $qtd OFFSET $offset";

        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getCidadeById($id_cidade)
    {
        $filtros_query = "";
        $parameters = array();

        if (isset($id_cidade) && $id_cidade != "") {
            $filtros_query .= " AND c.id = :id_cidade";
            $parameters[':id_cidade'] = $id_cidade;
        }

        $sql = "SELECT
                    c.*, e.id AS id_estado, e.nome AS nome_estado
                FROM
                    cidade c, estado e
                WHERE
                    c.uf = e.uf
                AND
                    TRUE $filtros_query";

        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetch();
    }
}
