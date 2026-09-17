<?php 

require_once 'header.php';

?>

<h1><?php echo isset($book) ? 'Modifier le livre ' . $bookInfos['title'] : 'Ajouter un livre'; ?></h1>
<form method="post" <?php if(isset($book)) { ?>action="index.php?action=Book/updateBook/<?php echo $bookInfos['id']; ?>"<?php } else { ?>action="index.php?action=Book/createBook"<?php } ?>>
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title" required value="<?php echo isset($book) ? htmlspecialchars($bookInfos['title']) : ''; ?>"><br>

    <label for="author">Auteur :</label>
    <input type="text" id="author" name="author" required value="<?php echo isset($book) ? htmlspecialchars($bookInfos['author']) : ''; ?>"><br>

    <label for="available">Disponible :</label>
    <input type="checkbox" id="available" name="available" <?php echo isset($book) && $bookInfos['available'] ? 'checked' : ''; ?>><br>

    <label for="pageNumber">Nombre de pages :</label>
    <input type="number" id="pageNumber" name="pageNumber" required value="<?php echo isset($book) ? htmlspecialchars($book['pageNumber']) : ''; ?>"><br>

    <input type="submit" value="<?php echo isset($book) ? 'Modifier le livre' : 'Ajouter le livre'; ?>">
</form>