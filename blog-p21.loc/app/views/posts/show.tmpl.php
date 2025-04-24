<?php require_once(COMPONENTS . "/header.php"); ?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4"><?= $header ?></h3>
                <div class="post-content mb-4">
                    <p><?= $post['content'] ?></p>
                </div>


                <div class="button-group mb-4">
                    <form action="posts/rating" method="POST" style="display:inline;">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $post['post_id'] ?>">
                        <input type="hidden" name="action" value="INCREASE">
                        <button type="submit" class="btn btn-outline-secondary me-2">+</button>
                    </form>

                    <div class="rating mb-4 d-inline-block" style="font-size: 1.5rem; margin: 0 10px;">
                        <span class="badge bg-light text-dark"><?= $rating ?></span>
                    </div>

                    <form action="posts/rating" method="POST" style="display:inline;">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $post['post_id'] ?>">
                        <input type="hidden" name="action" value="DECREASE">
                        <button type="submit" class="btn btn-outline-secondary me-2">-</button>
                    </form>

                    <form action="posts" method="POST" style="display:inline;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="<?= $post['post_id'] ?>">
                        <button type="submit" class="btn btn-outline-danger">Удалить пост</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once COMPONENTS . "/footer.php"; ?>