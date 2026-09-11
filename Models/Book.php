<?php 

require_once 'Media.php';
require_once 'include/db_connect.php';

class Book extends Media {
    private int $pageNumber;
    const TABLE = "books";

    public function __construct(string $title, string $author, bool $disponible, int $pageNumber){
        parent::__construct($title, $author, $disponible);
        $this->pageNumber = $pageNumber;
    }

    public function getPageNumber(): int{
        return $this->pageNumber;
    }

    public function setPageNumber(int $pageNumber): void{
        $this->pageNumber = $pageNumber;
    }

    public static function getBooks(): array{
        try{
            $db = connection();
            $stmt = $db->prepare("Select * from " . Book::TABLE);
            $stmt->execute();
            $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $books;
        } catch(PDOException $e) {
            die('Erreur de requête : ' . $e->getMessage());
        }
    }

    public static function getBookById(int $bookId){
        try{
            $db = connection();
            $stmt = $db->prepare("Select * from " . Book::TABLE . " Where id = :id");
            $stmt->bindValue(':id', $bookId, PDO::PARAM_INT);
            $stmt->execute();
            $book = $stmt->fetch(PDO::FETCH_ASSOC);

            return $book;
        } catch (PDOException $e) {
            die('Erreur de requête : ' . $e->getMessage());
        }
    }

    public static function update($id, $title, $author, $disponible){
        try {
            $db = connection();
            $stmt = $db->prepare("Update " . Book::TABLE . " Set title = :title, author = :author, disponible = :disponible where id = :id");
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':author', $author, PDO::PARAM_STR);
            $stmt->bindValue(':disponible', $disponible, PDO::PARAM_BOOL);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch(PDOException $e){
            die('Erreur de requête : ' . $e->getMessage());
        }
    }

    public static function delete($id){
        try{
            $db = connection();
            $stmt = $db->prepare('DELETE FROM ' . Book::TABLE . ' WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $e){
            die('Erreur de requête : ' . $e->getMessage());
            return false;
        }
    }

}