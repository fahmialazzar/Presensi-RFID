<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="laporan-generate-container">
    <style>
        :root {
            /* Purple theme for Siswa section */
            --siswa-primary: #8B5CF6;
            --siswa-primary-light: #F5F3FF;
            --siswa-primary-dark: #6D28D9;
            --siswa-secondary: #C4B5FD;
            --siswa-accent: #A78BFA;
            
            /* Green theme for Guru section */
            --guru-primary: #10B981;
            --guru-primary-light: #ECFDF5;
            --guru-primary-dark: #059669;
            --guru-secondary: #A7F3D0;
            --guru-accent: #6EE7B7;
            
            /* Common colors */
            --danger: #EF4444;
            --info: #3B82F6;
            --dark: #1F2937;
            --light: #F9FAFB;
            --text: #374151;
            --text-light: #6B7280;
            --border: #E5E7EB;
            --shadow: rgba(0, 0, 0, 0.05);
        }
        
        .laporan-generate-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 1rem;
            margin-top: 2rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        
        /* Alert Styles */
        .alert-laporan {
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
        
        .alert-laporan.alert-success {
            border-left-color: var(--guru-primary);
            background-color: rgba(16, 185, 129, 0.05);
            color: var(--guru-primary);
        }
        
        .alert-laporan.alert-danger {
            border-left-color: var(--danger);
            background-color: rgba(239, 68, 68, 0.05);
            color: var(--danger);
        }
        
        .alert-laporan .close {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-light);
            transition: color 0.2s;
            padding: 0;
            margin: 0;
            font-size: 1.5rem;
            line-height: 1;
        }
        
        /* Main Card */
        .laporan-main-card {
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px var(--shadow);
            animation: fadeIn 0.5s ease-out;
        }
        
        .laporan-main-header {
            background: linear-gradient(135deg, #EC4899 0%, #EF4444 100%);
            padding: 2rem;
            color: white;
        }
        
        .laporan-main-header h4 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            color: white;
        }
        
        .laporan-main-header p {
            font-size: 0.9375rem;
            margin: 0;
            opacity: 0.95;
            color: white;
        }
        
        .laporan-main-body {
            padding: 2.5rem;
        }
        
        /* Section Cards */
        .laporan-section-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px var(--shadow);
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .laporan-section-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }
        
        /* Siswa Card */
        .laporan-section-card.siswa {
            border-top: 4px solid var(--siswa-primary);
        }
        
        .laporan-section-card.siswa h4 {
            color: var(--siswa-primary);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        /* Guru Card */
        .laporan-section-card.guru {
            border-top: 4px solid var(--guru-primary);
        }
        
        .laporan-section-card.guru h4 {
            color: var(--guru-primary);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        /* Info Text */
        .info-text {
            color: var(--text);
            font-size: 0.9375rem;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        .info-text b {
            color: var(--dark);
        }
        
        /* Form Group */
        .form-group-laporan {
            margin-bottom: 1.5rem;
        }
        
        .form-group-laporan label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-group-laporan label i {
            font-size: 1.125rem;
        }
        
        /* Input Styles */
        .input-laporan {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.9375rem;
            color: var(--text);
            background-color: var(--light);
            border: 2px solid var(--border);
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .input-laporan:focus {
            outline: none;
            border-color: var(--siswa-primary);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
        }
        
        .laporan-section-card.guru .input-laporan:focus {
            border-color: var(--guru-primary);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
        
        /* Select Dropdown */
        .select-laporan {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.9375rem;
            color: var(--text);
            background-color: var(--light);
            border: 2px solid var(--border);
            border-radius: 10px;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236B7280' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
            cursor: pointer;
        }
        
        .select-laporan:focus {
            outline: none;
            border-color: var(--siswa-primary);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
        }
        
        /* Button Styles */
        .btn-laporan {
            width: 48%; /* agar dua tombol sejajar dan simetris */
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-size: 0.9375rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            margin-bottom: 0.75rem;
            color: #fff !important; /* pastikan teks putih */
        }
        
        .btn-laporan i {
            font-size: 2rem;
        }
        
        .btn-laporan .btn-content {
            text-align: left;
            flex: 1;
            
        }
        
        .btn-laporan .btn-content h4 {
            margin: 0;
            font-size: 1.125rem;
            font-weight: 700;
            color: #fff !important; /* pastikan tulisan di dalam putih */
        }
        
        /* PDF Button - Red */
        .btn-laporan.btn-pdf {
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }
        
        .btn-laporan.btn-pdf:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }
        
        /* DOC Button - Blue */
        .btn-laporan.btn-doc {
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .btn-laporan.btn-doc:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }
        
        .btn-laporan:active {
            transform: translateY(0);
        }
        
        /* Button Container */
         .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
         }
        
        /* Grid Layout */
        .laporan-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        
        /* Date Input Row */
        .date-input-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .date-input-row label {
            font-weight: 600;
            color: var(--dark);
            white-space: nowrap;
            margin: 0;
        }
        
        .date-input-row .input-laporan {
            flex: 1;
            max-width: 200px;
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
        
        /* Responsive */
        @media (max-width: 1200px) {
            .laporan-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .laporan-generate-container {
                padding: 1.5rem 1rem;
                margin-top: 1rem;
            }
            
            .laporan-main-header {
                padding: 1.5rem;
            }
            
            .laporan-main-header h4 {
                font-size: 1.5rem;
            }
            
            .laporan-main-body {
                padding: 1.5rem;
            }
            
            .laporan-section-card {
                padding: 1.5rem;
            }
            
            .date-input-row {
                flex-direction: column;
                align-items: stretch;
            }
            
            .date-input-row .input-laporan {
                max-width: 100%;
            }
        }
    </style>

    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('msg')) : ?>
        <div class="alert-laporan alert-<?= session()->getFlashdata('error') == true ? 'danger' : 'success'  ?>">
            <span><?= session()->getFlashdata('msg') ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Main Card -->
    <div class="laporan-main-card">
        <div class="laporan-main-header">
            <h4>Generate Laporan</h4>
            <p>Generate laporan presensi siswa dan guru</p>
        </div>
        
        <div class="laporan-main-body">
            <div class="laporan-grid">
                <!-- Siswa Section -->
                <div class="laporan-section-card siswa">
                    <h4>Laporan Presensi Siswa</h4>
                    
                    <form action="<?= base_url('admin/laporan/siswa'); ?>" method="post">
                        <!-- Date Input -->
                        <div class="date-input-row">
                            <label>
                                <i class="material-icons">calendar_today</i>
                                Bulan:
                            </label>
                            <input type="month" name="tanggalSiswa" id="tanggalSiswa" class="input-laporan" value="<?= date('Y-m'); ?>" required>
                        </div>
                        
                        <!-- Kelas Select -->
                        <div class="form-group-laporan">
                            <label>
                                <i class="material-icons">class</i>
                                Pilih Kelas
                            </label>
                            <select name="kelas" class="select-laporan" required>
                                <option value="">--Pilih kelas--</option>
                                <?php foreach ($kelas as $key => $value) : ?>
                                    <?php
                                    $idKelas = $value['id_kelas'];
                                    $kelasName = "{$value['kelas']} {$value['jurusan']}";
                                    $jumlahSiswa = count($siswaPerKelas[$key]);
                                    ?>
                                    <option value="<?= $idKelas; ?>">
                                        <?= "$kelasName - {$jumlahSiswa} siswa"; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="errMsg"></div>
                        
                        <!-- Buttons -->
                        <div class="btn-container">
                            <button type="submit" name="type" value="pdf" class="btn-laporan btn-pdf">
                                <i class="material-icons">print</i>
                                <div class="btn-content">
                                    <h4>Generate PDF</h4>
                                </div>
                            </button>
                            
                            <button type="submit" name="type" value="doc" class="btn-laporan btn-doc">
                                <i class="material-icons">description</i>
                                <div class="btn-content">
                                    <h4>Generate DOC</h4>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Guru Section -->
                <?php if (user()->toArray()['is_superadmin'] ?? '0' == '1') : ?>
                <div class="laporan-section-card guru">
                    <h4>Laporan Presensi Guru</h4>
                    
                    <p class="info-text">
                        Total jumlah guru: <b><?= count($guru); ?></b>
                    </p>
                    
                    <form action="<?= base_url('admin/laporan/guru'); ?>" method="post">
                        <!-- Date Input -->
                        <div class="date-input-row">
                            <label>
                                <i class="material-icons">calendar_today</i>
                                Bulan:
                            </label>
                            <input type="month" name="tanggalGuru" id="tanggalGuru" class="input-laporan" value="<?= date('Y-m'); ?>" required>
                        </div>
                        
                        <!-- Buttons -->
                        <div class="btn-container">
                            <button type="submit" name="type" value="pdf" class="btn-laporan btn-pdf">
                                <i class="material-icons">print</i>
                                <div class="btn-content">
                                    <h4>Generate PDF</h4>
                                </div>
                            </button>
                            
                            <button type="submit" name="type" value="doc" class="btn-laporan btn-doc">
                                <i class="material-icons">description</i>
                                <div class="btn-content">
                                    <h4>Generate DOC</h4>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>