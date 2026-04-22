<?php require ROOT . '/app/views/layouts/header.php'; ?>
<?php $p = $data['product']; ?>
<?php
// Parse pipe-separated fields
$benefits   = !empty($p['benefits'])    ? explode('|', $p['benefits'])   : [];
$howToUse   = $p['how_to_use']  ?? '';
$ingredients = $p['ingredients'] ?? '';

// Calculate discount %
$discount = 0;
if (!empty($p['old_price']) && $p['old_price'] > 0) {
    $discount = round((($p['old_price'] - $p['price']) / $p['old_price']) * 100);
}
?>

<!-- BREADCRUMB (E3: Navigation breadcrumb — Recognition > Recall) -->
<div style="background: var(--gray-100); padding: 12px 0; border-bottom: 1px solid var(--border);">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= BASEURL ?>">Home</a>
            <span>›</span>
            <a href="<?= BASEURL ?>/category">Shop</a>
            <?php if (!empty($data['category'])): ?>
            <span>›</span>
            <a href="<?= BASEURL ?>/category?cat=<?= $data['category']['id'] ?>"><?= htmlspecialchars($data['category']['name']) ?></a>
            <?php endif; ?>
            <span>›</span>
            <span><?= htmlspecialchars($p['name']) ?></span>
        </div>
    </div>
</div>

<!-- PRODUCT DETAIL (C2: Hierarki informasi, E1: Above the fold) -->
<section class="product-detail-page">
    <div class="container">
        <div class="product-detail-grid">

            <!-- LEFT: Image Gallery -->
            <div class="product-gallery">
                <div class="gallery-main">
                    <img id="mainImg"
                         src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($p['image']) ?>"
                         alt="<?= htmlspecialchars($p['name']) ?>"
                         onerror="this.src='<?= BASEURL ?>/assets/images/placeholder.jpg'">
                </div>
                <div class="gallery-thumbs">
                    <!-- Dummy thumbs untuk prototype -->
                    <?php for ($i = 0; $i < 4; $i++): ?>
                    <div class="gallery-thumb <?= $i === 0 ? 'active' : '' ?>"
                         onclick="document.getElementById('mainImg').src=this.querySelector('img').src; document.querySelectorAll('.gallery-thumb').forEach(t=>t.classList.remove('active')); this.classList.add('active')">
                        <img src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($p['image']) ?>"
                             alt="thumbnail"
                             onerror="this.src='<?= BASEURL ?>/assets/images/placeholder.jpg'">
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- RIGHT: Product Info (Above the fold — E1) -->
            <div class="product-info">

                <!-- Meta -->
                <div class="product-meta">
                    <?php if (!empty($data['category'])): ?>
                    <span class="product-badge-cat"><?= htmlspecialchars($data['category']['name']) ?></span>
                    <?php endif; ?>
                    <?php if ($p['is_bestseller']): ?><span class="product-badge-cat" style="background:#FFF7E0; color:#D68910;">🔥 Best Seller</span><?php endif; ?>
                    <?php if ($p['is_new']): ?><span class="product-badge-cat" style="background:#E8F8F0; color:#27AE60;">✨ New</span><?php endif; ?>
                </div>

                <h1><?= htmlspecialchars($p['name']) ?></h1>

                <?php if (!empty($p['variant'])): ?>
                <p style="color:var(--gray-600); font-size:14px; margin-top:4px;"><?= htmlspecialchars($p['variant']) ?> • <?= htmlspecialchars($p['size'] ?? '') ?></p>
                <?php endif; ?>

                <!-- Rating -->
                <div class="product-rating-detail" style="margin: 10px 0;">
                    <span class="stars" style="font-size:16px;">★★★★★</span>
                    <span style="font-size:14px; font-weight:600;"><?= number_format($p['rating'], 1) ?></span>
                    <span style="font-size:13px; color:var(--gray-400);">(<?= number_format($p['review_count']) ?> ulasan)</span>
                </div>

                <!-- Price (QC1: Harga jelas) -->
                <div class="product-price-detail">
                    <span class="price-main">Rp <?= number_format($p['price'], 0, ',', '.') ?></span>
                    <?php if (!empty($p['old_price'])): ?>
                    <span class="price-original">Rp <?= number_format($p['old_price'], 0, ',', '.') ?></span>
                    <span class="price-discount">Hemat <?= $discount ?>%</span>
                    <?php endif; ?>
                </div>

                <!-- Short Description -->
                <?php if (!empty($p['description'])): ?>
                <p class="product-desc"><?= htmlspecialchars(substr($p['description'], 0, 160)) ?>...</p>
                <?php endif; ?>

                <!-- Variant Picker -->
                <?php if (!empty($p['variant'])): ?>
                <div class="product-variant-section">
                    <label>Varian: <strong><?= htmlspecialchars($p['variant']) ?></strong></label>
                    <div class="variant-options">
                        <button class="variant-btn active"><?= htmlspecialchars($p['variant']) ?></button>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Quantity (E2: Efisiensi) -->
                <div class="qty-row">
                    <span class="qty-label">Jumlah:</span>
                    <div class="qty-control">
                        <button class="qty-btn" onclick="changeQty(-1)">−</button>
                        <input type="number" class="qty-num" id="qty" value="1" min="1">
                        <button class="qty-btn" onclick="changeQty(1)">+</button>
                    </div>
                    <span style="font-size:12px; color:var(--gray-400);">Stok: <?= $p['stock'] ?? 100 ?></span>
                </div>

                <!-- CTA Buttons (E2: Tombol aksi langsung tersedia) -->
                <div class="action-row">
                    <a href="#" class="btn-primary">🛍️ Shop Now</a>
                    <button class="btn-cart">🛒 Keranjang</button>
                </div>

                <!-- Trust Signals -->
                <div class="product-trust">
                    <div class="trust-item-detail">🚚 Free Ongkir > 150rb</div>
                    <div class="trust-item-detail">✅ BPOM Certified</div>
                    <div class="trust-item-detail">↩ 7 Hari Retur</div>
                </div>

            </div>

        </div>

        <!-- PRODUCT TABS (C2: Pengelompokan informasi per section) -->
        <div class="product-tabs-section">

            <div class="tabs-header">
                <button class="tab-btn active" onclick="openTab(event,'desc')">Deskripsi</button>
                <button class="tab-btn" onclick="openTab(event,'benefits')">Manfaat</button>
                <button class="tab-btn" onclick="openTab(event,'usage')">Cara Pakai</button>
                <button class="tab-btn" onclick="openTab(event,'ingredients')">Komposisi</button>
                <button class="tab-btn" onclick="openTab(event,'reviews')">Ulasan (<?= number_format($p['review_count']) ?>)</button>
            </div>

            <div class="tab-content active" id="desc">
                <p><?= htmlspecialchars($p['description'] ?? 'Tidak ada deskripsi tersedia.') ?></p>
            </div>

            <div class="tab-content" id="benefits">
                <?php if (!empty($benefits)): ?>
                <ul class="benefits-list">
                    <?php foreach ($benefits as $b): ?>
                    <li><?= htmlspecialchars(trim($b)) ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <p>Informasi manfaat belum tersedia.</p>
                <?php endif; ?>
            </div>

            <div class="tab-content" id="usage">
                <p><?= htmlspecialchars($howToUse ?: 'Cara penggunaan belum tersedia.') ?></p>
            </div>

            <div class="tab-content" id="ingredients">
                <p style="line-height:2;"><?= htmlspecialchars($ingredients ?: 'Informasi komposisi belum tersedia.') ?></p>
            </div>

            <div class="tab-content" id="reviews">
                <div style="text-align:center; padding: 40px; color: var(--gray-400);">
                    <p style="font-size:48px; margin-bottom:8px;">⭐</p>
                    <p style="font-size:36px; font-weight:700; color:var(--text);"><?= number_format($p['rating'], 1) ?>/5</p>
                    <p>Berdasarkan <?= number_format($p['review_count']) ?> ulasan</p>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- RELATED PRODUCTS (QC1: Informasi relevan) -->
