<div class="card-body">
    <div class="row">
        <div class="col-auto me-auto">
            <div class="pt-3 pl-3">
                <h4 class="font-weight-bold">Absen Siswa</h4>
                <p class="text-muted">Daftar siswa kelas <?= $kelas; ?></p>
            </div>
        </div>
        <div class="col">
            <a href="#" class="btn btn-outline-purple rounded-pill pl-3 mr-3 mt-3" onclick="kelas = onDateChange()" data-toggle="tab">
                <i class="material-icons mr-2">refresh</i> Refresh
            </a>
        </div>
        <div class="col-auto">
            <div class="px-4">
                <h3 class="text-end">
                    <span class="badge bg-purple text-white rounded-pill px-3 py-2"><?= $kelas; ?></span>
                </h3>
            </div>
        </div>
    </div>

    <div id="dataSiswa" class="card-body table-responsive pb-5">
        <?php if (!empty($data)) : ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><b>No.</b></th>
                        <th><b>NIS</b></th>
                        <th><b>Nama Siswa</b></th>
                        <th><b>Kehadiran</b></th>
                        <th><b>Jam masuk</b></th>
                        <th><b>Jam pulang</b></th>
                        <th><b>Keterangan</b></th>
                        <th><b>Aksi</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($data as $value) : ?>
                        <?php
                        $idKehadiran = intval($value['id_kehadiran'] ?? ($lewat ? 5 : 4));
                        $kehadiran = kehadiran($idKehadiran);
                        ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $value['nis']; ?></td>
                            <td><b><?= $value['nama_siswa']; ?></b></td>
                            <td>
                                <span class="badge status-badge bg-<?= $kehadiran['color']; ?> text-white text-center px-3 py-2">
                                    <?= $kehadiran['text']; ?>
                                </span>
                            </td>
                            <td><b><?= $value['jam_masuk'] ?? '-'; ?></b></td>
                            <td><b><?= $value['jam_keluar'] ?? '-'; ?></b></td>
                            <td><?= $value['keterangan'] ?? '-'; ?></td>
                            <td>
                                <?php if (!$lewat) : ?>
                                    <button data-toggle="modal" data-target="#ubahModal" onclick="getDataKehadiran(<?= $value['id_presensi'] ?? '-1'; ?>, <?= $value['id_siswa']; ?>)" class="btn btn-edit rounded-pill" id="<?= $value['nis']; ?>">
                                        <i class="material-icons">edit</i>
                                        Edit
                                    </button>
                                <?php else : ?>
                                    <button class="btn btn-disabled rounded-pill">No Action</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach ?>
                </tbody>
            </table>
        <?php
        else :
        ?>
            <div class="row">
                <div class="col">
                    <div class="empty-state">
                        <i class="material-icons">error_outline</i>
                        <h4 class="text-center text-danger">Data tidak ditemukan</h4>
                    </div>
                </div>
            </div>
        <?php
        endif; ?>
    </div>
</div>

<style>
    /* Custom Colors for Status */
    .bg-purple {
        background-color: #6200ee !important;
    }
    
    .text-white {
        color: #ffffff !important;
    }
    
    .bg-success {
        background-color: #0cbb34 !important;
    }
    
    .bg-warning {
        background-color: #ff9800 !important;
    }
    
    .bg-info {
        background-color: #03a9f4 !important;
    }
    
    .bg-danger {
        background-color: #f44336 !important;
    }
    
    .bg-disabled {
        background-color: #9e9e9e !important;
    }
    
    .badge {
        font-weight: 500;
        font-size: 0.85rem;
        border-radius: 50px;
        display: inline-block;
        padding: 5px 10px;
    }
    
    .status-badge {
        width: 140px;
    }
    
    .btn-edit {
        color: #6200ee;
        background-color: rgba(98, 0, 238, 0.1);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        transition: all 0.2s ease;
    }
    
    .btn-edit:hover {
        background-color: rgba(98, 0, 238, 0.2);
    }
    
    .btn-disabled {
        color: #757575;
        background-color: #f5f5f5;
        border: none;
        cursor: not-allowed;
    }
    
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }
    
    .empty-state i {
        font-size: 48px;
        color: #f44336;
        margin-bottom: 15px;
    }
</style>

<?php
function kehadiran($kehadiran): array
{
    $text = '';
    $color = '';
    switch ($kehadiran) {
        case 1:
            $color = 'success';
            $text = 'Hadir';
            break;
        case 2:
            $color = 'warning';
            $text = 'Sakit';
            break;
        case 3:
            $color = 'info';
            $text = 'Izin';
            break;
        case 4:
            $color = 'danger';
            $text = 'Tanpa keterangan';
            break;
        case 5:
        default:
            $color = 'disabled';
            $text = 'Belum tersedia';
            break;
    }

    return ['color' => $color, 'text' => $text];
}
?>