<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="qr-generate-container">
    <style>
        :root {
            /* Purple theme for Siswa/Kelas section */
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
        
        .qr-generate-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 1rem;
            margin-top: 2rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        
        /* Alert Styles */
        .alert-qr {
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
        
        .alert-qr.alert-success {
            border-left-color: var(--success);
            background-color: rgba(16, 185, 129, 0.05);
            color: var(--success);
        }
        
        .alert-qr.alert-danger {
            border-left-color: var(--danger);
            background-color: rgba(239, 68, 68, 0.05);
            color: var(--danger);
        }
        
        .alert-qr .close {
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
        .qr-main-card {
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px var(--shadow);
            animation: fadeIn 0.5s ease-out;
        }
        
        .qr-main-header {
            background: linear-gradient(135deg, #EC4899 0%, #EF4444 100%);
            padding: 2rem;
            color: white;
        }
        
        .qr-main-header h4 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            color: white;
        }
        
        .qr-main-header p {
            font-size: 0.9375rem;
            margin: 0;
            opacity: 0.95;
            color: white;
        }
        
        .qr-main-body {
            padding: 2.5rem;
        }
        
        /* Section Cards */
        .qr-section-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px var(--shadow);
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .qr-section-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }
        
        /* Siswa Card */
        .qr-section-card.siswa {
            border-top: 4px solid var(--siswa-primary);
        }
        
        .qr-section-card.siswa h4 {
            color: var(--siswa-primary);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .qr-section-card.siswa a {
            color: var(--siswa-primary);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .qr-section-card.siswa a:hover {
            color: var(--siswa-primary-dark);
            text-decoration: underline;
        }
        
        /* Guru Card */
        .qr-section-card.guru {
            border-top: 4px solid var(--guru-primary);
        }
        
        .qr-section-card.guru h4 {
            color: var(--guru-primary);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .qr-section-card.guru a {
            color: var(--guru-primary);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .qr-section-card.guru a:hover {
            color: var(--guru-primary-dark);
            text-decoration: underline;
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

.btn-qr {
    width: 100%;
    padding: 1rem 1.5rem;
    border: none;
    border-radius: 12px;
    font-size: 0.9375rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    text-decoration: none;
    margin-bottom: 0.75rem;
    color: white; /* <-- INI YANG MENGATUR WARNA TEXT PUTIH */
}
        
        .btn-qr i {
            font-size: 1.5rem;
        }
        

        .btn-qr.btn-siswa {
            background: linear-gradient(135deg, var(--siswa-primary) 0%, var(--siswa-primary-dark) 100%);
            color: white !important;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .btn-qr.btn-guru {
            background: linear-gradient(135deg, var(--guru-primary) 0%, var(--guru-primary-dark) 100%);
        color: white !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        /* Green Buttons for Guru */
        .btn-qr.btn-guru {
            background: linear-gradient(135deg, var(--guru-primary) 0%, var(--guru-primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        
        .btn-qr.btn-guru:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }
        
        .btn-qr:active {
            transform: translateY(0);
        }
        
        /* Button Grid */
        .btn-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
        
        /* Select Dropdown */
        .select-custom {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.9375rem;
            color: var(--text);
            background-color: var(--light);
            border: 2px solid var(--border);
            border-radius: 10px;
            transition: all 0.3s ease;
            margin-bottom: 0.75rem;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236B7280' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
            cursor: pointer;
        }
        
        .select-custom:focus {
            outline: none;
            border-color: var(--siswa-primary);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
        }
        
        /* Progress Bar */
        .progress-container {
            margin-top: 1rem;
            padding: 1rem;
            background: var(--light);
            border-radius: 10px;
            display: none;
        }
        
        .progress-container.show {
            display: block;
            animation: fadeIn 0.3s ease-out;
        }
        
        .progress-text {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .progress-text i {
            font-size: 1.125rem;
        }
        
        .progress-bar-bg {
            height: 8px;
            border-radius: 10px;
            background-color: #E5E7EB;
            overflow: hidden;
        }
        
        .progress-bar-bg.siswa {
            background-color: var(--siswa-secondary);
        }
        
        .progress-bar-bg.guru {
            background-color: var(--guru-secondary);
        }
        
        .progress-bar-fill {
            height: 100%;
            transition: width 0.3s ease;
            border-radius: 10px;
        }
        
        .progress-bar-fill.siswa {
            background: linear-gradient(90deg, var(--siswa-primary) 0%, var(--siswa-primary-dark) 100%);
        }
        
        .progress-bar-fill.guru {
            background: linear-gradient(90deg, var(--guru-primary) 0%, var(--guru-primary-dark) 100%);
        }
        
        /* Error Text */
        .error-text {
            color: var(--danger);
            font-size: 0.875rem;
            font-weight: 600;
            margin-top: 0.5rem;
            display: none;
        }
        
        .error-text.show {
            display: block;
        }
        
        /* Divider */
        .divider {
            border: none;
            height: 2px;
            background: linear-gradient(to right, transparent, var(--border), transparent);
            margin: 2rem 0;
        }
        
        /* Section Title */
        .section-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--dark);
            margin: 1.5rem 0 1rem 0;
        }
        
        /* Warning Box */
        .warning-box {
            background: rgba(239, 68, 68, 0.05);
            border-left: 4px solid var(--danger);
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-top: 1.5rem;
            display: flex;
            align-items: start;
            gap: 0.75rem;
        }
        
        .warning-box i {
            color: var(--danger);
            font-size: 1.25rem;
            margin-top: 0.125rem;
        }
        
        .warning-box p {
            color: var(--danger);
            font-size: 0.875rem;
            margin: 0;
            font-weight: 500;
        }
        
        /* Grid Layout */
        .qr-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
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
            .qr-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .qr-generate-container {
                padding: 1.5rem 1rem;
                margin-top: 1rem;
            }
            
            .qr-main-header {
                padding: 1.5rem;
            }
            
            .qr-main-header h4 {
                font-size: 1.5rem;
            }
            
            .qr-main-body {
                padding: 1.5rem;
            }
            
            .qr-section-card {
                padding: 1.5rem;
            }
            
            .btn-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('msg')) : ?>
        <div class="alert-qr alert-<?= session()->getFlashdata('error') == true ? 'danger' : 'success'  ?>">
            <span><?= session()->getFlashdata('msg') ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Main Card -->
    <div class="qr-main-card">
        <div class="qr-main-header">
            <h4>Generate QR Code</h4>
            <p>Generate QR berdasarkan kode unik data siswa/guru</p>
        </div>
        
        <div class="qr-main-body">
            <div class="qr-grid">
                <!-- Siswa Section -->
                <div class="qr-section-card siswa">
                    <h4>Data Siswa</h4>
                    <p class="info-text">
                        Total jumlah siswa: <b><?= count($siswa); ?></b><br>
                        <a href="<?= base_url('admin/siswa'); ?>">Lihat data</a>
                    </p>
                    
                    <!-- Generate All & Download All Buttons -->
                    <div class="btn-grid">
                        <!-- <button onclick="generateAllQrSiswa()" class="btn-qr btn-siswa">
                            <i class="material-icons">qr_code</i>
                            <span>Generate All</span>
                        </button> -->
                        <a href="<?= base_url('admin/qr/siswa/download'); ?>" class="btn-qr btn-siswa">
                            <i class="material-icons">cloud_download</i>
                            <span>Download All</span>
                        </a>
                    </div>
                    
                    <!-- Progress Bar for All Siswa -->
                    <div id="progressSiswa" class="progress-container">
                        <div class="progress-text">
                            <span id="progressTextSiswa">Progres: 0/0</span>
                            <i id="progressSelesaiSiswa" class="material-icons" style="display: none; color: var(--siswa-primary);">check_circle</i>
                        </div>
                        <div class="progress-bar-bg siswa">
                            <div id="progressBarSiswa" class="progress-bar-fill siswa" style="width: 0%;"></div>
                        </div>
                    </div>
                    
                    <hr class="divider">
                    
                    <!-- Generate per Kelas -->
                    <h5 class="section-title" style="color: var(--siswa-primary);">Generate per kelas</h5>
                    
                    <form action="<?= base_url('admin/qr/siswa/download'); ?>" method="get">
                        <select name="id_kelas" id="kelasSelect" class="select-custom" required>
                            <option value="">--Pilih kelas--</option>
                            <?php foreach ($kelas as $value) : ?>
                                <option id="idKelas<?= $value['id_kelas']; ?>" value="<?= $value['id_kelas']; ?>">
                                    <?= $value['kelas'] . ' ' . $value['jurusan']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        
                        <span class="error-text" id="textErrorKelas"></span>
                        
                        <div class="btn-grid">
                            <!-- <button type="button" onclick="generateQrSiswaByKelas()" class="btn-qr btn-siswa">
                                <i class="material-icons">qr_code</i>
                                <span>Generate Kelas</span>
                            </button> -->
                            <button type="submit" class="btn-qr btn-siswa">
                                <i class="material-icons">cloud_download</i>
                                <span>Download Kelas</span>
                            </button>
                        </div>
                        
                        <!-- Progress Bar for Kelas -->
                        <div id="progressKelas" class="progress-container">
                            <div class="progress-text">
                                <span id="progressTextKelas">Progres: 0/0</span>
                                <i id="progressSelesaiKelas" class="material-icons" style="display: none; color: var(--siswa-primary);">check_circle</i>
                            </div>
                            <div class="progress-bar-bg siswa" id="progressBarBgKelas">
                                <div id="progressBarKelas" class="progress-bar-fill siswa" style="width: 0%;"></div>
                            </div>
                        </div>
                    </form>
                    
                    <p class="info-text" style="margin-top: 1.5rem;">
                        Untuk generate/download QR Code per masing-masing siswa kunjungi
                        <a href="<?= base_url('admin/siswa'); ?>"><b>data siswa</b></a>
                    </p>
                </div>

                <!-- Guru Section -->
                <?php if (user()->toArray()['is_superadmin'] ?? '0' == '1') : ?>
                <div class="qr-section-card guru">
                    <h4>Data Guru</h4>
                    <p class="info-text">
                        Total jumlah guru: <b><?= count($guru); ?></b><br>
                        <a href="<?= base_url('admin/guru'); ?>">Lihat data</a>
                    </p>
                    
                    <!-- Generate All & Download All Buttons -->
                    <div class="btn-grid">
                        <!-- <button onclick="generateAllQrGuru()" class="btn-qr btn-guru">
                            <i class="material-icons">qr_code</i>
                            <span>Generate All</span>
                        </button> -->
                        <a href="<?= base_url('admin/qr/guru/download'); ?>" class="btn-qr btn-guru">
                            <i class="material-icons">cloud_download</i>
                            <span>Download All</span>
                        </a>
                    </div>
                    
                    <!-- Progress Bar for Guru -->
                    <div id="progressGuru" class="progress-container">
                        <div class="progress-text">
                            <span id="progressTextGuru">Progres: 0/0</span>
                            <i id="progressSelesaiGuru" class="material-icons" style="display: none; color: var(--guru-primary);">check_circle</i>
                        </div>
                        <div class="progress-bar-bg guru">
                            <div id="progressBarGuru" class="progress-bar-fill guru" style="width: 0%;"></div>
                        </div>
                    </div>
                    
                    <p class="info-text" style="margin-top: 1.5rem;">
                        Untuk generate/download QR Code per masing-masing guru kunjungi
                        <a href="<?= base_url('admin/guru'); ?>"><b>data guru</b></a>
                    </p>
                    
                    <!-- Warning Box -->
                    <div class="warning-box">
                        <i class="material-icons">warning</i>
                        <p>File image QR Code tersimpan di [folder website]/public/uploads/</p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
  const dataGuru = [
    <?php foreach ($guru as $value) {
      echo "{
              'nama' : `$value[nama_guru]`,
              'unique_code' : `$value[unique_code]`,
              'nomor' : `$value[nuptk]`
            },";
    }; ?>
  ];

  const dataSiswa = [
    <?php foreach ($siswa as $value) {
      echo "{
              'nama' : `$value[nama_siswa]`,
              'unique_code' : `$value[unique_code]`,
              'id_kelas' : `$value[id_kelas]`,
              'nomor' : `$value[nis]`
            },";
    }; ?>
  ];

  var dataSiswaPerKelas = [];

  function generateAllQrSiswa() {
    var i = 1;
    const progressContainer = document.getElementById('progressSiswa');
    const progressText = document.getElementById('progressTextSiswa');
    const progressBar = document.getElementById('progressBarSiswa');
    const progressCheck = document.getElementById('progressSelesaiSiswa');
    
    progressContainer.classList.add('show');
    progressCheck.style.display = 'none';
    progressBar.style.width = '0%';

    dataSiswa.forEach(element => {
      jQuery.ajax({
        url: "<?= base_url('admin/generate/siswa'); ?>",
        type: 'post',
        data: {
          nama: element['nama'],
          unique_code: element['unique_code'],
          id_kelas: element['id_kelas'],
          nomor: element['nomor']
        },
        success: function(response) {
          if (!response) return;
          
          progressText.textContent = 'Progres: ' + i + '/' + dataSiswa.length;
          progressBar.style.width = ((i / dataSiswa.length) * 100) + '%';
          
          if (i == dataSiswa.length) {
            progressText.textContent = 'Progres: ' + i + '/' + dataSiswa.length + ' selesai';
            progressCheck.style.display = 'inline-block';
          }
          i++;
        }
      });
    });
  }

  function generateQrSiswaByKelas() {
    var i = 1;
    const idKelas = document.getElementById('kelasSelect').value;
    const errorText = document.getElementById('textErrorKelas');
    const progressContainer = document.getElementById('progressKelas');
    const progressText = document.getElementById('progressTextKelas');
    const progressBar = document.getElementById('progressBarKelas');
    const progressCheck = document.getElementById('progressSelesaiKelas');

    if (idKelas == '') {
      progressContainer.classList.remove('show');
      errorText.textContent = 'Pilih kelas terlebih dahulu';
      errorText.classList.add('show');
      return;
    }

    const kelas = document.getElementById('idKelas' + idKelas).textContent;

    jQuery.ajax({
      url: "<?= base_url('admin/generate/siswa-by-kelas'); ?>",
      type: 'post',
      data: {
        idKelas: idKelas
      },
      success: function(response) {
        dataSiswaPerKelas = response;

        if (dataSiswaPerKelas.length < 1) {
          progressContainer.classList.remove('show');
          errorText.textContent = 'Data siswa kelas ' + kelas + ' tidak ditemukan';
          errorText.classList.add('show');
          return;
        }

        errorText.classList.remove('show');
        progressContainer.classList.add('show');
        progressCheck.style.display = 'none';
        progressBar.style.width = '0%';

        dataSiswaPerKelas.forEach(element => {
          jQuery.ajax({
            url: "<?= base_url('admin/generate/siswa'); ?>",
            type: 'post',
            data: {
              nama: element['nama_siswa'],
              unique_code: element['unique_code'],
              id_kelas: element['id_kelas'],
              nomor: element['nis']
            },
            success: function(response) {
              if (!response) return;
              
              progressText.textContent = 'Progres: ' + i + '/' + dataSiswaPerKelas.length;
              progressBar.style.width = ((i / dataSiswaPerKelas.length) * 100) + '%';
              
              if (i == dataSiswaPerKelas.length) {
                progressText.textContent = 'Progres: ' + i + '/' + dataSiswaPerKelas.length + ' selesai';
                progressCheck.style.display = 'inline-block';
              }
              i++;
            },
            error: function(xhr, status, thrown) {
              console.error(xhr + status + thrown);
            }
          });
        });
      }
    });
  }

  function generateAllQrGuru() {
    var i = 1;
    const progressContainer = document.getElementById('progressGuru');
    const progressText = document.getElementById('progressTextGuru');
    const progressBar = document.getElementById('progressBarGuru');
    const progressCheck = document.getElementById('progressSelesaiGuru');
    
    progressContainer.classList.add('show');
    progressCheck.style.display = 'none';
    progressBar.style.width = '0%';

    dataGuru.forEach(element => {
      jQuery.ajax({
        url: "<?= base_url('admin/generate/guru'); ?>",
        type: 'post',
        data: {
          nama: element['nama'],
          unique_code: element['unique_code'],
          nomor: element['nomor']
        },
        success: function(response) {
          if (!response) return;
          
          progressText.textContent = 'Progres: ' + i + '/' + dataGuru.length;
          progressBar.style.width = ((i / dataGuru.length) * 100) + '%';
          
          if (i == dataGuru.length) {
            progressText.textContent = 'Progres: ' + i + '/' + dataGuru.length + ' selesai';
            progressCheck.style.display = 'inline-block';
          }
          i++;
        }
      });
    });
  }
</script>
<?= $this->endSection() ?>