<?php if (!empty($data['related'])): ?>
<section class="related-section">
    <div class="container">
        <div class="section-header">
            <h2>Produk Terkait</h2>
            <a href="<?= BASEURL ?>/category">Lihat Semua →</a>
        </div>
        <div class="product-grid">
            <?php foreach ($data['related'] as $rel): ?>
            <div class="product-card" onclick="window.location='<?= BASEURL ?>/product?id=<?= $rel['id'] ?>'">
                <div class="product-card-img">
                    <img src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($rel['image']) ?>"
                         alt="<?= htmlspecialchars($rel['name']) ?>"
                         onerror="this.src='<?= BASEURL ?>/assets/images/placeholder.jpg'">
                </div>
                <div class="product-card-body">
                    <h3 class="product-name"><?= htmlspecialchars($rel['name']) ?></h3>
                    <div class="product-price-row">
                        <span class="price-new">Rp <?= number_format($rel['price'], 0, ',', '.') ?></span>
                    </div>
                </div>
                <div class="product-card-footer">
                    <a href="<?= BASEURL ?>/product?id=<?= $rel['id'] ?>" class="btn-secondary">Lihat Detail</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<script>
function openTab(e, id) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById(id).classList.add('active');
    e.currentTarget.classList.add('active');
}
function changeQty(n) {
    var inp = document.getElementById('qty');
    var val = parseInt(inp.value) + n;
    if (val >= 1) inp.value = val;
}
</script>

<?php require ROOT . '/app/views/layouts/footer.php'; ?>
