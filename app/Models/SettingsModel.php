<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'tb_settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['setting_key', 'setting_value', 'description'];

    public function getSetting($key)
    {
        $result = $this->where('setting_key', $key)->first();
        return $result ? $result['setting_value'] : null;
    }

    public function updateSetting($key, $value)
    {
        return $this->where('setting_key', $key)->set(['setting_value' => $value])->update();
    }

    public function getAttendanceSettings()
    {
        $settings = [
            'masuk_start' => $this->getSetting('masuk_start'),
            'masuk_end' => $this->getSetting('masuk_end'),
            'pulang_start' => $this->getSetting('pulang_start'),
            'pulang_end' => $this->getSetting('pulang_end')
        ];
        
        return $settings;
    }
}