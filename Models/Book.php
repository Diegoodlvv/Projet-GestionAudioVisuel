<?php 

require_once 'Media.php';
require_once 'include/db_connect.php';

class Book extends Media {
    private int $pageNumber;
    const TABLE = "books";

    public function __construct(int $id, string $title, string $author, bool $available, int $pageNumber){
        parent::__construct($id, $title, $author, $available);
        $this->pageNumber = $pageNumber;
    }

    public function getPageNumber(): int{
        return $this->pageNumber;
    }

    public function setPageNumber(int $pageNumber): void{
        $this->pageNumber = $pageNumber;
    }
}