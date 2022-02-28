



<main>
    <?php foreach ($posts as $post) : ?>

        <h2><?= htmlspecialchars($post->getTitle()) ?></h2>


    <?php endforeach; ?>
</main>
   <hr>

