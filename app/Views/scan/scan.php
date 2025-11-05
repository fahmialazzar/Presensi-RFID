<?= $this->extend('templates/starting_page_layout'); ?>

<?= $this->section('navaction') ?>
<a href="<?= base_url('/admin'); ?>" class="btn btn-pill px-4 py-2 shadow-sm">
   <i class="material-icons align-middle mr-2" style="font-size: 18px;">dashboard</i>
   <span>Dashboard</span>
</a>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<?php
$oppBtn = '';
$waktu == 'Masuk' ? $oppBtn = 'pulang' : $oppBtn = 'masuk';
?>

<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row justify-content-center">
            <!-- Main Scanner Card -->
            <div class="col-lg-7 col-xl-6 mb-4">
               <div class="card shadow-sm rounded-lg overflow-hidden">
               <div class="card-header bg-gradient-primary text-white py-3 px-4">
               <div class="d-flex justify-content-between align-items-center">
               <div class="d-flex align-items-center gap-2">
         <button id="refreshPage" class="btn btn-light btn-sm rounded-pill shadow-sm me-2">🔄 Refresh</button>
         <button id="toggleFullScreen" class="btn btn-light btn-sm rounded-pill shadow-sm">🔳 Maximize</button>
      </div>
                  <div>
                     <h4 class="mb-0 font-weight-bold">Absen <?= $waktu; ?></h4>
                     <p class="mb-0 text-white-50">Tunjukkan QR Code Anda</p>
                  </div>
                  
                 
                  <div class="text-white">
                     <span class="bg-<?= $waktu == 'Masuk' ? 'success' : 'warning'; ?> px-3 py-1 rounded-pill">
                        Mode: <?= $waktu; ?> (Otomatis)
                     </span>
                  </div>
               </div>

               <div class="card-header bg-light py-2 px-4">
                  <div class="d-flex justify-content-between align-items-center">
                     <div>
                        <span class="font-weight-bold">Waktu Server:</span>
                     </div>
                     <div>
                        <h3 id="current-time" class="mb-0 font-weight-bold text-primary">00:00:00</h3>
                     </div>
                  </div>
                  </div>
            </div>
                  <div class="card-body p-4">
                     <div class="form-group mb-4">
                        <label for="pilihKamera" class="font-weight-medium mb-2">Pilih Kamera</label>
                        <select id="pilihKamera" class="form-control rounded-pill">
                           <option selected>Select camera devices</option>
                        </select>
                     </div>
                     <div class="attendance-times my-3 p-3 rounded bg-light">
   <div class="d-flex justify-content-between mb-2">
      <div>
         <strong>Jam Masuk:</strong> 
         <span class="badge bg-success text-white"><?= $settings['masuk_start'] ?> - <?= $settings['masuk_end'] ?></span>
      </div>
      <div>
         <strong>Jam Pulang:</strong> 
         <span class="badge bg-warning text-white"><?= $settings['pulang_start'] ?> - <?= $settings['pulang_end'] ?></span>
      </div>
   </div>
   <?php if (session()->get('isLoggedIn') && session()->get('level') == 'admin'): ?>
   <div class="text-right">
      <a href="<?= base_url('admin/attendance-settings') ?>" class="btn btn-sm btn-primary">
         <i class="material-icons align-middle" style="font-size: 16px;">settings</i> 
         Pengaturan Waktu
      </a>
   </div>
   <?php endif; ?>
</div>
                     <div class="scanner-container position-relative mb-4">
                        <div class="previewParent rounded-lg overflow-hidden shadow-sm">
                           <video id="previewKamera" class="w-100"></video>
                           
                           <!-- Scanner Animation Overlay -->
                           <div class="scanner-animation">
                              <div class="scan-line"></div>
                              <div class="scan-corner-tl"></div>
                              <div class="scan-corner-tr"></div>
                              <div class="scan-corner-bl"></div>
                              <div class="scan-corner-br"></div>
                           </div>
                           
                           <div class="text-center position-absolute scanning-text">
                              <h5 class="d-none w-100 text-white" id="searching"><b>Mencari...</b></h5>
                           </div>
                        </div>
                     </div>
                     
                     <div id="hasilScan" class="p-3 mt-4 rounded-lg"></div>
                  </div>
               </div>
            </div>

            <!-- Side Cards -->
            <div class="col-lg-5 col-xl-4">
               <!-- Tips Card -->
