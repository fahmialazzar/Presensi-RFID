<!-- Views/admin/data/import-data-guru.php -->
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="guru-import-container">
    <style>
        :root {
            /* Green theme for Guru section */
            --guru-primary: #10B981;
            --guru-primary-light: #ECFDF5;
            --guru-primary-dark: #059669;
            --guru-secondary: #A7F3D0;
            --guru-accent: #6EE7B7;
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
        
        .guru-import-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 1rem;
            margin-top: 2rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        
        /* Card Styles */
        .import-card {
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px var(--shadow);
            animation: fadeIn 0.5s ease-out;
            margin-bottom: 1.5rem;
        }
        
        .import-card-header {
            background: linear-gradient(135deg, var(--guru-primary) 0%, var(--guru-primary-dark) 100%);
            padding: 1.5rem 2rem;
            color: white;
        }
        
        .import-card-header h4 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            color: white;
        }
        
        .import-card-header p {
            font-size: 0.875rem;
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            color: white;
        }
        
        .import-card-body {
            padding: 2rem;
        }
        
        /* Upload Zone */
        .dm-uploader-container {
            margin-bottom: 1.5rem;
        }
        
        #drag-and-drop-zone {
            border: 3px dashed var(--border);
            border-radius: 16px;
            padding: 3rem 2rem;
            text-align: center;
            background-color: var(--light);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        #drag-and-drop-zone:hover,
        #drag-and-drop-zone.active {
            border-color: var(--guru-primary);
            background-color: var(--guru-primary-light);
        }
        
        .dm-upload-icon {
            margin-bottom: 1rem;
        }
        
        .dm-upload-icon i {
            font-size: 4rem;
            color: var(--guru-primary);
        }
        
        #drag-and-drop-zone h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 1.5rem;
        }
        
        #drag-and-drop-zone .btn {
            background: linear-gradient(135deg, var(--guru-primary) 0%, var(--guru-primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.875rem 2rem;
            font-size: 0.9375rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        #drag-and-drop-zone .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }
        
        #drag-and-drop-zone .btn input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        
        /* Spinner */
        .csv-upload-spinner {
            display: none;
            text-align: center;
            padding: 2rem;
            background: var(--light);
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }
        
        .csv-upload-spinner strong {
            display: block;
            font-size: 1.125rem;
            margin-bottom: 1rem;
            color: var(--guru-primary);
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
            background-color: var(--guru-primary);
            border-radius: 100%;
            display: inline-block;
            animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        }
        
        .spinner-bounce .bounce1 {
            animation-delay: -0.32s;
        }
        
        .spinner-bounce .bounce2 {
            animation-delay: -0.16s;
        }
        
        @keyframes sk-bouncedelay {
            0%, 80%, 100% { 
                transform: scale(0);
            } 
            40% { 
                transform: scale(1.0);
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
        }
        
        .csv-uploaded-files .list-group-item {
            padding: 0.875rem 1.25rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideInRight 0.3s ease-out;
        }
        
        .csv-uploaded-files .list-group-item-success {
            background-color: rgba(16, 185, 129, 0.05);
            border-color: var(--success);
            color: var(--dark);
        }
        
        .csv-uploaded-files .list-group-item-danger {
            background-color: rgba(239, 68, 68, 0.05);
            border-color: var(--danger);
            color: var(--dark);
        }
        
        .csv-uploaded-files i.fa-check {
            color: var(--success);
            font-size: 1.125rem;
        }
        
        .csv-uploaded-files i.fa-times {
            color: var(--danger);
            font-size: 1.125rem;
        }
        
        /* Help Documents */
        .help-documents {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px var(--shadow);
        }
        
        .help-documents .btn-download {
            width: 100%;
            background: linear-gradient(135deg, var(--guru-primary) 0%, var(--guru-primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.875rem 1.5rem;
            font-size: 0.9375rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .help-documents .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }
        
        .help-documents h5 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark);
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }
        
        .help-documents ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .help-documents ul li {
            padding: 0.5rem 0;
            color: var(--text-light);
            font-size: 0.875rem;
            line-height: 1.6;
            position: relative;
            padding-left: 1.5rem;
        }
        
        .help-documents ul li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: var(--guru-primary);
            font-weight: bold;
            font-size: 1.25rem;
        }
        
        /* Grid Layout */
        .import-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
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
            .guru-import-container {
                padding: 1.5rem 1rem;
                margin-top: 1rem;
            }
            
            .import-card-header {
                padding: 1.25rem 1.5rem;
            }
            
            .import-card-header h4 {
                font-size: 1.25rem;
            }
            
            .import-card-body {
                padding: 1.5rem;
            }
            
            #drag-and-drop-zone {
                padding: 2rem 1rem;
            }
            
            .dm-upload-icon i {
                font-size: 3rem;
            }
            
            #drag-and-drop-zone h3 {
                font-size: 1rem;
            }
        }
    </style>

    <?= view('admin/_messages'); ?>

    <div class="import-grid">
        <!-- Main Upload Card -->
        <div class="import-card">
            <div class="import-card-header">
                <h4>Import Data Guru</h4>
            </div>
            <div class="import-card-body">
                <div class="form-group">
                    <div class="dm-uploader-container">
                        <div id="drag-and-drop-zone" class="dm-uploader p-2">
                            <p class="dm-upload-icon">
                                <i class="material-icons">cloud_upload</i>
                            </p>
                            <h3 class="text-muted">Drag &amp; drop files here</h3>
                            <div class="btn btn-success mb-5">
                                <span>Open the file Browser</span>
                                <input type="file" title='Click to add Files' />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div id="csv_upload_spinner" class="csv-upload-spinner">
                                <strong class="text-csv-importing">Importing Guru...</strong>
                                <strong class="text-csv-import-completed">completed!</strong>
                                <div class="spinner-bounce">
                                    <div class="bounce1"></div>
                                    <div class="bounce2"></div>
                                    <div class="bounce3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="csv-uploaded-files-container">
                                <ul id="csv_uploaded_files" class="list-group csv-uploaded-files"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Help Documents Card -->
        <div class="import-card">
            <div class="import-card-header">
                <h4>Help Documents</h4>
                <p>documents to generate your CSV file</p>
            </div>
            <div class="import-card-body">
                <a href="<?= base_url('admin/guru/download-template') ?>" class="btn-download">
                    Download CSV Template
                </a>
                <div class="mt-3">
                    <h5>Petunjuk Pengisian:</h5>
                    <ul class="text-muted">
                        <li>NUPTK: Minimal 16 karakter</li>
                        <li>Nama Guru: Nama lengkap guru</li>
                        <li>Jenis Kelamin: 1 = Laki-laki, 2 = Perempuan</li>
                        <li>Alamat: Alamat lengkap guru</li>
                        <li>No HP: Nomor telepon guru</li>
                        <li>Unique Code: Kode RFID (harus tepat 10 karakter dan unik)</li>
                        <li>Tgl Lahir: Format YYYY-MM-DD (contoh: 1980-05-15)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    // Debugging: Test manual upload first
    $('#drag-and-drop-zone input[type="file"]').on('change', function(e) {
        var file = e.target.files[0];
        if (file) {
            console.log('File selected manually:', file);
            testDirectUpload(file);
        }
    });

    // Konfigurasi dm-uploader dengan debug
    $('#drag-and-drop-zone').dmUploader({
        url: '<?= base_url("admin/guru/generateCSVObjectPost"); ?>',
        multiple: false,
        maxFileSize: 5242880, // 5MB
        extFilter: ["csv"],
        extraData: function(id) {
            var csrfData = {
                '<?= csrf_token() ?>': '<?= csrf_hash(); ?>'
            };
            console.log('CSRF Data:', csrfData);
            return csrfData;
        },
        onDragEnter: function() {
            console.log('Drag enter');
            this.addClass('active');
        },
        onDragLeave: function() {
            console.log('Drag leave');
            this.removeClass('active');
        },
        onNewFile: function(id, file) {
            console.log('New file detected:', {
                id: id,
                name: file.name,
                size: file.size,
                type: file.type
            });
            
            // Reset UI
            $("#csv_upload_spinner").show();
            $("#csv_upload_spinner .spinner-bounce").show();
            $("#csv_upload_spinner .text-csv-importing").show();
            $("#csv_upload_spinner .text-csv-import-completed").hide();
            $("#csv_uploaded_files").empty();
            
            // Basic validation
            if (file.size > 5242880) {
                alert('File terlalu besar. Maksimal 5MB.');
                $("#csv_upload_spinner").hide();
                return false;
            }
            
            if (!file.name.toLowerCase().endsWith('.csv')) {
                alert('File harus berformat CSV.');
                $("#csv_upload_spinner").hide();
                return false;
            }
        },
        onBeforeUpload: function(id) {
            console.log('Before upload - File ID:', id);
        },
        onUploadProgress: function(id, percent) {
            console.log('Upload progress:', percent + '%');
        },
        onUploadSuccess: function(id, response) {
            console.log('Upload success - Raw response:', response);
            console.log('Response type:', typeof response);
            
            try {
                var obj = typeof response === 'string' ? JSON.parse(response) : response;
                console.log('Parsed response:', obj);
                
                if (obj.result == 1) {
                    var numberOfItems = obj.numberOfItems || 0;
                    var txtFileName = obj.txtFileName || "";
                    
                    console.log('Success - Items:', numberOfItems, 'File:', txtFileName);
                    
                    if (numberOfItems > 0) {
                        addCSVItem(numberOfItems, txtFileName, 1);
                    } else {
                        $("#csv_upload_spinner").hide();
                        alert('File CSV kosong atau tidak memiliki data yang valid.');
                    }
                } else {
                    $("#csv_upload_spinner").hide();
                    alert('Gagal memproses file: ' + (obj.message || 'Unknown error'));
                }
            } catch (e) {
                console.error('Error parsing response:', e);
                console.error('Raw response was:', response);
                $("#csv_upload_spinner").hide();
                alert("Error parsing server response: " + e.message);
            }
        },
        onUploadError: function(id, xhr) {
            console.error('Upload error details:', {
                id: id,
                status: xhr.status,
                statusText: xhr.statusText,
                responseText: xhr.responseText,
                readyState: xhr.readyState
            });
            
            $("#csv_upload_spinner").hide();
            
            var errorMessage = 'Upload failed';
            if (xhr.responseText) {
                try {
                    var errorObj = JSON.parse(xhr.responseText);
                    errorMessage = errorObj.error || errorObj.message || errorMessage;
                } catch (e) {
                    errorMessage = xhr.responseText.substring(0, 200);
                }
            }
            
            alert('Upload Error (' + xhr.status + '): ' + errorMessage);
        }
    });
});

