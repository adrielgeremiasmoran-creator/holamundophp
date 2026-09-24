<?php

class Controller
{
    public function model(string $model)
    {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    public function view(string $view, array $data = []): void
    {
        extract($data);
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/' . $view . '.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function redirect(string $url): void
    {
        $base = '/holamundophp/public';
        header('Location: ' . $base . $url);
        exit;
    }

    public function input(string $key): ?string
    {
        $value = $_POST[$key] ?? $_GET[$key] ?? null;
        return $value !== null ? htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8') : null;
    }

    public function flash(string $key, string $message): void
    {
        $_SESSION['flash'][$key] = $message;
    }
}