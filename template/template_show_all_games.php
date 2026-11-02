<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title><?= $title ?? "" ?></title>
</head>
<body>
    <?php include 'component/navbar.php'?>
    <main class="container-fluid">
        <h1>Liste des jeux</h1>
        <section>
            <?php foreach ($data["games"] ?? []as $game) :?>
                <article>
                    <h2><?= htmlspecialchars($game["title"]) ?></h2>
                    <h3><?= htmlspecialchars($game["type"]) ?></h3>
                    <p><?= htmlspecialchars($game["publish_at"]) ?></p>
                    <p><?= htmlspecialchars($game["name"] . " " . $game["manufacturer"]) ?></p>
                </article>
            <?php endforeach ?>
        </section>
    </main>
</body>
</html>