<div class="card shadow-sm rounded-lg mb-4">
    <div class="card-body p-4">
        <h5 class="font-weight-bold mb-3">Tips</h5>
        <ul class="pl-3 mb-0">
            <li class="mb-2"><b>QR Code:</b> Tunjukkan QR code (NIS/NUPTK) sampai terlihat jelas di kamera</li>
            <li class="mb-2"><b>RFID Card:</b> Tempelkan kartu RFID pada reader</li>
            <li>Posisikan tidak terlalu jauh maupun terlalu dekat</li>
        </ul>
    </div>
</div>

<!-- Usage Card -->
<div class="card shadow-sm rounded-lg">
    <div class="card-body p-4">
        <h5 class="font-weight-bold mb-3">Penggunaan</h5>
        <ul class="pl-3 mb-0">
            <li class="mb-2"><b>QR Code:</b> Scan menggunakan NIS (Siswa) atau NUPTK (Guru)</li>
            <li class="mb-2"><b>RFID:</b> Gunakan kartu RFID yang terdaftar</li>
            <li class="mb-2">Jika berhasil scan akan muncul data di bawah preview kamera</li>
            <li class="mb-2">Klik tombol <b><span class="text-success">Absen masuk</span> / <span class="text-warning">Absen pulang</span></b> untuk mengubah waktu absensi</li>
            <li class="mb-2">Untuk melihat data absensi, klik tombol <span class="text-primary"><i class="material-icons align-middle" style="font-size: 16px;">dashboard</i> Dashboard</span></li>
            <li>Untuk mengakses halaman petugas anda harus login terlebih dahulu</li>
        </ul>
    </div>
</div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- CSS for Scanner Animation and Styling -->
<style>
   body {
      background-color: #f8f9fa;
   }
   
   .card {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
   }
   
   .rounded-pill {
      border-radius: 50px !important;
   }
   
   /* Scanner container with responsive sizing */
   .scanner-container {
      position: relative;
      width: 100%;
   }
   
   .previewParent {
      position: relative;
      background-color: #000;
      border-radius: 8px;
      overflow: hidden;
      /* Adaptive height based on width, maintains reasonable proportions */
      min-height: 180px;
      max-height: 320px;
      height: calc(min(50vw, 320px));
   }
   
   /* Make video element fill container while maintaining aspect ratio */
   #previewKamera {
      width: 100%;
      height: 100%;
      object-fit: cover;
   }
   
   .scanner-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.2);
      pointer-events: none;
      display: flex;
      justify-content: center;
      align-items: center;
   }
   
   .previewParent.unpreview .scanner-overlay {
      background: rgba(0, 0, 0, 0.7);
      z-index: 2;
   }
   
   #searching {
      font-size: 14px;
      font-weight: 500;
      padding: 6px 14px;
      background: rgba(0, 0, 0, 0.5);
      border-radius: 50px;
      z-index: 3;
   }
   
   /* Scan animation elements */
   .scanner-overlay::before,
   .scanner-overlay::after {
      content: '';
      position: absolute;
      border: 2px solid transparent;
      width: 20px;
      height: 20px;
   }
   
   /* Top-left corner */
   .scanner-overlay::before {
      top: 10px;
      left: 10px;
      border-top-color: #2ecc71;
      border-left-color: #2ecc71;
   }
   
   /* Bottom-right corner */
   .scanner-overlay::after {
      bottom: 10px;
      right: 10px;
      border-bottom-color: #2ecc71;
      border-right-color: #2ecc71;
   }
   
   /* Form controls styling */
   .form-control {
      border: 1px solid #e0e0e0;
      background-color: #f8f9fa;
      transition: all 0.2s ease;
      font-size: 14px;
   }
   
   .form-control:focus {
      box-shadow: none;
      border-color: #80bdff;
      background-color: #fff;
   }
   
   .form-control.rounded-pill {
      padding-left: 15px;
      padding-right: 15px;
   }
   
   /* Scan result area */
   #hasilScan {
      border-radius: 8px;
      min-height: 10px;
      transition: all 0.3s ease;
   }
   
   /* Scanner animation - horizontal line */
   .previewParent::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, transparent, #2ecc71, transparent);
      animation: scan 2s ease-in-out infinite;
      box-shadow: 0 0 8px rgba(46, 204, 113, 0.5);
      z-index: 1;
   }
   
   @keyframes scan {
      0% { top: 5%; opacity: 0.8; }
      50% { top: 95%; opacity: 1; }
      100% { top: 5%; opacity: 0.8; }
   }
   
   /* Button styling */
   .btn {
      font-size: 14px;
      transition: all 0.2s ease;
   }
   
   .btn-outline-secondary {
      color: #6c757d;
      border-color: #dee2e6;
   }
   
   .btn-outline-secondary:hover {
      background-color: #f8f9fa;
      color: #495057;
   }
   
   /* Responsive adjustments */
   @media (max-width: 576px) {
      .previewParent {
         min-height: 160px;
         height: calc(min(70vw, 280px));
      }
      
      .scanner-overlay::before,
      .scanner-overlay::after {
         width: 15px;
         height: 15px;
      }
   }
   
   /* Current time display */
   #current-time {
      font-size: 14px;
      font-weight: 500;
   }

   /* Add these styles to your existing <style> section */

