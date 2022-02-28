<?php
declare(strict_types=1);

namespace App\core;

/**
 * Class Controller
 * @package App\core
 * @author Houssem TAYECH <houssem@forticas.com>
 */
class Controller
{
    /**
     * @param string $path
     * @param array $args
     * @param bool $isWithoutLayout
     * @return void
     */
    public function renderView(string $path, array $args = [], bool $isWithoutLayout = false):void
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

    /**
     * @param string $path
     * @return void
     */
    public function redirectTo(string $path):void
    {
        header("Location: $path");
    }

    /**
     * @param string $path
     * @return void
     */
    public function redirectToRoute(string $path):void
    {
        header("Location: {$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["HTTP_HOST"]}" . BASE_URI . "/$path");
    }

    /**
     * @param array $content
     * @return void
     */
    public function json(array $content):void
    {
        header('Content-Type: application/json');
        echo json_encode($content);
        die;
    }

}
