<?php 
namespace Scrapbook\Core;

use Scrapbook\Core\Request;
use Scrapbook\Core\Router;
use Scrapbook\Core\Session;

class Application
{
   private Router $router;
   private Request $request;
   static public Session $session;
   static public $manager;
   static public $config;

   public function __construct(array $config, array $routes)
   {
      self::$config = json_decode(json_encode($config));
      self::$session = new Session();
      
      $this->request = new Request();
      $this->router = new Router($routes);
    }

   public function run()
   {
      try 
      {
         $dbDriver = "Scrapbook\\Core\\Drivers\\" . ucfirst(self::$config->database->driver);
         self::$manager = new $dbDriver;

         $params = [
            "server" => self::$config->database->server, 
            "login"  => self::$config->database->login, 
            "password" => self::$config->database->password,
            "database" => self::$config->database->name
         ];
         
         self::$manager->connect($params);

         $response = $this->router->resolve($this->request);
         $response->send();
      }
      catch(Exceplion $e)
      {
         throw "Error in Application->run()";
      }
   }
}