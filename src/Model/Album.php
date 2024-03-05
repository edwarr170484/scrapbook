<?php 
namespace Scrapbook\Model;

use Scrapbook\Core\Model;
use Scrapbook\Model\Image;
use Scrapbook\Model\Comment;

class Album extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "album";
    }

    public function findAll()
    {
        $image = new Image();
        $comment = new Comment();
        $albums = [];

        $results = $this->manager->query("SELECT a.id as id, a.name as name, a.tieser as tieser, a.date_created as date_created, a.date_updated as date_updated, i.id as image_id, i.album_id as image_album, i.caption as image_caption, i.path as image_path, i.likes as image_likes, i.dislikes as image_dislikes, i.date_added as image_date, (SELECT count(*) FROM $comment->table WHERE image_id=i.id) as comments FROM $this->table a LEFT JOIN $image->table i ON (i.album_id = a.id)");

        if(count($results) > 0)
        {
            $albums = $this->process($results);
        }

        return $albums;
    }

    public function find($id)
    {
        $image = new Image();
        $comment = new Comment();
        $albums = [];

        $results = $this->manager->prepared("SELECT a.id as id, a.name as name, a.tieser as tieser, a.date_created as date_created, a.date_updated as date_updated, i.id as image_id, i.album_id as image_album, i.caption as image_caption, i.path as image_path, i.likes as image_likes, i.dislikes as image_dislikes, i.date_added as image_date, (SELECT count(*) FROM $comment->table WHERE image_id=i.id) as comments FROM $this->table a LEFT JOIN $image->table i ON (i.album_id = a.id) WHERE a.id=?", [intval($id)]);

        if(count($results) > 0)
        {
            $albums = $this->process($results);
        }

        return count($albums) > 0 ? $albums[0] : null;
    }

    public function add($values)
    {
        return $this->manager->prepared("INSERT INTO $this->table (name, tieser) values (?, ?)", $values);
    }

    public function edit($values)
    {
        return $this->manager->prepared("UPDATE $this->table SET name=?, tieser=?, date_updated=current_timestamp() WHERE id=?", $values);
    }

    public function delete($id, $rootDir)
    {
        $image = new Image();

        $images = $image->findByAlbumId($id);

        if(count($images) > 0)
        {
            foreach($images as $albumImage)
            {
                $image->delete($albumImage["id"], $rootDir);
            }
        }

        return $this->manager->prepared("DELETE FROM $this->table WHERE id=?", [intval($id)]);
    }

    private function process($results)
    {
        $albums = [];

        foreach($results as $result)
        {
            $dateCreated = new \DateTime($result["date_created"]);
            $dateUpdated = new \DateTime($result["date_updated"]);
            $imageDate = $result["image_date"] ? new \DateTime($result["image_date"]) : new \DateTime("now");

            if(!array_key_exists($result["id"], $albums))
            {
                $albums[$result["id"]] = [
                    "id"     => $result["id"],
                    "name"   => $result["name"],
                    "tieser" => $result["tieser"],
                    "date_created" => $dateCreated,
                    "date_updated" => $dateUpdated,
                    "images" => []
                ];
            }
            
            if($result["image_id"])
            {
                $likes = $result["image_likes"] ? json_decode($result["image_likes"], true) : [];
                $dislikes = $result["image_dislikes"] ? json_decode($result["image_dislikes"], true) : [];

                $albums[$result["id"]]["images"][] = [
                    "id"       => $result["image_id"],
                    "album_id" => $result["image_album"],
                    "caption"  => $result["image_caption"],
                    "path"     => $result["image_path"],
                    "likes"    => $likes,
                    "dislikes" => $dislikes,
                    "likesCount" => array_reduce($likes, function($l, $v){if($v == 1){$l += 1;}return $l;}, 0),
                    "dislikesCount" => array_reduce($dislikes, function($l, $v){if($v == 1){$l += 1;}return $l;}, 0),
                    "date_added" => $imageDate,
                    "comments" => $result["comments"]
                ];
            }
        }

        return array_values($albums);
    }
}