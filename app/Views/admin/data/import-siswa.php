<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="siswa-import-container">
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
        
        .siswa-import-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 2rem 1rem;
            margin-top: 2rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        
        /* Alert Styles - More Visible */
        .alert-import {
            background-color: white;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-left: 4px solid;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideInDown 0.4s ease-out;
            font-weight: 600;
            font-size: 0.9375rem;
        }
        
        .alert-import.alert-success {
            border-left-color: var(--success);
            background-color: rgba(16, 185, 129, 0.15);
            color: #047857;
        }
        
        .alert-import.alert-danger {
            border-left-color: var(--danger);
            background-color: rgba(239, 68, 68, 0.15);
            color: #B91C1C;
        }
        
        .alert-import.alert-warning {
            border-left-color: var(--warning);
            background-color: rgba(245, 158, 11, 0.15);
            color: #B45309;
        }
        
        .alert-import .close {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-light);
            transition: color 0.2s;
            padding: 0;
            margin: 0;
            font-size: 1.5rem;
        }
        
        .alert-import .close:hover {
            color: var(--dark);
        }
        
        /* Cards Grid */
        .import-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 1.5rem;
        }
        
        /* Card Styles */
        .import-card {
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px var(--shadow);
            animation: fadeIn 0.5s ease-out;
        }
        
        .import-card-header {
            background: linear-gradient(135deg, var(--siswa-primary) 0%, var(--siswa-primary-dark) 100%);
            padding: 1.5rem 2rem;
            color: white;
        }
        
        .import-card-header h4 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            color: white;
        }
        
        .import-card-header p {
            font-size: 0.875rem;
            margin: 0;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .import-card-body {
            padding: 2rem;
        }
        
        /* Drag and Drop Zone */
        .dm-uploader-container {
            margin-bottom: 1.5rem;
        }
        
        .dm-uploader {
            border: 3px dashed var(--border);
            border-radius: 16px;
            background-color: var(--light);
            padding: 3rem 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .dm-uploader:hover,
        .dm-uploader.active {
            border-color: var(--siswa-primary);
            background-color: var(--siswa-primary-light);
        }
        
        .dm-upload-icon i {
            font-size: 4rem;
            color: var(--siswa-primary);
            margin-bottom: 1rem;
        }
        
        .dm-uploader h3 {
            color: var(--text-light);
            font-size: 1.125rem;
            font-weight: 500;
            margin: 1rem 0 1.5rem 0;
        }
        
        .dm-uploader .btn {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--siswa-primary) 0%, var(--siswa-primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .dm-uploader .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        }
        
        .dm-uploader .btn input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        
        /* Upload Spinner */
        .csv-upload-spinner {
            display: none;
            text-align: center;
            padding: 2rem;
            background-color: var(--siswa-primary-light);
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }
        
        .csv-upload-spinner strong {
            display: block;
            font-size: 1rem;
            color: var(--siswa-primary-dark);
            margin-bottom: 1rem;
        }
        
        .text-csv-import-completed {
            display: none;
            color: var(--success) !important;
        }
        
        .spinner-bounce {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .spinner-bounce > div {
            width: 12px;
            height: 12px;
            background-color: var(--siswa-primary);
            border-radius: 50%;
            animation: bounce 1.4s infinite ease-in-out both;
        }
        
        .spinner-bounce .bounce1 {
            animation-delay: -0.32s;
        }
        
        .spinner-bounce .bounce2 {
            animation-delay: -0.16s;
        }
        
        @keyframes bounce {
            0%, 80%, 100% {
                transform: scale(0);
            }
            40% {
                transform: scale(1);
            }
        }
        
        /* Uploaded Files List */
        .csv-uploaded-files-container {
            width: 100%;
        }
        
        .csv-uploaded-files {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 400px;
            overflow-y: auto;
        }
        
        .csv-uploaded-files li {
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            animation: slideInRight 0.3s ease-out;
        }
        
        .list-group-item-success {
            background-color: rgba(16, 185, 129, 0.15);
            color: #047857;
            border-left: 3px solid var(--success);
        }
        
        .list-group-item-danger {
            background-color: rgba(239, 68, 68, 0.15);
            color: #B91C1C;
            border-left: 3px solid var(--danger);
        }
        
        /* Help Document Card */
        .help-card .import-card-body {
            padding: 1.5rem;
        }
        
        .btn-help {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border: 2px solid var(--success);
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 0.75rem;
        }
        
        .btn-help:hover {
            background-color: var(--success);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        
        .help-instructions {
            margin-top: 1.5rem;
            padding: 1.5rem;
            background-color: var(--light);
            border-radius: 12px;
        }
        
        .help-instructions h5 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1rem;
        }
        
        .help-instructions ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .help-instructions li {
            padding: 0.5rem 0;
            font-size: 0.875rem;
            color: var(--text);
            border-bottom: 1px solid var(--border);
        }
        
        .help-instructions li:last-child {
            border-bottom: none;
        }
        
        .help-instructions li strong {
            color: var(--siswa-primary);
            font-weight: 600;
        }
        
        /* Modal Styles */
        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--siswa-primary) 0%, var(--siswa-primary-dark) 100%);
            color: white;
            border-radius: 16px 16px 0 0;
            padding: 1.5rem;
        }
        
        .modal-header .modal-title {
            font-weight: 700;
            font-size: 1.25rem;
        }
        
        .modal-header .close {
            color: white;
            opacity: 0.8;
            text-shadow: none;
        }
        
        .modal-header .close:hover {
            opacity: 1;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-body table {
            margin: 0;
        }
        
        .modal-body .table thead th {
            background-color: var(--siswa-primary-light);
            color: var(--siswa-primary-dark);
            font-weight: 600;
            border: none;
            padding: 0.75rem;
        }
        
        .modal-body .table tbody tr {
            transition: background-color 0.2s;
        }
        
        .modal-body .table tbody tr:hover {
            background-color: var(--siswa-primary-light);
        }
        
        .modal-body .table tbody td {
            padding: 0.75rem;
            vertical-align: middle;
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
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .import-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .siswa-import-container {
                padding: 1.5rem 1rem;
                margin-top: 1rem;
            }
            
            .import-card-header {
                padding: 1.25rem 1.5rem;
            }
            
            .import-card-body {
                padding: 1.5rem;
            }
            
            .dm-uploader {
                padding: 2rem 1rem;
            }
        }
    </style>
    
    <div class="container-fluid">
        <?= view('admin/_messages'); ?>
        
        <div class="import-grid">
            <!-- Upload Card -->
            <div class="import-card">
                <div class="import-card-header">
                    <h4>Bulk Import Siswa</h4>
                    <p>Angkatan <?= $generalSettings->school_year; ?></p>
                </div>
                <div class="import-card-body">
                    <div class="dm-uploader-container">
                        <div id="drag-and-drop-zone" class="dm-uploader">
                            <p class="dm-upload-icon">
                                <i class="material-icons">cloud_upload</i>
                            </p>
                            <h3>Drag & drop CSV file di sini</h3>
                            <div class="btn">
                                <span>Pilih File CSV</span>
                                <input type="file" title='Click to add Files' />
                            </div>
                        </div>
                    </div>
                    
                    <div id="csv_upload_spinner" class="csv-upload-spinner">
                        <strong class="text-csv-importing">Mengimpor data siswa...</strong>
                        <strong class="text-csv-import-completed">Import selesai!</strong>
                        <div class="spinner-bounce">
                            <div class="bounce1"></div>
                            <div class="bounce2"></div>
                            <div class="bounce3"></div>
                        </div>
                    </div>
                    
                    <div class="csv-uploaded-files-container">
                        <ul id="csv_uploaded_files" class="csv-uploaded-files"></ul>
                    </div>
                </div>
            </div>
            
            <!-- Help Document Card -->
            <div class="import-card help-card">
                <div class="import-card-header">
                    <h4>Panduan Import</h4>
                    <p>Dokumen bantuan untuk import CSV</p>
                </div>
                <div class="import-card-body">
                    <form action="<?= base_url('admin/siswa/downloadCSVFilePost'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <button type="button" class="btn-help" data-toggle="modal" data-target="#modalKelas">
                            📋 Lihat Daftar Kelas
                        </button>
                        <button class="btn-help" name="submit" value="csv_siswa_template">
                            📥 Download Template CSV
                        </button>
                    </form>
                    
                    <div class="help-instructions">
                        <h5>📖 Petunjuk Pengisian CSV:</h5>
                        <ul>
                            <li><strong>NIS:</strong> Nomor Induk Siswa (angka)</li>
                            <li><strong>Nama Siswa:</strong> Nama lengkap siswa</li>
                            <li><strong>ID Kelas:</strong> Gunakan ID dari Daftar Kelas</li>
                            <li><strong>Jenis Kelamin:</strong> "Laki-laki" atau "Perempuan"</li>
                            <li><strong>Alamat:</strong> Alamat lengkap siswa</li>
                            <li><strong>No HP:</strong> Nomor telepon siswa</li>
                            <li><strong>Unique Code:</strong> Kode RFID (10 karakter unik)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Kelas -->
<div class="modal fade" id="modalKelas" tabindex="-1" aria-labelledby="modalKelasTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKelasTitle">Daftar Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <th><b>ID</b></th>
                            <th><b>Kelas / Tingkat</b></th>
                            <th><b>Jurusan</b></th>
                        </thead>
                        <tbody>
                            <?php foreach ($kelas as $value) : ?>
                                <tr>
                                    <td><?= $value['id_kelas']; ?></td>
                                    <td><b><?= $value['kelas']; ?></b></td>
                                    <td><?= $value['jurusan']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#drag-and-drop-zone').dmUploader({
            url: '<?= base_url("admin/siswa/generateCSVObjectPost"); ?>',
            multiple: false,
            extFilter: ["csv"],
            extraData: function(id) {
                return {
                    '<?= csrf_token() ?>': '<?= csrf_hash(); ?>'
                };
            },
            onDragEnter: function() {
                this.addClass('active');
            },
            onDragLeave: function() {
                this.removeClass('active');
            },
            onNewFile: function(id, file) {
                $("#csv_upload_spinner").show();
                $("#csv_upload_spinner .spinner-bounce").show();
                $("#csv_upload_spinner .text-csv-importing").show();
                $("#csv_upload_spinner .text-csv-import-completed").hide();
                $("#csv_uploaded_files").empty();
            },
            onUploadSuccess: function(id, response) {
                var numberOfItems = 0;
                var txtFileName = "";
                try {
                    var obj = JSON.parse(response);
                    if (obj.result == 1) {
                        numberOfItems = obj.numberOfItems;
                        txtFileName = obj.txtFileName;
                        if (numberOfItems > 0) {
                            addCSVItem(numberOfItems, txtFileName, 1);
                        } else {
                            $("#csv_upload_spinner").hide();
                        }
                    } else {
                        $("#csv_upload_spinner").hide();
                    }
                } catch (e) {
                    alert("Invalid CSV file! Make sure there are no double quotes in your content. Double quotes can brake the CSV structure.");
                }
            }
        });
    });

    function addCSVItem(numberOfItems, txtFileName, index) {
        if (index <= numberOfItems) {
            var data = {
                'txtFileName': txtFileName,
                'index': index
            };
            $.ajax({
                type: "POST",
                url: '<?= base_url("admin/siswa/importCSVItemPost"); ?>',
                data: setAjaxData(data),
                success: function(response) {
                    var objSub = JSON.parse(response);
                    if (objSub.result == 1) {
                        $("#csv_uploaded_files").prepend('<li class="list-group-item-success">&nbsp;' + objSub.index + '.&nbsp;' + objSub.siswa.nis + '.&nbsp; - ' + objSub.siswa.nama_siswa +'</li>');
                    } else {
                        $("#csv_uploaded_files").prepend('<li class="list-group-item-danger">&nbsp;' + objSub.index + '.</li>');
                    }
                    if (objSub.index == numberOfItems) {
                        $("#csv_upload_spinner .text-csv-importing").hide();
                        $("#csv_upload_spinner .spinner-bounce").hide();
                        $("#csv_upload_spinner .text-csv-import-completed").css('display', 'block');
                    }
                    index = index + 1;
                    addCSVItem(numberOfItems, txtFileName, index);
                },
                error: function(xhr, status, thrown) {
                    swal({
                        text: 'Ada Kesalahan Pada CSV silahkan Cek Log',
                        icon: "warning"
                    }).then(function(willDelete) {
                        if (willDelete) {
                            location.reload();
                        }
                    });
                },
            });
        }
    }
</script>
<?= $this->endSection() ?>