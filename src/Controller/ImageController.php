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
}