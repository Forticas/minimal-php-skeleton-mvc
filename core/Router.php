<?php
declare(strict_types=1);

namespace App\core;

/**
 * Class Router
 * @package App\core
 * @author Houssem TAYECH <houssem@forticas.com>
 */
class Router
{
    /**
     * @var array
     */
    private array $actions = [];

    /**
     * @param string $path
     * @param string $callback
     * @return void
     */
    public function register(string $path, string $callback)
    {
        $this->actions[] = [
            'path' => $path, 'callback' => $callback
        ];
    }

    /**
     * @return void
     */
    public function run()
    {
        $request = $_SERVER['REQUEST_URI'];
        // remove get params
        if ($question_mark_position = strpos($request, '?')) {
            $request = substr($request, 0, $question_mark_position);
        }
        $request_without_base_uri = str_replace(BASE_URI, "", $request);
        $exploded_request_uri = explode("/", $request_without_base_uri);

        foreach ($this->actions as $action) {
            // la route match without variables
            if ($request_without_base_uri == $action['path']) {

                $this->runWithExactMatch($action['callback']);
                return;
            }

            $exploded_defined_path = explode("/", $action['path']);

            // compare length
            if (count($exploded_defined_path) == count($exploded_request_uri)) {

                if (count(array_intersect($exploded_defined_path, $exploded_request_uri)) > 1) {
                    $args = [];
                    foreach ($exploded_defined_path as $key => $value) {
                        if (str_starts_with($value, "#")) {
                            $args[] = $exploded_request_uri[$key];
                        }
                    }
                    $this->runWithParams($action['callback'], $args);
                    return;
                }
            }
        }

        $this->showPageNotFound();

    }

    /**
     * @param string $callback
     * @return void
     */
    private function runWithExactMatch(string $callback)
    {
        [$controller, $method] = explode("::", $callback);
        $controller_instance = new $controller();
        $controller_instance->$method();

    }

    /**
     * @param string $callback
     * @param array $params
     * @return void
     */
    private function runWithParams(string $callback, array $params)
    {
        if (empty($params) || in_array("", $params)) {
            $this->showPageNotFound();
            return;
        }
        [$controller, $method] = explode("::", $callback);
        $controller_instance = new $controller();
        call_user_func_array([$controller_instance, $method], $params);

    }

    /**
     * @return void
     */
    private function showPageNotFound(): void
    {
        http_response_code(404);
        echo <<<HTML
        <html lang="en">
            <head>
                <title>404 Not Found</title>
            </head>
            <body>
                <h1>404 Page Not Found</h1>
            </body>    
        </html>
HTML;

    }
}