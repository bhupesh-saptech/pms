<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function list()
    {
       $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM users");
        $result = $query->getResult();
        echo "<pre>";
        print_r($result);
    }
}
