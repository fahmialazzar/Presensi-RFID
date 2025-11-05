<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="siswa-container">
    <style>
        :root {
            /* Purple theme for Siswa section */
            --siswa-primary: #8B5CF6;
            --siswa-primary-light: #F5F3FF;
            --siswa-primary-dark: #6D28D9;
            --siswa-secondary: #C4B5FD;
            --siswa-accent: #A78BFA;
            --success: #10B981;
            --warning: #F59E0B;
            --info: #3B82F6;
            --danger: #EF4444;
            --dark: #1F2937;
            --light: #F9FAFB;
            --text: #374151;
            --text-light: #6B7280;
            --border: #E5E7EB;
            --shadow: rgba(0, 0, 0, 0.05);
        }
        
        .siswa-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 2rem 1rem;
            margin-top: 2rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        
        /* Alert Styles */
        .alert-custom {
            background-color: white;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 20px var(--shadow);
            border-left: 4px solid;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideInDown 0.4s ease-out;
        }
        
        .alert-custom.alert-success {
            border-left-color: var(--success);
            background-color: rgba(16, 185, 129, 0.05);
        }
        
        .alert-custom.alert-danger {
            border-left-color: var(--danger);
            background-color: rgba(239, 68, 68, 0.05);
        }
        
        .alert-custom .close {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-light);
            transition: color 0.2s;
        }
        
        .alert-custom .close:hover {
            color: var(--dark);
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .btn-custom {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            text-decoration: none;
            color: white;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
            color: white;
            text-decoration: none;
        }
        
        .btn-custom:active {
            transform: translateY(0);
        }
        
        .btn-custom i {
            margin-right: 0.5rem;
            font-size: 1.25rem;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--siswa-primary) 0%, var(--siswa-primary-dark) 100%);
        }
        
        .btn-primary-custom:hover {
            background: linear-gradient(135deg, var(--siswa-primary-dark) 0%, #5B21B6 100%);
        }
        
        .btn-danger-custom {
            background: linear-gradient(135deg, var(--danger) 0%, #DC2626 100%);
        }
        
        .btn-danger-custom:hover {
            background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);
        }
        
        /* Main Card */
        .card-custom {
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px var(--shadow);
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Card Header */
        .card-header-custom {
            background: linear-gradient(135deg, var(--siswa-primary) 0%, var(--siswa-primary-dark) 100%);
            padding: 2rem;
            color: white;
        }
        
        .header-content {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .header-title {
            display: flex;
            flex-direction: column;
        }
        
        .header-title h4 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            color: white;
        }
        
        .header-title p {
            font-size: 0.875rem;
            margin: 0;
            color: rgba(255, 255, 255, 0.8);
        }
        
        /* Filter Tabs */
        .filter-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .filter-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .filter-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        
        .filter-tab {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            text-decoration: none;
        }
        
        .filter-tab:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
            color: white;
            text-decoration: none;
        }
        
        .filter-tab.active {
            background-color: white;
            color: var(--siswa-primary);
            border-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .filter-tab i {
            margin-right: 0.5rem;
            font-size: 1.125rem;
        }
        
        /* Card Body */
        .card-body-custom {
            padding: 2rem;
            min-height: 400px;
        }
        
        .loading-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            color: var(--text-light);
        }
        
        .loading-state i {
            font-size: 3rem;
            color: var(--siswa-primary);
            margin-bottom: 1rem;
            animation: pulse 1.5s ease-in-out infinite;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.5;
                transform: scale(1.1);
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .siswa-container {
                padding: 1.5rem 1rem;
                margin-top: 1rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-custom {
                width: 100%;
                justify-content: center;
            }
            
            .filter-section {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .filter-tabs {
                flex-direction: column;
            }
            
            .filter-tab {
                width: 100%;
                justify-content: center;
            }
            
            .card-header-custom {
                padding: 1.5rem;
            }
            
            .card-body-custom {
                padding: 1.5rem;
            }
        }
        
        /* Scroll behavior */
        html {
            scroll-behavior: smooth;
        }
        
        /* Action Buttons for Table */
        .action-btn-group {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }
        
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            padding: 0;
            text-decoration: none;
        }
        
        .action-btn i {
            font-size: 1.125rem;
            margin: 0;
        }
        
        .action-btn-edit {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--info);
        }
        
        .action-btn-edit:hover {
            background-color: var(--info);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
        }
        
        .action-btn-delete {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }
        
        .action-btn-delete:hover {
            background-color: var(--danger);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
        }
        
        .action-btn-download {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }
        
        .action-btn-download:hover {
            background-color: var(--success);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3);
        }
        
        /* Override Bootstrap button styles if present */
        .action-btn.btn {
            min-width: 36px;
            padding: 0;
            line-height: 36px;
        }
        
        .action-btn.btn i {
            line-height: 1;
            vertical-align: middle;
        }
    </style>
    
    <div class="container-fluid">
        <!-- Alert Messages -->
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert-custom alert-<?= session()->getFlashdata('error') == true ? 'danger' : 'success' ?>">
                <span><?= session()->getFlashdata('msg') ?></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
        <?php endif; ?>
        
        <!-- Action Buttons -->
        <div class="action-buttons">
            <a class="btn-custom btn-primary-custom" href="<?= base_url('admin/siswa/create'); ?>">
                <i class="material-icons">add</i>
                <span>Tambah Data Siswa</span>
            </a>
            <a class="btn-custom btn-primary-custom" href="<?= base_url('admin/siswa/bulk'); ?>">
                <i class="material-icons">cloud_upload</i>
                <span>Import CSV</span>
            </a>
            <button class="btn-custom btn-danger-custom btn-table-delete" onclick="deleteSelectedSiswa('Data yang sudah dihapus tidak bisa dikembalikan');">
                <i class="material-icons">delete_forever</i>
                <span>Hapus Beberapa</span>
            </button>
        </div>
        
        <!-- Main Card -->
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="header-content">
                    <div class="header-title">
                        <h4>Daftar Siswa</h4>
                        <p>Angkatan <?= $generalSettings->school_year; ?></p>
                    </div>
                    
                    <div class="filter-section">
                        <!-- Filter Kelas -->
                        <div class="filter-group">
                            <span class="filter-title">Filter Kelas:</span>
                            <div class="filter-tabs">
                                <a class="filter-tab active" onclick="kelas = null; trig()" href="#" data-toggle="tab">
                                    <i class="material-icons">check</i>
                                    <span>Semua Kelas</span>
                                </a>
                                <?php
                                $tempKelas = [];
                                foreach ($kelas as $value) : ?>
                                    <?php if (!in_array($value['kelas'], $tempKelas)) : ?>
                                        <a class="filter-tab" onclick="kelas = '<?= $value['kelas']; ?>'; trig()" href="#" data-toggle="tab">
                                            <i class="material-icons">school</i>
                                            <span>Kelas <?= $value['kelas']; ?></span>
                                        </a>
                                        <?php array_push($tempKelas, $value['kelas']) ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Filter Jurusan -->
                        <div class="filter-group">
                            <span class="filter-title">Filter Jurusan:</span>
                            <div class="filter-tabs">
                                <a class="filter-tab active" onclick="jurusan = null; trig()" href="#" data-toggle="tab">
                                    <i class="material-icons">check</i>
                                    <span>Semua Jurusan</span>
                                </a>
                                <?php foreach ($jurusan as $value) : ?>
                                    <a class="filter-tab" onclick="jurusan = '<?= $value['jurusan']; ?>'; trig();" href="#" data-toggle="tab">
                                        <i class="material-icons">work</i>
                                        <span><?= $value['jurusan']; ?></span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body-custom">
                <div id="dataSiswa">
                    <div class="loading-state">
                        <i class="material-icons">school</i>
                        <p>Memuat daftar siswa...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   var kelas = null;
   var jurusan = null;

   getDataSiswa(kelas, jurusan);

   function trig() {
      // Update active state for filter tabs
      event.preventDefault();
      const clickedTab = event.currentTarget;
      const filterGroup = clickedTab.closest('.filter-tabs');
      
      // Remove active class from all tabs in this group
      filterGroup.querySelectorAll('.filter-tab').forEach(tab => {
         tab.classList.remove('active');
      });
      
      // Add active class to clicked tab
      clickedTab.classList.add('active');
      
      getDataSiswa(kelas, jurusan);
   }

   function getDataSiswa(_kelas = null, _jurusan = null) {
      jQuery.ajax({
         url: "<?= base_url('/admin/siswa'); ?>",
         type: 'post',
         data: {
            'kelas': _kelas,
            'jurusan': _jurusan
         },
         beforeSend: function() {
            $('#dataSiswa').html(`
               <div class="loading-state">
                  <i class="material-icons">hourglass_empty</i>
                  <p>Memuat data siswa...</p>
               </div>
            `);
         },
         success: function(response, status, xhr) {
            $('#dataSiswa').html(response);

            $('html, body').animate({
               scrollTop: $("#dataSiswa").offset().top - 100
            }, 500);
         },
         error: function(xhr, status, thrown) {
            console.log(thrown);
            $('#dataSiswa').html(`
               <div class="loading-state">
                  <i class="material-icons" style="color: var(--danger);">error_outline</i>
                  <p style="color: var(--danger);">Gagal memuat data: ${thrown}</p>
               </div>
            `);
         }
      });
   }

   document.addEventListener('DOMContentLoaded', function() {
      $("#checkAll").click(function(e) {
         console.log(e);
         $('input:checkbox').not(this).prop('checked', this.checked);
      });
   });
</script>
<?= $this->endSection() ?>