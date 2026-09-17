<?php 

require_once 'Media.php';
require_once 'db_connect.php';
require_once 'Enum/EnumMovie.php';

class Movie extends Media{
    private float $duration;
    private EnumMovie $genre;
    const TABLE = "movie";

    public function __construct(int $id, string $title, string $author, bool $available, float $duration, EnumMovie $genre)
    {
        parent::__construct($id, $title, $author, $available);
        $this->duration = $duration;
        $this->genre = $genre;
    }

    public function getDuration(): float{
        return $this->duration;
    }

    public function setDuration(float $duration): void{
        $this->duration = $duration;
    }

    public function getGenre(): EnumMovie{
        return $this->genre;
    }

    public function setGenre(EnumMovie $genre): void{
        $this->genre = $genre;
    }

    public static function getMovies(): array {
        try{
            $connexion = connection();
            $query = "SELECT * FROM " . self::TABLE;
            $stmt = $connexion->prepare($query);
            $stmt->execute();
            $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $moviesArray = [];

            foreach ($movies as $movie) {
                $moviesArray[] = Media::getMediaById($movie['media_id']);
            }
            
            return $moviesArray;

        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function getMovieById(int $id): ?array {
        try{
            $connexion = connection();
            $query = "SELECT * FROM " . self::TABLE . " WHERE media_id = :id";
            $stmt = $connexion->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $movie = $stmt->fetch(PDO::FETCH_ASSOC);

            return $movie;

        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function createMovie(string $title, string $author, bool $available,float $duration, EnumMovie $genre): void {
        try {
            $connexion = connection();

            $mediaId = Media::create($title, $author, $available);

            $query = "INSERT INTO " . self::TABLE . " (duration, genre, media_id) VALUES (:duration, :genre, :media_id)";

            $stmt = $connexion->prepare($query);
            $stmt->bindValue(':duration', $duration);
            $stmt->bindValue(':genre', $genre->value);
            $stmt->bindValue(':media_id', $mediaId, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function updateMovie(string $title, string $author, bool $available, float $duration, EnumMovie $genre, int $id): void {
        try{
            $connexion = connection();
            Media::updateMedia($id, $title, $author, $available);
            $query = "UPDATE " . self::TABLE . " SET duration = :duration, genre = :genre WHERE id = :id";
            $stmt = $connexion->prepare($query);
            $stmt->bindValue(':duration', $duration,  PDO::PARAM_INT);
            $stmt->bindValue(':genre', $genre->value);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }

    public static function deleteMovie(int $id): void
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