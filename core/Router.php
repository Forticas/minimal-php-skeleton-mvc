<?php
declare(strict_types=1);

namespace App\core;

class Router
{
    private $actions = [];

    public function register(string $path, string $callback)
    {
        $this->actions[] = [
            'path' => $path, 'callback' => $callback
        ];
    }

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
            // la route match exatement sans variables
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

    private function runWithExactMatch($callback)
    {
        [$controller, $method] = explode("::", $callback);
        $controller_instance = new $controller();
        $controller_instance->$method();

    }

    private function runWithParams($callback, $params)
    {
        if (empty($params) || in_array("", $params)) {
            $this->showPageNotFound();
            return;
        }
        [$controller, $method] = explode("::", $callback);
        $controller_instance = new $controller();
        call_user_func_array([$controller_instance, $method], $params);

    }

    private function showPageNotFound()
    {
        http_response_code(404);
        echo <<<HTML
        <html>
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