#current-time {
   font-family: 'Roboto Mono', monospace;
   font-size: 1.8rem;
   letter-spacing: 2px;
   color: #3498db;
   text-shadow: 0 0 10px rgba(52, 152, 219, 0.2);
   transition: all 0.3s ease;
}

.card-header.bg-light {
   background-color: #f8f9fa;
   border-bottom: 1px solid rgba(0,0,0,0.05);
}

/* Add a subtle pulse animation to the clock */
@keyframes pulse {
   0% { transform: scale(1); }
   50% { transform: scale(1.02); }
   100% { transform: scale(1); }
}

#current-time.pulse {
   animation: pulse 1s infinite;
}

/* Make the time change color every second */
.time-changed {
   color: #2980b9 !important;
}

/* Pause Overlay Styling */
.pause-overlay {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background: rgba(0, 0, 0, 0.85);
   display: none;
   justify-content: center;
   align-items: center;
   z-index: 10;
   cursor: pointer;
   border-radius: 8px;
}

.pause-overlay .pause-content {
   text-align: center;
   color: white;
   padding: 20px;
}

.pause-overlay .pause-icon {
   font-size: 64px;
   color: #ffc107;
   margin-bottom: 15px;
   animation: pulse-icon 2s infinite;
}

.pause-overlay h5 {
   color: white;
   margin-bottom: 10px;
   font-weight: 600;
}

.pause-overlay p {
   color: rgba(255, 255, 255, 0.8);
   margin: 0;
   font-size: 14px;
}

@keyframes pulse-icon {
   0%, 100% { opacity: 1; transform: scale(1); }
   50% { opacity: 0.6; transform: scale(1.1); }
}

/* Scanner status indicator */
.scanner-status {
   position: absolute;
   top: 10px;
   right: 10px;
   background: rgba(46, 204, 113, 0.9);
   color: white;
   padding: 5px 15px;
   border-radius: 20px;
   font-size: 12px;
   font-weight: 600;
   z-index: 5;
   display: none;
}

.scanner-status.active {
   display: block;
   background: rgba(46, 204, 113, 0.9);
}

.scanner-status.paused {
   display: block;
   background: rgba(255, 193, 7, 0.9);
}

.scanner-status.scanning {
   display: block;
   background: rgba(52, 152, 219, 0.9);
   animation: blink 1s infinite;
}

@keyframes blink {
   0%, 50%, 100% { opacity: 1; }
   25%, 75% { opacity: 0.5; }
}
</style>

