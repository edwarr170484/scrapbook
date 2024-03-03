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

    public function sql($query)
    {
        return $this->manager->query($query);
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

    public function getLastInsertId()
    {
        return $this->manager->getLastInsertId();
    }

    public function getTableName()
    {
        return $this->table;
    }
}