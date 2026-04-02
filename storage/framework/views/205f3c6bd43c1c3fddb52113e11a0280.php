<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>


<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-label">Total Penjualan</div>
        <div class="stat-val"><?php echo e($totalPenjualan); ?></div>
        <div class="stat-sub">transaksi</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Pelanggan</div>
        <div class="stat-val"><?php echo e($totalPelanggan); ?></div>
        <div class="stat-sub">pelanggan</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Produk</div>
        <div class="stat-val"><?php echo e($totalProduk); ?></div>
        <div class="stat-sub"><?php echo e($stokMenipis ?? 0); ?> stok menipis</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Omset Bulan Ini</div>
        <div class="stat-val sm">Rp <?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></div>
        <div class="stat-sub">bulan ini</div>
    </div>
</div>


<div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">

    
    <div class="card">
        <div class="card-head">
            <div class="card-title">Penjualan Terbaru</div>
            <a href="<?php echo e(route('penjualan.index')); ?>" class="btn-link">Lihat semua →</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $penjualanTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color:var(--muted); font-size:12px;">#PJL-<?php echo e(str_pad($p->PenjualanID, 3, '0', STR_PAD_LEFT)); ?></td>
                    <td style="font-weight:500;"><?php echo e($p->pelanggan->NamaPelanggan ?? '-'); ?></td>
                    <td style="font-weight:600;">Rp <?php echo e(number_format($p->TotalHarga, 0, ',', '.')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="3" class="empty">Belum ada penjualan</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="card">
        <div class="card-head">
            <div class="card-title">Stok Menipis</div>
            <a href="<?php echo e(route('produk.index')); ?>" class="btn-link">Lihat semua →</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $produkStokRendah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="font-weight:500;"><?php echo e($p->NamaProduk); ?></td>
                    <td style="font-weight:700; color:<?php echo e($p->Stok <= 5 ? '#dc2626' : '#e08f3a'); ?>;">
                        <?php echo e($p->Stok); ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="2" class="empty">Stok aman</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>


<?php $__env->startPush('styles'); ?>
<style>
.faq-btn {
    position: fixed;
    bottom: 28px; right: 28px;
    width: 44px; height: 44px;
    border-radius: 50%;
    background: var(--text);
    color: #fff;
    border: none;
    font-size: 18px;
    font-weight: 700;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 4px 14px rgba(0,0,0,0.18);
    transition: background 0.15s, transform 0.15s;
    z-index: 400;
    font-family: 'Inter', sans-serif;
}
.faq-btn:hover { background: #333; transform: scale(1.07); }

.faq-overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.3);
    z-index: 401;
    align-items: flex-end;
    justify-content: flex-end;
    padding: 80px 28px;
}
.faq-overlay.show { display: flex; }

.faq-panel {
    background: #fff;
    border-radius: 12px;
    width: 360px;
    max-height: 75vh;
    overflow-y: auto;
    box-shadow: 0 8px 32px rgba(0,0,0,0.14);
    display: flex;
    flex-direction: column;
}
.faq-panel-head {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky; top: 0;
    background: #fff;
    border-radius: 12px 12px 0 0;
}
.faq-panel-title { font-size: 14px; font-weight: 700; color: var(--text); }
.faq-close {
    background: none; border: none;
    font-size: 18px; color: var(--muted);
    cursor: pointer; line-height: 1;
    padding: 2px 6px; border-radius: 4px;
    transition: background 0.15s;
}
.faq-close:hover { background: var(--bg); color: var(--text); }

