<?= $this->extend('templates/laporan') ?>

<?= $this->section('content') ?>
<style>
   @page {
      size: A4 landscape;
      margin: 15mm 10mm;
   }
   
   body {
      font-family: 'Times New Roman', Times, serif;
      font-size: 11pt;
      margin: 0;
      padding: 0;
   }
   
   .header-section {
      position: relative;
      border-bottom: 3px solid #000;
      padding-bottom: 10px;
      margin-bottom: 15px;
   }
   
   .logo-container {
      position: absolute;
      top: 0;
      right: 0;
      width: 80px;
      height: 80px;
   }
   
   .logo-container img {
      width: 100%;
      height: 100%;
      object-fit: contain;
   }
   
   .header-text {
      text-align: center;
      padding-right: 90px; /* Space for logo */
   }
   
   .header-text h2 {
      font-size: 16pt;
      font-weight: bold;
      margin: 5px 0;
      text-transform: uppercase;
   }
   
   .header-text h4 {
      font-size: 12pt;
      font-weight: normal;
      margin: 3px 0;
   }
   
   .info-section {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      font-size: 11pt;
   }
   
   .info-section span {
      font-weight: bold;
   }
   
   table.attendance-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 9pt;
      margin-bottom: 15px;
   }
   
   table.attendance-table th,
   table.attendance-table td {
      border: 1px solid #000;
      padding: 4px 6px;
      text-align: center;
   }
   
   table.attendance-table th {
      background-color: #e0e0e0;
      font-weight: bold;
   }
   
   table.attendance-table td.nama-siswa {
      text-align: left;
      padding-left: 8px;
      min-width: 180px;
      max-width: 200px;
   }
   
   table.attendance-table td.no {
      width: 30px;
   }
   
   table.attendance-table td.tanggal {
      width: 25px;
      font-size: 8pt;
   }
   
   table.attendance-table td.total {
      width: 30px;
      font-weight: bold;
   }
   
   /* Color coding for attendance */
   .hadir {
      background-color: #90EE90 !important;
      font-weight: bold;
   }
   
   .sakit {
      background-color: #FFFF99 !important;
      font-weight: bold;
   }
   
   .izin {
      background-color: #FFFF99 !important;
      font-weight: bold;
   }
   
   .alpha {
      background-color: #FFB6B6 !important;
      font-weight: bold;
   }
   
   .kosong {
      background-color: #f5f5f5;
   }
   
   /* Summary section */
   .summary-section {
      margin-top: 10px;
      font-size: 11pt;
   }
   
   .summary-table {
      border: none;
   }
   
   .summary-table td {
      border: none;
      padding: 2px 0;
   }
   
   .summary-table td:first-child {
      width: 150px;
      font-weight: bold;
   }
   
   /* Print specific */
   @media print {
      body {
         print-color-adjust: exact;
         -webkit-print-color-adjust: exact;
      }
      
      .hadir, .sakit, .izin, .alpha {
         print-color-adjust: exact;
         -webkit-print-color-adjust: exact;
      }
   }
</style>

<!-- Header Section -->
<div class="header-section">
   <div class="logo-container">
      <img src="<?= getLogo(); ?>" alt="Logo Sekolah">
   </div>
   <div class="header-text">
      <h2>Daftar Hadir Siswa</h2>
      <h4><?= $generalSettings->school_name; ?></h4>
      <h4>Tahun Pelajaran <?= $generalSettings->school_year; ?></h4>
   </div>
</div>

<!-- Info Section -->
<div class="info-section">
   <span>Bulan: <?= $bulan; ?></span>
   <span>Kelas: <?= "{$kelas['kelas']} {$kelas['jurusan']}"; ?></span>
</div>

