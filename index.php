<?php
require_once("./vendor/autoload.php");
require_once("./config/env.php");
require_once("./config/routes.php");

use Scrapbook\Core\Application;

try
{
    $app = new Application($config, $routes);
    
    $app->run();
}
catch(Exception $e)
{
    echo('Application could not be started. Error: ' . $e->getMessage());
}