<?php

namespace App\Controllers\Admin;

use App\Models\GuruModel;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class DataGuru extends BaseController
{
   protected GuruModel $guruModel;

   protected $guruValidationRules = [
      'nuptk' => [
         'rules' => 'required|max_length[20]|min_length[16]',
         'errors' => [
            'required' => 'NUPTK harus diisi.',
            'is_unique' => 'NUPTK ini telah terdaftar.',
            'min_length' => 'Panjang NUPTK minimal 16 karakter'
         ]
      ],
      'nama' => [
         'rules' => 'required|min_length[3]',
         'errors' => [
            'required' => 'Nama harus diisi'
         ]
      ],
      'jk' => ['rules' => 'required', 'errors' => ['required' => 'Jenis kelamin wajib diisi']],
      'no_hp' => 'required|numeric|max_length[20]|min_length[5]',
      'unique_code' => [
        'rules' => 'required|exact_length[10]|is_unique[tb_guru.unique_code]',
        'errors' => [
            'required' => 'Kode RFID harus diisi',
            'exact_length' => 'Kode RFID harus 10 karakter',
            'is_unique' => 'Kartu RFID sudah terdaftar'
        ]
      ],
      'tgl_lahir' => [
         'rules' => 'required|valid_date',
         'errors' => [
             'required' => 'Tanggal lahir harus diisi',
             'valid_date' => 'Format tanggal lahir tidak valid'
         ]
      ]
   ];

   public function __construct()
   {
      $this->guruModel = new GuruModel();
   }

   /**
    * Get validation rules for editing guru
    * This excludes the current record from unique checks
    */
   private function getEditValidationRules($idGuru)
   {
      return [
         'nuptk' => [
            'rules' => 'required|max_length[20]|min_length[16]',
            'errors' => [
               'required' => 'NUPTK harus diisi.',
               'is_unique' => 'NUPTK ini telah terdaftar.',
               'min_length' => 'Panjang NUPTK minimal 16 karakter'
            ]
         ],
         'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
               'required' => 'Nama harus diisi'
            ]
         ],
         'jk' => ['rules' => 'required', 'errors' => ['required' => 'Jenis kelamin wajib diisi']],
         'no_hp' => 'required|numeric|max_length[20]|min_length[5]',
         'unique_code' => [
           'rules' => "required|exact_length[10]|is_unique[tb_guru.unique_code,id_guru,{$idGuru}]",
           'errors' => [
               'required' => 'Kode RFID harus diisi',
               'exact_length' => 'Kode RFID harus 10 karakter',
               'is_unique' => 'Kartu RFID sudah terdaftar'
           ]
         ],
         'tgl_lahir' => [
            'rules' => 'required|valid_date',
            'errors' => [
                'required' => 'Tanggal lahir harus diisi',
                'valid_date' => 'Format tanggal lahir tidak valid'
            ]
         ]
      ];
   }

   public function index()
   {
      $data = [
         'title' => 'Data Guru',
         'ctx' => 'guru',
      ];

      return view('admin/data/data-guru', $data);
   }

   public function ambilDataGuru()
   {
      $result = $this->guruModel->getAllGuru();

      $data = [
         'data' => $result,
         'empty' => empty($result)
      ];

      return view('admin/data/list-data-guru', $data);
   }

   public function formTambahGuru()
   {
      $data = [
         'ctx' => 'guru',
         'title' => 'Tambah Data Guru'
      ];

      return view('admin/data/create/create-data-guru', $data);
   }

   public function saveGuru()
   {
      // validasi
      if (!$this->validate($this->guruValidationRules)) {
         $data = [
            'ctx' => 'guru',
            'title' => 'Tambah Data Guru',
            'validation' => $this->validator,
            'oldInput' => $this->request->getVar()
         ];
         return view('/admin/data/create/create-data-guru', $data);
      }

      // simpan
      $result = $this->guruModel->createGuru(
         nuptk: $this->request->getVar('nuptk'),
         nama: $this->request->getVar('nama'),
         jenisKelamin: $this->request->getVar('jk'),
         alamat: $this->request->getVar('alamat'),
         noHp: $this->request->getVar('no_hp'),
         unique_code: $this->request->getVar('unique_code'),
         tglLahir: $this->request->getVar('tgl_lahir')
      );

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Tambah data berhasil',
            'error' => false
         ]);
         return redirect()->to('/admin/guru');
      }

      session()->setFlashdata([
         'msg' => 'Gagal menambah data',
         'error' => true
      ]);
      return redirect()->to('/admin/guru/create/');
   }

   public function formEditGuru($id)
   {
      $guru = $this->guruModel->getGuruById($id);

      if (empty($guru)) {
         throw new PageNotFoundException('Data guru dengan id ' . $id . ' tidak ditemukan');
      }

      $data = [
         'data' => $guru,
         'ctx' => 'guru',
         'title' => 'Edit Data Guru',
      ];

      return view('admin/data/edit/edit-data-guru', $data);
   }

   public function updateGuru()
   {
      $idGuru = $this->request->getVar('id');
      
      // Use the modified validation rules for editing
      if (!$this->validate($this->getEditValidationRules($idGuru))) {
         $data = [
            'data' => $this->guruModel->getGuruById($idGuru),
            'ctx' => 'guru',
            'title' => 'Edit Data Guru',
            'validation' => $this->validator,
            'oldInput' => $this->request->getVar()
         ];
         return view('/admin/data/edit/edit-data-guru', $data);
      }
      
      // Update data guru
      $result = $this->guruModel->updateGuru(
         id: $idGuru,
         nuptk: $this->request->getVar('nuptk'),
         nama: $this->request->getVar('nama'),
         jenisKelamin: $this->request->getVar('jk'),
         alamat: $this->request->getVar('alamat'),
         noHp: $this->request->getVar('no_hp'),
         unique_code: $this->request->getVar('unique_code'),
         tglLahir: $this->request->getVar('tgl_lahir')
      );

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit data berhasil',
            'error' => false
         ]);
         return redirect()->to('/admin/guru');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/guru/edit/' . $idGuru);
   }

   public function delete($id)
   {
      $result = $this->guruModel->delete($id);

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Data berhasil dihapus',
            'error' => false
         ]);
         return redirect()->to('/admin/guru');
      }

      session()->setFlashdata([
         'msg' => 'Gagal menghapus data',
         'error' => true
      ]);
      return redirect()->to('/admin/guru');
   }

   /////
   public function downloadTemplate()
    {
        $filename = 'csv_guru_template.csv';
        $filepath = FCPATH . 'assets/file/' . $filename;
        
        // Create directory if it doesn't exist
        $dir = FCPATH . 'assets/file/';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        
        // Create CSV template with correct fields
        $file = fopen($filepath, 'w');
        
        // Add header row
        fputcsv($file, ['nuptk', 'nama_guru', 'jenis_kelamin', 'alamat', 'no_hp', 'unique_code', 'tgl_lahir']);
        
        // Add sample data rows
        fputcsv($file, ['1234567890123456', 'Budi Santoso', '1', 'Jl. Kenanga No. 10 Jakarta', '081234567890', 'AB12345678', '1980-05-15']);
        fputcsv($file, ['1234567890123457', 'Siti Nurhaliza', '2', 'Jl. Melati No. 5 Bandung', '082345678901', 'CD87654321', '1985-10-20']);
        
        fclose($file);
        
        return $this->response->download($filepath, null);
    }

