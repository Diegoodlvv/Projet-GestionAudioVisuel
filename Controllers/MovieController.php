<?php 

require_once 'Models/Movie.php';
require_once 'Controllers/MediaController.php';
require_once 'Services/FileService.php';
require_once 'Models/File.php';

class movieController {
    static function library() {
        $books = Movie::getMovies();
        require_once('views/book/library.php');
    }

    function createMovie() {
        if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['duration']) && isset($_POST['genre'])){
            $title = $_POST['title'];
            $author = $_POST['author'];
            $available = isset($_POST['available']) ? 1 : 0;
            $duration = $_POST['duration'];
            $genre = EnumMovie::from($_POST['genre']);

            if (isset($_FILES['illustration']) && $_FILES['illustration']['error'] !== UPLOAD_ERR_NO_FILE) {
                $fileId = FileService::uploadIllustration(
                    $_FILES['illustration'],
                    $_SESSION['user_id']
                );
            } else {
                echo "Aucun fichier téléchargé.";

                require_once ('views/movie/form.php');
            }

            if(!empty($title) && !empty($author)  && !empty($duration) && !empty($genre)){
                $movieId = Movie::createMovie($title, $author, $available, $fileId, $duration, $genre);

                echo "Le film a été ajouté avec succès.";
                MediaController::library();
                require_once ('views/media/mediatheque.php');
            } else {
                echo "Veuillez remplir tous les champs."; 

                require_once ('views/movie/form.php');
            }
        } else {
            require_once ('views/movie/form.php');
        }
    }

    function updateMovie(int $id) {
        $movie = Movie::getMovieById($id);

        if (!$movie) {
            echo "Film introuvable.";
            return;
        }

        $movieInfos = Media::getMediaById($movie['media_id']);
        $fileId = $movieInfos['file_id'] ?? null;
        $currentFile = File::getFileById($fileId);
        var_dump($currentFile);

        $maxPostSize = ini_get('post_max_size');
        $maxPost = File::toBytes($maxPostSize);

        if(isset($_SERVER["CONTENT_LENGTH"]) && $_SERVER["CONTENT_LENGTH"] > $maxPost){
            echo "fichier trop volumineux";
            MediaController::library();
            require_once('views/media/mediatheque.php');
            return;
        } 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title = $_POST['title'];
            $author = $_POST['author'];
            $available = isset($_POST['available']) ?? false;
            $duration = $_POST['duration'];
            $genre = EnumMovie::from($_POST['genre']);

            Movie::updateMovie($title, $author, $available, $fileId, $duration, $genre, $id);

            if (isset($_FILES['illustration']) && $_FILES['illustration']['error'] !== UPLOAD_ERR_NO_FILE ) 
            {
                FileService::uploadIllustration(
                    $_FILES['illustration'],
                    $_SESSION['user_id']
                );

                unlink(__DIR__ . '/../uploads/' . $currentFile['stored_name']);
            }

            echo "Le film a bien été modifié";
            MediaController::library();
            require_once('views/media/mediatheque.php');
            return;
        }

        require_once('views/movie/form.php');
    }

    function deleteMovie(int $id){
        $movie = Movie::getMovieById($id);
        if(!$movie){
            $message = "Livre introuvable";
        } else {
            Movie::deleteMovie($id);
            echo "Suppression réussie";
        }
        MediaController::library();
        require_once ('views/media/mediatheque.php');
    }

    function emprunterMovie(int $id) {
        try {
            Movie::emprunter($id);
            echo "Vous avez emprunté ce film.";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        MediaController::library();
        require_once('views/media/mediatheque.php');
    }

    function rendreMovie(int $id) {
        try {
            Movie::rendre($id);
            echo "Vous avez rendu ce film.";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        MediaController::library();
        require_once('views/media/mediatheque.php');
    }
}