<?php

namespace App\Controllers;

use App\Models\WaktuAbsensiModel;
use CodeIgniter\I18n\Time;

class WaktuAbsensi extends BaseController
{
    protected $waktuModel;
    
    public function __construct()
    {
        $this->waktuModel = new WaktuAbsensiModel();
    }
    
    // Display settings page
    public function index()
    {
        $data = [
            'title' => 'Pengaturan Waktu Absensi',
            'settings' => $this->waktuModel->getActiveSettings()
        ];
        
        return view('waktu_absensi/index', $data);
    }
    
    // Show edit form
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Pengaturan Waktu',
            'setting' => $this->waktuModel->find($id)
        ];
        
        if (empty($data['setting'])) {
            return redirect()->to('/waktu-absensi')->with('error', 'Pengaturan tidak ditemukan');
        }
        
        return view('waktu_absensi/edit', $data);
    }
    
    // Update settings
    public function update($id)
    {
        $rules = [
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'jam_mulai' => $this->request->getVar('jam_mulai'),
            'jam_selesai' => $this->request->getVar('jam_selesai')
        ];
        
        if ($this->waktuModel->update($id, $data)) {
            return redirect()->to('/waktu-absensi')->with('message', 'Pengaturan waktu berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui pengaturan');
        }
    }
}