/**
     * Display import data guru page
     */
    public function importCSV()
    {
        $data = [
            'ctx' => 'guru',
            'title' => 'Import Data Guru'
        ];
        
        return view('admin/data/import-data-guru', $data);
    }
    
    /**
     * Generate CSV Object Post for Guru
     */
    

    /**
     * Generate CSV Object for Guru
     */
 public function generateCSVObjectPost()
{
    // Debug: Log semua data yang masuk
    log_message('debug', 'Request Method: ' . $this->request->getMethod());
    log_message('debug', 'Is AJAX: ' . ($this->request->isAJAX() ? 'Yes' : 'No'));
    log_message('debug', 'POST Data: ' . print_r($this->request->getPost(), true));
    log_message('debug', 'FILES Data: ' . print_r($_FILES, true));
    log_message('debug', 'Headers: ' . print_r($this->request->headers(), true));

    // Pastikan ini adalah POST request
    if ($this->request->getMethod() !== 'POST') {
        log_message('error', 'Invalid request method: ' . $this->request->getMethod());
        return $this->response->setStatusCode(405)->setJSON(['error' => 'Method not allowed']);
    }

    try {
        // Cek CSRF token - ini bisa jadi penyebab error 400
        $csrfToken = $this->request->getPost(csrf_token());
        log_message('debug', 'CSRF Token received: ' . $csrfToken);
        log_message('debug', 'CSRF Token expected: ' . csrf_hash());
        
        // Skip CSRF validation untuk debugging (HAPUS INI SETELAH TESTING)
        // if (!$this->validate([])) {
        //     log_message('error', 'CSRF validation failed');
        //     return $this->response->setStatusCode(400)->setJSON(['error' => 'CSRF validation failed']);
        // }

        // Cek apakah file ada
        $file = $this->request->getFile('file');
        log_message('debug', 'File object: ' . print_r($file, true));
        
        if (!$file) {
            log_message('error', 'No file found in request');
            return $this->response->setJSON([
                'result' => 0,
                'message' => 'File tidak ditemukan dalam request'
            ]);
        }

        if (!$file->isValid()) {
            log_message('error', 'File is not valid: ' . $file->getErrorString());
            return $this->response->setJSON([
                'result' => 0,
                'message' => 'File tidak valid: ' . $file->getErrorString()
            ]);
        }

        if ($file->hasMoved()) {
            log_message('error', 'File has already been moved');
            return $this->response->setJSON([
                'result' => 0,
                'message' => 'File sudah dipindahkan'
            ]);
        }

        // Validasi ekstensi file
        $extension = $file->getClientExtension();
        log_message('debug', 'File extension: ' . $extension);
        
        if (strtolower($extension) !== 'csv') {
            return $this->response->setJSON([
                'result' => 0,
                'message' => 'File harus berformat CSV'
            ]);
        }

        // Validasi ukuran file
        $fileSize = $file->getSize();
        log_message('debug', 'File size: ' . $fileSize);
        
        if ($fileSize > 5242880) { // 5MB
            return $this->response->setJSON([
                'result' => 0,
                'message' => 'File terlalu besar (maksimal 5MB)'
            ]);
        }

        // Buat direktori jika belum ada
        $uploadPath = FCPATH . 'uploads/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $tmpPath = FCPATH . 'uploads/tmp/';
        if (!is_dir($tmpPath)) {
            mkdir($tmpPath, 0755, true);
        }

        // Delete old files
        $oldFiles = glob($tmpPath . '*.txt');
        foreach ($oldFiles as $oldFile) {
            @unlink($oldFile);
        }

        // Upload file langsung tanpa menggunakan UploadModel dulu
        $newName = $file->getRandomName();
        log_message('debug', 'New filename: ' . $newName);
        
        if (!$file->move($uploadPath, $newName)) {
            log_message('error', 'Failed to move uploaded file');
            return $this->response->setJSON([
                'result' => 0,
                'message' => 'Gagal menyimpan file'
            ]);
        }

        $filePath = 'uploads/' . $newName;
        log_message('debug', 'File saved to: ' . $filePath);

        // Generate CSV object
        $obj = $this->generateCSVObject($filePath);
        log_message('debug', 'CSV object: ' . print_r($obj, true));
        
        if (!empty($obj)) {
            $data = [
                'result' => 1,
                'numberOfItems' => $obj->numberOfItems ?? 0,
                'txtFileName' => $obj->txtFileName ?? '',
            ];
            return $this->response->setJSON($data);
        }

        return $this->response->setJSON([
            'result' => 0,
            'message' => 'Gagal memproses file CSV'
        ]);

    } catch (\Throwable $e) {
        log_message('error', 'CSV Upload Error: ' . $e->getMessage());
        log_message('error', 'Stack trace: ' . $e->getTraceAsString());
        
        return $this->response->setStatusCode(500)->setJSON([
            'result' => 0,
            'error' => 'Terjadi kesalahan server: ' . $e->getMessage()
        ]);
    }
}


