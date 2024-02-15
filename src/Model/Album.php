<?php 
namespace Scrapbook\Model;

use Scrapbook\Core\Model;

class Album extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "album";
    }
}