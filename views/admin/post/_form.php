<form class="formPost__container" action="" method="POST" enctype="multipart/form-data">
    <?= $form->input('name', 'Titre :'); ?>
    <?= $form->input('slug', 'URL :'); ?>
    <?= $form->file('image', 'Image à la une :'); ?>
    <?php if ($post->getImage()): ?>
        <img class="form__image--loaded" src="<?= $post->getImageURL('small') ?>" alt="">
    <?php endif ?>
    <?= $form->select('categories_ids', 'Catégorie :', $categories); ?>
    <?= $form->input('created_at', 'Date de Création :'); ?>
    <?= $form->textarea('content', 'Contenu :'); ?>

    <button class="administration__btn-createAndEdit">
        <?php if ($post->getID() !== null): ?>
            Modifier
        <?php else: ?>
            Créer
        <?php endif ?>
    </button>
</form>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        $( "#fieldcreated_at" ).datepicker();
    } );
</script>