/**
 * Generate CSV Object for Guru
 */
private function generateCSVObject($path)
{
    try {
        $fullPath = FCPATH . $path;
        log_message('debug', 'Processing file: ' . $fullPath);
        
        // Validasi file exists
        if (!file_exists($fullPath)) {
            log_message('error', 'File tidak ditemukan: ' . $fullPath);
            return null;
        }

        // Cek apakah file bisa dibaca
        if (!is_readable($fullPath)) {
            log_message('error', 'File tidak bisa dibaca: ' . $fullPath);
            return null;
        }

        $handle = fopen($fullPath, 'r');
        if ($handle === false) {
            log_message('error', 'Tidak bisa membuka file: ' . $fullPath);
            return null;
        }

        // Baca header
        $headers = fgetcsv($handle);
        log_message('debug', 'CSV Headers: ' . print_r($headers, true));
        
        if ($headers === false) {
            fclose($handle);
            log_message('error', 'Tidak bisa membaca header CSV');
            return null;
        }

        // Hitung jumlah baris data
        $count = 0;
        $lineNumber = 1;
        while (($row = fgetcsv($handle)) !== false) {
            $lineNumber++;
            // Skip empty rows
            if (!empty(array_filter($row, function($value) { return trim($value) !== ''; }))) {
                $count++;
                log_message('debug', 'Line ' . $lineNumber . ': ' . print_r($row, true));
            }
        }
        fclose($handle);

        log_message('debug', 'Total data rows: ' . $count);

        // Buat file txt untuk menyimpan data sementara
        $txtFileName = basename($path, '.csv') . '_' . time() . '.txt';
        $txtPath = FCPATH . 'uploads/tmp/' . $txtFileName;
        
        // Salin file CSV ke txt untuk processing
        if (!copy($fullPath, $txtPath)) {
            log_message('error', 'Gagal menyalin file ke tmp: ' . $txtPath);
            return null;
        }

        log_message('debug', 'Created temp file: ' . $txtPath);

        return (object)[
            'numberOfItems' => $count,
            'txtFileName' => $txtFileName
        ];
        
    } catch (\Exception $e) {
        log_message('error', 'Error in generateCSVObject: ' . $e->getMessage());
        return null;
    }
}
/**
 * Import CSV Item Post for Guru
 */
