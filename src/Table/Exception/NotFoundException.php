<?php

namespace App\Table\Exception;

class NotFoundException extends \Exception {

    public function __construct(string $table, $id)
    {
        $this->message = "Aucun enregistrement ne correspond à l'identifiant #$id dans la table '$table'";
    }

}

?>