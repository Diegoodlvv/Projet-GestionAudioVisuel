<?php 

require_once 'Models/User.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class UserController {

    static function register() {
        $errors = [];
        $email = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmPassword'] ?? '';


            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse email n'est pas valide.";
            }

            if (!User::isValidPassword($password)) {
                $errors[] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
            }

            if ($password !== $confirmPassword) {
                $errors[] = "Les mots de passe ne correspondent pas.";
            }

            if (empty($errors) && User::findByEmail($email) !== null) {
                $errors[] = "Cette adresse email est déjà utilisée.";
            }

            if (empty($errors)) {
                $user = User::create($email, $password);

                session_regenerate_id(true);
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_email'] = $user->getEmail();

                header('Location: index.php?action=Media/library');
                exit;
            }
        }

        require_once('views/user/register.php');
    }

    static function login() {
        $errors = [];
        $email = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $userRow = User::findByEmail($email);

            if (!$userRow || !User::verifyPassword($password, $userRow['password'])) {
                $errors[] = "Email ou mot de passe incorrect.";
            }

            if (empty($errors)) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $userRow['id'];
                $_SESSION['user_email'] = $userRow['email'];

                header('Location: index.php?action=Media/library');
                exit;
            }
        }

        require_once('views/user/login.php');
    }

    static function logout() {
        session_destroy();

        header('Location: index.php?action=User/login');
        exit;
    }
}