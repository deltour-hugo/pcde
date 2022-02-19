<?php

use App\Connection;
use App\Model\{Category, Post};
use App\PaginatedQuery;
use App\Table\{CategoryTable, PostTable};

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();

$category = (new CategoryTable($pdo))->find($id);

if ($category->getSlug() !== $slug) {
    $url = $router->url('category', ['slug' => $category->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}

$title = "{$category->getName()}";

[$posts, $pagination] = (new PostTable($pdo))->findPaginatedForCategory($category->getID());

$link = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
$items = (new CategoryTable($pdo))->all();

?>

<link rel="stylesheet" href="../../styles/app.css">

<h1 class="page__title"><?= e($title) ?></h1>

<div class="container__articles">
    <?php foreach ($posts as $post): ?>
    <?php require dirname(__DIR__) . '/post/card.php' ?>
    <?php endforeach ?>
</div>

<div class="paginated__container">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>