public function importCSVItemPost()
{
    try {
        $txtFileName = $this->request->getPost('txtFileName');
        $index = (int) $this->request->getPost('index');

        log_message('debug', 'ImportCSVItemPost - File: ' . $txtFileName . ', Index: ' . $index);

        if (!$txtFileName || !is_numeric($index) || $index <= 0) {
            return $this->response->setJSON([
                'result' => 0,
                'message' => 'Parameter tidak valid.',
                'index' => $index
            ]);
        }

        $guru = $this->importCSVItem($txtFileName, $index);
        
        if ($guru && is_array($guru)) {
            return $this->response->setJSON([
                'result' => 1,
                'guru' => $guru,
                'index' => $index
            ]);
        } else {
            return $this->response->setJSON([
                'result' => 0,
                'index' => $index,
                'message' => is_string($guru) ? $guru : 'Data kosong atau format CSV tidak valid pada baris ' . $index
            ]);
        }
        
    } catch (\Throwable $e) {
        log_message('error', 'ImportCSVItemPost Error: ' . $e->getMessage());
        return $this->response->setJSON([
            'result' => 0,
            'index' => $index ?? 0,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ]);
    }
}

/**
 * Import single CSV item
 */
private function importCSVItem($txtFileName, $index)
{
    try {
        $txtPath = FCPATH . 'uploads/tmp/' . $txtFileName;
        
        log_message('debug', 'Looking for file: ' . $txtPath);
        
        if (!file_exists($txtPath)) {
            log_message('error', 'File tmp tidak ditemukan: ' . $txtPath);
            return 'File temporary tidak ditemukan';
        }

        $handle = fopen($txtPath, 'r');
        if ($handle === false) {
            return 'Tidak dapat membuka file';
        }

        // Baca header
        $headers = $this->readCSVLine($handle);
        if ($headers === false || empty($headers)) {
            fclose($handle);
            log_message('error', 'Cannot read headers from CSV');
            return 'Tidak dapat membaca header CSV';
        }

        log_message('debug', 'CSV Headers: ' . print_r($headers, true));

        // Loop sampai baris yang diminta
        $currentIndex = 0;
        while (($row = $this->readCSVLine($handle)) !== false) {
            // Skip baris kosong
            if (empty(array_filter($row, fn($val) => trim($val) !== ''))) {
                continue;
            }

            $currentIndex++;
            if ($currentIndex === $index) {
                fclose($handle);

                log_message('debug', "Found row {$index}: " . print_r($row, true));

                // Gabungkan header dan row menjadi key => value
                $data = array_combine($headers, $row);

                if ($data === false) {
                    return 'Jumlah kolom tidak sesuai dengan header';
                }

                log_message('debug', 'Data siap insert: ' . print_r($data, true));

                // Simpan ke database
                $guruModel = new GuruModel();
                $guruModel->insert($data);

                return $data;
            }
        }

        fclose($handle);
        return 'Baris ' . $index . ' tidak ditemukan dalam file';

    } catch (\Exception $e) {
        log_message('error', 'Error in importCSVItem: ' . $e->getMessage());
        return 'Error: ' . $e->getMessage();
    }
}


