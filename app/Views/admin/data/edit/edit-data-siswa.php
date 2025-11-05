<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="siswa-form-container">
    <style>
        :root {
            /* Purple theme for Siswa section */
            --siswa-primary: #8B5CF6;
            --siswa-primary-light: #F5F3FF;
            --siswa-primary-dark: #6D28D9;
            --siswa-secondary: #C4B5FD;
            --siswa-accent: #A78BFA;
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
        
        .siswa-form-container {
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
            font-weight: 600;
            font-size: 0.9375rem;
        }
        
        .alert-form.alert-success {
            border-left-color: var(--success);
            background-color: rgba(16, 185, 129, 0.15);
            color: #047857;
        }
        
        .alert-form.alert-danger {
            border-left-color: var(--danger);
            background-color: rgba(239, 68, 68, 0.15);
            color: #B91C1C;
        }
        
        .alert-form .close {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-light);
            transition: color 0.2s;
            padding: 0;
            margin: 0;
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
            background: linear-gradient(135deg, var(--siswa-primary) 0%, var(--siswa-primary-dark) 100%);
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
            border-color: var(--siswa-primary);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
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
        
        /* Select Dropdown */
        select.form-control-custom {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236B7280' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
            cursor: pointer;
        }
        
        /* Textarea */
        textarea.form-control-custom {
            resize: vertical;
            min-height: 100px;
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
            accent-color: var(--siswa-primary);
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
        
        /* Row for side-by-side fields */
        .form-row-custom {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--siswa-primary) 0%, var(--siswa-primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
            margin-top: 2rem;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
            background: linear-gradient(135deg, var(--siswa-primary-dark) 0%, #5B21B6 100%);
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
            .siswa-form-container {
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
            
            .form-row-custom {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            .radio-group {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
    
    <div class="container-fluid">
        <div class="form-card">
            <div class="form-card-header">
                <h4>Form Edit Siswa</h4>
            </div>
            
            <div class="form-card-body">
                <form action="<?= base_url('admin/siswa/edit'); ?>" method="post">
                    <?= csrf_field() ?>
                    <?php $validation = \Config\Services::validation(); ?>

                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div class="alert-form alert-<?= session()->getFlashdata('error') == true ? 'danger' : 'success' ?>">
                            <span><?= session()->getFlashdata('msg') ?></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                    <?php endif; ?>

                    <input type="hidden" name="id" value="<?= $data['id_siswa']; ?>">

                    <div class="form-group-custom">
                        <label for="nis">NIS</label>
                        <input type="text" 
                               id="nis" 
                               class="form-control-custom <?= $validation->getError('nis') ? 'is-invalid' : ''; ?>" 
                               name="nis" 
                               placeholder="Masukkan NIS (contoh: 1234)" 
                               value="<?= old('nis') ?? $oldInput['nis'] ?? $data['nis'] ?>">
                        <div class="invalid-feedback-custom">
                            <?= $validation->getError('nis'); ?>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" 
                               id="nama" 
                               class="form-control-custom <?= $validation->getError('nama') ? 'is-invalid' : ''; ?>" 
                               name="nama" 
                               placeholder="Masukkan nama lengkap siswa" 
                               value="<?= old('nama') ?? $oldInput['nama'] ?? $data['nama_siswa'] ?>">
                        <div class="invalid-feedback-custom">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>

                    <div class="form-row-custom">
                        <div class="form-group-custom">
                            <label for="kelas">Kelas</label>
                            <select class="form-control-custom <?= $validation->getError('id_kelas') ? 'is-invalid' : ''; ?>" 
                                    id="kelas" 
                                    name="id_kelas">
                                <option value="">-- Pilih Kelas --</option>
                                <?php foreach ($kelas as $value) : ?>
                                    <option value="<?= $value['id_kelas']; ?>" 
                                            <?= old('id_kelas') ?? $oldInput['id_kelas'] ?? $value['id_kelas'] == $data['id_kelas'] ? 'selected' : ''; ?>>
                                        <?= $value['kelas'] . ' ' . $value['jurusan']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback-custom">
                                <?= $validation->getError('id_kelas'); ?>
                            </div>
                        </div>

                        <div class="form-group-custom">
                            <label>Jenis Kelamin</label>
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
                    </div>

                    <div class="form-group-custom">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" 
                               id="tgl_lahir" 
                               class="form-control-custom <?= $validation->getError('tgl_lahir') ? 'is-invalid' : ''; ?>" 
                               name="tgl_lahir" 
                               value="<?= old('tgl_lahir') ?? $oldInput['tgl_lahir'] ?? $data['tgl_lahir'] ?? '' ?>">
                        <div class="invalid-feedback-custom">
                            <?= $validation->getError('tgl_lahir'); ?>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label for="unique_code">Tap Kartu RFID</label>
                        <input type="text" 
                               id="unique_code" 
                               class="form-control-custom <?= $validation->getError('unique_code') ? 'is-invalid' : ''; ?>" 
                               name="unique_code" 
                               value="<?= old('unique_code') ?? $oldInput['unique_code'] ?? $data['unique_code'] ?? '' ?>"
                               placeholder="Tempelkan kartu RFID pada reader...">
                        <div class="invalid-feedback-custom">
                            <?= $validation->getError('unique_code'); ?>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label for="hp">Nomor HP</label>
                        <input type="number" 
                               id="hp" 
                               name="no_hp" 
                               class="form-control-custom <?= $validation->getError('no_hp') ? 'is-invalid' : ''; ?>" 
                               placeholder="Contoh: 08123456789"
                               value="<?= old('no_hp') ?? $oldInput['no_hp'] ?? $data['no_hp'] ?>">
                        <div class="invalid-feedback-custom">
                            <?= $validation->getError('no_hp'); ?>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" 
                                  name="alamat" 
                                  rows="3" 
                                  class="form-control-custom <?= $validation->getError('alamat') ? 'is-invalid' : ''; ?>" 
                                  placeholder="Masukkan alamat lengkap siswa"><?= old('alamat') ?? $oldInput['alamat'] ?? $data['alamat'] ?? '' ?></textarea>
                        <div class="invalid-feedback-custom">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        Perbarui Data Siswa
                    </button>
                </form>

                <hr class="divider">
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>