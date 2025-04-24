<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title ?? "BLOG" ?> </title>
    <base href="<?= PATH ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/main.css">
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid container">
                    <a class="navbar-brand" href="">Blog</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link active" aria-current="page" href="">Home</a>
                            <a class="nav-link" href="contacts">Contacts</a>
                            <a class="nav-link" href="posts/create">New Post</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <?php getAlerts(); ?>