<?php
namespace Scrapbook\Controller;

use Scrapbook\Core\Request;
use Scrapbook\Core\Controller;

use Scrapbook\Model\Album;

class MainController extends Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->loadModel(Album::class);
    }

    public function index(Request $request)
    {
        return $this->render("index.php", ["title" => "Главная страница", "header" => "Мои альбомы", "albums" => $this->model->album->findAll()]);
    }
}