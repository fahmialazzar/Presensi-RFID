<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content ios-blue-theme">
  <style>
    /* iOS Blue Theme – Form Edit Petugas */
    .ios-blue-theme {
      --primary: #007AFF;
      --primary-light: #EAF2FF;
      --text-dark: #1F2937;
      --border: #E5E7EB;
      --success: #10B981;
      --warning: #FFB020;
      --danger: #FF3B30;
      --bg-light: #F9FAFB;
    }

    .ios-blue-theme .card {
      background: #fff;
      border-radius: 16px;
      border: 1px solid var(--border);
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
      overflow: hidden;
    }

    .ios-blue-theme .card-header {
      background: linear-gradient(90deg, var(--primary) 0%, #409CFF 100%);
      color: #fff;
      padding: 1.25rem 1.5rem;
      border-bottom: none;
      text-align: center;
    }

    .ios-blue-theme .card-header h4 {
      font-weight: 600;
      font-size: 1.25rem;
      margin-bottom: 0.25rem;
    }

    .ios-blue-theme .card-header p {
      font-size: 0.9rem;
      color: #E0E7FF;
      margin: 0;
    }

    .ios-blue-theme .card-body {
      background: var(--bg-light);
      border-radius: 0 0 16px 16px;
      padding: 2rem;
    }

    /* Inner cards for sections (Masuk & Pulang) */
    .ios-blue-theme .card .card {
      border: 1px solid var(--border);
      border-radius: 14px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      transition: all 0.2s ease;
    }

    .ios-blue-theme .card .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
    }

    .ios-blue-theme .card .card-header {
      border-bottom: none;
      padding: 1rem 1.25rem;
      color: #fff;
      font-weight: 600;
    }

    .ios-blue-theme .card .card-header.bg-success {
      background: linear-gradient(90deg, var(--success) 0%, #34D399 100%);
    }

    .ios-blue-theme .card .card-header.bg-warning {
      background: linear-gradient(90deg, var(--warning) 0%, #FFD369 100%);
      color: #fff;
    }

    .ios-blue-theme .card .card-body {
      background: #fff;
      padding: 1.5rem;
    }

    /* Forms */
    .ios-blue-theme label {
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 6px;
      display: block;
    }

    .ios-blue-theme input.form-control {
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 0.75rem 1rem;
      font-size: 0.95rem;
      transition: all 0.2s ease;
    }

    .ios-blue-theme input.form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(0, 122, 255, 0.15);
    }

    /* Buttons */
    .ios-blue-theme .btn {
      border-radius: 10px;
      font-weight: 600;
      transition: all 0.2s ease;
    }

    .ios-blue-theme .btn-primary {
      background-color: var(--primary);
      border: none;
      color: #fff;
    }

    .ios-blue-theme .btn-primary:hover {
      background-color: #005FCC;
      transform: translateY(-1px);
      box-shadow: 0 4px 10px rgba(0, 122, 255, 0.25);
    }

    /* Alerts */
    .ios-blue-theme .alert {
      border-radius: 12px;
      padding: 1rem 1.25rem;
      font-size: 0.95rem;
      margin-bottom: 1.25rem;
    }

    .ios-blue-theme .alert-success {
      background-color: rgba(16, 185, 129, 0.1);
      color: var(--success);
      border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .ios-blue-theme .alert-danger {
      background-color: rgba(255, 59, 48, 0.1);
      color: var(--danger);
      border: 1px solid rgba(255, 59, 48, 0.3);
    }
  </style>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header">
            <h4><b>Form Edit Petugas</b></h4>
            <p>Atur waktu untuk presensi masuk dan pulang</p>
          </div>

          <div class="card-body">
            <?php if (session()->has('success')) : ?>
              <div class="alert alert-success">
                <?= session('success') ?>
              </div>
            <?php endif; ?>

            <?php if (session()->has('errors')) : ?>
              <div class="alert alert-danger">
                <ul>
                  <?php foreach (session('errors') as $error) : ?>
                    <li><?= $error ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/attendance-settings/update') ?>" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header bg-success">
                      <h5 class="mb-0">Waktu Presensi Masuk</h5>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="masuk_start">Jam Mulai</label>
                        <input type="time" class="form-control" id="masuk_start" name="masuk_start" value="<?= $settings['masuk_start'] ?>">
                      </div>
                      <div class="form-group mt-3">
                        <label for="masuk_end">Jam Selesai</label>
                        <input type="time" class="form-control" id="masuk_end" name="masuk_end" value="<?= $settings['masuk_end'] ?>">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header bg-warning">
                      <h5 class="mb-0">Waktu Presensi Pulang</h5>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="pulang_start">Jam Mulai</label>
                        <input type="time" class="form-control" id="pulang_start" name="pulang_start" value="<?= $settings['pulang_start'] ?>">
                      </div>
                      <div class="form-group mt-3">
                        <label for="pulang_end">Jam Selesai</label>
                        <input type="time" class="form-control" id="pulang_end" name="pulang_end" value="<?= $settings['pulang_end'] ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>
