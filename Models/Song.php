<?php 

class Song{
    private string $title;
    private int $note;
    private float $duration;

    public function __construct(string $title, int $note, float $duration){
        $this->title = $title;
        $this->note = $note;
        $this->duration = $duration;
    }

    public function getTitle(): string{
        return $this->title;
    }

    public function setTitle(string $title): void{
        $this->title = $title;
    }

    public function getNote(): int{
        return $this->note;
    }

    public function setNote(int $note): void{
        $this->note = $note;
    }

    public function getDuration(): float{
        return $this->duration;
    }

    public function setDuration(float $duration): void{
        $this->duration = $duration;
    }
}