<!-- Attendance Table -->
<table class="attendance-table">
   <thead>
      <!-- Row 1: Merged header -->
      <tr>
         <th rowspan="2" class="no">No</th>
         <th rowspan="2">Nama Siswa</th>
         <th colspan="<?= count($tanggal); ?>">Hari / Tanggal</th>
         <th colspan="4">Total Kehadiran</th>
      </tr>
      <!-- Row 2: Day and date -->
      <tr>
         <?php foreach ($tanggal as $value) : ?>
            <th class="tanggal">
               <?= $value->toLocalizedString('E'); ?><br>
               <?= $value->format('d'); ?>
            </th>
         <?php endforeach; ?>
         <th class="total hadir">H</th>
         <th class="total sakit">S</th>
         <th class="total izin">I</th>
         <th class="total alpha">A</th>
      </tr>
   </thead>
   
   <tbody>
      <?php $i = 0; ?>
      <?php foreach ($listSiswa as $siswa) : ?>
         <?php
         $jumlahHadir = count(array_filter($listAbsen, function ($a) use ($i) {
            if ($a['lewat'] || is_null($a[$i]['id_kehadiran'])) return false;
            return $a[$i]['id_kehadiran'] == 1;
         }));
         $jumlahSakit = count(array_filter($listAbsen, function ($a) use ($i) {
            if ($a['lewat'] || is_null($a[$i]['id_kehadiran'])) return false;
            return $a[$i]['id_kehadiran'] == 2;
         }));
         $jumlahIzin = count(array_filter($listAbsen, function ($a) use ($i) {
            if ($a['lewat'] || is_null($a[$i]['id_kehadiran'])) return false;
            return $a[$i]['id_kehadiran'] == 3;
         }));
         $jumlahTidakHadir = count(array_filter($listAbsen, function ($a) use ($i) {
            if ($a['lewat']) return false;
            if (is_null($a[$i]['id_kehadiran']) || $a[$i]['id_kehadiran'] == 4) return true;
            return false;
         }));
         ?>
         <tr>
            <td class="no"><?= $i + 1; ?></td>
            <td class="nama-siswa"><?= $siswa['nama_siswa']; ?></td>
            <?php foreach ($listAbsen as $absen) : ?>
               <?= kehadiran($absen[$i]['id_kehadiran'] ?? ($absen['lewat'] ? 5 : 4)); ?>
            <?php endforeach; ?>
            <td class="total hadir">
               <?= $jumlahHadir != 0 ? $jumlahHadir : '-'; ?>
            </td>
            <td class="total sakit">
               <?= $jumlahSakit != 0 ? $jumlahSakit : '-'; ?>
            </td>
            <td class="total izin">
               <?= $jumlahIzin != 0 ? $jumlahIzin : '-'; ?>
            </td>
            <td class="total alpha">
               <?= $jumlahTidakHadir != 0 ? $jumlahTidakHadir : '-'; ?>
            </td>
         </tr>
      <?php
         $i++;
      endforeach; ?>
   </tbody>
</table>

<!-- Summary Section -->
<div class="summary-section">
   <table class="summary-table">
      <tr>
         <td>Jumlah Siswa</td>
         <td>: <?= count($listSiswa); ?> siswa</td>
      </tr>
      <tr>
         <td>Laki-laki</td>
         <td>: <?= $jumlahSiswa['laki']; ?> siswa</td>
      </tr>
      <tr>
         <td>Perempuan</td>
         <td>: <?= $jumlahSiswa['perempuan']; ?> siswa</td>
      </tr>
   </table>
</div>

<?php
function kehadiran($kehadiran)
{
   $text = '';
   switch ($kehadiran) {
      case 1:
         $text = "<td class='tanggal hadir'>H</td>";
         break;
      case 2:
         $text = "<td class='tanggal sakit'>S</td>";
         break;
      case 3:
         $text = "<td class='tanggal izin'>I</td>";
         break;
      case 4:
         $text = "<td class='tanggal alpha'>A</td>";
         break;
      case 5:
      default:
         $text = "<td class='tanggal kosong'></td>";
         break;
   }

   return $text;
}
?>

<?= $this->endSection() ?>