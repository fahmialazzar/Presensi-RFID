<?php

namespace App\Controllers;

use App\Models\SettingWaktuModel;

class SettingWaktu extends BaseController
{
    protected $settingWaktuModel;

    public function __construct()
    {
        $this->settingWaktuModel = new SettingWaktuModel();
    }

    public function index()
    {
        // Cek apakah user adalah admin
        if (!session()->get('isAdmin')) {
            return redirect()->to(base_url('/admin/login'))->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }

        $data = [
            'title' => 'Pengaturan Waktu Absensi',
            'waktu_masuk' => $this->settingWaktuModel->getWaktuByTipe('masuk'),
            'waktu_pulang' => $this->settingWaktuModel->getWaktuByTipe('pulang')
        ];

        return view('setting/waktu', $data);
    }

    public function update()
    {
        // Cek apakah user adalah admin
        if (!session()->get('isAdmin')) {
            return redirect()->to(base_url('/admin/login'))->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }

        // Validasi input
        $rules = [
            'waktu_masuk_mulai' => 'required',
            'waktu_masuk_selesai' => 'required',
            'waktu_pulang_mulai' => 'required',
            'waktu_pulang_selesai' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update waktu masuk
        $this->settingWaktuModel->updateWaktu(
            'masuk',
            $this->request->getPost('waktu_masuk_mulai'),
            $this->request->getPost('waktu_masuk_selesai')
        );

        // Update waktu pulang
        $this->settingWaktuModel->updateWaktu(
            'pulang',
            $this->request->getPost('waktu_pulang_mulai'),
            $this->request->getPost('waktu_pulang_selesai')
        );

        return redirect()->to(base_url('setting/waktu'))->with('message', 'Pengaturan waktu berhasil diperbarui');
    }

    public function getWaktu()
    {
        $data = [
            'waktu_masuk' => $this->settingWaktuModel->getWaktuByTipe('masuk'),
            'waktu_pulang' => $this->settingWaktuModel->getWaktuByTipe('pulang')
        ];

        return $this->response->setJSON($data);
    }
}