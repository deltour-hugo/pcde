<?php

$categories = array_map(function ($category) use ($router) {
    $url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
    return <<<HTML
        <a class="card__category" href="{$url}">• {$category->getName()}</a>
    HTML;
}, $post->getCategories());

?>

<div class="card">
    <div class="card__thumb">
        <?php if ($post->getImage()): ?>
            <img src="<?= $post->getImageURL('large') ?>" alt="<?= htmlentities($post->getName()) ?>">
        <?php else: ?>
            <img src="../../assets/imgs/png/error.png">
        <?php endif ?>
    </div>
    <div class="card__body">

        <h3 class="card__title"><?= htmlentities($post->getName()) ?></h3>

        <div class="card__categories">
            <?php if (!empty($post->getCategories())): ?>
            <?= implode("<br>", $categories) ?>
            <?php endif ?>
        </div>

        <p class="card__description"><?= $post->getExcerpt() ?></p>

    </div>
        
    <hr class="card__separator">

    <footer class="card__footer">

        <button class="card__button">
            <a class="card__button--a animated-link" href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>">Voir plus</a>
        </button>

        <!-- <div class="card__date">
            <?= $post->getCreatedAt()->format('d/m/Y') ?>
        </div> -->
    
    </footer>

</div>