<script type="text/javascript" src="<?= base_url('assets/js/plugins/zxing/zxing.min.js') ?>"></script>
<script src="<?= base_url('assets/js/core/jquery-3.5.1.min.js') ?>"></script>
<script type="text/javascript">
   let selectedDeviceId = null;
   let audio = new Audio("<?= base_url('assets/audio/beep.mp3'); ?>");
   const codeReader = new ZXing.BrowserMultiFormatReader();
   const sourceSelect = $('#pilihKamera');
   
   // ============= IDLE DETECTION SYSTEM =============
   let isScanning = false;
   let isScannerPaused = false;
   let idleTimeout = null;
   let lastActivityTime = Date.now();
   const IDLE_TIME = 30000; // 30 detik tidak ada aktivitas = pause (bisa disesuaikan)
   const SCAN_COOLDOWN = 2500; // Waktu tunggu setelah scan berhasil
   
   // Fungsi untuk mendeteksi aktivitas user
   function resetIdleTimer() {
      lastActivityTime = Date.now();
      
      // Jika scanner sedang paused, resume otomatis
      if (isScannerPaused && !isScanning) {
         resumeScanner();
      }
      
      // Clear timeout lama dan set yang baru
      clearTimeout(idleTimeout);
      idleTimeout = setTimeout(() => {
         pauseScanner();
      }, IDLE_TIME);
   }
   
   // Fungsi untuk pause scanner
   function pauseScanner() {
      if (!isScannerPaused && !isScanning) {
         isScannerPaused = true;
         console.log("Scanner paused (idle)");
         
         if (codeReader) {
            codeReader.reset();
         }
         
         // Update UI
         $('.previewParent').addClass('unpreview');
         $('#previewKamera').addClass('d-none');
         $('#searching').removeClass('d-none').html('<b>Scanner di-pause<br><small>Gerakkan mouse/tap layar untuk melanjutkan</small></b>');
         
         // Show pause overlay
         showPauseOverlay();
      }
   }
   
   // Fungsi untuk resume scanner
   function resumeScanner() {
      if (isScannerPaused) {
         isScannerPaused = false;
         console.log("Scanner resumed");
         
         // Hide pause overlay
         hidePauseOverlay();
         
         // Restart scanner
         initScanner();
         
         // Reset idle timer
         resetIdleTimer();
      }
   }
   
   // Fungsi untuk show pause overlay
   function showPauseOverlay() {
      if ($('#pauseOverlay').length === 0) {
         $('.scanner-container').append(`
            <div id="pauseOverlay" class="pause-overlay">
               <div class="pause-content">
                  <i class="material-icons pause-icon">pause_circle_outline</i>
                  <h5>Scanner Di-pause</h5>
                  <p>Sentuh layar atau gerakkan mouse untuk melanjutkan</p>
               </div>
            </div>
         `);
      }
      $('#pauseOverlay').fadeIn(300);
   }
   
   // Fungsi untuk hide pause overlay
   function hidePauseOverlay() {
      $('#pauseOverlay').fadeOut(300);
   }
   
   // Event listeners untuk mendeteksi aktivitas
   $(document).on('mousemove click touchstart keypress', function() {
      resetIdleTimer();
   });
   
   // Klik pada pause overlay untuk resume
   $(document).on('click', '#pauseOverlay', function() {
      resumeScanner();
   });
   
   // ============= SCANNER FUNCTIONS =============

   $(document).on('change', '#pilihKamera', function() {
      selectedDeviceId = $(this).val();
      if (codeReader) {
         codeReader.reset();
         isScanning = false;
         initScanner();
      }
   });

   function initScanner() {
      // Jangan init jika sedang paused
      if (isScannerPaused) {
         console.log("Scanner paused, skip init");
         return;
      }
      
      isScanning = true;
      
      codeReader.listVideoInputDevices()
         .then(videoInputDevices => {
            videoInputDevices.forEach(device =>
               console.log(`${device.label}, ${device.deviceId}`)
            );

            if (videoInputDevices.length < 1) {
               alert("Camera not found!");
               isScanning = false;
               return;
            }

            if (selectedDeviceId == null) {
               if (videoInputDevices.length <= 1) {
                  selectedDeviceId = videoInputDevices[0].deviceId
               } else {
                  selectedDeviceId = videoInputDevices[1].deviceId
               }
            }

            if (videoInputDevices.length >= 1) {
               sourceSelect.html('');
               videoInputDevices.forEach((element) => {
                  const sourceOption = document.createElement('option')
                  sourceOption.text = element.label
                  sourceOption.value = element.deviceId
                  if (element.deviceId == selectedDeviceId) {
                     sourceOption.selected = 'selected';
                  }
                  sourceSelect.append(sourceOption)
               })
            }

            $('.previewParent').removeClass('unpreview');
            $('#previewKamera').removeClass('d-none');
            $('#searching').addClass('d-none');

            codeReader.decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
               .then(result => {
                  console.log("QR Code detected:", result.text);
                  
                  // Reset activity timer saat scan berhasil
                  resetIdleTimer();
                  
                  cekData(result.text);

                  $('#previewKamera').addClass('d-none');
                  $('.previewParent').addClass('unpreview');
                  $('#searching').removeClass('d-none').html('<b>Memproses...</b>');

                  if (codeReader) {
                     codeReader.reset();
                     isScanning = false;

                     // Delay setelah berhasil scan
                     setTimeout(() => {
                        if (!isScannerPaused) {
                           initScanner();
                        }
                     }, SCAN_COOLDOWN);
                  }
               })
               .catch(err => {
                  console.error("Scanner error:", err);
                  isScanning = false;
                  
                  // Retry jika belum di-pause
                  if (!isScannerPaused) {
                     setTimeout(() => {
                        initScanner();
                     }, 1000);
                  }
               });

         })
         .catch(err => {
            console.error(err);
            isScanning = false;
         });
   }

   if (navigator.mediaDevices) {
      initScanner();
      resetIdleTimer(); // Start idle timer
   } else {
      alert('Cannot access camera.');
   }

   async function cekData(code) {
      // Bersihkan kode dari spasi atau karakter aneh
      code = code.trim();
      
      console.log("Kode yang akan dicek: " + code);
      
      jQuery.ajax({
         url: "<?= base_url('scan/cek'); ?>",
         type: 'post',
         data: {
            'unique_code': code,
            'waktu': '<?= strtolower($waktu); ?>'
         },
         success: function(response, status, xhr) {
            audio.play();
            console.log("Response:", response);
            $('#hasilScan').html(response);

            $('html, body').animate({
               scrollTop: $("#hasilScan").offset().top
            }, 500);
            
            // Reset idle timer setelah berhasil
            resetIdleTimer();
         },
         error: function(xhr, status, thrown) {
            console.log("Error:", thrown);
            $('#hasilScan').html('<div class="alert alert-danger">Terjadi kesalahan: ' + thrown + '</div>');
         }
      });
   }

   function clearData() {
      $('#hasilScan').html('');
   }
   
   // ============= RFID READER INTEGRATION =============
   let rfidInput = "";
   let rfidTimeout = null;

   document.addEventListener("keypress", function(event) {
      // Abaikan input jika sedang fokus pada elemen input/select
      if (event.target.tagName === 'INPUT' || event.target.tagName === 'SELECT' || event.target.tagName === 'TEXTAREA') {
         return;
      }
      
      // Reset idle timer saat ada input RFID
      resetIdleTimer();
      
      // Jika Enter ditekan
      if (event.key === "Enter") {
         if (rfidInput.length > 0) {
            console.log("RFID/QR Scanned: " + rfidInput);
            cekData(rfidInput);
            rfidInput = "";
         }
         event.preventDefault();
      } else {
         // Tambahkan karakter ke buffer
         rfidInput += event.key;
         
         // Reset timeout
         clearTimeout(rfidTimeout);
         
         // Set timeout baru
         rfidTimeout = setTimeout(() => { 
            rfidInput = ""; 
         }, 100);
      }
   });

   // ============= CLOCK & AUTO REFRESH =============
   
   function updateClock() {
      const now = new Date();
      let hours = now.getHours();
      let minutes = now.getMinutes();
      let seconds = now.getSeconds();
      
      hours = hours < 10 ? '0' + hours : hours;
      minutes = minutes < 10 ? '0' + minutes : minutes;
      seconds = seconds < 10 ? '0' + seconds : seconds;
      
      const timeString = `${hours}:${minutes}:${seconds}`;
      $('#current-time').text(timeString);
      
      checkTimeForRefresh(hours, minutes);
   }

   function checkTimeForRefresh(hours, minutes) {
      const currentTime = `${hours}:${minutes}`;
      
      const masukStart = '<?= $settings["masuk_start"] ?>';
      const masukEnd = '<?= $settings["masuk_end"] ?>';
      const pulangStart = '<?= $settings["pulang_start"] ?>';
      const pulangEnd = '<?= $settings["pulang_end"] ?>';
      
      const currentMode = '<?= $waktu ?>'; 
      
      const timeString = `${hours}:${minutes}`;
      
      if (currentMode === 'Masuk' && timeString === pulangStart) {
         console.log("Switching to Pulang mode");
         setTimeout(() => { window.location.reload(); }, 2000);
         return;
      }
      
      if (currentMode === 'Pulang' && timeString === masukStart) {
         console.log("Switching to Masuk mode");
         setTimeout(() => { window.location.reload(); }, 2000);
         return;
      }
      
      if (minutes % 5 === 0 && seconds === 0) {
         console.log("Periodic refresh");
         setTimeout(() => { window.location.reload(); }, 2000);
      }
   }

   function addClockVisualEffects() {
      let lastSeconds = new Date().getSeconds();
      
      setInterval(() => {
         const now = new Date();
         const currentSeconds = now.getSeconds();
         
         if (currentSeconds !== lastSeconds) {
            $('#current-time').addClass('time-changed');
            setTimeout(() => {
               $('#current-time').removeClass('time-changed');
            }, 500);
            
            lastSeconds = currentSeconds;
         }
      }, 100);
   }

   $(document).ready(function() {
      updateClock();
      setInterval(updateClock, 1000);
      addClockVisualEffects();
      
      $(document).on('scanSuccess', function() {
         $('#current-time').addClass('pulse');
         setTimeout(() => {
            $('#current-time').removeClass('pulse');
         }, 2000);
      });
   });

   // ============= FULLSCREEN & REFRESH BUTTONS =============
   
   const btn = document.getElementById('toggleFullScreen');

   btn.addEventListener('click', () => {
      resetIdleTimer(); // Reset timer saat interaksi
      
      if (!document.fullscreenElement) {
         document.documentElement.requestFullscreen();
         btn.innerHTML = '🔲 Minimize';
      } else {
         document.exitFullscreen();
         btn.innerHTML = '🔳 Maximize';
      }
   });

   document.addEventListener('fullscreenchange', () => {
      if (!document.fullscreenElement) {
         btn.innerHTML = '🔳 Maximize';
      }
   });

   const refreshBtn = document.getElementById('refreshPage');

   refreshBtn.addEventListener('click', () => {
      location.reload();
   });
   
   // Manual pause/resume button (opsional)
   $(document).ready(function() {
      // Tambahkan tombol pause manual jika diinginkan
      $('.card-header.bg-gradient-primary .d-flex.align-items-center.gap-2').append(`
         <button id="toggleScanner" class="btn btn-warning btn-sm rounded-pill shadow-sm">
            ⏸️ Pause
         </button>
      `);
      
      $('#toggleScanner').on('click', function() {
         if (isScannerPaused) {
            resumeScanner();
            $(this).html('⏸️ Pause').removeClass('btn-success').addClass('btn-warning');
         } else {
            pauseScanner();
            $(this).html('▶️ Resume').removeClass('btn-warning').addClass('btn-success');
         }
      });
   });
</script>
<?= $this->endSection(); ?>