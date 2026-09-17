<?php 

require_once 'Models/Book.php';
require_once 'Controllers/MediaController.php';

class BookController {
    static function library() {
        $books = Book::getBooks();
        require_once('views/book/library.php');
    }

    function createBook() {
        if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['available']) && isset($_POST['pageNumber'])){
            $title = $_POST['title'];
            $author = $_POST['author'];
            $available = $_POST['available'];
            $pageNumber = $_POST['pageNumber'];

            if(!empty($title) && !empty($author) && !empty($pageNumber)){
                $book = new Book(0, $title, $author, $available, $pageNumber);
                $book::createBook($title, $author, $available, $pageNumber);
                echo "Le livre a été ajouté avec succès.";
                MediaController::library();
                require_once ('views/media/mediatheque.php');
            } else {
                echo "Veuillez remplir tous les champs."; 
                require_once ('views/book/form.php');
            }
        } else {
            require_once ('views/book/form.php');
        }
    }

    function updateBook(int $id) {
        $book = Book::getBookById($id);

        if (!$book) {
            echo "Livre introuvable.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title = $_POST['title'];
            $author = $_POST['author'];
            $available = isset($_POST['available']);
            $pageNumber = $_POST['pageNumber'];

            Book::updateBook($title, $author, $available, $pageNumber, $id);

            echo "Le livre a bien été modifié";
            MediaController::library();
            require_once('views/media/mediatheque.php');
            return;
        }

        $bookInfos = Media::getMediaById($book['media_id']);
        require_once('views/Book/form.php');
    }


    function deleteBook(int $id){
        $book = Book::getBookById($id);
        if(!$book){
            $message = "Livre introuvable";
        } else {
            Book::deleteBook($id);
            echo "Suppression réussie";
        }
        MediaController::library();
        require_once ('views/media/mediatheque.php');
    }
}