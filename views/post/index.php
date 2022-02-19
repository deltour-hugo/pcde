<?php

use App\Table\{PostTable, CategoryTable};
use App\Connection;

$title = 'Accueil | Petit Coeur d\'étoile';

$pdo = Connection::getPDO();

$table = new PostTable($pdo);
[$posts, $pagination] = $table->findPaginated();

$link = $router->url('home');
$items = (new CategoryTable($pdo))->all();

?>

<h1 class="homepage__title reveal-1">Suivez le <span class="highlight reveal-4">fil</span> de mes créations :</h1>
<div class="container__articles">
    <?php foreach ($posts as $post): ?>
    <?php require 'card.php' ?>
    <?php endforeach ?>
</div>

<div class="paginated__container">
    <?= $pagination->previousLink($link); ?>
    <?= $pagination->nextLink($link); ?>
</div>