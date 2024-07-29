<?php

namespace App\Controllers;

use Config\Services;
use App\Models\SheltersModel;
use App\Models\UsersModel;
use App\Models\RentsModel;
use App\Models\BikesModel;
use App\Models\AdminsModel;
use Myth\Auth\Models\UserModel;


class Dashboard extends BaseController
{

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['activeMenu'] = "dashboard";

        $usersData = new UsersModel();
        $data['usersData'] = $usersData->select('fakultas')->findAll();
        $data['totalUsers'] = $usersData->totalUsers();

        $bikesData = new BikesModel();
        $data['bikesData'] = $bikesData->findAll();
        $data['totalBikes'] = $bikesData->totalBikes();

        $rentsData = new RentsModel();
        $data['rentsData'] = $rentsData->select('waktu_kembali')->findAll();
        $data['totalRents'] = $rentsData->totalRents();


        $shelter = new SheltersModel();
        $data['shelters'] = $shelter->shelterDashboard();

        echo view("layout/header", $data);
        echo view("layout/sidebar", $data);
        echo view('dashboard', $data);
        echo view("layout/footer");

    }
}