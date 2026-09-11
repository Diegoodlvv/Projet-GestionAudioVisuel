<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Médiathèque</h1>
    <ul>
        <? foreach ($books as $book): ?>
            <li>
                <strong>Titre :</strong> <?= htmlspecialchars($book->getTitle()) ?><br>
                <strong>Auteur :</strong> <?= htmlspecialchars($book->getAuthor()) ?><br>
                <strong>Disponible :</strong> <?= $book->isAvailable() ? 'Oui' : 'Non' ?><br>
                <strong>Nombre de pages :</strong> <?= $book->getPageNumber() ?><br>
            </li>
    </ul>
</body>
</html>