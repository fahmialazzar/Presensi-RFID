<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, rgba(173, 216, 230, 0.8), rgba(255, 290, 275, 0.8));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(15px);
        }
        .login-container {
            display: flex;
            width: 80%;
            max-width: 900px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }
        .login-form {
            flex: 1;
            padding: 40px;
        }
        .login-image {
    flex: 1.5;
    background: url('/assets/img/smksalogin2.png') no-repeat center 40%;
    background-size: cover;
    min-height: 400px;
}

        .btn-scan {
            position: absolute;
            top: 20px;
            left: 20px;
            background: transparent;
            border: none;
            padding: 10px;
        }
        .btn-primary {
            background-color: #001f3f;
            border-color: #001f3f;
        }
        .btn-primary:hover {
            background-color: #00152b;
            border-color: #000f20;
        }
    </style>
</head>
<body>
    <!-- <a href="< ?= base_url('/'); ?>" class="btn-scan">
        <img src="assets\img\sidebar\smksa.png" alt="QR Code" width="90">
    </a> -->
    <div class="login-container">
        <div class="login-form">
            <h2 class="mb-1 text">LOGIN SISTEM ABSENSI</h2>
            <p class="text-muted">Silahkan masukkan username dan password Anda</p>
            <?= view('\App\Views\admin\_message_block') ?>
            <form action="<?= url_to('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Email atau Username</label>
                    <input type="text" name="login" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.login') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                    </div>
                </div>
                    </br>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <p class="mt-3"><a href="<?= url_to('forgot') ?>">Lupa Password?</a></p>
            </form>
        </div>
        <div class="login-image"></div>
    </div>
</body>
</html>
