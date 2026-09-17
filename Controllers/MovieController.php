<?php 

require_once 'Models/Movie.php';
require_once 'Controllers/MediaController.php';

class movieController {
    static function library() {
        $books = Movie::getMovies();
        require_once('views/book/library.php');
    }

    function createMovie() {
        if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['available']) && isset($_POST['duration']) && isset($_POST['genre'])){
            $title = $_POST['title'];
            $author = $_POST['author'];
            $available = $_POST['available'];
            $duration = $_POST['duration'];
            $genre = EnumMovie::from($_POST['genre']);

            if(!empty($title) && !empty($author)  && !empty($duration) && !empty($genre)){
                $book = new Movie(0, $title, $author, $available, $duration, $genre);
                $book::createMovie($title, $author, $available, $duration, $genre);
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title = $_POST['title'];
            $author = $_POST['author'];
            $available = isset($_POST['available']);
            $duration = $_POST['duration'];
            $genre = EnumMovie::from($_POST['genre']);

            Movie::updateMovie( $title, $author, $available, $duration, $genre, $id);

            echo "Le film a bien été modifié";
            MediaController::library();
            require_once('views/media/mediatheque.php');
            return;
        }

        $movieInfos = Media::getMediaById($movie['media_id']);
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