<?php

namespace App;
use \PDO;

class Connection {

    public static function getPDO (): PDO
    {
        return new PDO('mysql:dbname=;host=', '', '');
    }

}

?>
