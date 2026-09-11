<?php 

require_once 'Media.php';

class Book extends Media {
    private int $pageNumber;

    public function __construct(string $title, string $author, bool $disponible, int $pageNumber){
        parent::__construct($title, $author, $disponible);
        $this->pageNumber = $pageNumber;
    }

    public function getPageNumber(): int{
        return $this->pageNumber;
    }

    public function setPageNumber(int $pageNumber): void{
        $this->pageNumber = $pageNumber;
    }
}