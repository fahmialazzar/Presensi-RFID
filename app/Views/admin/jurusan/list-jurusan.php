<div class="card-body table-responsive ios-blue-theme">
  <style>
    /* iOS Blue Theme for Data Jurusan */
    .ios-blue-theme {
      --info: #007AFF;
      --danger: #FF3B30;
      --success: #10B981;
      --text-dark: #1F2937;
      --border: #E5E7EB;
      --bg-light: #F9FAFB;
    }

    .ios-blue-theme table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 8px;
    }

    .ios-blue-theme thead th {
      color: var(--info);
      font-weight: 600;
      text-transform: uppercase;
      border-bottom: 2px solid var(--border);
      padding: 12px;
      background-color: #fff;
      text-align: center;
    }

    .ios-blue-theme tbody tr {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      transition: all 0.2s ease;
    }

    .ios-blue-theme tbody tr:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .ios-blue-theme td {
      padding: 14px;
      vertical-align: middle;
      color: var(--text-dark);
      text-align: center;
    }

    /* Action Buttons for Table */
    .action-btn-group {
      display: flex;
      gap: 0.5rem;
      justify-content: center;
    }

    .action-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      transition: all 0.2s ease;
      padding: 0;
      text-decoration: none;
    }

    .action-btn i {
      font-size: 1.125rem;
      margin: 0;
    }

    .action-btn-edit {
      background-color: rgba(59, 130, 246, 0.1);
      color: var(--info);
    }

    .action-btn-edit:hover {
      background-color: var(--info);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
    }

    .action-btn-delete {
      background-color: rgba(239, 68, 68, 0.1);
      color: var(--danger);
    }

    .action-btn-delete:hover {
      background-color: var(--danger);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
    }

    /* Override Bootstrap defaults */
    .action-btn.btn {
      min-width: 36px;
      padding: 0;
      line-height: 36px;
    }

    .action-btn.btn i {
      line-height: 1;
      vertical-align: middle;
    }
  </style>

  <?php if (!empty($data)) : ?>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Jurusan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        foreach ($data as $value) : ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= esc($value['jurusan']); ?></td>
            <td>
              <div class="action-btn-group">
                <a href="<?= base_url('admin/jurusan/edit/' . $value['id']); ?>" class="action-btn action-btn-edit" title="Edit">
                  <i class="material-icons">edit</i>
                </a>
                <button onclick='deleteItem("admin/jurusan/deleteJurusanPost","<?= $value["id"]; ?>","Konfirmasi untuk menghapus data");' class="action-btn action-btn-delete" title="Delete">
                  <i class="material-icons">delete_forever</i>
                </button>
              </div>
            </td>
          </tr>
        <?php $i++;
        endforeach; ?>
      </tbody>
    </table>
  <?php else : ?>
    <div class="row">
      <div class="col">
        <h4 class="text-center text-danger">Data tidak ditemukan</h4>
      </div>
    </div>
  <?php endif; ?>
</div>