.faq-section-label {
    font-size: 10px; font-weight: 600;
    text-transform: uppercase; letter-spacing: 1px;
    color: var(--muted);
    padding: 14px 20px 6px;
}
.faq-item { border-bottom: 1px solid #f2ede8; }
.faq-item:last-child { border-bottom: none; }
.faq-q {
    width: 100%; background: none; border: none;
    padding: 13px 20px;
    display: flex; align-items: center; justify-content: space-between; gap: 12px;
    text-align: left; cursor: pointer;
    font-size: 13px; font-weight: 500; color: var(--text);
    font-family: 'Inter', sans-serif;
    transition: background 0.15s;
}
.faq-q:hover { background: #faf8f5; }
.faq-q.open { color: var(--text); }
.faq-chevron {
    font-size: 10px; color: var(--muted);
    flex-shrink: 0; transition: transform 0.2s;
}
.faq-q.open .faq-chevron { transform: rotate(180deg); }
.faq-a {
    display: none;
    padding: 0 20px 13px;
    font-size: 12px; color: var(--muted);
    line-height: 1.7;
}
.faq-a.show { display: block; }
</style>
<?php $__env->stopPush(); ?>

<button class="faq-btn" onclick="toggleFaq()">?</button>

<div class="faq-overlay" id="faq-overlay" onclick="closeFaqOutside(event)">
    <div class="faq-panel">
        <div class="faq-panel-head">
            <div class="faq-panel-title">Bantuan — FAQ</div>
            <button class="faq-close" onclick="toggleFaq()">✕</button>
        </div>

        <div class="faq-section-label">Untuk Admin</div>

        <div class="faq-item">
            <button class="faq-q" onclick="toggleQ(this)">
                Bagaimana cara login sebagai admin?
                <span class="faq-chevron">▼</span>
            </button>
            <div class="faq-a">Gunakan email dan password yang sudah didaftarkan sebagai admin. Role admin diatur langsung di database.</div>
        </div>
        <div class="faq-item">
            <button class="faq-q" onclick="toggleQ(this)">
                Bagaimana cara menambah produk baru?
                <span class="faq-chevron">▼</span>
            </button>
            <div class="faq-a">Masuk ke menu Produk → klik "+ Tambah" → isi nama, harga, stok, dan foto → klik Simpan.</div>
        </div>
        <div class="faq-item">
            <button class="faq-q" onclick="toggleQ(this)">
                Bagaimana cara melihat laporan penjualan?
                <span class="faq-chevron">▼</span>
            </button>
            <div class="faq-a">Masuk ke menu Penjualan untuk melihat semua transaksi. Gunakan filter tanggal untuk melihat penjualan per periode. Menu Detail Penjualan menampilkan rincian per item.</div>
        </div>
        <div class="faq-item">
            <button class="faq-q" onclick="toggleQ(this)">
                Apakah stok otomatis berkurang saat ada pembelian?
                <span class="faq-chevron">▼</span>
            </button>
            <div class="faq-a">Ya, stok berkurang otomatis ketika pelanggan checkout dari keranjang.</div>
        </div>
        <div class="faq-item">
            <button class="faq-q" onclick="toggleQ(this)">
                Bagaimana cara menghapus penjualan?
                <span class="faq-chevron">▼</span>
            </button>
            <div class="faq-a">Klik Hapus di tabel penjualan. Data transaksi akan dihapus namun stok produk tidak akan berubah.</div>
        </div>

        <div class="faq-section-label">Untuk Pelanggan</div>

        <div class="faq-item">
            <button class="faq-q" onclick="toggleQ(this)">
                Bagaimana cara mendaftar?
                <span class="faq-chevron">▼</span>
            </button>
            <div class="faq-a">Klik "Daftar" di halaman login → isi nama, email, dan password → klik Daftar Sekarang.</div>
        </div>
        <div class="faq-item">
            <button class="faq-q" onclick="toggleQ(this)">
                Bagaimana cara membeli tanaman?
                <span class="faq-chevron">▼</span>
            </button>
            <div class="faq-a">Pilih tanaman di halaman Beranda → atur jumlah → klik "Keranjang" → buka halaman Keranjang → klik Checkout.</div>
        </div>
        <div class="faq-item">
            <button class="faq-q" onclick="toggleQ(this)">
                Apakah keranjang tersimpan jika saya logout?
                <span class="faq-chevron">▼</span>
            </button>
            <div class="faq-a">Ya, keranjang tersimpan di database sehingga tetap ada meski kamu logout dan login kembali.</div>
        </div>
        <div class="faq-item">
            <button class="faq-q" onclick="toggleQ(this)">
                Bagaimana cara melihat riwayat pembelian?
                <span class="faq-chevron">▼</span>
            </button>
            <div class="faq-a">Klik menu "Riwayat" di navbar untuk melihat semua transaksi yang pernah kamu lakukan.</div>
        </div>
        <div class="faq-item">
            <button class="faq-q" onclick="toggleQ(this)">
                Bagaimana cara mengisi nomor telepon dan alamat?
                <span class="faq-chevron">▼</span>
            </button>
            <div class="faq-a">Masuk ke menu "Profil" → isi nomor telepon dan alamat → klik Simpan.</div>
        </div>

    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function toggleFaq() {
    document.getElementById('faq-overlay').classList.toggle('show');
}
function closeFaqOutside(e) {
    if (e.target === document.getElementById('faq-overlay')) toggleFaq();
}
function toggleQ(btn) {
    const answer = btn.nextElementSibling;
    const isOpen = btn.classList.contains('open');
    // tutup semua
    document.querySelectorAll('.faq-q.open').forEach(b => {
        b.classList.remove('open');
        b.nextElementSibling.classList.remove('show');
    });
    // buka yang diklik (kalau belum open)
    if (!isOpen) {
        btn.classList.add('open');
        answer.classList.add('show');
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>