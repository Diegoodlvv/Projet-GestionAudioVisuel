<?php 

require_once 'db_connect.php';

abstract class Media{
    protected int $id;
    protected string $title;
    protected string $author;
    protected bool $available;
    const TABLE = "media";

    public function __construct(int $id, string $title, string $author, bool $available)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->available = $available;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getTitle(): string{
        return $this->title;
    }

    public function setTitle(string $title): void{
        $this->title = $title;
    }

    public function getAuthor(): string{
        return $this->author;
    }

    public function setAuthor(string $author): void{
        $this->author = $author;
    }

    public function isAvailable(): bool{
        return $this->available;
    }

    public function emprunt(){
        if($this->available == true){
            echo "Vous avez emprunter le livre : " . $this->title;

            $this->available = false;
        } else{
            echo "Ce livre n'est pas available à l'emprunt";
        }
    }

    public function giveBack(){
        if($this->available == false){
            echo "Vous avez rendu le livre : " . $this->title;

            $this->available = true;
        } else {
            echo "Nous avons déjà ce livre dans notre médiathèque";
        }
    }

    public static function create(string $title, string $author, bool $available): int
    {
        $connexion = connection();

        $query = "INSERT INTO media (title, author, available) VALUES (:title, :author, :available)";

        $stmt = $connexion->prepare($query);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':author', $author);
        $stmt->bindValue(':available', $available, PDO::PARAM_BOOL);

        $stmt->execute();

        return (int) $connexion->lastInsertId();
    }

    public static function getMedias(): array{
        try {
            $db = connection();
            $stmt = $db->prepare("SELECT * FROM " . self::TABLE);
            $stmt->execute();
            $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $books;
        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function getMediaById(int $id): ?array{
        try {
            $db = connection();
            $stmt = $db->prepare("SELECT * FROM " . self::TABLE . " WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
            $media = $stmt->fetch(PDO::FETCH_ASSOC);

            return $media;

        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function updateMedia(int $id, string $title, string $author, bool $available): void{
        try {
            $db = connection();
            $stmt = $db->prepare("UPDATE " . self::TABLE . " SET title = :title, author = :author, available = :available WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':author', $author, PDO::PARAM_STR);
            $stmt->bindValue(':available', $available, PDO::PARAM_BOOL);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function deleteMedia(int $id): void{
        try {
            $db = connection();
            $stmt = $db->prepare("DELETE FROM " . self::TABLE . " WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    

}
