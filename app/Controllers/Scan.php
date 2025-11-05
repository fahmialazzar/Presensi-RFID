<?php

namespace App\Controllers;
ini_set('display_errors', 1);
error_reporting(E_ALL);
use CodeIgniter\I18n\Time;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\PresensiGuruModel;
use App\Models\PresensiSiswaModel;
use App\Models\SettingsModel;
use App\Libraries\enums\TipeUser;

class Scan extends BaseController
{
   protected SiswaModel $siswaModel;
   protected GuruModel $guruModel;
   protected SettingsModel $settingsModel;

   protected PresensiSiswaModel $presensiSiswaModel;
   protected PresensiGuruModel $presensiGuruModel;

   public function __construct()
   {
      $this->siswaModel = new SiswaModel();
      $this->guruModel = new GuruModel();
      $this->presensiSiswaModel = new PresensiSiswaModel();
      $this->presensiGuruModel = new PresensiGuruModel();
      $this->settingsModel = new SettingsModel();
   }
   
   public function index($t = null)
{
   // Get attendance time settings
   $settings = $this->settingsModel->getAttendanceSettings();
   
   // Get current local time from PC
   $currentTime = Time::now();
   $currentTimeStr = $currentTime->format('H:i');
   
   // Determine the attendance type based on current time and settings
   if ($t === null) {
       // Only auto-determine if no specific mode was requested
       if ($this->isTimeInRange($currentTimeStr, $settings['masuk_start'], $settings['masuk_end'])) {
           $t = 'Masuk';
       } elseif ($this->isTimeInRange($currentTimeStr, $settings['pulang_start'], $settings['pulang_end'])) {
           $t = 'Pulang';
       } else {
           // Outside of defined ranges, check which is closer
           $now = strtotime($currentTimeStr);
           $masukStart = strtotime($settings['masuk_start']);
           $pulangStart = strtotime($settings['pulang_start']);
           
           // Default to masuk if outside of all ranges
           $t = 'Masuk';
           
           // Log the current state for debugging
           log_message('info', "Current time: $currentTimeStr, Outside time ranges, defaulting to $t");
       }
   }
   
   $data = [
       'waktu' => $t, 
       'title' => 'Absensi Siswa dan Guru Berbasis QR Code',
       'settings' => $settings
   ];
   
   return view('scan/scan', $data);
}

   private function isTimeInRange($time, $start, $end)
   {
       return ($time >= $start && $time <= $end);
   }

   public function cekKode()
{
    // Get settings
    $settings = $this->settingsModel->getAttendanceSettings();
    
    // ambil variabel POST
    $code = $this->request->getVar('unique_code');
    $waktuAbsen = $this->request->getVar('waktu');
    
    // Validate waktuAbsen
    if (!in_array(strtolower($waktuAbsen), ['masuk', 'pulang'])) {
        $currentTime = Time::now()->format('H:i');
        
        if ($this->isTimeInRange($currentTime, $settings['masuk_start'], $settings['masuk_end'])) {
            $waktuAbsen = 'masuk';
        } elseif ($this->isTimeInRange($currentTime, $settings['pulang_start'], $settings['pulang_end'])) {
            $waktuAbsen = 'pulang';
        } else {
            return $this->showErrorView('Absensi tidak dapat dilakukan di luar waktu yang ditentukan');
        }
    }
    
    $status = false;
    $type = TipeUser::Siswa;
    $result = null;

    // STRATEGI PENCARIAN BERTINGKAT:
    // 1. Cari berdasarkan unique_code (RFID) - PRIORITAS PERTAMA
    // 2. Jika tidak ketemu, cari berdasarkan NIS (QR Code Siswa)
    // 3. Jika tidak ketemu, cari berdasarkan NUPTK (QR Code Guru)
    
    // LANGKAH 1: Cek RFID - unique_code SISWA
    $result = $this->siswaModel->cekSiswa($code);
    
    if (!empty($result)) {
        $status = true;
        $type = TipeUser::Siswa;
        log_message('info', "Data ditemukan via RFID Siswa (unique_code): $code");
    } else {
        // LANGKAH 2: Cek RFID - unique_code GURU
        $result = $this->guruModel->cekGuru($code);
        
        if (!empty($result)) {
            $status = true;
            $type = TipeUser::Guru;
            log_message('info', "Data ditemukan via RFID Guru (unique_code): $code");
        } else {
            // LANGKAH 3: Cek QR Code - NIS SISWA
            $result = $this->siswaModel->cekSiswaByNIS($code);
            
            if (!empty($result)) {
                $status = true;
                $type = TipeUser::Siswa;
                log_message('info', "Data ditemukan via QR Code Siswa (NIS): $code");
            } else {
                // LANGKAH 4: Cek QR Code - NUPTK GURU
                $result = $this->guruModel->cekGuruByNUPTK($code);
                
                if (!empty($result)) {
                    $status = true;
                    $type = TipeUser::Guru;
                    log_message('info', "Data ditemukan via QR Code Guru (NUPTK): $code");
                }
            }
        }
    }

    if (!$status) {
        log_message('error', "Data tidak ditemukan untuk kode: $code");
        return $this->showErrorView('Data tidak ditemukan. Pastikan kartu RFID atau QR Code sudah terdaftar.');
    }

    // jika data ditemukan
    switch (strtolower($waktuAbsen)) {
        case 'masuk':
            return $this->absenMasuk($type, $result, $settings);
            break;

        case 'pulang':
            return $this->absenPulang($type, $result, $settings);
            break;

        default:
            return $this->showErrorView('Data tidak valid');
            break;
    }
}

