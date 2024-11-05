<?php

namespace App\Base;

class RequestOld
{
    public function __construct()
    {
        $this->all();
    }

    public static function get($key)
    {
        return $_GET[$key] ?? null;
    }

    public static function post($key)
    {
        return $_POST[$key] ?? null;
    }

    public static function file($key)
    {
        return $_FILES[$key] ?? null;
    }

    public static function all()
    {
        return $_REQUEST;
    }

    public static function has($key)
    {
        return isset($_REQUEST[$key]);
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function uri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public static function url()
    {
        return $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    public static function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}