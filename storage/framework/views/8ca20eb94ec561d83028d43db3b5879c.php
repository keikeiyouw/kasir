<?php $__env->startSection('title', 'Edit Penjualan'); ?>
<?php $__env->startSection('content'); ?>

<div style="max-width:540px;">
    <div class="card">
        <div class="card-head">
            <div class="card-title">Edit Penjualan</div>
            <a href="<?php echo e(route('penjualan.index')); ?>" class="btn btn-outline">← Kembali</a>
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
                <div class="alert alert-error"><?php echo e($errors->first()); ?></div>
            <?php endif; ?>
            <form action="<?php echo e(route('penjualan.update', $penjualan)); ?>" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="form-group">
                    <label class="form-label">Pelanggan</label>
                    <select name="PelangganID" class="form-control" required>
                        <?php $__currentLoopData = $pelanggans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($p->PelangganID); ?>" <?php echo e($penjualan->PelangganID == $p->PelangganID ? 'selected' : ''); ?>>
                            <?php echo e($p->NamaPelanggan); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="TanggalPenjualan" class="form-control" value="<?php echo e($penjualan->TanggalPenjualan); ?>" required>
                </div>
                <div style="display:flex; gap:8px; margin-top:6px;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo e(route('penjualan.index')); ?>" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/penjualan/edit.blade.php ENDPATH**/ ?>