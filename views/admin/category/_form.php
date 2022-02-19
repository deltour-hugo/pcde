<form class="formCategory__container" action="" method="POST">
    <?= $form->input('name', 'Titre'); ?>
    <?= $form->input('slug', 'URL'); ?>

    <button class="administration__btn-createAndEdit">
        <?php if ($item->getID() !== null): ?>
            Modifier
        <?php else: ?>
            Créer
        <?php endif ?>
    </button>
</form>