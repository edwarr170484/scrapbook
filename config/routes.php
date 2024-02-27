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
    [
        "method"     => "get",
        "uri"        => "/album/image",
        "controller" => "ImageController",
        "handler"    => "single"
    ],
    [
        "method"     => "post",
        "uri"        => "/album/images/add",
        "controller" => "ImageController",
        "handler"    => "add"
    ],
    [
        "method"     => "post",
        "uri"        => "/album/images/edit",
        "controller" => "ImageController",
        "handler"    => "edit"
    ],
    [
        "method"     => "post",
        "uri"        => "/album/images/delete",
        "controller" => "ImageController",
        "handler"    => "delete"
    ],
];