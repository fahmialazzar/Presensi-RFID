<div id="dataSiswa" class="card-body table-responsive pb-5">
   <?php if (!empty($data)) : ?>
      <table class="table">
         <thead>
            <th><b>No.</b></th>
            <th><b>NUPTK</b></th>
            <th><b>Nama Guru</b></th>
            <th><b>Kehadiran</b></th>
            <th><b>Jam masuk</b></th>
            <th><b>Jam pulang</b></th>
            <th><b>Keterangan</b></th>
            <th><b>Aksi</b></th>
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
                  <td><?= $value['nuptk']; ?></td>
                  <td><b><?= $value['nama_guru']; ?></b></td>
                  <td>
                     <span class="badge badge-pill" style="background-color: <?= getBadgeColor($kehadiran['color']); ?>; color: <?= getTextColor($kehadiran['color']); ?>; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 500;">
                        <?= $kehadiran['text']; ?>
                     </span>
                  </td>
                  <td><?= $value['jam_masuk'] ?? '-'; ?></td>
                  <td><?= $value['jam_keluar'] ?? '-'; ?></td>
                  <td><?= $value['keterangan'] ?? '-'; ?></td>
                  <td>
                     <?php if (!$lewat) : ?>
                        <button data-toggle="modal" data-target="#ubahModal" onclick="getDataKehadiran(<?= $value['id_presensi'] ?? '-1'; ?>, <?= $value['id_guru']; ?>)" class="btn btn-info" style="padding: 6px 12px;" id="<?= $value['id_guru']; ?>">
                           <i class="material-icons" style="font-size: 14px; vertical-align: middle; margin-right: 2px;">edit</i>
                           Edit
                        </button>
                     <?php else : ?>
                        <button class="btn" style="background-color: #f8f9fa; color: #adb5bd; padding: 6px 12px; cursor: not-allowed;">No Action</button>
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
      <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
         <div class="text-center">
            <i class="material-icons" style="font-size: 48px; color: #dc3545; margin-bottom: 16px;">search_off</i>
            <h5 class="text-danger">Data tidak ditemukan</h5>
         </div>
      </div>
   <?php
   endif; ?>
</div>

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

function getBadgeColor($color): string
{
   switch ($color) {
      case 'success':
         return '#e8f5e9';
      case 'warning':
         return '#fff8e1';
      case 'info':
         return '#e1f5fe';
      case 'danger':
         return '#ffebee';
      case 'disabled':
      default:
         return '#f5f5f5';
   }
}

function getTextColor($color): string
{
   switch ($color) {
      case 'success':
         return '#2e7d32';
      case 'warning':
         return '#f57f17';
      case 'info':
         return '#0277bd';
      case 'danger':
         return '#c62828';
      case 'disabled':
      default:
         return '#757575';
   }
}
?>