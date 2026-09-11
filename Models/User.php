<?php 

class User {
    private string $email;
    private string $password;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;
    const TABLE = "users";

    public function __construct(string $email, string $password ){
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
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

    public static function create(string $email, string $password): User
    {
        try {
            $db = connection();
            $stmt = $db->prepare("INSERT INTO " . self::TABLE . " (email, password, created_at, updated_at) VALUES (:email, :password, NOW(), NOW())");

            $password = password_hash($password, PASSWORD_ARGON2ID);

            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            return new User($email, $password);
        } catch (PDOException $e) {
            throw new Exception("Error creating user: " . $e->getMessage());
        }
    }
}