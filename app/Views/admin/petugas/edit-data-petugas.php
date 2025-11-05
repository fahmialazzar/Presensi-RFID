<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<div class="petugas-form-container">
  <style>
    :root {
      /* iOS Blue Theme for Petugas section */
      --petugas-primary: #3B82F6;
      --petugas-primary-light: #EFF6FF;
      --petugas-primary-dark: #2563EB;
      --petugas-secondary: #BFDBFE;
      --petugas-accent: #60A5FA;
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

    .petugas-form-container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 2rem 1rem;
      margin-top: 2rem;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    /* Alert Styles */
    .alert-form {
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

    .alert-form.alert-success {
      border-left-color: var(--success);
      background-color: rgba(16, 185, 129, 0.05);
      color: var(--success);
    }

    .alert-form.alert-danger {
      border-left-color: var(--danger);
      background-color: rgba(239, 68, 68, 0.05);
      color: var(--danger);
    }

    .alert-form .close {
      background: none;
      border: none;
      cursor: pointer;
      color: var(--text-light);
      transition: color 0.2s;
      padding: 0;
      font-size: 1.5rem;
    }

    .alert-form .close:hover {
      color: var(--dark);
    }

    /* Card Styles */
    .form-card {
      background-color: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 20px var(--shadow);
      animation: fadeIn 0.5s ease-out;
    }

    .form-card-header {
      background: linear-gradient(135deg, var(--petugas-primary) 0%, var(--petugas-primary-dark) 100%);
      padding: 2rem;
      color: white;
    }

    .form-card-header h4 {
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0;
      color: white;
    }

    .form-card-body {
      padding: 2.5rem;
    }

    /* Form Groups */
    .form-group-custom {
      margin-bottom: 1.5rem;
    }

    .form-group-custom label {
      display: block;
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--dark);
      margin-bottom: 0.5rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .form-control-custom,
    .custom-select {
      width: 100%;
      padding: 0.75rem 1rem;
      font-size: 0.9375rem;
      line-height: 1.5;
      color: var(--text);
      background-color: var(--light);
      border: 2px solid var(--border);
      border-radius: 10px;
      transition: all 0.3s ease;
      font-family: inherit;
    }

    .form-control-custom:focus,
    .custom-select:focus {
      outline: none;
      border-color: var(--petugas-primary);
      background-color: white;
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    .form-control-custom::placeholder {
      color: var(--text-light);
    }

    .form-control-custom.is-invalid,
    .custom-select.is-invalid {
      border-color: var(--danger);
      background-color: rgba(239, 68, 68, 0.05);
    }

    .form-control-custom.is-invalid:focus,
    .custom-select.is-invalid:focus {
      box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .invalid-feedback-custom {
      display: none;
      font-size: 0.875rem;
      color: var(--danger);
      margin-top: 0.5rem;
      font-weight: 500;
    }

    .form-control-custom.is-invalid ~ .invalid-feedback-custom,
    .custom-select.is-invalid ~ .invalid-feedback-custom {
      display: block;
    }

    /* Submit Button */
    .btn-submit {
      width: 100%;
      padding: 1rem;
      background: linear-gradient(135deg, var(--petugas-primary) 0%, var(--petugas-primary-dark) 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
      margin-top: 2rem;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
      background: linear-gradient(135deg, var(--petugas-primary-dark) 0%, #1D4ED8 100%);
    }

    .btn-submit:active {
      transform: translateY(0);
    }

    .divider {
      border: none;
      height: 2px;
      background: linear-gradient(to right, transparent, var(--border), transparent);
      margin: 2rem 0 0 0;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
      .petugas-form-container { padding: 1.5rem 1rem; margin-top: 1rem; }
      .form-card-header { padding: 1.5rem; }
      .form-card-body { padding: 1.5rem; }
    }
  </style>

  <!-- Alert -->
  <?php if (session()->getFlashdata('msg')) : ?>
    <div class="alert-form alert-<?= session()->getFlashdata('error') == true ? 'danger' : 'success' ?>">
      <span><?= session()->getFlashdata('msg') ?></span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
    </div>
  <?php endif; ?>

  <!-- Card -->
  <div class="form-card">
    <div class="form-card-header">
      <h4>Form Edit Petugas</h4>
    </div>

    <div class="form-card-body">
      <form action="<?= base_url('admin/petugas/edit'); ?>" method="post">
        <?= csrf_field() ?>
        <?php $validation = \Config\Services::validation(); ?>

        <input type="hidden" name="id" value="<?= $data['id']; ?>">

        <div class="form-group-custom">
          <label for="username">Username</label>
          <input type="text" id="username" class="form-control-custom <?= $validation->getError('username') ? 'is-invalid' : ''; ?>" name="username" placeholder="username123" value="<?= old('username') ?? $oldInput['username'] ?? $data['username'] ?>">
          <div class="invalid-feedback-custom"><?= $validation->getError('username'); ?></div>
        </div>

        <div class="form-group-custom">
          <label for="email">Email</label>
          <input type="email" id="email" class="form-control-custom <?= $validation->getError('email') ? 'is-invalid' : ''; ?>" name="email" placeholder="email@example.com" value="<?= old('email') ?? $oldInput['email'] ?? $data['email'] ?>">
          <div class="invalid-feedback-custom"><?= $validation->getError('email'); ?></div>
        </div>

        <div class="form-group-custom">
          <label for="password">Password Baru</label>
          <input type="password" id="password" class="form-control-custom <?= $validation->getError('password') ? 'is-invalid' : ''; ?>" name="password" placeholder="Masukkan password baru (opsional)">
          <div class="invalid-feedback-custom"><?= $validation->getError('password'); ?></div>
        </div>

        <div class="form-group-custom">
          <label for="role">Role</label>
          <select class="custom-select <?= $validation->getError('role') ? 'is-invalid' : ''; ?>" id="role" name="role">
            <option value="">-- Pilih role --</option>
            <option value="0" <?= (old('role') ?? $oldInput['role'] ?? $data['is_superadmin']) == "0" ? 'selected' : ''; ?>>Petugas</option>
            <option value="1" <?= (old('role') ?? $oldInput['role'] ?? $data['is_superadmin']) == "1" ? 'selected' : ''; ?>>Super Admin</option>
          </select>
          <div class="invalid-feedback-custom"><?= $validation->getError('role'); ?></div>
        </div>

        <button type="submit" class="btn-submit">Simpan Perubahan</button>
        <hr class="divider">
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
