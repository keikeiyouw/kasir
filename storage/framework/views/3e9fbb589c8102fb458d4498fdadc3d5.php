<?php $__env->startSection('title', 'Tambah Penjualan'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.item-row {
    display: grid;
    grid-template-columns: 1fr 70px 100px 28px;
    gap: 8px;
    align-items: center;
    margin-bottom: 8px;
}
.sub-text {
    font-size: 12px;
    font-weight: 600;
    color: var(--text);
}
.btn-remove {
    background: none;
    border: none;
    color: var(--muted);
    cursor: pointer;
    font-size: 16px;
    padding: 0;
    line-height: 1;
    transition: color 0.15s;
}
.btn-remove:hover { color: #dc2626; }
.total-box {
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 12px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

<div style="max-width:640px;">
    <div class="card">
        <div class="card-head">
            <div class="card-title">Tambah Penjualan</div>
            <a href="<?php echo e(route('penjualan.index')); ?>" class="btn btn-outline">← Kembali</a>
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
                <div class="alert alert-error"><?php echo e($errors->first()); ?></div>
            <?php endif; ?>
            <form action="<?php echo e(route('penjualan.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-2col">
                    <div class="form-group">
                        <label class="form-label">Pelanggan</label>
                        <select name="PelangganID" class="form-control" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            <?php $__currentLoopData = $pelanggans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($pl->PelangganID); ?>"><?php echo e($pl->NamaPelanggan); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="TanggalPenjualan" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Item Produk</label>
                    <div id="items">
                        <div class="item-row">
                            <select name="produk[]" class="form-control produk-sel" onchange="hitung()">
                                <option value="">-- Pilih Produk --</option>
                                <?php $__currentLoopData = $produks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($p->ProdukID); ?>" data-harga="<?php echo e($p->Harga); ?>"><?php echo e($p->NamaProduk); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <input type="number" name="jumlah[]" class="form-control jml" value="1" min="1" onchange="hitung()">
                            <div class="sub-text">Rp 0</div>
                            <button type="button" class="btn-remove" onclick="hapusItem(this)">✕</button>
                        </div>
                    </div>
                    <button type="button" onclick="tambahItem()" class="btn btn-outline" style="margin-top:8px;">+ Tambah Item</button>
                </div>

                <div class="total-box">
                    <span style="font-size:13px; color:var(--muted); font-weight:500;">Total Harga</span>
                    <span id="totalShow" style="font-size:20px; font-weight:700; color:var(--text); letter-spacing:-0.5px;">Rp 0</span>
                </div>

                <input type="hidden" name="TotalHarga" id="totalVal" value="0">
                <div style="display:flex; gap:8px;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo e(route('penjualan.index')); ?>" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
function hitung() {
    let total = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const sel = row.querySelector('.produk-sel');
        const qty = parseInt(row.querySelector('.jml').value) || 0;
        const harga = parseInt(sel.options[sel.selectedIndex]?.dataset.harga || 0);
        const sub = harga * qty;
        row.querySelector('.sub-text').textContent = 'Rp ' + sub.toLocaleString('id-ID');
        total += sub;
    });
    document.getElementById('totalShow').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('totalVal').value = total;
}

function tambahItem() {
    const template = document.querySelector('.item-row').cloneNode(true);
    template.querySelector('.produk-sel').value = '';
    template.querySelector('.jml').value = 1;
    template.querySelector('.sub-text').textContent = 'Rp 0';
    document.getElementById('items').appendChild(template);
}

function hapusItem(btn) {
    const rows = document.querySelectorAll('.item-row');
    if (rows.length > 1) {
        btn.closest('.item-row').remove();
        hitung();
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/penjualan/create.blade.php ENDPATH**/ ?>