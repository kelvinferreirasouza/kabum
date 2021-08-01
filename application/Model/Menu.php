<?php

namespace Kabum\Model;

use Kabum\Core\Model;

class Menu extends Model
{
    public function getMenu()
    {
        $sql = "SELECT 
                    *
                FROM
                    menu
                WHERE
                    ativo = :ativo
                AND
                    id_sub_pagina = :id_sub
                ORDER BY
                    ordem";

        $qry = $this->db->prepare($sql);
        $qry->execute(array(':ativo' => true, ':id_sub' => 0));

        return $qry->fetchAll();
    }

    public function getSubmenuByMenu($id_sub)
    {
        $usuario = (new Usuario())->getUsuarioById($_SESSION['kabum']['id']);

        $sql = "SELECT
                    *
                FROM
                    menu
                WHERE
                    ativo = :ativo
                AND
                    id_sub_pagina = :id_sub
                ORDER BY
                    ordem";

        $query = $this->db->prepare($sql);
        $query->execute(array(':id_sub' => $id_sub, ':ativo' => true));

        return $query->fetchAll();
    }

    public function getMenuByRota($rota)
    {
        $sql = "SELECT * FROM menu WHERE ativo = TRUE and rota = :rota";
        $query = $this->db->prepare($sql);
        $parameters = array(':rota' => $rota);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function getMenuById($id_menu)
    {
        $usuario = (new Usuario())->getUsuarioById($_SESSION['ops']['id']);

        $sql = "SELECT * FROM menu WHERE ativo = :ativo AND id_menu = :id_menu ORDER BY ordem";
        $qry = $this->db->prepare($sql);
        $qry->execute(
            array(
                ':acesso' => $usuario->nivel,
                ':ativo' => true,
                ':id_menu' => $id_menu
            )
        );

        return $qry->fetch();
    }
}
