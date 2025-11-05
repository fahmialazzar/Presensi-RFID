<?php
$context = $ctx ?? 'dashboard';
?>

<!-- Sidebar Biru Tua Modern dengan Efek Cahaya -->
<div class="sidebar" style="min-height: 100vh;">

   <style>
      /* === SIDEBAR UTAMA === */
      .sidebar {
         background: linear-gradient(180deg, #0a1a2f, #0d2342);
         color: #fff !important;
         width: 260px;
         transition: all 0.3s ease;
         font-family: 'Poppins', sans-serif;
         position: fixed;
         left: 0;
         top: 0;
         box-shadow: 0 0 25px rgba(0, 123, 255, 0.15);
         overflow-y: auto;
      }

      /* === LOGO === */
      .sidebar .logo {
         text-align: center;
         padding: 20px 10px;
         font-weight: bold;
         border-bottom: 1px solid rgba(255, 255, 255, 0.15);
      }

      .sidebar .logo a {
         color: #4fc3f7;
         text-decoration: none;
         font-size: 16px;
         line-height: 1.4;
      }

      /* === MENU === */
      .sidebar .sidebar-wrapper {
         padding: 10px 0;
      }

      .sidebar .nav {
         list-style: none;
         padding-left: 0;
         margin: 0;
      }

      .sidebar .nav-item {
         margin: 5px 10px;
         border-radius: 8px;
         position: relative;
         overflow: hidden;
      }

      .sidebar .nav-item a {
         color: #cfd8e3 !important;
         display: flex;
         align-items: center;
         padding: 12px 18px;
         border-radius: 10px;
         text-decoration: none;
         position: relative;
         transition: all 0.3s ease;
         z-index: 1;
         overflow: hidden;
      }

      /* Efek cahaya saat hover */
      .sidebar .nav-item a::before {
         content: "";
         position: absolute;
         left: -50%;
         top: 0;
         width: 50%;
         height: 100%;
         background: rgba(0, 170, 255, 0.15);
         transform: skewX(-25deg);
         transition: all 0.5s ease;
         opacity: 0;
         z-index: 0;
      }

      .sidebar .nav-item a:hover::before {
         left: 120%;
         opacity: 1;
      }

      .sidebar .nav-item a:hover {
         color: #fff !important;
         background: rgba(0, 150, 255, 0.15);
         box-shadow: 0 0 15px rgba(0, 200, 255, 0.3);
         transform: translateX(4px);
      }

      .sidebar .nav-item.active a {
         background: rgba(0, 123, 255, 0.25);
         color: #fff !important;
         box-shadow: 0 0 15px rgba(0, 191, 255, 0.3);
      }

      /* === ICON === */
      .sidebar .material-icons {
         margin-right: 10px;
         font-size: 20px;
         color: #4fc3f7;
         transition: color 0.3s ease;
      }

      .sidebar .nav-item a:hover .material-icons {
         color: #00b0ff;
      }

      /* === TEXT === */
      .sidebar .nav p {
         margin: 0;
         font-weight: 500;
         font-size: 14px;
      }

      /* Scroll halus */
      .sidebar::-webkit-scrollbar {
         width: 6px;
      }

      .sidebar::-webkit-scrollbar-thumb {
         background: rgba(0, 150, 255, 0.3);
         border-radius: 10px;
      }

      .sidebar::-webkit-scrollbar-thumb:hover {
         background: rgba(0, 150, 255, 0.5);
      }

      
   </style>

   <div class="logo">
      <a href="#">
         <b>Operator<br>Petugas Presensi</b>
      </a>
   </div>

   <div class="sidebar-wrapper">
      <ul class="nav">

         <li class="nav-item <?= $context == 'dashboard' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('admin/dashboard'); ?>">
               <i class="material-icons">dashboard</i>
               <p>Dashboard</p>
            </a>
         </li>

         <li class="nav-item <?= $context == 'absen-siswa' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('admin/absen-siswa'); ?>">
               <i class="material-icons">checklist</i>
               <p>Presensi Siswa</p>
            </a>
         </li>

         <?php if (user()->toArray()['is_superadmin'] ?? '0' == '1') : ?>
            <li class="nav-item <?= $context == 'absen-guru' ? 'active' : ''; ?>">
               <a class="nav-link" href="<?= base_url('admin/absen-guru'); ?>">
                  <i class="material-icons">checklist</i>
                  <p>Presensi Guru</p>
               </a>
            </li>
         <?php endif; ?>

         <li class="nav-item <?= $context == 'siswa' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('admin/siswa'); ?>">
               <i class="material-icons">person</i>
               <p>Data Siswa</p>
            </a>
         </li>

         <?php if (user()->toArray()['is_superadmin'] ?? '0' == '1') : ?>
            <li class="nav-item <?= $context == 'guru' ? 'active' : ''; ?>">
               <a class="nav-link" href="<?= base_url('admin/guru'); ?>">
                  <i class="material-icons">person_4</i>
                  <p>Data Guru</p>
               </a>
            </li>
         <?php endif; ?>

         <li class="nav-item <?= $context == 'kelas' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('admin/kelas'); ?>">
               <i class="material-icons">school</i>
               <p>Data Kelas & Jurusan</p>
            </a>
         </li>

         <li class="nav-item <?= $context == 'qr' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('admin/generate'); ?>">
               <i class="material-icons">qr_code</i>
               <p>Generate QR Code</p>
            </a>
         </li>

         <li class="nav-item <?= $context == 'laporan' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('admin/laporan'); ?>">
               <i class="material-icons">print</i>
               <p>Generate Laporan</p>
            </a>
         </li>

         <?php if (user()->toArray()['is_superadmin'] ?? '0' == '1') : ?>
            <li class="nav-item <?= $context == 'petugas' ? 'active' : ''; ?>">
               <a class="nav-link" href="<?= base_url('admin/petugas'); ?>">
                  <i class="material-icons">computer</i>
                  <p>Data Petugas</p>
               </a>
            </li>

            <li class="nav-item <?= $context == 'general_settings' ? 'active' : ''; ?>">
               <a class="nav-link" href="<?= base_url('admin/general-settings'); ?>">
                  <i class="material-icons">settings</i>
                  <p>Pengaturan</p>
               </a>
            </li>

            <li class="nav-item <?= (uri_string() == 'admin/attendance-settings') ? 'active' : '' ?>">
               <a class="nav-link" href="<?= base_url('admin/attendance-settings'); ?>">
                  <i class="material-icons">schedule</i>
                  <p>Pengaturan Waktu Absen</p>
               </a>
            </li>
         <?php endif; ?>
      </ul>
   </div>
</div>
