<?php 

require_once 'Models/Media.php';
require_once 'Models/Book.php';
require_once 'Models/Movie.php';
require_once 'Models/Album.php';

class MediaController{

    static function library()
    {
        $books = Book::getBooks();
        $movies = Movie::getMovies();
        $albums = Album::getAlbums();

        require_once('views/media/mediatheque.php');
    }

    static function home()
    {

        $totalMedias = Media::getTotalMedias();
        $pages = ceil($totalMedias / 3);

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        if($currentPage < 0){
            header('Location: index.php?action=Media/home&page=1');
        } elseif ($currentPage > $totalMedias){
            header('Location: index.php?action=Media/home&page=' . $totalMedias);
        }

        $medias = Media::getMedias();

        $search = trim($_GET["text"] ?? "");

        if ($search === "") {
            $mediasFiltered = $medias;
        } else {
            $mediasFiltered = array_filter($medias, fn($media) => Media::rechercherMedia($media, $search));
        }

        require_once('views/media/home.php');
    }
}