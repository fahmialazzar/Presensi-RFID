<div class="modal-body">
   <div class="container-fluid">
      <form id="formUbah">
         <input type="hidden" name="id_siswa" value="<?= $data['id_siswa'] ?? ''; ?>">
         <input type="hidden" name="id_guru" value="<?= $data['id_guru'] ?? ''; ?>">
         <input type="hidden" name="id_kelas" value="<?= $data['id_kelas'] ?? ''; ?>">

         <div class="form-group mb-4">
            <label for="kehadiran" class="form-label fw-bold">Kehadiran</label>
            <div class="kehadiran-options" id="kehadiran">
               <?php foreach ($listKehadiran as $value2) : ?>
                  <?php $kehadiran = kehadiran($value2['id_kehadiran']); ?>
                  <div class="kehadiran-option">
                     <input class="form-check-input" type="radio" name="id_kehadiran" id="k<?= $kehadiran['text']; ?>" value="<?= $value2['id_kehadiran']; ?>" <?= $value2['id_kehadiran'] == ($presensi['id_kehadiran'] ?? '4') ? 'checked' : ''; ?>>
                     <label class="form-check-label" for="k<?= $kehadiran['text']; ?>">
                        <span class="kehadiran-badge bg-<?= $kehadiran['color']; ?>"><?= $kehadiran['text']; ?></span>
                     </label>
                  </div>
               <?php endforeach; ?>
            </div>
         </div>

         <div class="row mb-4">
            <div class="col">
               <label for="jamMasuk" class="form-label fw-bold">Jam masuk</label>
               <input class="form-control rounded-pill" type="time" name="jam_masuk" id="jamMasuk" value="<?= $presensi['jam_masuk'] ?? ''; ?>">
            </div>
            <div class="col">
               <label for="jamKeluar" class="form-label fw-bold">Jam keluar</label>
               <input class="form-control rounded-pill" type="time" name="jam_keluar" id="jamKeluar" value="<?= $presensi['jam_keluar'] ?? ''; ?>">
            </div>
         </div>

         <div class="form-group mb-2">
            <label for="keterangan" class="form-label fw-bold">Keterangan</label>
            <textarea id="keterangan" name="keterangan" class="form-control rounded" rows="3"><?= trim($presensi['keterangan'] ?? ''); ?></textarea>
         </div>
      </form>
   </div>
</div>

<div class="modal-footer">
   <button type="button" class="btn btn-outline-secondary rounded-pill" data-dismiss="modal">Tutup</button>
   <button type="button" onclick="ubahKehadiran()" class="btn btn-purple rounded-pill" data-dismiss="modal">Ubah</button>
</div>

<style>
   /* Modal Specific Styles */
   .modal-body {
      padding: 20px;
   }
   
   .form-label {
      font-size: 0.9rem;
      margin-bottom: 8px;
      display: block;
      color: #424242;
   }
   
   .fw-bold {
      font-weight: 600;
   }
   
   .kehadiran-options {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 15px;
   }
   
   .kehadiran-option {
      display: flex;
      align-items: center;
      margin-right: 15px;
   }
   
   .kehadiran-option input {
      margin-right: 8px;
   }
   
   .kehadiran-badge {
      padding: 5px 12px;
      border-radius: 50px;
      color: white;
      font-size: 0.85rem;
      display: inline-block;
   }
   
   .rounded-pill {
      border-radius: 50px !important;
   }
   
   .btn-purple {
      background-color: #6200ee;
      color: white;
      border: none;
      padding: 8px 20px;
      font-weight: 500;
      transition: all 0.3s ease;
   }
   
   .btn-purple:hover {
      background-color: #4b01d7;
      box-shadow: 0 2px 8px rgba(98, 0, 238, 0.3);
   }
   
   .btn-outline-secondary {
      color: #616161;
      background-color: transparent;
      border: 1px solid #9e9e9e;
   }
   
   .btn-outline-secondary:hover {
      background-color: #f5f5f5;
   }
   
   .form-control {
      padding: 10px 15px;
      border: 1px solid #e0e0e0;
      transition: all 0.2s ease;
   }
   
   .form-control:focus {
      border-color: #6200ee;
      box-shadow: 0 0 0 2px rgba(98, 0, 238, 0.15);
   }
   
   textarea.form-control {
      min-height: 80px;
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