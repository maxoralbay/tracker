<?php

namespace App\base;

class View
{
    private static $instance = null;
    private mixed $viewPath;
    public $BASE_DIR = __DIR__ . DIRECTORY_SEPARATOR . '..';

    private function __construct($viewPath = 'frontend')
    {
        $this->viewPath = $viewPath;
    }

    public static function getInstance($viewPath = 'frontend')
    {
        if (self::$instance === null) {
            self::$instance = new self($viewPath);
        }
        return self::$instance;
    }

    public static function render($view, $data = [])
    {
        try {

            $viewPath = self::getInstance()->viewPath;
            //app/viewPath
            //app/frontend/index.php
            $viewFile = self::getInstance()->BASE_DIR . DIRECTORY_SEPARATOR . $viewPath . DIRECTORY_SEPARATOR . $view;
            if (file_exists($viewFile)) {
                extract($data);
                include_once $viewFile;
            } else {
                throw new \Exception("View file not found: {$viewFile}");
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
