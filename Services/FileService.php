<?php

class FileService
{
    private const MAX_SIZE = 5 * 1024 * 1024; 

    private const TYPES = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp'
    ];

    public static function uploadIllustration(array $file, int $uploadedBy): int
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Erreur lors de l'upload.");
        }

        if ($file['size'] > self::MAX_SIZE){
            throw new Exception(
                "Le fichier est trop volumineux."
            );
        }

        $mimeType = $file['type'];

        if (!isset(self::TYPES[$mimeType])) {
            throw new Exception(
                "Type de fichier non autorisé."
            );
        }

        $extension = self::TYPES[$mimeType];

        $storedName = bin2hex(random_bytes(16)) . '.' . $extension;

        $uploadDirectory = __DIR__ . '/../uploads/';

        $destination = $uploadDirectory . $storedName;

        if (!move_uploaded_file($file['tmp_name'], $destination))
        {
            throw new Exception("Impossible d'enregistrer le fichier.");
        }

        $fileId = File::create($file['name'], $storedName, $file['size'], $mimeType, $uploadedBy);
        
        return $fileId;
    }
}