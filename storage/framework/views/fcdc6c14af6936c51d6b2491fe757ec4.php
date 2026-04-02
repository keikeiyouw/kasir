<?php $__env->startSection('title', 'Detail Penjualan'); ?>
<?php $__env->startSection('content'); ?>

<div style="display:grid; grid-template-columns:1fr 300px; gap:16px; align-items:start;">

    
    <div class="card">
        <div class="card-head">
            <div class="card-title">Item Pembelian</div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $penjualan->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="font-weight:500;"><?php echo e($d->produk->NamaProduk ?? '-'); ?></td>
                    <td><?php echo e($d->JumlahProduk); ?></td>
                    <td style="color:var(--muted);">Rp <?php echo e(number_format($d->produk->Harga ?? 0, 0, ',', '.')); ?></td>
                    <td style="font-weight:600;">Rp <?php echo e(number_format($d->Subtotal, 0, ',', '.')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    
    <div style="display:flex; flex-direction:column; gap:14px;">
        <div class="card">
            <div class="card-head">
                <div class="card-title">Info Transaksi</div>
            </div>
            <div style="padding:16px 20px;">
                <div style="margin-bottom:12px;">
                    <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); margin-bottom:3px;">ID</div>
                    <div style="font-weight:600; font-size:13px;">#PJL-<?php echo e(str_pad($penjualan->PenjualanID, 3, '0', STR_PAD_LEFT)); ?></div>
                </div>
                <div style="margin-bottom:12px;">
                    <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); margin-bottom:3px;">Tanggal</div>
                    <div style="font-weight:500; font-size:13px;"><?php echo e(\Carbon\Carbon::parse($penjualan->TanggalPenjualan)->isoFormat('D MMM Y')); ?></div>
                </div>
                <div style="margin-bottom:16px;">
                    <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); margin-bottom:3px;">Pelanggan</div>
                    <div style="font-weight:500; font-size:13px;"><?php echo e($penjualan->pelanggan->NamaPelanggan ?? '-'); ?></div>
                </div>
                <div style="border-top:1px solid var(--border); padding-top:12px; display:flex; justify-content:space-between; align-items:center;">
                    <div style="font-size:12px; color:var(--muted); font-weight:500;">Total</div>
                    <div style="font-size:18px; font-weight:700; color:var(--text); letter-spacing:-0.5px;">
                        Rp <?php echo e(number_format($penjualan->TotalHarga, 0, ',', '.')); ?>

                    </div>
                </div>
            </div>
        </div>

        <a href="<?php echo e(route('penjualan.index')); ?>" class="btn btn-outline" style="justify-content:center;">← Kembali</a>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/penjualan/show.blade.php ENDPATH**/ ?>