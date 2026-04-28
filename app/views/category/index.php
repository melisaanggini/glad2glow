<?php
$pageTitle = 'Shop — Glad2Glow';
$pageCSS   = 'category.css';
require ROOT . '/app/views/layouts/header.php';
?>

<?php
// Mapping nama kategori → file gambar
$catImages = [
    'Make Up'     => 'makeup.png',
    'Cleanser'    => 'micellar.png',
    'Serum'       => 'serum.png',
    'Toner'       => 'toner.png',
    'Moisturizer' => 'moisturizer.png',
    'Body Lotion' => 'lotion.png',
    'Combo Sets'  => 'combo.png',
];

$activeFilter = $data['active_filter'] ?? null;
?>

<section class="category-hero">
    <div class="container">
        <h2>Find the Best Skincare Routine for Your Skin</h2>
    </div>
</section>

<!-- CATEGORY + PRODUCT -->
<section class="category-page">
    <div class="container">

        <!--  CATEGORY FILTER HORIZONTAL  -->
        <div class="category-horizontal">

            <a href="<?= BASEURL ?>/category?cat=bestseller"
               class="category-item <?= ($activeFilter === 'bestseller') ? 'active' : '' ?>">
                <img src="<?= BASEURL ?>/assets/images/icon_bestseller.png" alt="Best Seller">
                <p>Best Seller</p>
            </a>

            <?php foreach ($data['categories'] as $cat): ?>
            <a href="<?= BASEURL ?>/category?cat=<?= $cat['id'] ?>"
               class="category-item <?= ($activeFilter == $cat['id']) ? 'active' : '' ?>">
                <img src="<?= BASEURL ?>/assets/images/<?= $catImages[$cat['name']] ?? 'placeholder.jpg' ?>"
                     alt="<?= htmlspecialchars($cat['name']) ?>">
                <p><?= htmlspecialchars($cat['name']) ?></p>
            </a>
            <?php endforeach; ?>

        </div>


        <!--  PRODUCT GRID  -->
        <?php if (!empty($data['products'])): ?>

        <div class="category-product-grid">

            <?php foreach ($data['products'] as $product): ?>
            <div class="cat-product-card" onclick="window.location='<?= BASEURL ?>/product?id=<?= $product['id'] ?>'">

                <div class="cat-product-img">
                    <img src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($product['image']) ?>"
                         alt="<?= htmlspecialchars($product['name']) ?>"
                         onerror="this.src='<?= BASEURL ?>/assets/images/products/placeholder.png';">
                </div>

                <div class="cat-product-body">
                    <h4><?= htmlspecialchars($product['name']) ?></h4>

                    <div class="cat-price-row">
                        <div class="price-left">
                            <span class="price-new-cat">$<?= number_format($product['price'], 0) ?></span>
                        </div>

                        <div class="price-right">
                            <span class="stars-cat">★ <?= number_format($product['rating'], 1) ?></span>
                            <span class="review-cat"><?= $product['review_count'] ?> review</span>
                        </div>
                    </div>
                </div>

                <div class="cat-product-footer">
                    <a href="<?= BASEURL ?>/product?id=<?= $product['id'] ?>" class="btn-shop-cat">Shop Now</a>
                    <button class="btn-cart-cat">
                        <img src="<?= BASEURL ?>/assets/icons/icon_cart.png" alt="cart">
                    </button>
                </div>

            </div>
            <?php endforeach; ?>

        </div>

        <?php else: ?>
            <div class="cat-empty-hint">
                <p>Select Category First!</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php require ROOT . '/app/views/layouts/footer.php'; ?>
