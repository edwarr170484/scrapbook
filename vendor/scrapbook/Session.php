<?php 
namespace Scrapbook\Core;

class Session{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) 
        {
            session_start();
        }
    }

    public function get($name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function is($name)
    {
        return isset($_SESSION[$name]);
    }

    public function remove($name)
    {
        if(isset($_SESSION[$name]))
        {
            unset($_SESSION[$name]);
        }
    }
}