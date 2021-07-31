<?php


namespace Kabum\Model;

use Kabum\Core\Model;

class ConfigSistema extends Model
{
    public function getConfigs()
    {
        $sql = "SELECT * FROM configuracao_sistema WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => 1);

        $query->execute($parameters);
        return $query->fetch();
    }
}
