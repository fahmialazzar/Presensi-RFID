<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card shadow-sm rounded-lg">
               <div class="card-body">
                  <div class="row justify-content-between">
                     <div class="col">
                        <div class="pt-3 pl-3">
                           <h4 class="font-weight-bold">Daftar Kelas</h4>
                           <p class="text-muted">Silakan pilih kelas</p>
                        </div>
                     </div>
                  </div>

                  <div class="card-body pt-1 px-3">
                     <div class="row g-3">
                        <?php foreach ($kelas as $value) : ?>
                           <?php
                           $idKelas = $value['id_kelas'];
                           $namaKelas =  $value['kelas'] . ' ' . $value['jurusan'];
                           ?>
                           <div class="col-md-3 mb-3">
                              <button id="kelas-<?= $idKelas; ?>" onclick="getSiswa(<?= $idKelas; ?>, '<?= $namaKelas; ?>')" class="btn btn-outline-purple kelas-btn w-100">
                                 <?= $namaKelas; ?>
                              </button>
                           </div>
                        <?php endforeach; ?>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-3">
                        <div class="pt-3 pl-3 pb-2">
                           <h4 class="font-weight-bold">Tanggal</h4>
                           <input class="form-control rounded-pill" type="date" name="tangal" id="tanggal" value="<?= date('Y-m-d'); ?>" onchange="onDateChange()">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="card shadow-sm rounded-lg mt-4" id="dataSiswa">
         <div class="card-body">
            <div class="row justify-content-between">
               <div class="col-auto me-auto">
                  <div class="pt-3 pl-3">
                     <h4 class="font-weight-bold">Presensi Siswa</h4>
                     <p class="text-muted">Daftar siswa muncul disini</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Modal ubah kehadiran -->
   <div class="modal fade" id="ubahModal" tabindex="-1" aria-labelledby="modalUbahKehadiran" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content rounded-lg">
            <div class="modal-header">
               <h5 class="modal-title font-weight-bold" id="modalUbahKehadiran">Ubah kehadiran</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div id="modalFormUbahSiswa"></div>
         </div>
      </div>
   </div>
</div>

<style>
   /* Custom Purple Theme */
   :root {
      --purple-primary: #6200ee;
      --purple-light: #e8ddff;
      --purple-dark: #4b01d7;
      --white: #ffffff;
   }

   body {
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
   }

   .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      background-color: var(--white);
      margin-bottom: 20px;
   }

   .btn-outline-purple {
      color: var(--purple-primary);
      background-color: var(--white);
      border: 2px solid var(--purple-primary);
      border-radius: 12px;
      font-weight: 500;
      padding: 10px 15px;
      transition: all 0.3s ease;
      margin-bottom: 10px;
   }

   .btn-outline-purple:hover {
      background-color: var(--purple-light);
      color: var(--purple-primary);
      border-color: var(--purple-primary);
   }

   .btn-outline-purple.active {
      background-color: var(--white);
      color: var(--purple-primary);
      border-color: var(--purple-primary);
      box-shadow: 0 2px 8px rgba(98, 0, 238, 0.25);
   }

   .rounded-pill {
      border-radius: 50px !important;
   }

   .rounded-lg {
      border-radius: 12px !important;
   }

   .shadow-sm {
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
   }

   .form-control {
      border: 1px solid #e0e0e0;
      padding: 10px 15px;
   }

   .form-control:focus {
      border-color: var(--purple-primary);
      box-shadow: 0 0 0 2px rgba(98, 0, 238, 0.25);
   }

   .kelas-btn {
      margin-right: 10px;
      margin-bottom: 10px;
   }

   table {
      border-collapse: separate;
      border-spacing: 0;
      width: 100%;
      border-radius: 12px;
      overflow: hidden;
   }

   th {
      background-color: #f8f9fa;
      color: #495057;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.8rem;
      letter-spacing: 0.5px;
   }

   td, th {
      padding: 12px 15px;
      border-bottom: 1px solid #e9ecef;
   }

   /* Modal Styles */
   .modal-content {
      border: none;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
   }

   .modal-header {
      border-bottom: 1px solid #f0f0f0;
      padding: 15px 20px;
   }

   .modal-body {
      padding: 20px;
   }

   .modal-footer {
      border-top: 1px solid #f0f0f0;
      padding: 15px 20px;
   }
</style>

<script>
   var lastIdKelas;
   var lastKelas;

   function onDateChange() {
      if (lastIdKelas != null && lastKelas != null) getSiswa(lastIdKelas, lastKelas);
   }

   function getSiswa(idKelas, kelas) {
      var tanggal = $('#tanggal').val();

      updateBtn(idKelas);

      jQuery.ajax({
         url: "<?= base_url('/admin/absen-siswa'); ?>",
         type: 'post',
         data: {
            'kelas': kelas,
            'id_kelas': idKelas,
            'tanggal': tanggal
         },
         success: function(response, status, xhr) {
            $('#dataSiswa').html(response);

            $('html, body').animate({
               scrollTop: $("#dataSiswa").offset().top
            }, 500);
         },
         error: function(xhr, status, thrown) {
            console.log(thrown);
            $('#dataSiswa').html(thrown);
         }
      });

      lastIdKelas = idKelas;
      lastKelas = kelas;
   }

   function updateBtn(id_btn) {
      for (let index = 1; index <= <?= count($kelas); ?>; index++) {
         if (index != id_btn) {
            $('#kelas-' + index).removeClass('active');
         } else {
            $('#kelas-' + index).addClass('active');
         }
      }
   }

   function getDataKehadiran(idPresensi, idSiswa) {
      jQuery.ajax({
         url: "<?= base_url('/admin/absen-siswa/kehadiran'); ?>",
         type: 'post',
         data: {
            'id_presensi': idPresensi,
            'id_siswa': idSiswa
         },
         success: function(response, status, xhr) {
            $('#modalFormUbahSiswa').html(response);
         },
         error: function(xhr, status, thrown) {
            console.log(thrown);
            $('#modalFormUbahSiswa').html(thrown);
         }
      });
   }

   function ubahKehadiran() {
      var tanggal = $('#tanggal').val();

      var form = $('#formUbah').serializeArray();

      form.push({
         name: 'tanggal',
         value: tanggal
      });

      console.log(form);

      jQuery.ajax({
         url: "<?= base_url('/admin/absen-siswa/edit'); ?>",
         type: 'post',
         data: form,
         success: function(response, status, xhr) {
            if (response['status']) {
               getSiswa(lastIdKelas, lastKelas);
               alert('Berhasil ubah kehadiran : ' + response['nama_siswa']);
            } else {
               alert('Gagal ubah kehadiran : ' + response['nama_siswa']);
            }
         },
         error: function(xhr, status, thrown) {
            console.log(thrown);
            alert('Gagal ubah kehadiran\n' + thrown);
         }
      });
   }
</script>
<?= $this->endSection() ?>