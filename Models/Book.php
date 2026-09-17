<?php 

require_once 'Media.php';
require_once 'db_connect.php';

class Book extends Media {
    private int $pageNumber;
    const TABLE = "book";

    public function __construct(int $id, string $title, string $author, bool $available, int $pageNumber){
        parent::__construct($id, $title, $author, $available);
        $this->pageNumber = $pageNumber;
    }

    public function getPageNumber(): int{
        return $this->pageNumber;
    }

    public function setPageNumber(int $pageNumber): void{
        $this->pageNumber = $pageNumber;
    }

    public static function getBooks(): array {
        try{
            $connexion = connection();
            $query = "SELECT * FROM " . self::TABLE;
            $stmt = $connexion->prepare($query);
            $stmt->execute();
            $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $booksArray = [];

            foreach ($books as $book) {
                $booksArray[] = Media::getMediaById($book['media_id']);
            }
            
            return $booksArray;

        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function getBookById(int $id): ?array {
        try{
            $connexion = connection();
            $query = "SELECT * FROM " . self::TABLE . " WHERE media_id = :id";
            $stmt = $connexion->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $book = $stmt->fetch(PDO::FETCH_ASSOC);

            return $book;

        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function createBook( string $title, string $author, bool $available, int $pageNumber): void {
        try {
            $connexion = connection();

            $mediaId = Media::create($title, $author, $available);

            $query = "INSERT INTO " . self::TABLE . " (pageNumber, media_id) VALUES (:pageNumber, :media_id)";

            $stmt = $connexion->prepare($query);
            $stmt->bindValue(':pageNumber', $pageNumber, PDO::PARAM_INT);
            $stmt->bindValue(':media_id', $mediaId, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function updateBook(string $title, string $author, bool $available, int $pageNumber, int $id): void {
        try{
            $connexion = connection();
            Media::updateMedia($id, $title, $author, $available);
            $query = "UPDATE " . self::TABLE . " SET pageNumber = :pageNumber WHERE id = :id";
            $stmt = $connexion->prepare($query);
            $stmt->bindValue(':pageNumber', $pageNumber, PDO::PARAM_INT);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function deleteBook(int $id): void
    {
        try {
            $db = connection();

            $stmt = $db->prepare('DELETE FROM ' . self::TABLE . ' WHERE media_id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            Media::deleteMedia($id);


        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function emprunter(int $id): void {
        $media = Media::getMediaById($id);

        if (!$media) {
            throw new Exception("Livre introuvable.");
        }

        if (!$media['available']) {
            throw new Exception("Ce livre n'est pas disponible à l'emprunt.");
        }

        Media::updateAvailability($id, false);
    }

    public static function rendre(int $id): void {
        $media = Media::getMediaById($id);

        if (!$media) {
            throw new Exception("Livre introuvable.");
        }

        if ($media['available']) {
            throw new Exception("Ce livre est déjà disponible.");
        }

        Media::updateAvailability($id, true);
    }

}