<?php 

require_once 'Models/Media.php';
require_once 'Models/Book.php';

class MediaController{

    static function library()
    {
        $medias = Media::getMedias();
        $books = Book::getBooks();
        var_dump($books);

        require_once('views/media/mediatheque.php');
    }

    static function create(){
        if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['available']) && isset($_POST['pageNumber'])){
            $title = $_POST['title'];
            $author = $_POST['author'];
            $available = $_POST['available'];
            $pageNumber = $_POST['pageNumber'];

            if(!empty($title) && !empty($author) && !empty($pageNumber)){
                $book = new Book(0, $title, $author, $available, $pageNumber);
                $book->create($title, $author, $available);
                echo "Le livre a été ajouté avec succès.";
                require_once ('views/book/library.php');
            } else {
                echo "Veuillez remplir tous les champs."; 
                require_once ('views/book/form.php');
            }
        }
    }
}