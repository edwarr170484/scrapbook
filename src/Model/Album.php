<?php 
namespace Scrapbook\Model;

use Scrapbook\Core\Model;
use Scrapbook\Model\Image;

class Album extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "album";
    }

    public function add($values)
    {
        return $this->manager->prepared("INSERT INTO $this->table (name, tieser) values (?, ?)", $values);
    }

    public function edit($values)
    {
        return $this->manager->prepared("UPDATE $this->table SET name=?, tieser=?, date_updated=current_timestamp() WHERE id=?", $values);
    }

    public function delete($id)
    {
        return $this->manager->prepared("DELETE FROM $this->table WHERE id=?", [intval($id)]);
    }
}