<?php

use App\Attachment\PostAttachment;
use App\Connection;
use App\Table\{PostTable, CategoryTable};
use App\Html\Form;
use App\Validators\PostValidator;
use App\ObjectHelper;
use App\Model\Post;
use App\Auth;

Auth::check();

$errors = [];
$post = new Post();
$pdo = Connection::getPDO();
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
$post->setCreatedAt(date('Y-m-d H:i:s'));

if (!empty($_POST)) {
    $postTable = new PostTable($pdo);
    $data = array_merge($_POST, $_FILES);
    $v = new PostValidator($data, $postTable, $post->getID(), $categories);
    ObjectHelper::hydrate($post, $data, ['name', 'slug', 'content', 'created_at', 'image']);
    if ($v->validate()) {
        $pdo->beginTransaction();
        PostAttachment::upload($post);
        $postTable->createPost($post);
        $postTable->attachCategories($post->getID(), $_POST['categories_ids']);
        $pdo->commit();
        header('Location: ' . $router->url('admin_posts', ['id' => $post->getID()]) . '?created=1');
        exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($post, $errors);

?>

<?php if (!empty($errors)): ?>
    <div class="alert alert--danger">
        <img class="alert__icon" src="../../assets/imgs/svg/Warning.svg" alt="Icône Warning">
        L'article n'a pas pu être créé.
    </div>
<?php endif ?>

<h1 class="page__title">Créer un article :</h1>

<?php require('_form.php') ?>