// Function untuk test upload manual (debugging)
function testDirectUpload(file) {
    console.log('Testing direct upload...');
    
    var formData = new FormData();
    formData.append('file', file);
    formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
    
    // Log FormData contents
    for (var pair of formData.entries()) {
        console.log('FormData:', pair[0], pair[1]);
    }
    
    $.ajax({
        url: '<?= base_url("admin/guru/generateCSVObjectPost"); ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log('Direct upload success:', response);
        },
        error: function(xhr, status, error) {
            console.error('Direct upload error:', {
                status: xhr.status,
                statusText: xhr.statusText,
                responseText: xhr.responseText,
                error: error
            });
        }
    });
}

function addCSVItem(numberOfItems, txtFileName, index) {
    if (index <= numberOfItems) {
        console.log('Processing item:', index, 'of', numberOfItems);
        
        var data = {
            'txtFileName': txtFileName,
            'index': index,
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        };
        
        $.ajax({
            type: "POST",
            url: '<?= base_url("admin/guru/importCSVItemPost"); ?>',
            data: data,
            dataType: 'json',
            timeout: 30000,
            success: function(response) {
                console.log('Import item success:', response);
                
                var objSub = typeof response === 'string' ? JSON.parse(response) : response;
                
                if (objSub.result == 1 && objSub.guru) {
                    var displayText = objSub.guru.nuptk + ' - ' + objSub.guru.nama_guru;
                    $("#csv_uploaded_files").append(
                        '<li class="list-group-item list-group-item-success">' +
                        '<i class="fa fa-check text-success"></i> ' +
                        objSub.index + '. ' + displayText +
                        '</li>'
                    );
                } else {
                    var errorMsg = objSub.message || 'Error processing item';
                    $("#csv_uploaded_files").append(
                        '<li class="list-group-item list-group-item-danger">' +
                        '<i class="fa fa-times text-danger"></i> ' +
                        objSub.index + '. ' + errorMsg +
                        '</li>'
                    );
                }
                
                if (objSub.index == numberOfItems) {
                    $("#csv_upload_spinner .text-csv-importing").hide();
                    $("#csv_upload_spinner .spinner-bounce").hide();
                    $("#csv_upload_spinner .text-csv-import-completed").css('display', 'block');
                    
                    setTimeout(function() {
                        $("#csv_upload_spinner").fadeOut();
                    }, 3000);
                }
                
                addCSVItem(numberOfItems, txtFileName, index + 1);
            },
            error: function(xhr, status, thrown) {
                console.error('Import item error:', {
                    index: index,
                    status: xhr.status,
                    responseText: xhr.responseText,
                    thrown: thrown
                });
                
                $("#csv_uploaded_files").append(
                    '<li class="list-group-item list-group-item-danger">' +
                    '<i class="fa fa-times text-danger"></i> ' +
                    index + '. Error: ' + (xhr.responseText || thrown) +
                    '</li>'
                );
                
                if (xhr.status >= 500) {
                    $("#csv_upload_spinner").hide();
                    alert('Server error occurred. Check console for details.');
                    return;
                }
                
                addCSVItem(numberOfItems, txtFileName, index + 1);
            }
        });
    }
}

</script>
<?= $this->endSection() ?>