<?php

require_once 'Media.php';

class Album extends Media{
    private int $trackNumber;
    private string $editor;
    const TABLE = "album";

    public function __construct(int $id, string $title, string $author, bool $available, int $trackNumber, string $editor)
    {
       parent::__construct($id, $title, $author, $available);
       $this->trackNumber = $trackNumber;
       $this->editor = $editor;
    }

    public function getTrackNumber(): int{
        return $this->trackNumber;
    }

    public function setTrackNumber(int $trackNumber): void{
        $this->trackNumber = $trackNumber;
    }

    public function getEditor(): string{
        return $this->editor;
    }

    public function setEditor(string $editor): void{
        $this->editor = $editor;
    }

    public static function getAlbums(): array {
        try{
            $connexion = connection();
            $query = "SELECT * FROM " . self::TABLE;
            $stmt = $connexion->prepare($query);
            $stmt->execute();
            $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $albumsArray = [];

            foreach ($albums as $album) {
                $albumsArray[] = Media::getMediaById($album['media_id']);
            }
            
            return $albumsArray;

        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function getAlbumById(int $id): ?array {
        try{
            $connexion = connection();
            $query = "SELECT * FROM " . self::TABLE . " WHERE media_id = :id";
            $stmt = $connexion->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $album = $stmt->fetch(PDO::FETCH_ASSOC);

            return $album;

        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function createAlbum( string $title, string $author, bool $available, int $trackNumber, string $editor): void {
        try {
            $connexion = connection();

            $mediaId = Media::create($title, $author, $available);

            $query = "INSERT INTO " . self::TABLE . " (trackNumber, editor, media_id) VALUES (:trackNumber, :editor, :media_id)";

            $stmt = $connexion->prepare($query);
            $stmt->bindValue(':trackNumber', $trackNumber, PDO::PARAM_INT);
            $stmt->bindValue(':editor', $editor, PDO::PARAM_STR);
            $stmt->bindValue(':media_id', $mediaId, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function updateAlbum(string $title, string $author, bool $available, int $trackNumber, string $editor, int $id): void {
        try{
            $connexion = connection();
            Media::updateMedia($id, $title, $author, $available);
            $query = "UPDATE " . self::TABLE . " SET trackNumber = :trackNumber, editor = :editor WHERE media_id = :id";
            $stmt = $connexion->prepare($query);
            $stmt->bindValue(':trackNumber', $trackNumber, PDO::PARAM_INT);
            $stmt->bindValue(':editor', $editor, PDO::PARAM_INT);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function deleteAlbum(int $id): void
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

}