private function readCSVLine($handle)
{
    // Coba dengan delimiter yang berbeda
    $delimiters = [',', ';', '\t'];
    $position = ftell($handle);
    
    foreach ($delimiters as $delimiter) {
        fseek($handle, $position);
        $row = fgetcsv($handle, 0, $delimiter);
        
        if ($row !== false && count($row) > 1) {
            return $row;
        }
    }
    
    // Fallback ke delimiter default
    fseek($handle, $position);
    return fgetcsv($handle);
}

/**
 * Process guru data from CSV row
 */
// private function processGuruData($headers, $row)
// {
//     try {
//         log_message('debug', 'Processing guru data - Headers: ' . print_r($headers, true));
//         log_message('debug', 'Processing guru data - Row: ' . print_r($row, true));
        
//         // Clean headers (remove BOM, trim whitespace)
//         $cleanHeaders = [];
//         foreach ($headers as $header) {
//             $clean = trim($header);
//             // Remove BOM if present
//             $clean = str_replace("\xEF\xBB\xBF", '', $clean);
//             $cleanHeaders[] = $clean;
//         }
        
//         log_message('debug', 'Clean headers: ' . print_r($cleanHeaders, true));

//         // Mapping header ke data
//         $data = [];
//         foreach ($cleanHeaders as $key => $header) {
//             $value = isset($row[$key]) ? trim($row[$key]) : '';
//             $data[$header] = $value;
//         }
        
//         log_message('debug', 'Mapped data: ' . print_r($data, true));

//         // Kemungkinan nama kolom dalam bahasa Indonesia dan Inggris
//         $guruData = [
//             'nuptk' => $this->getColumnValue($data, ['NUPTK', 'nuptk']),
//             'nama_guru' => $this->getColumnValue($data, ['Nama Guru', 'nama_guru', 'Nama', 'Name']),
//             'jenis_kelamin' => $this->getColumnValue($data, ['Jenis Kelamin', 'jenis_kelamin', 'Gender']),
//             'alamat' => $this->getColumnValue($data, ['Alamat', 'alamat', 'Address']),
//             'no_hp' => $this->getColumnValue($data, ['No HP', 'no_hp', 'Phone', 'Telepon']),
//             'unique_code' => $this->getColumnValue($data, ['Unique Code', 'unique_code', 'RFID']),
//             'tgl_lahir' => $this->getColumnValue($data, ['Tgl Lahir', 'tgl_lahir', 'Tanggal Lahir', 'Birth Date']),
//         ];

//         log_message('debug', 'Processed guru data: ' . print_r($guruData, true));

//         // Validasi data wajib
//         $errors = [];
        
//         if (empty($guruData['nuptk'])) {
//             $errors[] = 'NUPTK tidak boleh kosong';
//         } elseif (strlen($guruData['nuptk']) < 16) {
//             $errors[] = 'NUPTK harus minimal 16 karakter';
//         }
        
//         if (empty($guruData['nama_guru'])) {
//             $errors[] = 'Nama Guru tidak boleh kosong';
//         }
        
//         if (!empty($guruData['jenis_kelamin']) && !in_array($guruData['jenis_kelamin'], ['1', '2'])) {
//             $errors[] = 'Jenis Kelamin harus 1 (Laki-laki) atau 2 (Perempuan)';
//         }
        
//         if (!empty($guruData['unique_code']) && strlen($guruData['unique_code']) !== 10) {
//             $errors[] = 'Unique Code harus tepat 10 karakter';
//         }

//         // Validasi format tanggal
//         if (!empty($guruData['tgl_lahir'])) {
//             $date = DateTime::createFromFormat('Y-m-d', $guruData['tgl_lahir']);
//             if (!$date || $date->format('Y-m-d') !== $guruData['tgl_lahir']) {
//                 $errors[] = 'Format tanggal lahir harus YYYY-MM-DD';
//             }
//         }

//         if (!empty($errors)) {
//             throw new \Exception(implode(', ', $errors));
//         }

