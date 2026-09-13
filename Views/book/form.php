<?php 

require_once 'header.php';

?>

<h1>Ajouter un livre</h1>
<form  method="post" action="index.php?action=Book/createBook">
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title" required><br>

    <label for="author">Auteur :</label>
    <input type="text" id="author" name="author" required><br>

    <label for="available">Disponible :</label>
    <input type="checkbox" id="available" name="available"><br>

    <label for="pageNumber">Nombre de pages :</label>
    <input type="number" id="pageNumber" name="pageNumber" required><br>

    <input type="submit" value="Ajouter le livre">
</form>