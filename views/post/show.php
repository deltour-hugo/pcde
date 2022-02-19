<?php

use App\Connection;
use App\Table\{PostTable, CategoryTable};

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$post = (new PostTable($pdo))->find($id);
(new CategoryTable($pdo))->hydratePosts([$post]);
$items = (new CategoryTable($pdo))->all();

if ($post === false) {
    throw new Exception('Aucun article ne correspond à cet ID');
}

if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}

$title = "Article : {$post->getName()}";

?>


<div class="container__show">
    <h1 class="page__title"><?= e($post->getName()) ?></h1>

    <?php if ($post->getImage()): ?>
        <img class="article__image--show" src="<?= $post->getImageURL('large') ?>" alt="<?= htmlentities($post->getName()) ?>">
    <?php else: ?>
        <img src="../../assets/imgs/png/error.png">
    <?php endif ?>

    <p class="article__description"><?= $post->getFormattedContent() ?></p>

    <div class="card__categories">
        <?php foreach($post->getCategories() as $k => $category):
            if ($k > 0):
                echo '<br>';
            endif;
            $category_url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
        ?>
        <a class="card__category" href="<?= $category_url ?>">• <?= e($category->getName()) ?></a>
        <?php endforeach ?>
    </div>

    <p class="text-muted">Publié le <?= $post->getCreatedAt()->format('d/m/Y') ?></p>
</div>