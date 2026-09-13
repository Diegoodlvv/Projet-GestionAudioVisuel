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
}