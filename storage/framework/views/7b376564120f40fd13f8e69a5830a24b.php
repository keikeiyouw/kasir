<?php $__env->startSection('title', 'Produk'); ?>
<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-head">
        <div class="card-title">Daftar Produk</div>
        <div style="display:flex; gap:8px;">
            <form method="GET" style="display:flex; gap:6px;">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari produk..." class="form-control" style="width:180px;">
                <button class="btn btn-outline">Cari</button>
            </form>
            <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-primary">+ Tambah</a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $produks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td style="color:var(--muted); font-size:12px;"><?php echo e($produks->firstItem() + $i); ?></td>
                <td>
                    <?php if($p->foto): ?>
                        <img src="<?php echo e(asset('storage/'.$p->foto)); ?>" style="width:36px; height:36px; object-fit:cover; border-radius:6px; display:block;">
                    <?php else: ?>
                        <div style="width:36px; height:36px; border-radius:6px; background:var(--bg); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; font-size:16px;">📦</div>
                    <?php endif; ?>
                </td>
                <td style="font-weight:500;"><?php echo e($p->NamaProduk); ?></td>
                <td>Rp <?php echo e(number_format($p->Harga, 0, ',', '.')); ?></td>
                <td>
                    <span class="badge <?php echo e($p->Stok <= 5 ? 'badge-danger' : ($p->Stok <= 20 ? 'badge-warning' : 'badge-success')); ?>">
                        <?php echo e($p->Stok); ?>

                    </span>
                </td>
                <td>
                    <div style="display:flex; gap:5px;">
                        <a href="<?php echo e(route('produk.edit', $p)); ?>" class="btn btn-outline">Edit</a>
                        <form action="<?php echo e(route('produk.destroy', $p)); ?>" method="POST" id="hapus-<?php echo e($p->ProdukID); ?>">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="button" class="btn btn-danger" onclick="showHapus(<?php echo e($p->ProdukID); ?>, '<?php echo e($p->NamaProduk); ?>')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="6" class="empty">Belum ada produk.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="pagi"><?php echo e($produks->links()); ?></div>
</div>


<div class="modal-overlay" id="modal-hapus">
    <div class="modal">
        <div class="modal-icon">🗑️</div>
        <h3>Hapus Produk</h3>
        <p id="modal-text">Yakin ingin menghapus produk ini?</p>
        <div class="modal-btns">
            <button class="btn-mcancel" onclick="closeModal('modal-hapus')">Batal</button>
            <button class="btn-mconfirm" id="btn-confirm-hapus">Hapus</button>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
function showHapus(id, nama) {
    document.getElementById('modal-hapus').classList.add('show');
    document.getElementById('modal-text').textContent = 'Yakin hapus "' + nama + '"?';
    document.getElementById('btn-confirm-hapus').onclick = function () {
        document.getElementById('hapus-' + id).submit();
    };
}
function closeModal(id) {
    document.getElementById(id).classList.remove('show');
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/produk/index.blade.php ENDPATH**/ ?>