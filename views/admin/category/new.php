<?php

use App\Connection;
use App\Table\CategoryTable;
use App\Html\Form;
use App\Validators\CategoryValidator;
use App\ObjectHelper;
use App\Model\Category;
use App\Auth;

Auth::check();

$errors = [];
$item = new Category();

if (!empty($_POST)) {
    $pdo = Connection::getPDO();
    $table = new CategoryTable($pdo);
    
    $v = new CategoryValidator($_POST, $table);
    ObjectHelper::hydrate($item, $_POST, ['name', 'slug']);
    if ($v->validate()) {
        $table->create([
            'name' => $item->getName(),
            'slug' => $item->getSlug()
        ]);
        header('Location: ' . $router->url('admin_categories') . '?created=1');
        exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($item, $errors);

?>

<h1 class="page__title">Créer une catégorie :</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert--danger">
        <img class="alert__icon" src="../../assets/imgs/svg/Warning.svg" alt="Icône Warning">
        La catégorie n'a pas pu être créée.
    </div>
<?php endif ?>

<?php require('_form.php') ?>