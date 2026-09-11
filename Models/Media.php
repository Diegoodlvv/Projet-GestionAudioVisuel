<?php 

abstract class Media{
    protected string $title;
    protected string $author;
    protected bool $disponible;

    public function __construct(string $title, string $author, bool $disponible)
    {
        $this->title = $title;
        $this->author = $author;
        $this->disponible = $disponible;
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

    public function isDisponible(): bool{
        return $this->disponible;
    }

    public function emprunt(){
        if($this->disponible == true){
            echo "Vous avez emprunter le livre : " . $this->title;

            $this->disponible = false;
        } else{
            echo "Ce livre n'est pas disponible à l'emprunt";
        }
    }

    public function giveBack(){
        if($this->disponible == false){
            echo "Vous avez rendu le livre : " . $this->title;

            $this->disponible = true;
        } else {
            echo "Nous avons déjà ce livre dans notre médiathèque";
        }
    }

}