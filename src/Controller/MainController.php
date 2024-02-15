<?php
namespace Scrapbook\Controller;

use Scrapbook\Core\Request;
use Scrapbook\Core\Controller;

use Scrapbook\Model\Album;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $album = new Album();

        $albums = $album->findAll();

        return $this->render("index.php", ["header" => "Мои альбомы", "albums" => $albums]);
    }
}