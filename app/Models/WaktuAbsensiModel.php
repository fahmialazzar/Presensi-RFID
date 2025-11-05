<?php

namespace App\Models;

use CodeIgniter\Model;

class WaktuAbsensiModel extends Model
{
    protected $table = 'tb_waktu_absensi';
    protected $primaryKey = 'id_waktu';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    
    protected $allowedFields = [
        'jenis',
        'jam_mulai',
        'jam_selesai',
        'aktif'
    ];
    
    // Get active time settings
    public function getActiveSettings()
    {
        return $this->where('aktif', 1)->findAll();
    }
    
    // Get specific setting by type (masuk/pulang)
    public function getSettingByType($type)
    {
        return $this->where(['jenis' => $type, 'aktif' => 1])->first();
    }
    
    // Update time settings
    public function updateSetting($id, $data)
    {
        return $this->update($id, $data);
    }
}