<?php
namespace App\Core;

class Controller {
    protected $viewPath = __DIR__ . '/../views/';

    public function render($view, $data = [], $layout = null) {
        extract($data);

        if (empty($this->viewPath)) {
            $this->viewPath = __DIR__ . '/../views/';
        }

        $viewFile = $this->viewPath . $view . '.php';

        if ($layout) {
            $layoutFile = $this->viewPath . 'layouts/' . $layout . '.php';

            if (file_exists($layoutFile)) {
                ob_start();
                include $viewFile;
                $content = ob_get_clean();
                include $layoutFile;
                return;
            }

            include $viewFile;
            return;
        }

        include $viewFile;
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