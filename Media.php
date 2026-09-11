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

    public function emprunter(){
        if($this->disponible == true){
            echo "Vous avez emprunter le livre : " . $this->title;

            $this->disponible = false;
        } else{
            echo "Ce livre n'est pas disponible à l'emprunt";
        }
    }

    public function rendre(){
        if($this->disponible == false){
            echo "Vous avez rendu le livre : " . $this->title;
            
            $this->disponible = true;
        } else {
            echo "Nous avons déjà ce livre dans notre médiathèque";
        }
    }

}