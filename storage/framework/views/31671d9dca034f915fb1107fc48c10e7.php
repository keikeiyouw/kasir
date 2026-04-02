<?php $__env->startSection('title', 'Penjualan'); ?>
<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-head">
        <div class="card-title">Daftar Penjualan</div>
        <form method="GET" style="display:flex; gap:6px;">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari pelanggan..." class="form-control" style="width:200px;">
            <button class="btn btn-outline">Cari</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $penjualans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td style="color:var(--muted); font-size:12px;"><?php echo e($penjualans->firstItem() + $i); ?></td>
                <td style="color:var(--muted); font-size:12px;">#PJL-<?php echo e(str_pad($p->PenjualanID, 3, '0', STR_PAD_LEFT)); ?></td>
                <td style="font-weight:500;"><?php echo e($p->pelanggan->NamaPelanggan ?? '-'); ?></td>
                <td style="color:var(--muted);"><?php echo e(\Carbon\Carbon::parse($p->TanggalPenjualan)->isoFormat('D MMM Y')); ?></td>
                <td style="font-weight:600;">Rp <?php echo e(number_format($p->TotalHarga, 0, ',', '.')); ?></td>
                <td>
                    <div style="display:flex; gap:5px; align-items:center;">
                        <a href="<?php echo e(route('penjualan.show', $p)); ?>" class="btn btn-outline">Detail</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="6" class="empty">Belum ada penjualan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="pagi"><?php echo e($penjualans->links()); ?></div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/penjualan/index.blade.php ENDPATH**/ ?>