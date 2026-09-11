<?php 

require_once 'Media.php';
require_once 'EnumMovie.php';

class Movie extends Media{
    private float $duration;
    private EnumMovie $genre;

    public function __construct(string $title, string $author, bool $disponible, float $duration, EnumMovie $genre)
    {
        parent::__construct($title, $author, $disponible);
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
}