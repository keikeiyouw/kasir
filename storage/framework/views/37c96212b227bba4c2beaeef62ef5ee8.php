<?php $__env->startSection('title', 'Tambah Produk'); ?>
<?php $__env->startSection('content'); ?>

<div style="max-width:540px;">
    <div class="card">
        <div class="card-head">
            <div class="card-title">Tambah Produk</div>
            <a href="<?php echo e(route('produk.index')); ?>" class="btn btn-outline">← Kembali</a>
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
                <div class="alert alert-error"><?php echo e($errors->first()); ?></div>
            <?php endif; ?>
            <form action="<?php echo e(route('produk.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="NamaProduk" class="form-control" value="<?php echo e(old('NamaProduk')); ?>" required>
                </div>
                <div class="form-2col">
                    <div class="form-group">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" name="Harga" class="form-control" value="<?php echo e(old('Harga')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stok</label>
                        <input type="number" name="Stok" class="form-control" value="<?php echo e(old('Stok')); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Foto Produk</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>
                <div style="display:flex; gap:8px; margin-top:6px;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo e(route('produk.index')); ?>" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/produk/create.blade.php ENDPATH**/ ?>