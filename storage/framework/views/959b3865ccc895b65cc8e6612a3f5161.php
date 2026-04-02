<?php $__env->startSection('title', 'Detail Pelanggan'); ?>
<?php $__env->startSection('content'); ?>

<div style="max-width:720px;">

    
    <div class="card" style="margin-bottom:16px;">
        <div class="card-head">
            <div class="card-title">Detail Pelanggan</div>
            <a href="<?php echo e(route('pelanggan.index')); ?>" class="btn btn-outline">← Kembali</a>
        </div>
        <div style="padding:16px 20px; display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">
            <div>
                <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); margin-bottom:4px;">Nama</div>
                <div style="font-weight:600;"><?php echo e($pelanggan->NamaPelanggan); ?></div>
            </div>
            <div>
                <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); margin-bottom:4px;">Telepon</div>
                <div style="font-weight:500;"><?php echo e($pelanggan->NomorTelepon ?? '-'); ?></div>
            </div>
            <div>
                <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); margin-bottom:4px;">Alamat</div>
                <div style="font-weight:500; color:var(--muted);"><?php echo e($pelanggan->Alamat ?? '-'); ?></div>
            </div>
        </div>
    </div>

    
    <div class="card">
        <div class="card-head">
            <div class="card-title">Riwayat Belanja</div>
            <div style="font-size:12px; color:var(--muted);"><?php echo e($penjualans->count()); ?> transaksi</div>
        </div>

        <?php if($penjualans->count() > 0): ?>
            <?php $__currentLoopData = $penjualans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="border-bottom:1px solid var(--border);">
                
                <div style="padding:12px 20px; display:flex; justify-content:space-between; align-items:center; background:#faf8f5;">
                    <div>
                        <div style="font-size:12px; font-weight:600; color:var(--text);">#PJL-<?php echo e(str_pad($p->PenjualanID, 3, '0', STR_PAD_LEFT)); ?></div>
                        <div style="font-size:11px; color:var(--muted); margin-top:2px;"><?php echo e(\Carbon\Carbon::parse($p->TanggalPenjualan)->isoFormat('D MMMM Y')); ?></div>
                    </div>
                    <div style="font-size:15px; font-weight:700; color:var(--text);">
                        Rp <?php echo e(number_format($p->TotalHarga, 0, ',', '.')); ?>

                    </div>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $p->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="font-weight:500;"><?php echo e($d->produk->NamaProduk ?? '-'); ?></td>
                            <td style="color:var(--muted);">Rp <?php echo e(number_format($d->produk->Harga ?? 0, 0, ',', '.')); ?></td>
                            <td><?php echo e($d->JumlahProduk); ?></td>
                            <td style="font-weight:600;">Rp <?php echo e(number_format($d->Subtotal, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="empty">Pelanggan ini belum pernah bertransaksi.</div>
        <?php endif; ?>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/pelanggan/show.blade.php ENDPATH**/ ?>