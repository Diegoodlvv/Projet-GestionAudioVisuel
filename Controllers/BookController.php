<?php 

class BookController{

    function library()
    {
        $books = Book::getBooks();

        require_once ('views/book/library.php');
    }

    function bookById(int $id){
        $book = Book::getBookById($id);

        if(!$book){
            $message = "Livre introuvable";
        } else {
            require_once ('views/book/' . $id);
        }

        $books = Book::getBooks();
        require_once ('views/book/library.php');
    }

    function update(int $id)
    {
        $book = Book::getBookById($id);

        if(!$book){
            $message = "Livre introuvable";
        } else {
            Book::update($book['id'], $book['title'], $book['author'], $book['disponible']);
        }

        $books = Book::getBooks();
        require_once ('views/book/library.php');
    }

    function delete(int $id){
        $book = Book::getBookById($id);
        
        if(!$book){
            $message = "Livre introuvable";
        } else {
            Book::delete($id);
        } 

        $books = Book::getBooks();
        require_once ('views/book/library.php');
    }
}