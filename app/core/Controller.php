<?php
namespace App\Core;

class Controller {
    protected $viewPath = 'app/views/';

    public function render($view, $data = [], $layout = null) {
        extract($data);

        if ($layout) {
            ob_start();
            include $this->viewPath . $view . '.php';
            $content = ob_get_clean();
            include $this->viewPath . 'layouts/' . $layout . '.php';
        } else {
            include $this->viewPath . $view . '.php';
        }
    }

    public function redirect($path, $code = 302) {
        header("Location: {$path}", true, $code);
        exit;
    }

    public function json($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
}