<?php

namespace Core;

class Controller {
    protected function view($view, $data = []): void
    {
        $viewPath = __DIR__ . "/../views/$view.php";
        if (!file_exists($viewPath)) {
            throw new \Exception("View file '$view.php' not found.");
        }

        extract($data);
        require __DIR__ . "/../views/$view.php";
    }
}