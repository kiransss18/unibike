<?php

namespace App\Models;

use CodeIgniter\Model;

class BikesModel extends Model
{
    protected $table = 'bikes';
    protected $primaryKey = 'id_bikes';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['foto', 'seri', 'tahun', 'deskripsi', 'status', 'baterai'];


    public function totalBikes()
    {
        return $this->countAllResults();
    }

    public function getAllBikes()
    {
        $query = $this->db->table('bikes')
            ->select('bikes.*, COUNT(rents.id_rents) as rents_bikes, SUM(TIMESTAMPDIFF(SECOND, waktu_pinjam, waktu_kembali)) as total_bike_times')
            ->join('rents', 'bikes.id_bikes = rents.id_bikes', 'left')
            ->groupBy('bikes.id_bikes')
            ->get();

        $results = $query->getResultArray();
        foreach ($results as &$result) {
            $total_bike_times = $result['total_bike_times'];
            $hours = floor($total_bike_times / 3600);
            $minutes = floor(($total_bike_times % 3600) / 60);
            $seconds = $total_bike_times % 60;
            $result['total_bike_times'] = "$hours jam $minutes menit $seconds detik";
        }

        return $results;
    }

    public function getBike($id_bikes)
    {
        $subquery = $this->db->table('rents')
            ->select("id_bikes, SUM(TIMESTAMPDIFF(SECOND, waktu_pinjam, waktu_kembali)) as total_bike_times")
            ->where('id_bikes', $id_bikes)
            ->getCompiledSelect();

        $query = $this->db->table('bikes')
            ->select('bikes.*, COUNT(rents.id_rents) as rents_bikes, MAX(subquery.total_bike_times) as total_bike_times')
            ->join("($subquery) as subquery", 'bikes.id_bikes = subquery.id_bikes', 'left')
            ->join('rents', 'bikes.id_bikes = rents.id_bikes', 'left')
            ->where('bikes.id_bikes', $id_bikes)
            ->get();

        $result = $query->getRowArray();
        $total_bike_times = $result['total_bike_times'];
        $hours = floor($total_bike_times / 3600);
        $minutes = floor(($total_bike_times % 3600) / 60);
        $seconds = $total_bike_times % 60;
        $result['total_bike_times'] = "$hours jam $minutes menit $seconds detik";

        return $result;
    }

}