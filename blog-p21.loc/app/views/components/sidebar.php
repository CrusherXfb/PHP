<?  $most_popular_posts = $db->query($sql)->findAll();    ?>

<div class="col-2">
    <h3>Topics</h3>
    <ul class="list-group">
        <!-- <li class="list-group-item disabled" aria-disabled="true">A disabled item</li> -->
        <?php foreach ($most_popular_posts as $link): ?>
            <li class="list-group-item"><a class="nav-link" href="post?id=<?= $link['post_id'] ?>"><?= $link['title'] ?></a></li>
        <?php endforeach ?>
    </ul>
</div>