   public function absenMasuk($type, $result, $settings)
   {
      // data ditemukan
      $data['data'] = $result;
      $data['waktu'] = 'masuk';

      $date = Time::today()->toDateString();
      $currentTime = Time::now()->toTimeString(); // Get current time

      // absen masuk
      switch ($type) {
         case TipeUser::Guru:
            $idGuru = $result['id_guru'];
            $data['type'] = TipeUser::Guru;

            // Check if the current time is within allowed range
            $currentTimeStr = Time::now()->format('H:i');
            if (!$this->isTimeInRange($currentTimeStr, $settings['masuk_start'], $settings['masuk_end'])) {
               return $this->showErrorView('Absensi masuk guru hanya bisa dilakukan pada jam yang ditentukan');
            }

            $sudahAbsen = $this->presensiGuruModel->cekAbsen($idGuru, $date);

            if ($sudahAbsen) {
               $data['presensi'] = $this->presensiGuruModel->getPresensiById($sudahAbsen);
               return $this->showErrorView('Anda sudah absen hari ini', $data);
            }

            // Use current time for attendance record
            $this->presensiGuruModel->absenMasuk($idGuru, $date, $currentTime);

            $data['presensi'] = $this->presensiGuruModel->getPresensiByIdGuruTanggal($idGuru, $date);

            return view('scan/scan-result', $data);

         case TipeUser::Siswa:
            $idSiswa = $result['id_siswa'];
            $idKelas = $result['id_kelas'];
            $data['type'] = TipeUser::Siswa;

            // Check if the current time is within allowed range
            $currentTimeStr = Time::now()->format('H:i');
            if (!$this->isTimeInRange($currentTimeStr, $settings['masuk_start'], $settings['masuk_end'])) {
               return $this->showErrorView('Absensi masuk siswa hanya bisa dilakukan pada jam yang ditentukan');
            }

            $sudahAbsen = $this->presensiSiswaModel->cekAbsen($idSiswa, Time::today()->toDateString());

            if ($sudahAbsen) {
               $data['presensi'] = $this->presensiSiswaModel->getPresensiById($sudahAbsen);
               return $this->showErrorView('Anda sudah absen hari ini', $data);
            }

            // Use current time for attendance record
            $this->presensiSiswaModel->absenMasuk($idSiswa, $date, $currentTime, $idKelas);

            $data['presensi'] = $this->presensiSiswaModel->getPresensiByIdSiswaTanggal($idSiswa, $date);

            return view('scan/scan-result', $data);

         default:
            return $this->showErrorView('Tipe tidak valid');
      }
   }

   public function absenPulang($type, $result, $settings)
   {
      // data ditemukan
      $data['data'] = $result;
      $data['waktu'] = 'pulang';

      $date = Time::today()->toDateString();
      $currentTime = Time::now()->toTimeString(); // Get current time

      // absen pulang
      switch ($type) {
         case TipeUser::Guru:
            $idGuru = $result['id_guru'];
            $data['type'] = TipeUser::Guru;

            // Check if the current time is within allowed range
            $currentTimeStr = Time::now()->format('H:i');
            if (!$this->isTimeInRange($currentTimeStr, $settings['pulang_start'], $settings['pulang_end'])) {
               return $this->showErrorView('Absensi pulang guru hanya bisa dilakukan pada jam yang ditentukan');
            }

            $sudahAbsen = $this->presensiGuruModel->cekAbsen($idGuru, $date);

            if (!$sudahAbsen) {
               return $this->showErrorView('Anda belum absen hari ini', $data);
            }

            // Use current time for attendance record
            $this->presensiGuruModel->absenKeluar($sudahAbsen, $currentTime);

            $data['presensi'] = $this->presensiGuruModel->getPresensiById($sudahAbsen);

            return view('scan/scan-result', $data);

         case TipeUser::Siswa:
            $idSiswa = $result['id_siswa'];
            $data['type'] = TipeUser::Siswa;

            // Check if the current time is within allowed range
            $currentTimeStr = Time::now()->format('H:i');
            if (!$this->isTimeInRange($currentTimeStr, $settings['pulang_start'], $settings['pulang_end'])) {
               return $this->showErrorView('Absensi pulang siswa hanya bisa dilakukan pada jam yang ditentukan');
            }

            $sudahAbsen = $this->presensiSiswaModel->cekAbsen($idSiswa, $date);

            if (!$sudahAbsen) {
               return $this->showErrorView('Anda belum absen hari ini', $data);
            }

            // Use current time for attendance record
            $this->presensiSiswaModel->absenKeluar($sudahAbsen, $currentTime);

            $data['presensi'] = $this->presensiSiswaModel->getPresensiById($sudahAbsen);

            return view('scan/scan-result', $data);
         default:
            return $this->showErrorView('Tipe tidak valid');
      }
   }

   public function showErrorView(string $msg = 'no error message', $data = NULL)
   {
      $errdata = $data ?? [];
      $errdata['msg'] = $msg;

      return view('scan/error-scan-result', $errdata);
   }
}
