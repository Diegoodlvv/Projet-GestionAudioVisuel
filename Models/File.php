<?php

class File
{
    private const TABLE = 'File';

    public static function create(string $originalName, string $storedName, int $size, string $mimeType, int $uploadedBy): int {
        try {
            $db = connection();

            $query = "INSERT INTO " . self::TABLE . "(original_name, stored_name, size, mime_type, uploaded_at, uploaded_by) VALUES (:original_name, :stored_name, :size, :mime_type, :uploaded_at , :uploaded_by)";

            $stmt = $db->prepare($query);

            $stmt->bindValue(':original_name', $originalName, PDO::PARAM_STR);
            $stmt->bindValue(':stored_name', $storedName, PDO::PARAM_STR);
            $stmt->bindValue(':size', $size, PDO::PARAM_INT);
            $stmt->bindValue(':mime_type', $mimeType, PDO::PARAM_STR);
            $stmt->bindValue(':uploaded_at', new DateTime('now')->format('Y-m-d H:i:s'));
            $stmt->bindValue(':uploaded_by', $uploadedBy, PDO::PARAM_INT);

            $stmt->execute();

            return $db->lastInsertId();

        } catch (PDOException $e) {
            throw new Exception(
                "Erreur lors de l'enregistrement du fichier : "
                . $e->getMessage()
            );
        }
    }

    public static function getFileById(int $id): array
    {
        try {
            $db = connection();

            $query = "SELECT * FROM " . self::TABLE . " WHERE id = :id ORDER BY uploaded_at DESC";

            $stmt = $db->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            throw new Exception(
                "Erreur lors de la récupération des fichiers : "
                . $e->getMessage()
            );
        }
    }

    public static function toBytes(string|int $size): int{
        return substr($size, 0, 1) * 1024 * 1024;
    }
}