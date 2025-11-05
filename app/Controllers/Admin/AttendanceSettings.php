<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingsModel;

class AttendanceSettings extends BaseController
{
    protected $settingsModel;

    public function __construct()
    {
        $this->settingsModel = new SettingsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengaturan Waktu Absensi',
            'settings' => $this->settingsModel->getAttendanceSettings()
        ];
        
        return view('admin/attendance_settings', $data);
    }

    public function update()
    {
        // Validate input
        $rules = [
            'masuk_start' => 'required|regex_match[/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/]',
            'masuk_end' => 'required|regex_match[/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/]',
            'pulang_start' => 'required|regex_match[/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/]',
            'pulang_end' => 'required|regex_match[/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get form data
        $masukStart = $this->request->getPost('masuk_start');
        $masukEnd = $this->request->getPost('masuk_end');
        $pulangStart = $this->request->getPost('pulang_start');
        $pulangEnd = $this->request->getPost('pulang_end');

        // Update settings
        $this->settingsModel->updateSetting('masuk_start', $masukStart);
        $this->settingsModel->updateSetting('masuk_end', $masukEnd);
        $this->settingsModel->updateSetting('pulang_start', $pulangStart);
        $this->settingsModel->updateSetting('pulang_end', $pulangEnd);

        return redirect()->to('admin/attendance-settings')->with('success', 'Pengaturan waktu absensi berhasil diperbarui');
    }
}