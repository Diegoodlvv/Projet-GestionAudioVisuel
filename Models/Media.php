<?php 

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

    public function create(string $title, string $author, bool $available){
        $db = connection();
        $stmt = $db->prepare("INSERT INTO " . self::TABLE . " (title, author, available) VALUES (:title, :author, :available)");
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':author', $author, PDO::PARAM_STR);
        $stmt->bindValue(':available', $available, PDO::PARAM_BOOL);

        $stmt->execute();
    }
}