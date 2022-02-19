<?php

use App\Connection;
use App\Table\CategoryTable;
use App\Html\Form;
use App\Validators\CategoryValidator;
use App\ObjectHelper;
use App\Auth;

Auth::check();

$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$item = $table->find($params['id']);
$success = false;
$errors = [];
$fields = ['name', 'slug'];

if (!empty($_POST)) {
    $v = new CategoryValidator($_POST, $table, $item->getID());
    ObjectHelper::hydrate($item, $_POST, $fields);
    if ($v->validate()) {
        $table->update([
            'name' => $item->getName(),
            'slug' => $item->getSlug()
        ], $item->getID());
        $success = true;
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($item, $errors);

?>

<?php if ($success): ?>
<div class="alert alert--success">
    <img class="alert__icon" src="../../assets/imgs/svg/Success.svg" alt="Icône Success">
    La catégorie a bien été modifiée.
</div>
<?php endif ?>

<?php if (!empty($errors)): ?>
    <div class="alert alert--danger">
        <img class="alert__icon" src="../../assets/imgs/svg/Warning.svg" alt="Icône Warning">
        La catégorie n'a pas pu être modifié.
    </div>
<?php endif ?>

<h1 class="page__title">Éditer la catégorie :</h1>
<h2 class="administration__article--title"><?= e($item->getName()) ?></h2>

<?php require('_form.php') ?>