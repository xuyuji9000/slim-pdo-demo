<?php
namespace App\Controllers;

class PDOController extends HomeController
{
    public function get($req, $res,$args)
    {
        $dbhandler = $this->container->db;
        $queryUser = $dbhandler->prepare(' SELECT * FROM users ');

        $queryUser->execute();
        $users = $queryUser->fetchAll();
        return $res;
    }
}

