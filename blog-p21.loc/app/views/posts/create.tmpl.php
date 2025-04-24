<? require_once(COMPONENTS . "/header.php"); ?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3> NEW POST </h3>

                <form action="posts" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Post title</label>
                        <input class="form-control" id="title" name="title" value="<?= old('title') ?>">
                        <?= isset($validationResult) ? $validationResult->listErrors("title") : "" ?>
                    </div>
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Post description</label>
                        <input class="form-control" id="excerpt" name="excerpt" value="<?= old('excerpt') ?>">
                        <?= isset($validationResult) ? $validationResult->listErrors("excerpt") : "" ?>
                    </div>
                    <div class="mb-3">
                        <label for="content">Post content</label>
                        <textarea class="form-control" id="content" name="content"><?= old('content') ?></textarea>
                        <?= isset($validationResult) ? $validationResult->listErrors("content") : "" ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
</main>

<? require_once COMPONENTS . "/footer.php"; ?>