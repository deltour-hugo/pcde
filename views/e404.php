<?php
use App\Connection;
use App\Table\CategoryTable;

http_response_code(404);
$pdo = Connection::getPDO();
$items = (new CategoryTable($pdo))->all();
$title = "Woopps..."
?>

<h1 class="lost--title reveal-1">Vous êtes <span class="highlight">perdu</span> ?</h1>
<h2 class="lost--subtitle reveal-2">Peut-être seriez-vous interressé par les derniers articles ?</h2>
<a class="lost--link reveal-3" href="/">Voir les derniers articles.</a>
