<?php
namespace Scrapbook\Controller;

use Scrapbook\Core\Request;
use Scrapbook\Core\Controller;
use Scrapbook\Core\Application;

use Scrapbook\Model\Image;

class ImageController extends Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->loadModel(Image::class);
    }

    public function single(Request $request)
    {
        $single = $this->model->image->find($request->get("id"));

        return $this->json($single);
    }

    public function add(Request $request)
    {
        if($request->server("REQUEST_METHOD") == "POST")
        {
            if($request->files('image') && isset($request->files('image')['name']) && count($request->files('image')['name']) > 0)
            {
                foreach($request->files('image')['name'] as $key => $value){
                    
                    $path = "/uploads/images/" . $request->files('image')['name'][$key];
                    
                    if($request->files('image')['size'][$key] > 0){
                        
                        if(move_uploaded_file($request->files('image')['tmp_name'][$key],  Application::$config->root . $path))
                        {
                            $this->model->image->add([intval($request->post("album-id")), $request->files('image')['name'][$key], $path]);
                        }
                    }
                }
            }

            $this->redirect("/album?id=" . $request->post("album-id"));
        }

        $this->redirect("/");
    }

    public function edit(Request $request)
    {
        if($request->server("REQUEST_METHOD") == "POST")
        {
            $caption = $request->post("image-caption");
            $description = $request->post("image-description") ? $request->post("image-description") : "";

            if($request->post("image-id"))
            {
                $id = $request->post("image-id");
                $result = $this->model->image->edit([$caption, $description, $id]);
            }

            $this->redirect($request->post("redirect"));
        }
    }

    public function rate(Request $request)
    {
        if($request->server("REQUEST_METHOD") == "POST")
        {
            $type = $request->post("rate-type");
            $image = $request->post("rate-image");

            $table = $this->model->image->getTableName();

            $this->model->image->sql("UPDATE $table SET $type='$value' WHERE id=$image");
            $single = $this->model->image->find($image);

            return $this->json($single);
        }

        return $this->json([]);
    }

    public function delete(Request $request)
    {
        if($request->server("REQUEST_METHOD") == "POST")
        {
            try
            {
                $result = $this->model->image->delete($request->post("id"), Application::$config->root);

                return $this->json(['message' => 'Изображение успешно удалено', 'error' => 0]);
            }
            catch(\Throwable $e)
            {
                return $this->json(['message' => $e->getMessage(), 'error' => 1]);
            }
        }

        return $this->json(['message' => '', 'error' => 1]);
    }
}