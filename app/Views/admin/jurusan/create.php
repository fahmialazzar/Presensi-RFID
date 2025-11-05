<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<style>
  .ios-content {
    background: #f5f5f7;
    min-height: 100vh;
    padding: 64px 16px 24px;
  }

  .ios-container {
    max-width: 700px;
    margin: 0 auto;
  }

  .ios-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    transition: all 0.3s ease;
  }

  .ios-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 22px rgba(0, 0, 0, 0.08);
  }

  .ios-card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 24px 28px;
    color: #ffffff;
    text-align: center;
  }

  .ios-title {
    font-size: 22px;
    font-weight: 600;
    margin: 0;
    letter-spacing: -0.3px;
  }

  .ios-card-body {
    padding: 28px 32px;
  }

  label {
    font-weight: 500;
    color: #3a3a3c;
    margin-bottom: 6px;
    display: block;
  }

  .form-control {
    border-radius: 12px;
    border: 1px solid #d1d1d6;
    padding: 10px 14px;
    width: 100%;
    font-size: 15px;
    background-color: #f9f9fb;
    transition: border-color 0.2s, box-shadow 0.2s;
  }

  .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.25);
    outline: none;
    background-color: #ffffff;
  }

  .invalid-feedback {
    color: #d9534f;
    font-size: 13px;
    margin-top: 4px;
  }

  .ios-btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 14px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .ios-btn-primary:hover {
    transform: scale(1.03);
    box-shadow: 0 4px 14px rgba(118, 75, 162, 0.3);
  }

  .ios-btn-primary:active {
    transform: scale(0.98);
  }

  @media (max-width: 768px) {
    .ios-card-body {
      padding: 20px;
    }

    .ios-title {
      font-size: 20px;
    }
  }
</style>

<div class="ios-content">
  <div class="ios-container">
    <?= view('admin/_messages'); ?>

    <div class="ios-card">
      <div class="ios-card-header">
        <h4 class="ios-title"><b>Form Tambah Jurusan</b></h4>
      </div>

      <div class="ios-card-body">
        <form action="<?= base_url('admin/jurusan/tambahJurusanPost'); ?>" method="post">
          <?= csrf_field() ?>

          <div class="form-group mt-3">
            <label for="jurusan">Nama Jurusan</label>
            <input type="text"
              id="jurusan"
              class="form-control <?= invalidFeedback('jurusan') ? 'is-invalid' : ''; ?>"
              name="jurusan"
              placeholder="IPA, IPS, TKJ, AKL"
              value="<?= old('jurusan'); ?>"
              required>
            <div class="invalid-feedback">
              <?= invalidFeedback('jurusan'); ?>
            </div>
          </div>

          <button type="submit" class="ios-btn-primary mt-4">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
