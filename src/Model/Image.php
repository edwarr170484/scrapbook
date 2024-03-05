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

    public function findByAlbumId($albumId)
    {
        return $this->manager->prepared("SELECT * FROM $this->table WHERE album_id=?", [intval($albumId)]);
    }

    public function find($id)
    {
        $image = new Image();
        $comment = new Comment();
        $images = [];

        $results = $this->manager->prepared("SELECT i.id as id, i.album_id as album_id, i.name as name, i.caption as caption, i.description as description ,i.path as path, i.likes as likes, i.dislikes as dislikes, i.date_added as date_added, c.id as comment_id, c.image_id as comment_image, c.text as comment_text, c.name as comment_author, c.date_added as comment_date FROM $this->table i LEFT JOIN $comment->table c ON (c.image_id = i.id) WHERE i.id=?", [intval($id)]);

        if(count($results) > 0)
        {
            $images = $this->process($results);
        }

        return count($images) > 0 ? $images[0] : null;
    }


    public function add($values)
    {
        return $this->manager->prepared("INSERT INTO $this->table (album_id, name, path) values (?, ?, ?)", $values);
    }

    public function edit($values)
    {
        return $this->manager->prepared("UPDATE $this->table SET caption=?, description=? WHERE id=?", $values);
    }

    public function delete($id, $rootDir)
    {
        $comment = new Comment();
        $image = $this->find($id);

        if($image)
        {
            $fullPath = $rootDir . $image["path"];
            unlink($fullPath);

        }

        return $this->manager->prepared("DELETE FROM $this->table WHERE id=?", [intval($id)]);
    }

    private function process($results)
    {
        $images = [];
        
        foreach($results as $result)
        {
            $dateAdded = new \DateTime($result["date_added"]);
            $commentDate = $result["comment_date"] ? new \DateTime($result["comment_date"]) : new \DateTime("now");

            if(!array_key_exists($result["id"], $images))
            {
                $likes = $result["likes"] ? json_decode($result["likes"], true) : [];
                $dislikes = $result["dislikes"] ? json_decode($result["dislikes"], true) : [];

                $images[$result["id"]] = [
                    "id"     => $result["id"],
                    "album_id"   => $result["album_id"],
                    "caption" => $result["caption"],
                    "description" => $result["description"],
                    "path" => $result["path"],
                    "likes" => $likes,
                    "dislikes" => $dislikes,
                    "likesCount" => array_reduce($likes, function($l, $v){if($v == 1){$l += 1;}return $l;}, 0),
                    "dislikesCount" => array_reduce($dislikes, function($l, $v){if($v == 1){$l += 1;}return $l;}, 0),
                    "date_added" => $dateAdded,
                    "comments" => []
                ];
            }
            
            if($result["comment_id"])
            {
                $images[$result["id"]]["comments"][] = [
                    "id"       => $result["comment_id"],
                    "image_id" => $result["comment_image"],
                    "text"  => $result["comment_text"],
                    "name"     => $result["comment_author"],
                    "date_added"    => $commentDate->format("d.m.Y H:i")
                ];
            }
        }

        return array_values($images);
    }
}