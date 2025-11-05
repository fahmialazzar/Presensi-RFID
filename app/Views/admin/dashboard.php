<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="dashboard-container">
</br>
    <style>
        :root {
            /* Modern color scheme */
            --primary: #3B82F6;
            --primary-light: #EFF6FF;
            --secondary: #A5B4FC;
            --accent: #F59E0B;
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
        
        .dashboard-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 1rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px var(--shadow);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card-header {
            padding: 1.25rem 1.5rem 0.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .stat-card-body {
            padding: 0.5rem 1.5rem 1.25rem;
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-light);
            color: var(--primary);
            font-size: 20px;
            margin-right: 1rem;
        }
        
        .stat-content {
            flex: 1;
        }
        
        .stat-title {
            font-size: 0.875rem;
            color: var(--text-light);
            margin: 0;
            font-weight: 500;
        }
        
        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0.25rem 0;
            color: var(--dark);
        }
        
        .stat-footer {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            color: var(--text-light);
            padding: 0.75rem 1.5rem;
            border-top: 1px solid var(--border);
        }
        
        .stat-footer i {
            margin-right: 0.5rem;
            font-size: 1.125rem;
        }
        
        .cards-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .attendance-card {
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px var(--shadow);
        }
        
        .attendance-header {
            padding: 1.5rem;
            background-color: var(--primary-light);
        }
        
        .attendance-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: var(--primary);
        }
        
        .attendance-header p {
            font-size: 0.875rem;
            margin: 0.5rem 0 0;
            color: var(--text-light);
        }
        
        .attendance-body {
            padding: 1.5rem;
        }
        
        .attendance-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            text-align: center;
        }
        
        .attendance-stat h3 {
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-light);
        }
        
        .attendance-stat p {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            color: var(--dark);
        }
        
        .chart-card {
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px var(--shadow);
        }
        
        .chart-header {
            height: 260px;
            padding: 1.5rem;
            position: relative;
        }
        
        .chart-body {
            padding: 1.5rem;
        }
        
        .chart-body h2 {
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0;
            color: var(--dark);
        }
        
        .chart-body p {
            font-size: 0.875rem;
            margin: 0.5rem 0 0;
            color: var(--text-light);
        }
        
        .chart-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border);
        }
        
        .chart-footer a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--primary);
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s;
        }
        
        .chart-footer a:hover {
            color: var(--dark);
        }
        
        .chart-footer i {
            margin-right: 0.5rem;
            font-size: 1.125rem;
        }
        
        .text-success { color: var(--success) !important; }
        .text-warning { color: var(--warning) !important; }
        .text-info { color: var(--info) !important; }
        .text-danger { color: var(--danger) !important; }
        
        .bg-success-light { background-color: rgba(16, 185, 129, 0.1); }
        .bg-warning-light { background-color: rgba(245, 158, 11, 0.1); }
        .bg-info-light { background-color: rgba(59, 130, 246, 0.1); }
        .bg-danger-light { background-color: rgba(239, 68, 68, 0.1); }
        
        .icon-success { color: var(--success); background-color: rgba(16, 185, 129, 0.1); }
        .icon-warning { color: var(--warning); background-color: rgba(245, 158, 11, 0.1); }
        .icon-info { color: var(--info); background-color: rgba(59, 130, 246, 0.1); }
        .icon-danger { color: var(--danger); background-color: rgba(239, 68, 68, 0.1); }
        
        /* Animation effects */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stat-card, .attendance-card, .chart-card {
            animation: fadeIn 0.5s ease-out forwards;
        }
        
        .stats-grid .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stats-grid .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stats-grid .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stats-grid .stat-card:nth-child(4) { animation-delay: 0.4s; }
        
        .cards-row > div:nth-child(1) { animation-delay: 0.5s; }
        .cards-row > div:nth-child(2) { animation-delay: 0.6s; }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .cards-row {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .attendance-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
        }
        
        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    </br>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon icon-info">
                    <i class="material-icons">person</i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-title">Jumlah Siswa</h3>
                    <p class="stat-value"><?= count($siswa); ?></p>
                </div>
            </div>
            <div class="stat-footer">
                <i class="material-icons text-info">check_circle</i>
                <span>Terdaftar di Sistem</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon icon-success">
                    <i class="material-icons">grade</i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-title">Jumlah Kelas</h3>
                    <p class="stat-value"><?= count($kelas); ?></p>
                </div>
            </div>
            <div class="stat-footer">
                <i class="material-icons text-success">home</i>
                <span><?= $generalSettings->school_name ?? 'Sekolah' ?></span>
            </div>
        </div>
        
        <?php if (user()->toArray()['is_superadmin'] ?? '0' == '1') : ?>
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon icon-warning">
                    <i class="material-icons">person_4</i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-title">Jumlah Guru</h3>
                    <p class="stat-value"><?= count($guru); ?></p>
                </div>
            </div>
            <div class="stat-footer">
                <i class="material-icons text-warning">check_circle</i>
                <span>Terdaftar di Sistem</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon icon-danger">
                    <i class="material-icons">settings</i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-title">Jumlah Petugas</h3>
                    <p class="stat-value"><?= count($petugas); ?></p>
                </div>
            </div>
            <div class="stat-footer">
                <i class="material-icons text-danger">shield</i>
                <span>Petugas dan Administrator</span>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="cards-row">
        <div class="attendance-card">
            <div class="attendance-header">
                <h2>Absensi Siswa Hari Ini</h2>
                <p><?= $dateNow; ?></p>
            </div>
            <div class="attendance-body">
                <div class="attendance-stats">
                    <div class="attendance-stat">
                        <h3>Hadir</h3>
                        <p class="text-success"><?= $jumlahKehadiranSiswa['hadir']; ?></p>
                    </div>
                    <div class="attendance-stat">
                        <h3>Sakit</h3>
                        <p class="text-warning"><?= $jumlahKehadiranSiswa['sakit']; ?></p>
                    </div>
                    <div class="attendance-stat">
                        <h3>Izin</h3>
                        <p class="text-info"><?= $jumlahKehadiranSiswa['izin']; ?></p>
                    </div>
                    <div class="attendance-stat">
                        <h3>Alfa</h3>
                        <p class="text-danger"><?= $jumlahKehadiranSiswa['alfa']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if (user()->toArray()['is_superadmin'] ?? '0' == '1') : ?>
        <div class="attendance-card">
            <div class="attendance-header">
                <h2>Absensi Guru Hari Ini</h2>
                <p><?= $dateNow; ?></p>
            </div>
            <div class="attendance-body">
                <div class="attendance-stats">
                    <div class="attendance-stat">
                        <h3>Hadir</h3>
                        <p class="text-success"><?= $jumlahKehadiranGuru['hadir']; ?></p>
                    </div>
                    <div class="attendance-stat">
                        <h3>Sakit</h3>
                        <p class="text-warning"><?= $jumlahKehadiranGuru['sakit']; ?></p>
                    </div>
                    <div class="attendance-stat">
                        <h3>Izin</h3>
                        <p class="text-info"><?= $jumlahKehadiranGuru['izin']; ?></p>
                    </div>
                    <div class="attendance-stat">
                        <h3>Alfa</h3>
                        <p class="text-danger"><?= $jumlahKehadiranGuru['alfa']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="cards-row">
        <div class="chart-card">
            <div class="chart-header">
                <canvas id="studentAttendanceChart"></canvas>
            </div>
            <div class="chart-body">
                <h2>Tingkat Kehadiran Siswa</h2>
                <p>Jumlah kehadiran siswa dalam 7 hari terakhir</p>
            </div>
            <div class="chart-footer">
                <a href="<?= base_url('admin/absen-siswa'); ?>">
                    <i class="material-icons">trending_up</i>
                    <span>Lihat data lengkap</span>
                </a>
            </div>
        </div>
        
        <?php if (user()->toArray()['is_superadmin'] ?? '0' == '1') : ?>
        <div class="chart-card">
            <div class="chart-header">
                <canvas id="teacherAttendanceChart"></canvas>
            </div>
            <div class="chart-body">
                <h2>Tingkat Kehadiran Guru</h2>
                <p>Jumlah kehadiran guru dalam 7 hari terakhir</p>
            </div>
            <div class="chart-footer">
                <a href="<?= base_url('admin/absen-guru'); ?>">
                    <i class="material-icons">trending_up</i>
                    <span>Lihat data lengkap</span>
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize dashboard charts with smoother animations
        setTimeout(initDashboardCharts, 600);
    });

    function initDashboardCharts() {
        if (document.getElementById('studentAttendanceChart')) {
            const studentCtx = document.getElementById('studentAttendanceChart').getContext('2d');
            
            const studentData = {
                labels: [
                    <?php foreach ($dateRange as $value): ?>
                        "<?= $value ?>",
                    <?php endforeach; ?>
                ],
                datasets: [{
                    label: 'Kehadiran Siswa',
                    data: [
                        <?php foreach ($grafikKehadiranSiswa as $value): ?>
                            <?= $value ?>,
                        <?php endforeach; ?>
                    ],
                    fill: true,
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderColor: 'rgba(59, 130, 246, 0.8)',
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: 'rgba(59, 130, 246, 0.8)',
                    pointBorderWidth: 2,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#ffffff',
                    pointHoverBorderColor: 'rgba(59, 130, 246, 1)',
                    pointHoverBorderWidth: 3
                }]
            };
            
            const studentChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: '#1F2937',
                        bodyColor: '#374151',
                        borderColor: '#E5E7EB',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8,
                        boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)',
                        usePointStyle: true
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            display: true,
                            drawBorder: false,
                            color: 'rgba(226, 232, 240, 0.6)'
                        },
                        ticks: {
                            color: '#6B7280',
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6B7280',
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            };
            
            new Chart(studentCtx, {
                type: 'line',
                data: studentData,
                options: studentChartOptions
            });
        }
        
        if (document.getElementById('teacherAttendanceChart')) {
            const teacherCtx = document.getElementById('teacherAttendanceChart').getContext('2d');
            
            const teacherData = {
                labels: [
                    <?php foreach ($dateRange as $value): ?>
                        "<?= $value ?>",
                    <?php endforeach; ?>
                ],
                datasets: [{
                    label: 'Kehadiran Guru',
                    data: [
                        <?php foreach ($grafikkKehadiranGuru as $value): ?>
                            <?= $value ?>,
                        <?php endforeach; ?>
                    ],
                    fill: true,
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderColor: 'rgba(16, 185, 129, 0.8)',
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: 'rgba(16, 185, 129, 0.8)',
                    pointBorderWidth: 2,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#ffffff',
                    pointHoverBorderColor: 'rgba(16, 185, 129, 1)',
                    pointHoverBorderWidth: 3
                }]
            };
            
            const teacherChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: '#1F2937',
                        bodyColor: '#374151',
                        borderColor: '#E5E7EB',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8,
                        boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)',
                        usePointStyle: true
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            display: true,
                            drawBorder: false,
                            color: 'rgba(226, 232, 240, 0.6)'
                        },
                        ticks: {
                            color: '#6B7280',
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6B7280',
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            };
            
            new Chart(teacherCtx, {
                type: 'line',
                data: teacherData,
                options: teacherChartOptions
            });
        }
    }

    
</script>
<?= $this->endSection() ?>