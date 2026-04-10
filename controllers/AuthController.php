<?php
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    // Inscription 

    public function showRegister(): void
    {
        require_once 'views/auth/register.php';
    }

    public function register(): void
    {
        $errors   = [];
        $username = trim($_POST['username'] ?? '');
        $email    = trim($_POST['email']    ?? '');
        $password = $_POST['password']      ?? '';
        $confirm  = $_POST['confirm']       ?? '';

        // Validation
        if (empty($username)) {
            $errors[] = "Le nom d'utilisateur est requis.";
        } elseif (strlen($username) < 3) {
            $errors[] = "Le nom d'utilisateur doit contenir au moins 3 caractères.";
        }

        if (empty($email)) {
            $errors[] = "L'email est requis.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'email est invalide.";
        }

        if (empty($password)) {
            $errors[] = "Le mot de passe est requis.";
        } elseif (strlen($password) < 6) {
            $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
        }

        if ($password !== $confirm) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        }

        if (empty($errors) && User::emailExists($email)) {
            $errors[] = "Cet email est déjà utilisé.";
        }

        if (!empty($errors)) {
            require_once 'views/auth/register.php';
            return;
        }

        if (User::register($username, $email, $password)) {
            $_SESSION['flash'] = [
                'type' => 'success', 
                'message' => 'Compte créé ! Connectez-vous.'
            ];
            header('Location: index.php?action=login');
            exit;
        }

        $errors[] = 'Une erreur est survenue. Réessayez.';
        require_once 'views/auth/register.php';
    }

    // Connexion 

    public function showLogin(): void
    {
        require_once 'views/auth/login.php';
    }

    public function login(): void
    {
        $errors   = [];
        $email    = trim($_POST['email']    ?? '');
        $password = $_POST['password']      ?? '';

        if (empty($email) || empty($password)) {
            $errors[] = 'Veuillez remplir tous les champs.';
            require_once 'views/auth/login.php';
            return;
        }

        $user = User::login($email, $password);

        if ($user) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['flash']     = [
                'type' => 'success', 
                'message' => 'Bienvenue, ' . $user['username'] . ' !'
            ];
            header('Location: index.php?action=recipes');
            exit;
        }

        $errors[] = 'Email ou mot de passe incorrect.';
        require_once 'views/auth/login.php';
    }

    //Déconnexion 

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}