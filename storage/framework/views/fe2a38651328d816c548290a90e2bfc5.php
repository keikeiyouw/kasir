<?php $__env->startSection('title', 'Pelanggan'); ?>
<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-head">
        <div class="card-title">Daftar Pelanggan</div>
        <form method="GET" style="display:flex; gap:6px;">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari pelanggan..." class="form-control" style="width:200px;">
            <button class="btn btn-outline">Cari</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $pelanggans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td style="color:var(--muted); font-size:12px;"><?php echo e($pelanggans->firstItem() + $i); ?></td>
                <td style="font-weight:500;"><?php echo e($p->NamaPelanggan); ?></td>
                <td><?php echo e($p->NomorTelepon ?? '-'); ?></td>
                <td style="color:var(--muted);"><?php echo e($p->Alamat ?? '-'); ?></td>
                <td>
                    <a href="<?php echo e(route('pelanggan.show', $p)); ?>" class="btn btn-outline">Detail</a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5" class="empty">Belum ada pelanggan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="pagi"><?php echo e($pelanggans->links()); ?></div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/pelanggan/index.blade.php ENDPATH**/ ?>