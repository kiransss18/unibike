<?php

namespace App\Models;

use CodeIgniter\Model;

class SheltersModel extends Model
{
    protected $table = 'shelters';
    protected $primaryKey = 'id_shelter';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama_shelter', 'lokasi'];

    public function getAllShelters()
    {
        $query = $this->db->table('shelters')
            ->select('shelters.*, COUNT(bikes.id_bikes) as jumlah_sepeda')
            ->join('bikes', 'shelters.id_shelter = bikes.id_shelter', 'left')
            ->groupBy('shelters.id_shelter')
            ->get();

        $results = $query->getResultArray();
        return $results;
    }

    public function getShelter($id_shelter)
    {
        $query = $this->db->table('shelters')
            ->select('shelters.*, COUNT(bikes.id_bikes) as jumlah_sepeda')
            ->join('bikes', 'shelters.id_shelter = bikes.id_shelter', 'left')
            ->where('shelters.id_shelter', $id_shelter)
            ->get();

        $result = $query->getRowArray();
        return $result;
    }

    public function shelterDashboard()
    {
        $query = $this->db->table('shelters')
            ->select('shelters.id_shelter, shelters.nama_shelter, 
                  COUNT(bikes.id_bikes) as total_sepeda')
            ->join('bikes', 'shelters.id_shelter = bikes.id_shelter', 'left')
            ->groupBy('shelters.id_shelter, shelters.nama_shelter')
            ->get();

        $result = $query->getResultArray();

        foreach ($result as &$shelter) {
            $shelter_id = $shelter['id_shelter'];
            $total_rent = $this->db->table('rents')
                ->where('shelter_pinjam', $shelter_id)
                ->countAllResults();
            $total_all_rent = $this->db->table('rents')
                ->countAllResults();
            $percentage_rent = ($total_rent / $total_all_rent) * 100;
            $shelter['pinjam_persen'] = number_format($percentage_rent, 2) . '%';
        }

        return $result;
    }
}