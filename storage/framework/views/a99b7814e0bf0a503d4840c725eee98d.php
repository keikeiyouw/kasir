<?php $__env->startSection('title', 'Tambah Pelanggan'); ?>
<?php $__env->startSection('content'); ?>

<div style="max-width:540px;">
    <div class="card">
        <div class="card-head">
            <div class="card-title">Tambah Pelanggan</div>
            <a href="<?php echo e(route('pelanggan.index')); ?>" class="btn btn-outline">← Kembali</a>
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
                <div class="alert alert-error"><?php echo e($errors->first()); ?></div>
            <?php endif; ?>
            <form action="<?php echo e(route('pelanggan.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" name="NamaPelanggan" class="form-control" value="<?php echo e(old('NamaPelanggan')); ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="NomorTelepon" class="form-control" value="<?php echo e(old('NomorTelepon')); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <textarea name="Alamat" class="form-control" rows="3"><?php echo e(old('Alamat')); ?></textarea>
                </div>
                <div style="display:flex; gap:8px; margin-top:6px;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo e(route('pelanggan.index')); ?>" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/pelanggan/create.blade.php ENDPATH**/ ?>