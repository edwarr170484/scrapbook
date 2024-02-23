<?php 

$routes = [
    [
        "method"     => "get",
        "uri"        => "/",
        "controller" => "MainController",
        "handler"    => "index"
    ],
    [
        "method"     => "get",
        "uri"        => "/album",
        "controller" => "AlbumController",
        "handler"    => "single"
    ],
    [
        "method"     => "post",
        "uri"        => "/album/edit",
        "controller" => "AlbumController",
        "handler"    => "edit"
    ],
    [
        "method"     => "post",
        "uri"        => "/album/delete",
        "controller" => "AlbumController",
        "handler"    => "delete"
    ],
];