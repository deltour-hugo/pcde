<?php

use App\Model\User;
use App\Html\Form;
use App\Connection;
use App\Table\{CategoryTable, UserTable};
use App\Table\Exception\NotFoundException;

$title = "Connection";
$user = new User();
$errors = [];
$pdo = Connection::getPDO();
$items = (new CategoryTable($pdo))->all();

if (!empty($_POST)) {
    $user->setUsername($_POST['username']);
    $errors['password'] = 'Identifiants incorrects';

    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $table = new UserTable(Connection::getPDO());
        try {
            $u = $table->findByUsername($_POST['username']);
            $u->getPassword();
            $_POST['password'];
            if (password_verify($_POST['password'], $u->getPassword()) === true) {
                session_start();
                $_SESSION['auth'] = $u->getId();
                header('Location: ' . $router->url('admin_posts'));
                exit();
            }
        } catch (NotFoundException $e) {
        }
    }
}

$form = new Form($user, $errors);

?>

<h1 class="page__title">Se connecter</h1>

<?php if (isset($_GET['forbidden'])): ?>
<div class="alert alert--danger">
    <img class="alert__icon" src="../assets/imgs/svg/Warning.svg" alt="Icône Warning">
    Vous ne pouvez pas accéder à cette page.
</div>
<?php endif ?>

<form class="form__container" action="<?= $router->url('login') ?>" method="POST">
    <?= $form->input('username', 'Nom d\'utilisateur :'); ?>
    <?= $form->input('password', 'Mot de passe :'); ?>
    <button type="submit" class="btn-submit">Se Connecter</button>
</form>