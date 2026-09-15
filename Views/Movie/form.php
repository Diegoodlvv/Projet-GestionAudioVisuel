<?php 

require_once 'header.php';

?>

<h1><?php echo isset($movie) ? 'Modifier le film' . $movieInfos['title'] : 'Ajouter un film'; ?></h1>
<form  method="post" <?php if(isset($movie)) { ?>action="index.php?action=movie/updateMovie/<?php echo $movie['id']; ?>"<?php } else { ?>action="index.php?action=Movie/createMovie"<?php } ?>>
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title" required value="<?php echo isset($movie) ? htmlspecialchars($movieInfos['title']) : ''; ?>"><br>

    <label for="author">Auteur :</label>
    <input type="text" id="author" name="author" required value="<?php echo isset($movie) ? htmlspecialchars($movieInfos['author']) : ''; ?>"><br>

    <label for="available">Disponible :</label>
    <input type="checkbox" id="available" name="available" <?php echo isset($movie) && $movieInfos['available'] ? 'checked' : ''; ?>><br>

    <label for="duree">Durée du film en minutes</label>
    <input type="number" id="duree" name="duration" required value="<?php echo isset($movie) ? htmlspecialchars($movie['duration']) : ''; ?>"><br>

    <label for="duree">Genre</label>
    <select name="genre">
        <?php foreach(EnumMovie::cases() as $genre){ ?>
            <option value="<?= $genre->value ?>"><?= $genre->name ?></option>
        <?php } ?> 
    </select>

    <input type="submit" value="<?php echo isset($movie) ? 'Modifier le film' : 'Ajouter le film'; ?>">
</form>