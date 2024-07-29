<?php

namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Authorization\GroupModel;

class UsersModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'npm';

    protected $useAutoIncrement = false;
    protected $allowedFields = ['nama', 'email', 'npm', 'jurusan', 'fakultas', 'angkatan'];
    protected $afterInsert = ['addToGroup'];
    protected $assignGroup;

    public function totalUsers()
    {
        return $this->countAllResults();
    }

    public function getAllUsers()
    {
        $subquery = $this->db->table('rents')
            ->select("npm, SUM(TIMESTAMPDIFF(SECOND, waktu_pinjam, waktu_kembali)) as total_rent_time")
            ->groupBy('npm')
            ->getCompiledSelect();

        $query = $this->db->table('students')
            ->select('students.*, COUNT(rents.id_rents) as rents_users, subquery.total_rent_time')
            ->join("($subquery) as subquery", 'students.npm = subquery.npm', 'left')
            ->join('rents', 'students.npm = rents.npm', 'left')
            ->groupBy('students.npm, subquery.total_rent_time') // Add total_rent_time to GROUP BY clause
            ->get();

        $result = $query->getResultArray();

        foreach ($result as $key => $value) {
            $total_waktu = $value['total_rent_time'];
            $hours = floor($total_waktu / 3600);
            $minutes = floor(($total_waktu % 3600) / 60);
            $seconds = $total_waktu % 60;
            $result[$key]['total_rent_time'] = "$hours jam $minutes menit $seconds detik";
        }

        return $result;
    }

    public function getNpm($npm)
    {
        $subquery = $this->db->table('rents')
            ->select("npm, SUM(TIMESTAMPDIFF(SECOND, waktu_pinjam, waktu_kembali)) as total_rent_time")
            ->where('npm', $npm)
            ->getCompiledSelect();

        $query = $this->db->table('students')
            ->select('students.*, COUNT(rents.id_rents) as rents_users, MAX(subquery.total_rent_time) as total_rent_time')
            ->join("($subquery) as subquery", 'students.npm = subquery.npm', 'left')
            ->join('rents', 'students.npm = rents.npm', 'left')
            ->where('students.npm', $npm)
            ->get();

        $result = $query->getRowArray();

        $total_waktu = $result['total_rent_time'];
        $hours = floor($total_waktu / 3600);
        $minutes = floor(($total_waktu % 3600) / 60);
        $seconds = $total_waktu % 60;
        $result['total_rent_time'] = "$hours jam $minutes menit $seconds detik";

        return $result;
    }

    /**
     * If a default role is assigned in Config\Auth, will
     * add this user to that group. Will do nothing
     * if the group cannot be found.
     *
     * @param mixed $data
     *
     * @return mixed
     */
    protected function addToGroup($data)
    {
        if (is_numeric($this->assignGroup)) {
            $groupModel = model(GroupModel::class);
            $groupModel->addUserToGroup($data['id'], $this->assignGroup);
        }

        return $data;
    }

}