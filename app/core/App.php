<?php
class App
{
    protected $Controller = 'Home';
    protected $method = 'index';
    protected $params = [];
    public function __Construct()
    {
        $url = $this->parseURL();
        if (isset($url[0]) && file_exists('../app/Controllers/' . $url[0] . '.php')) {
            $this->Controller = $url[0];
            unset($url[0]);
        }
        require_once '../app/Controllers/' . $this->Controller . '.php';
        $this->Controller = new $this->Controller;
        if (isset($url[1])) {
            if (method_exists($this->Controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        if (!empty($url)) {
            $this->params = array_values($url);
        }
        call_user_func_array([$this->Controller, $this->method], $this->params);
    }
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
