<?php
$p         = $data['product'];
$pageTitle = htmlspecialchars($p['name']) . ' — Glad2Glow';
$pageCSS   = 'product.css';
require ROOT . '/app/views/layouts/header.php';

// Parse data
$benefits    = !empty($p['benefits'])    ? explode('|', $p['benefits']) : [];
$howToUse    = $p['how_to_use']  ?? '';
$ingredients = $p['ingredients'] ?? '';
$discount    = 0;
if (!empty($p['old_price']) && $p['old_price'] > 0) {
    $discount = round((($p['old_price'] - $p['price']) / $p['old_price']) * 100);
}
?>

<div class="breadcrumb-bar">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?= BASEURL ?>/category">Category</a>
            <span>›</span>
            <span>Detail Product</span>
        </nav>
    </div>
</div>


<!-- ===== PRODUCT DETAIL MAIN ===== -->
<section class="product-detail-page">
    <div class="container">
        <div class="product-detail-grid">

            <div class="product-gallery">
                <div class="gallery-main">
                    <img id="mainImg"
                         src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($p['image']) ?>"
                         alt="<?= htmlspecialchars($p['name']) ?>"
                         onerror="this.src='<?= BASEURL ?>/assets/images/placeholder.jpg'">
                </div>

                <div class="gallery-dots">
                    <?php for ($i = 0; $i < 4; $i++): ?>
                    <div class="gallery-dot <?= $i === 0 ? 'active' : '' ?>"
                         onclick="switchThumb(this, '<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($p['image']) ?>')">
                    </div>
                    <?php endfor; ?>
                </div>
            </div>


            <div class="product-info">
                <h1 class="product-detail-title"><?= htmlspecialchars($p['name']) ?></h1>
                <div class="product-price-rating-row">
                    <span class="detail-price">$<?= number_format($p['price'], 2) ?></span>
                    <span class="detail-rating">
                        <img src="<?= BASEURL ?>/assets/images/icon_star.png" alt="star" style="width:16px;height:16px;object-fit:contain;vertical-align:middle;">
                        <?= number_format($p['rating'], 1) ?> from 5
                    </span>
                </div>

                <?php if (!empty($p['description'])): ?>
                <p class="detail-desc"><?= htmlspecialchars($p['description']) ?></p>
                <?php endif; ?>

                <?php if (!empty($p['size'])): ?>
                <div class="detail-option-row">
                    <span class="detail-option-label">Size:</span>
                    <div class="size-options">
                        <?php
                        $sizes = ['15ml', '30ml'];
                        foreach ($sizes as $sz):
                        ?>
                        <button class="size-btn <?= ($sz === $p['size']) ? 'active' : '' ?>"><?= $sz ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="detail-option-row">
                    <span class="detail-option-label">Quantity:</span>
                    <div class="qty-control">
                        <button class="qty-btn" onclick="changeQty(-1)">-</button>
                        <input type="number" class="qty-num" id="qty" value="1" min="1">
                        <button class="qty-btn" onclick="changeQty(1)">+</button>
                    </div>
                </div>

                <div class="detail-actions">
                    <a href="#" class="btn-shop-now-detail">Shop Now</a>
                    <a href="#" class="btn-cart-detail">
                        <img src="<?= BASEURL ?>/assets/icons/icon_cart.png" alt="cart">
                    </a>
                </div>

            </div>
        </div>


        <div class="product-tabs-section">

            <div class="tabs-header">
                <button class="tab-btn active" onclick="openTab(event,'tab-desc')">Description</button>
                <button class="tab-btn" onclick="openTab(event,'tab-benefits')">Benefits</button>
                <button class="tab-btn" onclick="openTab(event,'tab-usage')">How to Use</button>
                <button class="tab-btn" onclick="openTab(event,'tab-ingredients')">Key Ingredients</button>
                <button class="tab-btn" onclick="openTab(event,'tab-faq')">FAQ</button>
            </div>

            <div class="tab-content active" id="tab-desc">
                <p><?= htmlspecialchars($p['description'] ?? 'Tidak ada deskripsi tersedia.') ?></p>

                <?php if (!empty($p['size'])): ?>
                <p class="tab-spec"><strong>Specification</strong><br><?= htmlspecialchars($p['size']) ?></p>
                <?php endif; ?>

                <?php if (!empty($howToUse)): ?>
                <p class="tab-spec"><strong>Precautions</strong></p>
                <ul class="tab-list">
                    <?php
                    $steps = explode('.', $howToUse);
                    foreach ($steps as $step):
                        $step = trim($step);
                        if (!empty($step)):
                    ?>
                    <li><?= htmlspecialchars($step) ?></li>
                    <?php endif; endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>

            <div class="tab-content" id="tab-benefits">
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

            <div class="tab-content" id="tab-usage">
                <p><?= htmlspecialchars($howToUse ?: 'Cara penggunaan belum tersedia.') ?></p>
            </div>

            <div class="tab-content" id="tab-ingredients">
                <p style="line-height:2;"><?= htmlspecialchars($ingredients ?: 'Informasi komposisi belum tersedia.') ?></p>
            </div>

            <div class="tab-content" id="tab-faq">
                <p>Belum ada FAQ untuk produk ini.</p>
            </div>

        </div>


        <div class="reviews-section">

            <div class="reviews-header">
                <a href="#" class="btn-write-review">Write a Review ✏️</a>
            </div>

            <div class="reviews-grid">
                <?php for ($i = 0; $i < 3; $i++): ?>
                <div class="review-card">
                    <div class="review-top">
                        <div class="review-user">
                            <div class="review-avatar">👤</div>
                            <span class="review-name">User</span>
                        </div>
                        <div class="review-stars">★★★★★</div>
                    </div>
                    <p class="review-text">
                        Easy to apply. Best purchase I've made this year. Seriously worth every penny.
                    </p>
                    <div class="review-img-placeholder"></div>
                </div>
                <?php endfor; ?>
            </div>

            <div class="reviews-pagination">
                <a href="#" class="page-btn active">1</a>
                <a href="#" class="page-btn">2</a>
                <a href="#" class="page-btn">3</a>
                <a href="#" class="page-btn">›</a>
            </div>

        </div>

    </div>
</section>


<?php if (!empty($data['related'])): ?>
<section class="related-section">
    <div class="container">
        <div class="section-header">
            <h2>Related Products</h2>
            <a href="<?= BASEURL ?>/category">View All →</a>
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
                        <span class="price-new">$<?= number_format($rel['price'], 0) ?></span>
                    </div>
                </div>
                <div class="product-card-footer">
                        <a href="<?= BASEURL ?>/product?id=<?= $rel['id'] ?>" class="btn-secondary" style="display:block; text-align:center;">View Details</a>
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
function switchThumb(el, src) {
    document.getElementById('mainImg').src = src;
    document.querySelectorAll('.gallery-dot').forEach(d => d.classList.remove('active'));
    el.classList.add('active');
}
document.querySelectorAll('.size-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>

<?php require ROOT . '/app/views/layouts/footer.php'; ?>