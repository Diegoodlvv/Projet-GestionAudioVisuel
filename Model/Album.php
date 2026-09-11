<?php

require_once 'Media.php';

class Album extends Media{
    private int $trackNumber;
    private string $editor;

    public function __construct(string $title, string $author, bool $disponible, int $trackNumber, string $editor)
    {
       parent::__construct($title, $author, $disponible);
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
}