<?php


namespace Kabum\Model;

use Kabum\Core\Model;

class GerenciaPost extends Model
{
    public function insert($arrayPost, $tabela, $return_id = null)
    {
        foreach ($arrayPost as $key => $value) {

            $arrColuna[] = $key;

            $arrColunaPdo[] = ":" . $key;

            $value = trim($value);

            if ($key == 'senha') {
                $arrValor[':' . $key] = $value;
            } else {
                $arrValor[':' . $key] = $value;
            }
        }

        $coluna = implode(",", $arrColuna);
        $pdo = implode(",", $arrColunaPdo);

        $sql = "INSERT INTO {$tabela} ({$coluna}) VALUES ({$pdo})";

        $query = $this->db->prepare($sql);
        $parameters = $arrValor;

        $result = $query->execute($parameters);

        //Insert com sucesso e retorno do id recem criado
        if ($result && $return_id) {
            return $this->db->lastInsertId();
        } else {
            return $result;
        }
    }

    public function update($arrayPost, $tabela, $where_col, $where_val)
    {
        foreach ($arrayPost as $key => $value) {

            $arrColuna[] = $key . " = " . ":" . $key;

            $value = trim($value);

            if ($key == 'senha') {
                $arrValor[':' . $key] = $value;
            } else {
                $arrValor[':' . $key] = $value;
            }
        }

        $coluna = implode(",", $arrColuna);

        $sql = "UPDATE {$tabela} SET {$coluna} WHERE {$where_col} = :id";

        $query = $this->db->prepare($sql);
        $parameters = $arrValor;
        $parameters[':id'] = $where_val;

        return $query->execute($parameters);
    }
}
