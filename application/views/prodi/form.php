<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5><?php echo $title; ?></h5>
        </div>
        <div class="card-body">
            <form action="<?php echo $action; ?>" method="post">
                
                <div class="mb-3">
                    <label for="prodi_id" class="form-label">ID Prodi</label>
                    <input type="number" name="prodi_id" id="prodi_id" class="form-control <?php echo form_error('prodi_id') ? 'is-invalid' : (isset($_POST['prodi_id']) ? 'is-valid' : ''); ?>" 
                           value="<?php echo set_value('prodi_id', isset($prodi['prodi_id']) ? $prodi['prodi_id'] : ''); ?>" <?php echo isset($prodi) ? 'readonly' : ''; ?>>
                    <?php if (form_error('prodi_id')): ?>
                        <div class="invalid-feedback"><?php echo form_error('prodi_id'); ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="fakultas_id" class="form-label">Fakultas</label>
                    <select name="fakultas_id" id="fakultas_id" class="form-select <?php echo form_error('fakultas_id') ? 'is-invalid' : (isset($_POST['fakultas_id']) ? 'is-valid' : ''); ?>">
                        <option value="">-- Pilih Fakultas --</option>
                        <?php foreach ($fakultas as $f): ?>
                            <option value="<?php echo $f['fakultas_id']; ?>"
                                <?php echo set_select('fakultas_id', $f['fakultas_id'], (isset($prodi['fakultas_id']) && $prodi['fakultas_id'] == $f['fakultas_id'])); ?>>
                                <?php echo $f['fakultas_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (form_error('fakultas_id')): ?>
                        <div class="invalid-feedback"><?php echo form_error('fakultas_id'); ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="prodi_name" class="form-label">Nama Program Studi</label>
                    <input type="text" name="prodi_name" id="prodi_name" class="form-control <?php echo form_error('prodi_name') ? 'is-invalid' : (isset($_POST['prodi_name']) ? 'is-valid' : ''); ?>" 
                           value="<?php echo set_value('prodi_name', isset($prodi['prodi_name']) ? $prodi['prodi_name'] : ''); ?>">
                    <?php if (form_error('prodi_name')): ?>
                        <div class="invalid-feedback"><?php echo form_error('prodi_name'); ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Strata</label>
                    <?php $strata_options = ['D3', 'S1', 'S2']; ?>
                    <?php foreach ($strata_options as $s): ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input <?php echo form_error('prodi_strata') ? 'is-invalid' : (isset($_POST['prodi_strata']) ? 'is-valid' : ''); ?>" 
                                   type="radio" name="prodi_strata" id="strata_<?php echo $s; ?>" value="<?php echo $s; ?>"
                                   <?php echo set_radio('prodi_strata', $s, (isset($prodi['prodi_strata']) && $prodi['prodi_strata'] === $s)); ?>>
                            <label class="form-check-label" for="strata_<?php echo $s; ?>"><?php echo $s; ?></label>
                        </div>
                    <?php endforeach; ?>
                    <?php if (form_error('prodi_strata')): ?>
                        <div class="text-danger small mt-1"><?php echo form_error('prodi_strata'); ?></div>
                    <?php endif; ?>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success"><?php echo $button; ?></button>
                    <a href="<?php echo base_url('prodi'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>