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

    public static function create(string $title, string $author, bool $available, int $fileId): int
    {
        $connexion = connection();

        $query = "INSERT INTO media (title, author, available, file_id) VALUES (:title, :author, :available, :file_id)";

        $stmt = $connexion->prepare($query);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':author', $author);
        $stmt->bindValue(':available', $available, PDO::PARAM_BOOL);
        $stmt->bindValue(':file_id', $fileId, PDO::PARAM_INT);

        $stmt->execute();

        return (int) $connexion->lastInsertId();
    }

    public static function getMedias(): array{

        $page = isset($_GET['page']) > 0 ? $_GET['page'] : 1;
        $limit = 3;
        $offset = ($page - 1) * $limit;

        try {
            $db = connection();
            $stmt = $db->prepare("SELECT * FROM " . self::TABLE . " LIMIT :limit OFFSET :offset");
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $medias = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $medias;

        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function getTotalMedias(): int {
        try {
            $db = connection();
            $stmt = $db->prepare("SELECT COUNT(*) as total FROM " . self::TABLE);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return (int) $result['total'];
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

    public static function updateMedia(int $id, string $title, string $author, bool $available, int $fileId): void{
        try {
            $db = connection();
            $stmt = $db->prepare("UPDATE " . self::TABLE . " SET title = :title, author = :author, available = :available, file_id = :file_id WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':author', $author, PDO::PARAM_STR);
            $stmt->bindValue(':available', $available, PDO::PARAM_BOOL);
            $stmt->bindValue(':file_id', $fileId, PDO::PARAM_INT);

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

    public static function updateAvailability(int $id, bool $available): void {
        try {
            $db = connection();
            $stmt = $db->prepare("UPDATE " . self::TABLE . " SET available = :available WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':available', $available, PDO::PARAM_BOOL);
            $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function rechercherMedia($media, $search)
    {
        $valeur = false;

        // recherche stricte 

        if(str_contains(strtolower($media["title"]), strtolower($search)) || str_contains(strtolower($media["author"]), strtolower($search))){
            $valeur = true;        
        }

        // recherche approximative sur la chaîne entière de chaque donnée 

        if(levenshtein(strtolower($search), strtolower($media["title"])) <= 2 || levenshtein(strtolower($search), strtolower($media["author"])) <= 2){
            $valeur = true;
        }

        // recherche appoximative sur chaque mot de chaque donnée 

        $mots = explode(" ", $media["title"] . " " .  $media["author"]);

        foreach($mots as $mot){
            if(levenshtein(strtolower($search), strtolower($mot)) <= 2 ){
                $valeur = true;
            }
        }
        
        return $valeur;

    }
}
