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
    <?php include 'component/navbar.php' ?>
    <main class="container-fluid">
        <h1>Ajouter un jeu</h1>
        <form action="" method="post">
            <label for="title">Titre :</label>
            <input type="text" name="title">
            <label for="type">Type :</label>
            <input type="text" name="type">
            <label for="publish_at">Date de publication :</label>
            <input type="date" name="publish_at">
            <label for="console">Console :</label>
            <select name="console">
                <?php foreach ($data["consoles"] ?? [] as $console) : ?>
                    <option value="<?= htmlspecialchars($console["id"]) ?>"><?= htmlspecialchars($console["name"] . " " . $console["manufacturer"]) ?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" value="Ajouter" name="submit">
        </form>
        <p><?= $data["error"] ?? '' ?></p>
        <p><?= $data["valid"] ?? '' ?></p>
    </main>
</body>

</html>