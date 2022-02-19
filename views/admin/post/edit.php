<?php

use App\Attachment\PostAttachment;
use App\Connection;
use App\Table\{PostTable, CategoryTable};
use App\Html\Form;
use App\Validators\PostValidator;
use App\ObjectHelper;
use App\Auth;

Auth::check();

$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
$post = $postTable->find($params['id']);
$categoryTable->hydratePosts([$post]);
$success = false;

$categories_error = false;
$errors = [];

if (!empty($_POST)) {
    $data = array_merge($_POST, $_FILES);
    $v = new PostValidator($data, $postTable, $post->getID(), $categories);
    ObjectHelper::hydrate($post, $data, ['name', 'slug', 'content', 'created_at', 'image']);

    if ($v->validate()) {
        $pdo->beginTransaction();
        PostAttachment::upload($post);
        $postTable->updatePost($post);
        $postTable->attachCategories($post->getID(), $_POST['categories_ids']);
        $pdo->commit();
        $categoryTable->hydratePosts([$post]);
        $success = true;
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($post, $errors);

?>

<?php if ($success): ?>
<div class="alert alert--success">
    <img class="alert__icon" src="../../assets/imgs/svg/Success.svg" alt="Icône Success">
    L'article a bien été modifié.
</div>
<?php endif ?>

<?php if (isset($_GET['created'])): ?>
<div class="alert alert--success">
    <img class="alert__icon" src="../../assets/imgs/svg/Success.svg" alt="Icône Success">
    L'article a bien été crée.
</div>
<?php endif ?>

<?php if (!empty($errors)): ?>
    <div class="alert alert--danger">
        <img class="alert__icon" src="../../assets/imgs/svg/Warning.svg" alt="Icône Warning">
        L'article n'a pas pu être modifié.
    </div>
<?php endif ?>

<h1 class="page__title">Editer l'article :</h1>

<h2 class="administration__article--title"><?= e($post->getName()) ?></h2>

<?php require('_form.php') ?>