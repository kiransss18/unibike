<?php

namespace App\Models;

use CodeIgniter\Model;

class RentsModel extends Model
{
    protected $table = 'rents';
    protected $primaryKey = 'id_rents';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['waktu_pinjam', 'waktu_kembali', 'deskripsi', 'status'];

    public function totalRents()
    {
        $query = $this->db->query("SELECT 
        COUNT(*) as total_pinjam, 
        COUNT(CASE WHEN status = 1 THEN 1 END) as total_kembali FROM rents");
        $result = $query->getRow();
        return $result;
    }

    public function getAllRents()
    {
        $query = $this->db->table('rents')
            ->select('rents.*, shelters.nama_shelter AS shelter_pinjam, shelters_kembali.nama_shelter AS shelter_kembali')
            ->select("CONCAT(
                TIMESTAMPDIFF(HOUR, rents.waktu_pinjam, rents.waktu_kembali), ' jam ',
                MOD(TIMESTAMPDIFF(MINUTE, rents.waktu_pinjam, rents.waktu_kembali), 60), ' menit ',
                MOD(TIMESTAMPDIFF(SECOND, rents.waktu_pinjam, rents.waktu_kembali), 60), ' detik'
            ) AS total_waktu", false)
            ->join('shelters', 'rents.shelter_pinjam = shelters.id_shelter', 'left')
            ->join('shelters as shelters_kembali', 'rents.shelter_kembali = shelters_kembali.id_shelter', 'left')
            ->get();

        $result = $query->getResultArray();

        return $result;
    }

    public function getRent($id_rents)
    {
        $query = $this->db->table('rents')
            ->select('rents.*, shelters.nama_shelter AS shelter_pinjam, shelters_kembali.nama_shelter AS shelter_kembali')
            ->select("CONCAT(
                TIMESTAMPDIFF(HOUR, rents.waktu_pinjam, rents.waktu_kembali), ' jam ',
                MOD(TIMESTAMPDIFF(MINUTE, rents.waktu_pinjam, rents.waktu_kembali), 60), ' menit ',
                MOD(TIMESTAMPDIFF(SECOND, rents.waktu_pinjam, rents.waktu_kembali), 60), ' detik'
            ) AS total_waktu", false)
            ->join('shelters', 'rents.shelter_pinjam = shelters.id_shelter', 'left')
            ->join('shelters as shelters_kembali', 'rents.shelter_kembali = shelters_kembali.id_shelter', 'left')
            ->where('rents.id_rents', $id_rents)
            ->get();

        $result = $query->getRowArray();

        return $result;
    }
}