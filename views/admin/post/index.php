<?php
use App\{Connection, Auth};
use App\Table\PostTable;

Auth::check();

$title = "Gestion des articles";
$pdo = Connection::getPDO();
[$posts, $pagination] = (new PostTable($pdo))->findPaginated();
$link = $router->url('admin_posts');
?>

<?php if (isset($_GET['delete'])): ?>
<div class="alert alert--success">
    <img class="alert__icon" src="../../assets/imgs/svg/Success.svg" alt="Icône Success">
    L'article a bien été supprimé.
</div>
<?php endif ?>

<div class="table__container">
    <table>
        <thead>
            <th class="th--ids">#ID</th>
            <th class="th--titles">Titre</th>
            <th class="th--options">
                <a href="<?= $router->url('admin_post_new') ?>" class="administration__btn-new">Nouveau</a>
            </th>
        </thead>
        <tbody>
            <?php foreach($posts as $post): ?>
            <tr>
            <td class="td--ids">#<?= $post->getID() ?></td>
                <td class="td--titles">
                    <?= e($post->getName()) ?>
                </td>
                <td class="td--options">
                    <a class="administration__btn-edit" href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>">
                    Editer
                    </a>

                    <form class="administration__form-delete" method="POST" onsubmit="return confirm('Voulez-vous vraiment effectuer cette action ?')" action="<?= $router->url('admin_post_delete', ['id' => $post->getID()]) ?>">

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

<div class="paginated__container">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>