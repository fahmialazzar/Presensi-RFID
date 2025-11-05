<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="guru-form-container">
    <style>
        :root {
            /* Green theme for Guru section */
            --guru-primary: #10B981;
            --guru-primary-light: #ECFDF5;
            --guru-primary-dark: #059669;
            --guru-secondary: #A7F3D0;
            --guru-accent: #6EE7B7;
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
        
        .guru-form-container {
            max-width: 1200px;
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
            margin: 0;
            font-size: 1.5rem;
            line-height: 1;
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
            background: linear-gradient(135deg, var(--guru-primary) 0%, var(--guru-primary-dark) 100%);
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
        
        .form-control-custom {
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
        
        .form-control-custom:focus {
            outline: none;
            border-color: var(--guru-primary);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
        
        .form-control-custom::placeholder {
            color: var(--text-light);
        }
        
        .form-control-custom.is-invalid {
            border-color: var(--danger);
            background-color: rgba(239, 68, 68, 0.05);
        }
        
        .form-control-custom.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }
        
        /* Invalid Feedback */
        .invalid-feedback-custom {
            display: none;
            font-size: 0.875rem;
            color: var(--danger);
            margin-top: 0.5rem;
            font-weight: 500;
        }
        
        .form-control-custom.is-invalid ~ .invalid-feedback-custom {
            display: block;
        }
        
        /* Radio Button Group */
        .radio-group {
            display: flex;
            gap: 2rem;
            padding: 0.75rem 1rem;
            background-color: var(--light);
            border: 2px solid var(--border);
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .radio-group.is-invalid {
            border-color: var(--danger);
            background-color: rgba(239, 68, 68, 0.05);
        }
        
        .radio-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        
        .radio-option input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--guru-primary);
        }
        
        .radio-option label {
            margin: 0;
            font-size: 0.9375rem;
            font-weight: 500;
            color: var(--text);
            cursor: pointer;
            text-transform: none;
            letter-spacing: normal;
        }
        
        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--guru-primary) 0%, var(--guru-primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            margin-top: 2rem;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            background: linear-gradient(135deg, var(--guru-primary-dark) 0%, #047857 100%);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        /* Divider */
        .divider {
            border: none;
            height: 2px;
            background: linear-gradient(to right, transparent, var(--border), transparent);
            margin: 2rem 0 0 0;
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
        @media (max-width: 768px) {
            .guru-form-container {
                padding: 1.5rem 1rem;
                margin-top: 1rem;
            }
            
            .form-card-header {
                padding: 1.5rem;
            }
            
            .form-card-header h4 {
                font-size: 1.25rem;
            }
            
            .form-card-body {
                padding: 1.5rem;
            }
            
            .radio-group {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>

    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('msg')) : ?>
        <div class="alert-form alert-<?= session()->getFlashdata('error') == true ? 'danger' : 'success'  ?>">
            <span><?= session()->getFlashdata('msg') ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Form Card -->
    <div class="form-card">
        <div class="form-card-header">
            <h4>Form Edit Guru</h4>
        </div>
        
        <div class="form-card-body">
            <form action="<?= base_url('admin/guru/edit'); ?>" method="post">
                <?= csrf_field() ?>
                <?php $validation = \Config\Services::validation(); ?>

                <!-- Hidden ID -->
                <input type="hidden" name="id" value="<?= $data['id_guru'] ?>">

                <!-- NUPTK -->
                <div class="form-group-custom">
                    <label for="nuptk">NUPTK</label>
                    <input type="text" 
                           id="nuptk" 
                           class="form-control-custom <?= $validation->getError('nuptk') ? 'is-invalid' : ''; ?>" 
                           name="nuptk" 
                           placeholder="1234" 
                           value="<?= old('nuptk') ?? $oldInput['nuptk'] ?? $data['nuptk'] ?>">
                    <div class="invalid-feedback-custom">
                        <?= $validation->getError('nuptk'); ?>
                    </div>
                </div>

                <!-- Nama Lengkap -->
                <div class="form-group-custom">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" 
                           id="nama" 
                           class="form-control-custom <?= $validation->getError('nama') ? 'is-invalid' : ''; ?>" 
                           name="nama" 
                           placeholder="Your Name" 
                           value="<?= old('nama') ?? $oldInput['nama'] ?? $data['nama_guru'] ?>" 
                           required>
                    <div class="invalid-feedback-custom">
                        <?= $validation->getError('nama'); ?>
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-group-custom">
                    <label for="jk">Jenis Kelamin</label>
                    <?php
                    $jenisKelamin = (old('jk') ?? $oldInput['jk'] ?? $data['jenis_kelamin']);
                    $l = $jenisKelamin == 'Laki-laki' || $jenisKelamin == '1' ? 'checked' : '';
                    $p = $jenisKelamin == 'Perempuan' || $jenisKelamin == '2' ? 'checked' : '';
                    ?>
                    <div class="radio-group <?= $validation->getError('jk') ? 'is-invalid' : ''; ?>">
                        <div class="radio-option">
                            <input type="radio" name="jk" id="laki" value="1" <?= $l; ?>>
                            <label for="laki">Laki-laki</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="jk" id="perempuan" value="2" <?= $p; ?>>
                            <label for="perempuan">Perempuan</label>
                        </div>
                    </div>
                    <div class="invalid-feedback-custom">
                        <?= $validation->getError('jk'); ?>
                    </div>
                </div>

                <!-- Tanggal Lahir -->
                <div class="form-group-custom">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" 
                           id="tgl_lahir" 
                           class="form-control-custom <?= $validation->getError('tgl_lahir') ? 'is-invalid' : ''; ?>" 
                           name="tgl_lahir" 
                           value="<?= old('tgl_lahir') ?? $oldInput['tgl_lahir'] ?? $data['tgl_lahir'] ?>">
                    <div class="invalid-feedback-custom">
                        <?= $validation->getError('tgl_lahir'); ?>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="form-group-custom">
                    <label for="alamat">Alamat</label>
                    <input type="text" 
                           id="alamat" 
                           name="alamat" 
                           class="form-control-custom" 
                           placeholder="Masukkan alamat lengkap"
                           value="<?= old('alamat') ?? $oldInput['alamat'] ?? $data['alamat'] ?>">
                </div>

                <!-- Tap Kartu RFID -->
                <div class="form-group-custom">
                    <label for="unique_code">Tap Kartu RFID</label>
                    <input type="text" 
                           id="unique_code" 
                           class="form-control-custom <?= $validation->getError('unique_code') ? 'is-invalid' : ''; ?>" 
                           name="unique_code" 
                           value="<?= old('unique_code') ?? $oldInput['unique_code'] ?? $data['unique_code'] ?>"
                           placeholder="Tempelkan kartu RFID...">
                    <div class="invalid-feedback-custom">
                        <?= $validation->getError('unique_code'); ?>
                    </div>
                </div>

                <!-- No HP -->
                <div class="form-group-custom">
                    <label for="hp">No HP</label>
                    <input type="number" 
                           id="hp" 
                           name="no_hp" 
                           class="form-control-custom <?= $validation->getError('no_hp') ? 'is-invalid' : ''; ?>" 
                           placeholder="08969xxx" 
                           value="<?= old('no_hp') ?? $oldInput['no_hp'] ?? $data['no_hp'] ?>" 
                           required>
                    <div class="invalid-feedback-custom">
                        <?= $validation->getError('no_hp'); ?>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit">Simpan</button>

                <!-- Divider -->
                <hr class="divider">
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>