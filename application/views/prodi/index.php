<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Daftar Program Studi</h5>
            <a href="<?php echo base_url('prodi/tambah'); ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Tambah Prodi
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th width="10%">No.</th>
                            <th>Nama Program Studi</th>
                            <th>Strata</th>
                            <th>Fakultas</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($prodi as $p): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $p['prodi_name']; ?></td>
                            <td><span class="badge bg-secondary"><?php echo $p['prodi_strata']; ?></span></td>
                            <td><?php echo $p['fakultas_name']; ?></td>
                            <td>
                                <a href="<?php echo base_url('prodi/ubah/' . $p['prodi_id']); ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="<?php echo base_url('prodi/hapus/' . $p['prodi_id']); ?>" class="btn btn-danger btn-sm btn-hapus">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>