//         // Simpan ke database (uncomment jika diperlukan)
//         /*
//         $guruModel = new \App\Models\GuruModel();
//         $result = $guruModel->insert($guruData);
//         if (!$result) {
//             throw new \Exception('Gagal menyimpan data ke database');
//         }
//         */

//         return $guruData;
        
//     } catch (\Exception $e) {
//         log_message('error', 'Error processing guru data: ' . $e->getMessage());
//         throw $e;
//     }
// }

/**
 * Get column value with multiple possible column names
 */
private function getColumnValue($data, $possibleNames)
{
    foreach ($possibleNames as $name) {
        if (isset($data[$name]) && $data[$name] !== '') {
            return $data[$name];
        }
    }
    return '';
}

/**
 * Download CSV template
 */
// public function downloadTemplate()
// {
//     try {
//         $filename = 'template_guru.csv';
        
//         // Header CSV
//         $headers = [
//             'NUPTK',
//             'Nama Guru', 
//             'Jenis Kelamin',
//             'Alamat',
//             'No HP',
//             'Unique Code',
//             'Tgl Lahir'
//         ];
        
//         // Sample data
//         $sampleData = [
//             [
//                 '1234567890123456',
//                 'John Doe',
//                 '1',
//                 'Jl. Contoh No. 123',
//                 '081234567890',
//                 'ABCD123456',
//                 '1980-05-15'
//             ],
//             [
//                 '6543210987654321',
//                 'Jane Smith',
//                 '2',
//                 'Jl. Sample No. 456',
//                 '087654321012',
//                 'EFGH789012',
//                 '1985-12-20'
//             ]
//         ];

//         // Set headers untuk download
//         $this->response->setHeader('Content-Type', 'text/csv');
//         $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        
//         // Buat output
//         $output = fopen('php://output', 'w');
        
//         // Tulis header
//         fputcsv($output, $headers);
        
//         // Tulis sample data
//         foreach ($sampleData as $row) {
//             fputcsv($output, $row);
//         }
        
//         fclose($output);
//         exit;
        
//     } catch (\Exception $e) {
//         log_message('error', 'Error generating template: ' . $e->getMessage());
//         return redirect()->back()->with('error', 'Gagal mendownload template');
//     }
// }

/**
 * Process guru data from CSV row
 */
private function processGuruData($headers, $row)
{
    try {
        // Mapping header ke data
        $data = [];
        foreach ($headers as $key => $header) {
            $header = trim($header);
            $data[$header] = isset($row[$key]) ? trim($row[$key]) : '';
        }

        // Validasi dan format data guru
        $guruData = [
            'nuptk' => $data['NUPTK'] ?? $data['nuptk'] ?? '',
            'nama_guru' => $data['Nama Guru'] ?? $data['nama_guru'] ?? '',
            'jenis_kelamin' => $data['Jenis Kelamin'] ?? $data['jenis_kelamin'] ?? '',
            'alamat' => $data['Alamat'] ?? $data['alamat'] ?? '',
            'no_hp' => $data['No HP'] ?? $data['no_hp'] ?? '',
            'unique_code' => $data['Unique Code'] ?? $data['unique_code'] ?? '',
            'tgl_lahir' => $data['Tgl Lahir'] ?? $data['tgl_lahir'] ?? '',
        ];

        // Validasi data wajib
        $errors = [];
        if (empty($guruData['nuptk']) || strlen($guruData['nuptk']) < 16) {
            $errors[] = 'NUPTK harus minimal 16 karakter';
        }
        
        if (empty($guruData['nama_guru'])) {
            $errors[] = 'Nama Guru tidak boleh kosong';
        }
        
        if (!in_array($guruData['jenis_kelamin'], ['1', '2'])) {
            $errors[] = 'Jenis Kelamin harus 1 (Laki-laki) atau 2 (Perempuan)';
        }
        
        if (!empty($guruData['unique_code']) && strlen($guruData['unique_code']) !== 10) {
            $errors[] = 'Unique Code harus tepat 10 karakter';
        }

        if (!empty($errors)) {
            throw new \Exception(implode(', ', $errors));
        }

        // Simpan ke database jika perlu
        // $guruModel = new GuruModel();
        // $result = $guruModel->insert($guruData);

        return $guruData;
        
    } catch (\Exception $e) {
        log_message('error', 'Error processing guru data: ' . $e->getMessage());
        throw $e;
    }
}


    //////////
    
    /**
     * Download CSV Template for Guru
     */
    
   
}