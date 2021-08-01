<?php

namespace Kabum\Model;

use Kabum\Core\Model;
use stdClass;

class Usuario extends Model
{
    public function checaSessao()
    {
        session_start();
        if (isset($_SESSION['kabum']['id']) == false) {
            header('location: ' . URL . 'login/index');
            exit;
        }
    }

    public function paginacao()
    {
        if (isset($_GET['pagina'])) {
            $paginacao = $_GET['pagina'];
        } else {
            $paginacao = 1;
        }

        return $paginacao;
    }

    public function getUsuarioByEmail($email)
    {
        $sql = "SELECT 
                    us.*
                FROM 
                    usuario us
                WHERE
                    UPPER(us.email) = UPPER(:email)";

        $query = $this->db->prepare($sql);
        $parameters = array(':email' => $email);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function getUsuarioById($id_usuario)
    {
        $sql = "SELECT * FROM usuario WHERE id = :id_usuario";

        $query = $this->db->prepare($sql);

        $parameters = array(':id_usuario' => $id_usuario);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function getUsuarioByCpf($cpf)
    {
        $sql = "SELECT * FROM usuario WHERE cpf = :cpf";

        $query = $this->db->prepare($sql);

        $parameters = array(':cpf' => $cpf);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function getUsuarios($qtd, $pagina, $filtros)
    {
        $filtros_query = "";
        $parameters = array();

        if (isset($filtros['nome']) && $filtros['nome'] != "") {
            $filtros_query .= " AND ucase(us.nome) LIKE ucase(:nome)";
            $parameters[':nome'] = "%{$filtros['nome']}%";
        }

        if (isset($filtros['email']) && $filtros['email'] != "") {
            $filtros_query .= " AND ucase(us.email) LIKE ucase(:email)";
            $parameters[':email'] = "%{$filtros['email']}%";
        }

        if (isset($filtros['ativo']) && $filtros['ativo'] != "") {
            $filtros_query .= " AND us.ativo = :ativo";
            $parameters[':ativo'] = $filtros['ativo'];
        } else {
            $filtros_query .= " AND us.ativo = 1";
        }

        $offset = ($pagina - 1) * $qtd;

        $sql = "SELECT
                    us.*, up.nome as tipo_perfil
                FROM
                    usuario us, usuario_perfil up
                WHERE
                    us.id_perfil = up.id
                AND
                    TRUE $filtros_query
                ORDER BY
                    nome ASC
                LIMIT
                    $qtd OFFSET $offset";

        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function insertUsuario($dados)
    {
        $arrayInsert = [];

        $arrayInsert['nome'] = $dados['nome'];
        $arrayInsert['email'] = $dados['email'];
        $arrayInsert['senha'] = md5($dados['senha']);

        (new GerenciaPost())->insert($arrayInsert, 'usuario');
    }

    public function updateUsuario($dados)
    {
        $arrayUpdate = [];

        $arrayUpdate['nome'] = $dados['nome'];
        $arrayUpdate['email'] = $dados['email'];
        $arrayUpdate['senha'] = $dados['senha'];
        $arrayUpdate['id_perfil'] = $dados['id_perfil'];
        $arrayUpdate['ativo'] = $dados['ativo'];

        (new GerenciaPost())->update($arrayUpdate, 'usuario', 'id_usuario', $dados['id_usuario']);
    }

    public function desativaUsuario($id_usuario)
    {
        $sql = "UPDATE usuario SET ativo = FALSE WHERE id_usuario = :id_usuario";

        $query = $this->db->prepare($sql);

        $parameters = array(':id_usuario' => $id_usuario);

        $query->execute($parameters);
    }

    public function ativaUsuario($id_usuario)
    {
        $sql = "UPDATE usuario SET ativo = TRUE WHERE id_usuario = :id_usuario";

        $query = $this->db->prepare($sql);

        $parameters = array(':id_usuario' => $id_usuario);

        $query->execute($parameters);
    }

    public function updateSenha($id_usuario, $senha)
    {
        $sql = "UPDATE usuario SET senha = :senha WHERE id_usuario = :id_usuario";

        $query = $this->db->prepare($sql);

        $parameters = array(':id_usuario' => $id_usuario, ':senha' => md5($senha));

        $query->execute($parameters);
    }
}
