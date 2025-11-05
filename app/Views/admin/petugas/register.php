<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<div class="petugas-form-container">
    <style>
        :root {
            /* Blue iOS theme for Petugas section */
            --petugas-primary: #007AFF;
            --petugas-primary-light: #E5F1FF;
            --petugas-primary-dark: #0051D5;
            --petugas-secondary: #5AC8FA;
            --success: #007AFF;
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
            background-color: rgba(0, 122, 255, 0.05);
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
            background: linear-gradient(135deg, var(--petugas-primary) 0%, var(--petugas-primary-dark) 100%);
            padding: 2rem;
            color: white;
        }

        .form-card-header h4 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .form-card-header p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.25rem;
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
        }

        .form-control-custom:focus {
            outline: none;
            border-color: var(--petugas-primary);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.1);
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

        /* Button */
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
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 122, 255, 0.3);
            margin-top: 1rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 122, 255, 0.4);
            background: linear-gradient(135deg, var(--petugas-primary-dark), #0041A8);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            border: none;
            height: 2px;
            background: linear-gradient(to right, transparent, var(--border), transparent);
            margin-top: 2rem;
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
            .petugas-form-container {
                padding: 1.5rem 1rem;
                margin-top: 1rem;
            }

            .form-card-header {
                padding: 1.5rem;
            }

            .form-card-body {
                padding: 1.5rem;
            }
        }
    </style>

    <!-- Alert -->
    <?= view('Myth\Auth\Views\_message_block') ?>

    <!-- Form Card -->
    <div class="form-card">
        <div class="form-card-header">
            <h4><?= lang('Auth.register') ?></h4>
            <p>Buat akun Petugas</p>
        </div>

        <div class="form-card-body">
            <form action="<?= url_to('register') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Email -->
                <div class="form-group-custom">
                    <label for="email"><?= lang('Auth.email') ?></label>
                    <input type="email"
                           id="email"
                           name="email"
                           class="form-control-custom <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                           placeholder="example@email.com"
                           value="<?= old('email') ?>">
                    <div class="invalid-feedback-custom"><?= session('errors.email') ?></div>
                </div>

                <!-- Username -->
                <div class="form-group-custom">
                    <label for="username"><?= lang('Auth.username') ?></label>
                    <input type="text"
                           id="username"
                           name="username"
                           class="form-control-custom <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>"
                           placeholder="yourusername"
                           value="<?= old('username') ?>">
                    <div class="invalid-feedback-custom"><?= session('errors.username') ?></div>
                </div>

                <!-- Password -->
                <div class="form-group-custom">
                    <label for="password"><?= lang('Auth.password') ?></label>
                    <input type="password"
                           id="password"
                           name="password"
                           class="form-control-custom <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                           placeholder="********">
                    <div class="invalid-feedback-custom"><?= session('errors.password') ?></div>
                </div>

                <!-- Repeat Password -->
                <div class="form-group-custom">
                    <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                    <input type="password"
                           id="pass_confirm"
                           name="pass_confirm"
                           class="form-control-custom <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                           placeholder="********">
                    <div class="invalid-feedback-custom"><?= session('errors.pass_confirm') ?></div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit"><?= lang('Auth.register') ?></button>
                <hr class="divider">
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
