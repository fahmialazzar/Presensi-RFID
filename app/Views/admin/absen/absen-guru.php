<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <!-- Date selection card -->
      <div class="card shadow-sm rounded-lg mb-4">
         <div class="card-body p-4">
            <h4 class="mb-3" style="font-weight: 600; font-size: 16px;">Tanggal</h4>
            <input class="form-control" type="date" name="tangal" id="tanggal" value="<?= date('Y-m-d'); ?>" onchange="getGuru()" style="max-width: 200px; border-radius: 10px; border: 1px solid #eaeaea;">
         </div>
      </div>
      
      <!-- Teacher attendance card -->
      <div class="card shadow-sm rounded-lg">
         <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
               <div>
                  <h4 style="font-weight: 600; font-size: 18px;">Presensi Guru</h4>
                  <p class="text-muted" style="font-size: 14px;">Daftar guru muncul disini</p>
               </div>
               <button onclick="getGuru()" class="btn" style="background-color: #ffffff; border: 1.5px solid #28a745; color: #28a745; border-radius: 10px; padding: 8px 16px; font-weight: 500;">
                  <i class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">refresh</i> Refresh
               </button>
            </div>

            <div id="dataGuru" class="mt-3">
               <!-- Data will be loaded here -->
            </div>
         </div>
      </div>
   </div>

   <!-- Modal with iOS-style design -->
   <div class="modal fade" id="ubahModal" tabindex="-1" aria-labelledby="modalUbahKehadiran" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header" style="border-bottom: 1px solid #f0f0f0; padding: 16px 20px;">
               <h5 class="modal-title" id="modalUbahKehadiran" style="font-weight: 600; font-size: 16px;">Ubah kehadiran</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div id="modalFormUbahGuru"></div>
         </div>
      </div>
   </div>
</div>

<style>
/* iOS-like styling */
.card {
   border: none;
   border-radius: 14px;
   box-shadow: 0 2px 10px rgba(0,0,0,0.05);
   margin-bottom: 16px;
}

.table {
   border-collapse: separate;
   border-spacing: 0;
}

.table thead th {
   border-top: none;
   border-bottom: 1px solid #f0f0f0;
   font-weight: 600;
   font-size: 13px;
   color: #28a745;
   padding: 16px 12px;
}

.table tbody td {
   padding: 14px 12px;
   border-top: none;
   border-bottom: 1px solid #f0f0f0;
   vertical-align: middle;
   font-size: 14px;
}

.table tbody tr:last-child td {
   border-bottom: none;
}

.btn {
   font-size: 14px;
   font-weight: 500;
   border-radius: 10px;
   padding: 8px 16px;
   transition: all 0.2s ease;
}

.btn-info {
   background-color: #ffffff;
   border: 1.5px solid #17a2b8;
   color: #17a2b8;
}

.btn-info:hover {
   background-color: #f8f9fa;
   color: #17a2b8;
}

.form-control {
   border-radius: 10px;
   padding: 10px 14px;
   border: 1px solid #eaeaea;
   transition: all 0.2s ease;
}

.form-control:focus {
   box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.25);
   border-color: #28a745;
}
</style>

<script>
   getGuru();

   function getGuru() {
      var tanggal = $('#tanggal').val();

      jQuery.ajax({
         url: "<?= base_url('/admin/absen-guru'); ?>",
         type: 'post',
         data: {
            'tanggal': tanggal
         },
         success: function(response, status, xhr) {
            $('#dataGuru').html(response);

            $('html, body').animate({
               scrollTop: $("#dataGuru").offset().top
            }, 500);
         },
         error: function(xhr, status, thrown) {
            console.log(thrown);
            $('#dataGuru').html(thrown);
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

      jQuery.ajax({
         url: "<?= base_url('/admin/absen-guru/edit'); ?>",
         type: 'post',
         data: form,
         success: function(response, status, xhr) {
            if (response['status']) {
               alert('Berhasil ubah kehadiran : ' + response['nama_guru']);
            } else {
               alert('Gagal ubah kehadiran : ' + response['nama_guru']);
            }

            getGuru();
         },
         error: function(xhr, status, thrown) {
            console.log(thrown);
            alert('Gagal ubah kehadiran\n' + thrown);
         }
      });
   }

   function getDataKehadiran(idPresensi, idGuru) {
      jQuery.ajax({
         url: "<?= base_url('/admin/absen-guru/kehadiran'); ?>",
         type: 'post',
         data: {
            'id_presensi': idPresensi,
            'id_guru': idGuru
         },
         success: function(response, status, xhr) {
            $('#modalFormUbahGuru').html(response);
         },
         error: function(xhr, status, thrown) {
            console.log(thrown);
            $('#modalFormUbahGuru').html(thrown);
         }
      });
   }
</script>
<?= $this->endSection() ?>