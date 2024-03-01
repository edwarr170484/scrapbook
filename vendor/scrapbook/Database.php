<?php 
namespace Scrapbook\Core;

interface Database
{
    public function connect(array $parameters);
}