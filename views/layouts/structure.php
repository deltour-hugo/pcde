<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="DELTOUR Hugo">
    <meta name="description" content="Découvrez à travers Petit Coeur d'étoile le fruit de ma passion pour la couture et entrez dans un monde où l'imagination n'a pas de limite.">
    <meta name="google-site-verification" content="imWxvoQvzZowJvPVSlgLMd2ReWXhTEZf-RljkoDlZF8"/>
    <link rel="shortcut icon" href="../../assets/imgs/svg/Heart.svg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link rel="manifest" href="../../manifest.json"/>
    <link rel="stylesheet" href="../../styles/app.css" id="theme_switcher">
    <script src="../../scripts/dynamics.js" defer></script>
    <script src="../../scripts/sidebar.js" defer></script>
    <script src="../../scripts/scrollReveal.js" defer></script>
    <script src="../../scripts/themeSwitcher.js" defer></script>
    <script src="../../scripts/credits.js" defer></script>
    <script src="https://kit.fontawesome.com/336176f8d2.js" crossorigin="anonymous" defer></script>
    <title><?= isset($title) ? e($title) : "PCDE" ?></title>
</head>
<body>
    <nav class="nav__container">
        <a class="nav__item" id="nav__logo" href="<?= $router->url('home') ?>"><img class="nav__heart" src="../../assets/imgs/svg/Heart.svg" alt="Logo de Petit Coeur d'étoile">Petit Cœur d'étoile</a>
        <div id="nav__menu">
            <svg x="8" y="0" width="40px" height="40px" viewBox="0 0 40 40">
                <circle cx="20" cy="20" r="18"></circle>
            </svg>
            <span></span>
        </div>
    </nav>

    <div class="container">

        <?= $content ?>

    </div>
    <aside class="sidebar">
        <div class="container__categories">
        <?php foreach($items as $item): ?>
            <a class="sidebar__item" href="/blog/categorie/<?= $item->getSlug() ?>-<?= $item->getID() ?>"><?= $item->getName() ?></a>
        <?php endforeach ?>
        </div>
        <svg id="sidebar__wave" class="sidebar__wave" width="100%" height="100vh" viewBox="0 0 200 900" version="1.1" preserveAspectRatio="none">
            <path 
              d="M200,0c0,0 -200,46.405 -200,177c0,130.595 126.228,90.241 149,287c22.772,196.759 51,436 51,436l32,0l-4,-900l-28,0Z" 
              data-to="M0,0c0,0 0,46.405 0,177c0,130.595 1.152,98.101 0,296c-1.153,198.07 0,427 0,427l200,0l0,-900l-200,0Z"/>
        </svg>
    </aside>

    <hr class="footer__separator">

    <footer class="footer">
        <ul class="footer__socials">
            <li class="footer__social"><a target="_blank" class="footer__social--link" href="https://www.facebook.com/laetitia.poton.1"><img class="footer__social--img" src="../../assets/imgs/png/facebook.png" alt="Logo de facebook."></a></li>
            <li class="footer__social"><a target="_blank" class="footer__social--link" href="https://www.instagram.com/petit_coeur_detoiles/"><img class="footer__social--img" src="../../assets/imgs/png/instagram.png" alt="Logo d'instagram."></a></li>
        </ul>
        <span id="credits">&copy; Petit Coeur d'étoile - 2022</span>
        <div class="theme__container">
            <input type="checkbox" id="dark-mode-toggle">
            <label class="dark-mode-toggle__label" for="dark-mode-toggle">
                <i class="fas fa-sun"></i>
                <i class="fas fa-moon"></i>
                <div class="ball"></div>
            </label>
        </div>
    </footer>
</body>
</html>
