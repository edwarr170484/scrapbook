<?php 
namespace Scrapbook\Model;

use Scrapbook\Core\Model;
use Scrapbook\Model\Comment;

class Image extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "images";
    }

    
}