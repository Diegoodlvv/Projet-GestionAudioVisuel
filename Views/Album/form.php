<?php 

require_once 'header.php';

?>

<h1><?php echo isset($album) ? 'Modifier l\'album ' . $albumInfos['title'] : 'Ajouter l\'album'; ?></h1>
<form method="post" <?php if(isset($album)) { ?>action="index.php?action=album/updatealbum/<?php echo $albumInfos['id']; ?>"<?php } else { ?>action="index.php?action=Album/createAlbum"<?php } ?>>
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title" required value="<?=  isset($album) ? htmlspecialchars($albumInfos['title']) : ''; ?>"><br>

    <label for="author">Auteur :</label>
    <input type="text" id="author" name="author" required value="<?=  isset($album) ? htmlspecialchars($albumInfos['author']) : ''; ?>"><br>

    <label for="available">Disponible :</label>
    <input type="checkbox" id="available" name="available" <?=  isset($album) && $albumInfos['available'] ? 'checked' : ''; ?>><br>

    <label for="trackNumber">Numéro de la track</label>
    <input type="number" id="trackNumber" name="trackNumber" required value="<?=  isset($album) ? htmlspecialchars($album['trackNumber']) : ''; ?>"><br>

    <label for="editor">Editeur</label>
    <input type="string" id="editor" name="editor" required value="<?=  isset($album) ? htmlspecialchars($album['editor']) : ''; ?>"><br>

    <input type="submit" value="<?=  isset($album) ? 'Modifier l\'album' : 'Ajouter l\'album'; ?>">
</form>