<?php

class App
{
    private string $controllerClass = 'UsersController';
    private string $method = 'index';
    private array $params = [];
    private $controllerInstance;

    public function __construct()
    {
        session_start();
        $url = $this->parseUrl();

        if (!empty($url[0])) {
            $candidate = ucfirst($url[0]) . 'Controller';
            if (file_exists(__DIR__ . '/../controllers/' . $candidate . '.php')) {
                $this->controllerClass = $candidate;
                unset($url[0]);
            }
        }

        require_once __DIR__ . '/../controllers/' . $this->controllerClass . '.php';
        $this->controllerInstance = new $this->controllerClass();

        if (!empty($url[1])) {
            if (method_exists($this->controllerInstance, $url[1])) {
                $this->method = $url[1];
                unset($url[0], $url[1]);
            } else {
                unset($url[0]);
            }
        }

        $this->params = $url ? array_values($url) : [];
    }

    public function run(): void
    {
        try {
            call_user_func_array([$this->controllerInstance, $this->method], $this->params);
        } catch (Throwable $e) {
            http_response_code(500);
            echo '<h1>Error</h1><p>' . htmlspecialchars($e->getMessage()) . '</p>';
        }
    }

    private function parseUrl(): array
    {
        $url = $_GET['url'] ?? '';
        return explode('/', filter_var(trim($url, '/'), FILTER_SANITIZE_URL));
    }
}