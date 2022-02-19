<?php

use App\{Connection, Auth};
use App\Table\CategoryTable;

Auth::check();

$title = "Gestion des catégories";
$pdo = Connection::getPDO();
$link = $router->url('admin_categories');
$items = (new CategoryTable($pdo))->all();

?>

<?php if (isset($_GET['delete'])): ?>
<div class="alert alert--success">
    <img class="alert__icon" src="../../assets/imgs/svg/Success.svg" alt="Icône Success">
    La catégorie a bien été supprimée.
</div>
<?php endif ?>

<div class="table__container">
    <table>
        <thead>
            <th class="th--ids">#ID</th>
            <th class="th--titles">Titre</th>
            <th class="th--urls">URL</th>
            <th class="th--options">
                <a href="<?= $router->url('admin_category_new') ?>" class="administration__btn-new">Nouveau</a>
            </th>
        </thead>
        <tbody>
            <?php foreach($items as $item): ?>
            <tr>
            <td class="td--ids">#<?= $item->getID() ?></td>
                <td class="td--titles">
                    <?= e($item->getName()) ?>
                </td>
                <td class="td--urls"><?= $item->getSlug() ?></td>
                <td class="td--options">
                    <a class="administration__btn-edit" href="<?= $router->url('admin_category', ['id' => $item->getID()]) ?>">
                    Editer
                    </a>

                    <form class="administration__form-delete" action="<?= $router->url('admin_category_delete', ['id' => $item->getID()]) ?>" method="POST"
                        onsubmit="return confirm('Voulez-vous vraiment effectuer cette action ?')">

                    <button type="submit" class="administration__btn-delete">
                        <img class="administration__btn-delete-trash" src="../../assets/imgs/svg/Trash.svg" alt="Supprimer">
                    </button>
                    </form>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>