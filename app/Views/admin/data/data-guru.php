<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="guru-container">
    <style>
        :root {
            /* Green theme for Guru section */
            --guru-primary: #10B981;
            --guru-primary-light: #ECFDF5;
            --guru-primary-dark: #059669;
            --guru-secondary: #6EE7B7;
            --guru-accent: #34D399;
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
        
        .guru-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 2rem 1rem;
            margin-top: 2rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        
        /* Alert Styles - More Visible */
        .alert-custom {
            background-color: white;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-left: 4px solid;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideInDown 0.4s ease-out;
            font-weight: 600;
            font-size: 0.9375rem;
        }
        
        .alert-custom.alert-success {
            border-left-color: var(--success);
            background-color: rgba(16, 185, 129, 0.15);
            color: #047857;
        }
        
        .alert-custom.alert-danger {
            border-left-color: var(--danger);
            background-color: rgba(239, 68, 68, 0.15);
            color: #B91C1C;
        }
        
        .alert-custom .close {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-light);
            transition: color 0.2s;
            padding: 0;
            margin: 0;
        }
        
        .alert-custom .close:hover {
            color: var(--dark);
        }
        
        /* Main Card */
        .card-custom {
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px var(--shadow);
            animation: fadeIn 0.5s ease-out;
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, var(--guru-primary) 0%, var(--guru-primary-dark) 100%);
            padding: 2rem;
            color: white;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
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
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }
        
        .btn-custom {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            text-decoration: none;
            color: white;
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }
        
        .btn-custom:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }
        
        .btn-custom:active {
            transform: translateY(0);
        }
        
        .btn-custom i {
            margin-right: 0.5rem;
            font-size: 1.125rem;
        }
        
        .btn-custom.active {
            background-color: white;
            color: var(--guru-primary);
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
            color: var(--guru-primary);
            margin-bottom: 1rem;
            animation: pulse 1.5s ease-in-out infinite;
        }
        
        /* Action Buttons for Table */
        .action-btn-group {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            align-items: center;
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
            line-height: 1;
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
            max-width: 36px;
            min-height: 36px;
            max-height: 36px;
            padding: 0 !important;
            line-height: 36px;
            margin: 0;
        }
        
        .action-btn.btn i {
            line-height: 1;
            vertical-align: middle;
        }
        
        /* Remove default form margins */
        .action-btn-group form {
            margin: 0;
            display: inline-flex;
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
            .guru-container {
                padding: 1.5rem 1rem;
                margin-top: 1rem;
            }
            
            .card-header-custom {
                padding: 1.5rem;
            }
            
            .header-content {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .action-buttons {
                width: 100%;
                flex-direction: column;
            }
            
            .btn-custom {
                width: 100%;
                justify-content: center;
            }
            
            .card-body-custom {
                padding: 1.5rem;
            }
        }
        
        /* Scroll behavior */
        html {
            scroll-behavior: smooth;
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
        
        <!-- Main Card -->
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="header-content">
                    <div class="header-title">
                        <h4>Daftar Guru</h4>
                        <p>Angkatan <?= $generalSettings->school_year; ?></p>
                    </div>
                    
                    <div class="action-buttons">
                        <a class="btn-custom" id="tabBtn" onclick="removeHover()" href="<?= base_url('admin/guru/create'); ?>">
                            <i class="material-icons">add</i>
                            <span>Tambah Guru</span>
                        </a>
                        <a class="btn-custom" href="<?= base_url('admin/guru/import') ?>">
                            <i class="material-icons">upload_file</i>
                            <span>Import Data</span>
                        </a>
                        <a class="btn-custom" id="refreshBtn" onclick="getDataGuru()" href="#" data-toggle="tab">
                            <i class="material-icons">refresh</i>
                            <span>Refresh</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card-body-custom">
                <div id="dataGuru">
                    <div class="loading-state">
                        <i class="material-icons">person</i>
                        <p>Memuat daftar guru...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   getDataGuru();

   function getDataGuru() {
      jQuery.ajax({
         url: "<?= base_url('/admin/guru'); ?>",
         type: 'post',
         data: {},
         beforeSend: function() {
            $('#dataGuru').html(`
               <div class="loading-state">
                  <i class="material-icons">hourglass_empty</i>
                  <p>Memuat data guru...</p>
               </div>
            `);
         },
         success: function(response, status, xhr) {
            $('#dataGuru').html(response);

            $('html, body').animate({
               scrollTop: $("#dataGuru").offset().top - 100
            }, 500);
            $('#refreshBtn').removeClass('active show');
         },
         error: function(xhr, status, thrown) {
            console.log(thrown);
            $('#dataGuru').html(`
               <div class="loading-state">
                  <i class="material-icons" style="color: var(--danger);">error_outline</i>
                  <p style="color: var(--danger);">Gagal memuat data: ${thrown}</p>
               </div>
            `);
            $('#refreshBtn').removeClass('active show');
         }
      });
   }

   function removeHover() {
      setTimeout(() => {
         $('#tabBtn').removeClass('active show');
      }, 250);
   }
</script>
<?= $this->endSection() ?>