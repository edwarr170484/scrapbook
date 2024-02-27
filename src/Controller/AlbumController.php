<?php
namespace Scrapbook\Controller;

use Scrapbook\Core\Request;
use Scrapbook\Core\Controller;
use Scrapbook\Core\Application;

use Scrapbook\Model\Album;

class AlbumController extends Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->loadModel(Album::class);
    }

    public function single(Request $request)
    {
        $single = $this->model->album->find($request->get("id"));

        return $this->render("album.php", ["title" => $single ? $single["name"] : "Альбом не найден", "album" => $single]);
    }

    public function edit(Request $request)
    {
        if($request->server("REQUEST_METHOD") == "POST")
        {
            $name = $request->post("album-name");
            $tieser = $request->post("album-tieser") ? $request->post("album-tieser") : "";

            if($request->post("album-id"))
            {
                $id = $request->post("album-id");
                $result = $this->model->album->edit([$name, $tieser, $id]);
            }
            else
            {
                $result = $this->model->album->add([$name, $tieser]);
            }

            $this->redirect("/");
        }

        try
        {
                $single = $this->model->album->find($request->get("id"));

                return $this->json($single);
        }
        catch(\Throwable $e)
        {
            return $this->json([]);
        }
    }

    public function delete(Request $request)
    {
        if($request->server("REQUEST_METHOD") == "POST")
        {
            try
            {
                $result = $this->model->album->delete($request->post("id"), Application::$config->root);

                return $this->json(['message' => 'Альбом успешно удален', 'error' => 0]);
            }
            catch(\Throwable $e)
            {
                return $this->json(['message' => $e->getMessage(), 'error' => 1]);
            }
        }

        return $this->json(['message' => '', 'error' => 1]);
    }
}