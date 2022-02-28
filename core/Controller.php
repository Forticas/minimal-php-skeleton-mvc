<?php
declare(strict_types=1);

namespace App\core;

class Controller
{
    public function renderView(string $path, $args = [], bool $isWithoutLayout = false)
    {
        foreach ($args as $key => $value) {
            $$key = $value;
        }
        ob_start();
        require_once __DIR__ . '/../src/view/' . $path . '.php';
        $content = ob_get_clean();
        if (!$isWithoutLayout)
            require_once __DIR__ . '/../src/view/layout.php';
    }

    public function redirectTo(string $path)
    {
        header("Location: $path");
    }

    public function redirectToRoute(string $path)
    {
        header("Location: {$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["HTTP_HOST"]}" . BASE_URI . "/$path");
    }

    public function json(array $content)
    {
        header('Content-Type: application/json');
        echo json_encode($content);
    }

}
