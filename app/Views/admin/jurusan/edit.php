<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<div class="ios-content">
  <style>
    :root {
      /* Warna utama untuk tema jurusan */
      --jurusan-primary: #007aff;
      --jurusan-primary-light: #f0f8ff;
      --jurusan-primary-dark: #0051c7;
      --jurusan-border: #e0e0e0;
      --jurusan-bg: #f9f9fb;
      --jurusan-text: #1c1c1e;
    }

    .ios-content {
      background: var(--jurusan-bg);
      min-height: 100vh;
      padding: 64px 16px 24px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }

    .ios-card {
      background: #fff;
      border-radius: 24px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
      width: 100%;
      max-width: 600px;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .ios-card:hover {
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .ios-card-header {
    background: linear-gradient(135deg, #7F7FD5 0%, #86A8E7 50%, #91EAE4 100%);
    padding: 24px 28px;
    color: #ffffff;
    text-align: center;
    }

    .ios-card-header h4 {
      margin: 0;
      font-weight: 600;
      font-size: 1.3rem;
      letter-spacing: 0.5px;
    }

    .ios-card-body {
      padding: 32px 28px;
    }

    .ios-form-group {
      margin-bottom: 24px;
    }

    .ios-form-group label {
      display: block;
      margin-bottom: 6px;
      color: var(--jurusan-text);
      font-weight: 500;
      font-size: 0.95rem;
    }

    .ios-form-group input {
      width: 100%;
      padding: 12px 14px;
      border-radius: 12px;
      border: 1px solid var(--jurusan-border);
      background-color: #fff;
      color: var(--jurusan-text);
      font-size: 0.95rem;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .ios-form-group input:focus {
      outline: none;
      border-color: var(--jurusan-primary);
      box-shadow: 0 0 0 3px rgba(0, 122, 255, 0.15);
    }

    .invalid-feedback {
      color: #e74c3c;
      font-size: 0.85rem;
      margin-top: 4px;
    }

    .ios-btn {
      display: inline-block;
      width: 100%;
      padding: 12px 0;
      border: none;
      border-radius: 16px;
       background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .ios-btn:hover {
      background: var(--jurusan-primary-dark);
      transform: translateY(-1px);
    }

    .ios-divider {
      border: none;
      border-top: 1px solid #f0f0f0;
      margin-top: 32px;
    }
  </style>

  <div class="ios-card">
    <div class="ios-card-header">
      <h4><b>Form Edit Jurusan</b></h4>
    </div>

    <div class="ios-card-body">
      <?= view('admin/_messages'); ?>

      <form action="<?= base_url('admin/jurusan/editJurusanPost'); ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= esc($jurusan->id); ?>">
        <input type="hidden" name="back_url" value="<?= currentFullURL(); ?>">

        <div class="ios-form-group">
          <label for="jurusan">Nama Jurusan</label>
          <input
            type="text"
            id="jurusan"
            class="<?= invalidFeedback('jurusan') ? 'is-invalid' : ''; ?>"
            name="jurusan"
            placeholder="Contoh: IPA, IPS"
            value="<?= old('jurusan') ?? $jurusan->jurusan ?? '' ?>"
            required
          >
          <div class="invalid-feedback">
            <?= invalidFeedback('jurusan'); ?>
          </div>
        </div>

        <button type="submit" class="ios-btn">Simpan</button>
      </form>

      <hr class="ios-divider">
    </div>
  </div>
</div>

<?= $this->endSection() ?>
