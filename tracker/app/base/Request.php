<?php

namespace App\Base;

class Request
{
    protected $queryParams;
    protected $postData;

    public function __construct()
    {
        $this->queryParams = $_GET;
        $this->postData = $_POST;
    }

    public function all()
    {
        return array_merge($this->queryParams, $this->postData);
    }

    public function input($key, $default = null)
    {
        return $this->queryParams[$key] ?? $this->postData[$key] ?? $default;
    }
}
