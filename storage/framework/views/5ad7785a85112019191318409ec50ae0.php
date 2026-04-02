<?php $__env->startSection('title', 'Detail Penjualan'); ?>
<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-head">
        <div class="card-title">Laporan Detail Penjualan</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td style="color:var(--muted); font-size:12px;"><?php echo e($details->firstItem() + $i); ?></td>
                <td>
                    <span class="badge badge-info">#PJL-<?php echo e(str_pad($d->PenjualanID, 3, '0', STR_PAD_LEFT)); ?></span>
                </td>
                <td style="font-weight:500;"><?php echo e($d->penjualan->pelanggan->NamaPelanggan ?? '-'); ?></td>
                <td><?php echo e($d->produk->NamaProduk ?? '-'); ?></td>
                <td><?php echo e($d->JumlahProduk); ?></td>
                <td style="font-weight:600;">Rp <?php echo e(number_format($d->Subtotal, 0, ',', '.')); ?></td>
                <td style="color:var(--muted);"><?php echo e(\Carbon\Carbon::parse($d->penjualan->TanggalPenjualan)->isoFormat('D MMM Y')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7" class="empty">Belum ada data.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="pagi"><?php echo e($details->links()); ?></div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/detailpenjualan/index.blade.php ENDPATH**/ ?>