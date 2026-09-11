<?php

require_once 'Media.php';

class Album extends Media{
    private int $trackNumber;
    private string $editor;

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
}