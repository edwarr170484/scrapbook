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
}