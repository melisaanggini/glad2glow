<?php require ROOT . '/app/views/layouts/header.php'; ?>
<section class="page-banner">
    <div class="container">
        <div class="breadcrumb"><a href="<?= BASEURL ?>">Home</a><span>›</span><span>Produk</span></div>
        <h1>Semua Produk</h1>
    </div>
</section>
<section style="padding:50px 0;">
    <div class="container">
        <div class="product-grid">
            <?php foreach ($data['products'] as $p): ?>
            <div class="product-card">
                <div class="product-card-img">
                    <img src="<?= BASEURL ?>/assets/images/products/<?= $p['image'] ?>" alt="<?= $p['name'] ?>" onerror="this.src='<?= BASEURL ?>/assets/images/placeholder.jpg'">
                </div>
                <div class="product-card-body">
                    <h3 class="product-name"><?= htmlspecialchars($p['name']) ?></h3>
                    <div class="product-price-row">
                        <span class="price-new">Rp <?= number_format($p['price'], 0, ',', '.') ?></span>
                    </div>
                </div>
                <div class="product-card-footer">
                    <a href="<?= BASEURL ?>/product?id=<?= $p['id'] ?>" class="btn-primary">Lihat Detail</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require ROOT . '/app/views/layouts/footer.php'; ?>
