<?php
namespace Scrapbook\Core;

use Scrapbook\Core\Application;

class Model
{
    protected $manager;
    protected string $table;
    
    public function __construct()
    {
        $this->manager = Application::$manager;
    }

    public function findAll()
    {
        return $this->manager->query("SELECT * FROM $this->table");
    }

    public function find($id)
    {
        $items = $this->manager->prepared("SELECT * FROM $this->table WHERE id=?", [intval($id)]);
        return count($items) > 0 ? $items[0] : null;
    }
}