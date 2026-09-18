<?php 
 
require_once 'db_connect.php';
 
class User {
    private int $id;
    private string $email;
    private string $password;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;
    const TABLE = "users";
 
    const PASSWORD_REGEX = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
 
    public function __construct(string $email, string $password, int $id = 0){
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }
 
    public function getId(): int{
        return $this->id;
    }
 
    public function getEmail(): string{
        return $this->email;
    }
 
    public function setEmail(string $email): void{
        $this->email = $email;
    }
 
    public function getPassword(): string{
        return $this->password;
    }
 
    public function setPassword(string $password): void{
        $this->password = $password;
    }
 
    public static function isValidPassword(string $password): bool {
        return preg_match(self::PASSWORD_REGEX, $password) === 1;
    }
 
    public static function verifyPassword(string $password, string $hashedPassword): bool {
        return password_verify($password, $hashedPassword);
    }
 
    public static function findByEmail(string $email): ?array {
        try {
            $db = connection();
            $stmt = $db->prepare("SELECT * FROM " . self::TABLE . " WHERE email = :email");
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
            return $user === false ? null : $user;
        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }
 
    public static function findById(int $id): ?array {
        try {
            $db = connection();
            $stmt = $db->prepare("SELECT * FROM " . self::TABLE . " WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
            return $user === false ? null : $user;
        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }
 
    public static function create(string $email, string $password): User
    {
        try {
            $db = connection();
 
            $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
 
            $stmt = $db->prepare("INSERT INTO " . self::TABLE . " (email, password, created_at, updated_at) VALUES (:email, :password, NOW(), NOW())");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();
 
            $id = (int) $db->lastInsertId();
 
            return new User($email, $hashedPassword, $id);
        } catch (PDOException $e) {
            throw new Exception("Erreur de requête : " . $e->getMessage());
        }
    }
}
 