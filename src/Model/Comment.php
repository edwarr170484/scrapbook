<?php 
namespace Scrapbook\Model;

use Scrapbook\Core\Model;

class Comment extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "comment";
    }

    public function add($values)
    {
        return $this->manager->prepared("INSERT INTO $this->table (image_id, text, name) values (?, ?, ?)", $values);
    }
}