<?= $this->extend('templates/admin_layout'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="card-title mb-0">Pengaturan Waktu Absensi</h4>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('message')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('message'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('setting/waktu/update'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="card-title mb-0">Jam Masuk</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="waktu_masuk_mulai">Waktu Mulai</label>
                                            <input type="time" class="form-control" id="waktu_masuk_mulai" name="waktu_masuk_mulai" value="<?= $waktu_masuk['waktu_mulai'] ?? '06:00' ?>" required>
                                            <small class="text-muted">Waktu mulai absen masuk</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="waktu_masuk_selesai">Waktu Selesai</label>
                                            <input type="time" class="form-control" id="waktu_masuk_selesai" name="waktu_masuk_selesai" value="<?= $waktu_masuk['waktu_selesai'] ?? '07:30' ?>" required>
                                            <small class="text-muted">Batas akhir absen masuk</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-warning text-white">
                                        <h5 class="card-title mb-0">Jam Pulang</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="waktu_pulang_mulai">Waktu Mulai</label>
                                            <input type="time" class="form-control" id="waktu_pulang_mulai" name="waktu_pulang_mulai" value="<?= $waktu_pulang['waktu_mulai'] ?? '14:00' ?>" required>
                                            <small class="text-muted">Waktu mulai absen pulang</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="waktu_pulang_selesai">Waktu Selesai</label>
                                            <input type="time" class="form-control" id="waktu_pulang_selesai" name="waktu_pulang_selesai" value="<?= $waktu_pulang['waktu_selesai'] ?? '17:00' ?>" required>
                                            <small class="text-muted">Batas akhir absen pulang</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>