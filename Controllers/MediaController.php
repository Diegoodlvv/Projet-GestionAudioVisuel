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
        $medias = Media::getMedias();
        $totalMedias = Media::getTotalMedias();
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $pages = ceil($totalMedias);

        require_once('views/media/home.php');
    }
}