<?php 

require_once 'Models/Media.php';
require_once 'Models/Book.php';
require_once 'Models/Movie.php';
require_once 'Models/Album.php';

class MediaController{

    static function library()
    {
        $medias = Media::getMedias();
        $books = Book::getBooks();
        $movies = Movie::getMovies();
        $albums = Album::getAlbums();

        require_once('views/media/mediatheque.php');
    }
}