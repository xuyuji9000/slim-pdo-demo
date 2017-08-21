<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/uploadimage/view', App\Controllers\UploadImageController::class.':view');
$app->post('/uploadimage/upload', App\Controllers\UploadImageController::class.':upload');
$app->get('/pdo', function($req, $res, $args){
    $dbhandler = $this->db;
    $queryUser = $dbhandler->prepare(' SELECT * FROM users ');

    $queryUser->execute();
    $users = $queryUser->fetchAll();
    return $users;
});
