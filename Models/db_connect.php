<?php

function connection(){
    $serveur = "localhost";
    $login = "root";
    $password = "";
    $database = "mediatheque";

    try{
        $connexion = new PDO("mysql:host=$serveur;dbname=$database", $login, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connexion;
    } catch(PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}