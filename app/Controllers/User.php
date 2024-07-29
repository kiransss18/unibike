<?php

namespace App\Controllers;

use App\Models\UsersModel;

class User extends BaseController
{

    public function index()
    {
        $data['title'] = "List Pengguna";
        $data['activeMenu'] = "List Pengguna";

        $user = new UsersModel();
        $data['users'] = $user->getAllUsers();

        echo view("layout/header", $data);
        echo view("layout/sidebar", $data);
        echo view('user/user');
        echo view("layout/footer");

    }


    public function userdetail($npm)
    {
        $data['title'] = "Detail Pengguna";
        $data['activeMenu'] = "List Pengguna";

        $user = new UsersModel();
        $data['user'] = $user->getNpm($npm);

        echo view("layout/header", $data);
        echo view("layout/sidebar", $data);
        echo view('user/userdetail');
        echo view("layout/footer");
    }

}