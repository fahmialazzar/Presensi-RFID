<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<style>
  .ios-content {
    background: #f5f5f7;
    min-height: 100vh;
    padding: 64px 16px 24px;         
  }

  .ios-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  .ios-card {
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    margin-bottom: 20px;
    transition: all 0.3s ease;
  }

  .ios-card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
  }

  .ios-card-header {
    padding: 20px 24px 16px;
    border-bottom: 1px solid #e5e5e7;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  }

  .ios-title {
    font-size: 22px;
    font-weight: 600;
    color: #ffffff;
    margin: 0 0 4px 0;
    letter-spacing: -0.3px;
  }

  .ios-subtitle {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.85);
    margin: 0;
    font-weight: 400;
  }

  .ios-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: 16px;
  }

  .ios-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 12px;
    color: #ffffff;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
    backdrop-filter: blur(10px);
    cursor: pointer;
  }

  .ios-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    color: #ffffff;
    transform: scale(1.02);
  }

  .ios-btn:active {
    transform: scale(0.98);
  }

  .ios-btn i {
    font-size: 18px;
  }

  .ios-card-body {
    padding: 20px 24px;
    min-height: 200px;
  }

  .ios-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .ios-content {
      padding: 16px 12px;
    }

    .ios-card-header {
      padding: 16px 20px 12px;
    }

    .ios-title {
      font-size: 20px;
    }

    .ios-actions {
      margin-top: 12px;
    }

    .ios-btn {
      padding: 7px 14px;
      font-size: 13px;
    }

    .ios-card-body {
      padding: 16px 20px;
    }

    .ios-grid {
      grid-template-columns: 1fr;
    }
  }

  /* Loading state */
  .ios-loading {
    text-align: center;
    padding: 40px 20px;
    color: #86868b;
  }

  .ios-loading i {
    font-size: 32px;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }
</style>

<div class="ios-content">
  <div class="ios-container">
    <?= view('admin/_messages'); ?>
    
    <div class="ios-grid">
      <!-- Card Kelas -->
      <div class="ios-card">
        <div class="ios-card-header">
          <h4 class="ios-title">Daftar Kelas</h4>
          <p class="ios-subtitle">Angkatan <?= $generalSettings->school_year; ?></p>
          
          <div class="ios-actions">
            <a class="ios-btn" href="<?= base_url('admin/kelas/tambah'); ?>">
              <i class="material-icons">add</i>
              <span>Tambah Kelas</span>
            </a>
            <a class="ios-btn" onclick="fetchKelasJurusanData('kelas', '#dataKelas')" href="javascript:void(0)">
              <i class="material-icons">refresh</i>
              <span>Refresh</span>
            </a>
          </div>
        </div>
        
        <div class="ios-card-body" id="dataKelas">
          <div class="ios-loading">
            <i class="material-icons">hourglass_empty</i>
            <p>Memuat data...</p>
          </div>
        </div>
      </div>

      <!-- Card Jurusan -->
      <div class="ios-card">
        <div class="ios-card-header">
          <h4 class="ios-title">Daftar Jurusan</h4>
          <p class="ios-subtitle">Angkatan <?= $generalSettings->school_year; ?></p>
          
          <div class="ios-actions">
            <a class="ios-btn" href="<?= base_url('admin/jurusan/tambah'); ?>">
              <i class="material-icons">add</i>
              <span>Tambah Jurusan</span>
            </a>
            <a class="ios-btn" onclick="fetchKelasJurusanData('jurusan', '#dataJurusan')" href="javascript:void(0)">
              <i class="material-icons">refresh</i>
              <span>Refresh</span>
            </a>
          </div>
        </div>
        
        <div class="ios-card-body" id="dataJurusan">
          <div class="ios-loading">
            <i class="material-icons">hourglass_empty</i>
            <p>Memuat data...</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    fetchKelasJurusanData('kelas', '#dataKelas');
    fetchKelasJurusanData('jurusan', '#dataJurusan');
  });
</script>

<?= $this->endSection() ?>