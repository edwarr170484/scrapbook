<?php
namespace Scrapbook\Controller;

use Scrapbook\Core\Request;
use Scrapbook\Core\Controller;
use Scrapbook\Core\Application;

use Scrapbook\Model\Comment;

class CommentController extends Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->loadModel(Comment::class);
    }

    public function add(Request $request)
    {
        if($request->server("REQUEST_METHOD") == "POST")
        {
            $image = $request->post("image");
            $name = $request->post("name") ? $request->post("name") : "";
            $text = $request->post("text") ? $request->post("text") : "";

            $result = $this->model->comment->add([$image, $text, $name]);

            try
            {
                $insertedId = $this->model->comment->getLastInsertId();
                $single = $this->model->comment->find($insertedId);
                $this->model->comment->delete($insertedId - 1);

                return $this->json($single);
            }
            catch(\Throwable $e)
            {
                return $this->json([]);
            }
        }

        
    }
}