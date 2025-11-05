<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<style>
  .ios-content {
    background: #f5f5f7;
    min-height: 100vh;
    padding: 64px 16px 24px; /* jarak atas lebih besar agar lega */
  }

  .ios-container {
    max-width: 800px;
    margin: 0 auto;
  }

  .ios-card {
    background: #fff;
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
    background: linear-gradient(135deg, #7F7FD5 0%, #86A8E7 50%, #91EAE4 100%);
    padding: 24px 28px;
    color: #fff;
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

  .form-control, .custom-select {
    border-radius: 12px;
    border: 1px solid #d1d1d6;
    padding: 10px 14px;
    width: 100%;
    font-size: 15px;
    transition: border-color 0.2s, box-shadow 0.2s;
    background-color: #f9f9fb;
  }

  .form-control:focus, .custom-select:focus {
    border-color: #7F7FD5;
    box-shadow: 0 0 0 3px rgba(127, 127, 213, 0.25);
    outline: none;
    background-color: #fff;
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
    display: inline-block;
  }

  .ios-btn-primary:hover {
    transform: scale(1.03);
    box-shadow: 0 4px 14px rgba(102, 126, 234, 0.3);
  }

  .ios-btn-primary:active {
    transform: scale(0.98);
  }

  hr {
    border: none;
    border-top: 1px solid #e5e5ea;
    margin-top: 24px;
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
        <h4 class="ios-title"><b>Form Tambah Kelas</b></h4>
      </div>

      <div class="ios-card-body">
        <form action="<?= base_url('admin/kelas/tambahKelasPost'); ?>" method="post">
          <?= csrf_field() ?>

          <div class="form-group mt-3">
            <label for="kelas">Kelas / Tingkat</label>
            <input type="text"
              id="kelas"
              class="form-control <?= invalidFeedback('kelas') ? 'is-invalid' : ''; ?>"
              name="kelas"
              placeholder="'X', 'XI', '12'"
              value="<?= old('kelas') ?>"
              required>
            <div class="invalid-feedback">
              <?= invalidFeedback('kelas'); ?>
            </div>
          </div>

          <div class="form-group mt-4">
            <label for="id_jurusan">Jurusan</label>
            <select
              class="custom-select <?= invalidFeedback('id_jurusan') ? 'is-invalid' : ''; ?>"
              id="id_jurusan"
              name="id_jurusan">
              <option value="">--Pilih Jurusan--</option>
              <?php foreach ($jurusan as $value) : ?>
                <option value="<?= $value['id']; ?>" <?= old('id_jurusan') == $value['id'] ? 'selected' : ''; ?>>
                  <?= $value['jurusan']; ?>
                </option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
              <?= invalidFeedback('id_jurusan'); ?>
            </div>
          </div>

          <button type="submit" class="ios-btn-primary mt-4">Simpan</button>
        </form>

        <hr>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
