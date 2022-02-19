<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../assets/imgs/svg/Heart.svg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/app.css">
    <title><?= isset($title) ? e($title) : "Administration" ?></title>
</head>
<body>
    <nav class="nav__container">
        <a href="<?= $router->url('admin_posts') ?>" class="nav__item--administration animated-link">Articles</a>
        <a href="<?= $router->url('admin_categories') ?>" class="nav__item--administration animated-link">Catégories</a>
        <form action="<?= $router->url('logout') ?>" method="POST" class="nav__item--administration nav__form-logout">
            <button type="submit" class="nav__btn-logout">
                Se déconnecter
            </button>
        </form>
    </nav>

    <div class="container">

        <?= $content ?>

    </div>
</body>
</html>