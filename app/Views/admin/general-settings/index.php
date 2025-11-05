<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content ios-blue-theme">
  <style>
    /* iOS Blue Theme for Pengaturan View */
    .ios-blue-theme {
      --primary: #007AFF;
      --primary-light: #EAF2FF;
      --text-dark: #1F2937;
      --border: #E5E7EB;
      --danger: #FF3B30;
      --success: #10B981;
      --bg-light: #F9FAFB;
    }

    .ios-blue-theme .card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      border: 1px solid var(--border);
    }

    .ios-blue-theme .card-header {
      background: linear-gradient(90deg, var(--primary) 0%, #409CFF 100%);
      color: #fff;
      padding: 1.2rem 1.5rem;
      border-bottom: none;
      text-align: center;
    }

    .ios-blue-theme .card-header h4 {
      font-weight: 600;
      font-size: 1.25rem;
      margin: 0;
    }

    .ios-blue-theme .card-body {
      background-color: var(--bg-light);
      border-radius: 0 0 16px 16px;
      padding: 2rem;
    }

    /* Form Fields */
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

    /* Upload Preview Box */
    .ios-blue-theme #logo {
      border-radius: 12px;
      background-color: #fff;
      border: 1px solid var(--border);
      padding: 8px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    /* Buttons */
    .ios-blue-theme .btn {
      border-radius: 10px;
      transition: all 0.2s ease;
      font-weight: 600;
    }

    .ios-blue-theme .btn-primary {
      background-color: var(--primary);
      border: none;
      color: #fff;
    }

    .ios-blue-theme .btn-primary:hover {
      background-color: #005FCC;
      box-shadow: 0 4px 10px rgba(0, 122, 255, 0.25);
      transform: translateY(-1px);
    }

    .ios-blue-theme .btn-file-upload {
      background-color: var(--primary);
      color: var(--primary-light);
    }

    .ios-blue-theme .btn-file-upload:hover {
      background-color: var(--primary);
      color: #fff;
      box-shadow: 0 4px 10px rgba(0, 122, 255, 0.25);
    }

    .ios-blue-theme hr {
      border: 0;
      border-top: 1px solid var(--border);
      margin: 2rem 0;
    }

    .ios-blue-theme .text-sm {
      font-size: 0.85rem;
    }
  </style>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <?= view('admin/_messages'); ?>
        <div class="card">
          <div class="card-header">
            <h4><b>Pengaturan</b></h4>
          </div>
          <div class="card-body">

            <form action="<?= base_url('admin/general-settings/update'); ?>" method="post" enctype="multipart/form-data">
              <?= csrf_field() ?>

              <div class="form-group mt-4">
                <label for="school_name">Nama Sekolah</label>
                <input type="text" id="school_name" class="form-control <?= invalidFeedback('school_name') ? 'is-invalid' : ''; ?>" name="school_name" placeholder="SMK 1 Indonesia" value="<?= $generalSettings->school_name; ?>" required>
                <div class="invalid-feedback">
                  <?= invalidFeedback('school_name'); ?>
                </div>
              </div>

              <div class="form-group mt-4">
                <label for="school_year">Tahun Ajaran</label>
                <input type="text" id="school_year" class="form-control <?= invalidFeedback('school_year') ? 'is-invalid' : ''; ?>" name="school_year" placeholder="2024/2025" value="<?= $generalSettings->school_year; ?>" required>
                <div class="invalid-feedback">
                  <?= invalidFeedback('school_year'); ?>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mt-4">
                    <label for="copyright">Copyright</label>
                    <input type="text" id="copyright" class="form-control <?= invalidFeedback('copyright') ? 'is-invalid' : ''; ?>" name="copyright" placeholder="@ 2024 All" value="<?= $generalSettings->copyright; ?>" required>
                    <div class="invalid-feedback">
                      <?= invalidFeedback('copyright'); ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mt-4">
                    <label for="logo">Logo</label>
                    <div style="margin-bottom: 10px;">
                      <img id="logo" src="<?= getLogo(); ?>" alt="logo" style="max-width: 220px; max-height: 220px;">
                    </div>
                    <div class="display-block">
                      <button type="button" onclick="$('#logo-upload').trigger('click');" class="btn btn-file-upload btn-sm">
                        Ganti Logo
                      </button>
                      <input type="file" id="logo-upload" name="logo" size="40" accept="image/jpg,image/jpeg,image/png,image/gif,image/svg+xml" onchange="$('#upload-file-info1').html($(this).val().replace(/.*[\/\\]/, ''));">

                      <span class="text-sm text-secondary">(.png, .jpg, .jpeg, .gif, .svg)</span>
                    </div>
                    <span class='label label-info' id="upload-file-info1"></span>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary btn-block mt-4">Simpan</button>
            </form>

            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
