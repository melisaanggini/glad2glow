<?php
$pageTitle = 'Glad2Glow — Glowing Skin Starts Here';
$pageCSS   = 'home.css';
require ROOT . '/app/views/layouts/header.php';
?>

<!-- HERO SECTION -->
    <section class="hero-section">
    <div class="container">
        <div class="hero-wrapper">
            <img src="<?= BASEURL ?>/assets/images/Hero.png" alt="Hero" class="hero-img">
                
            <div class="hero-content">
                <a href="<?= BASEURL ?>/category" class="btn-hero">
                    Shop Now
                </a>
            </div>
        </div>
    </div>
</section>


<!-- ===========================
     CATEGORY PRODUCT
     C1: Pengelompokan ikon, E3: Recognition > Recall
     =========================== -->
<section class="section-categories">
    <div class="container">

        <h2 style="text-align:center; font-size:26px; font-weight:600; margin-bottom:36px;">
            Category Product
        </h2>
        <div class="category-grid-home">
        <?php
        // Mapping kategori → gambar
        $catImages = [
            'Make Up'     => 'makeup.png',
            'Cleanser'    => 'micellar.png',
            'Serum'       => 'serum.png',
            'Toner'       => 'toner.png',
            'Moisturizer' => 'moisturizer.png',
            'Body Lotion' => 'lotion.png',
            'Combo Sets'  => 'combo.png',
        ];

        // URUTAN SESUAI FIGMA
        $order = [
            'Make Up',
            'Cleanser',
            'Serum',
            'Toner',
            'Moisturizer',
            'Body Lotion',
            'Combo Sets'
        ];

        $sortedCategories = [];

        if (!empty($data['categories'])) {

            foreach ($order as $name) {
                foreach ($data['categories'] as $cat) {
                    if ($cat['name'] === $name) {
                        $sortedCategories[] = $cat;
                    }
                }
            }

            foreach ($sortedCategories as $cat):
                $imgFile = $catImages[$cat['name']] ?? 'placeholder.jpg';
        ?>
            <a href="<?= BASEURL ?>/category?cat=<?= $cat['id'] ?>" class="category-card-home">
                <img src="<?= BASEURL ?>/assets/images/<?= $imgFile ?>" alt="<?= htmlspecialchars($cat['name']) ?>">
                <span><?= htmlspecialchars($cat['name']) ?></span>
            </a>
        <?php
            endforeach;
        }
        ?>
        </div>

    </div>
</section>


<!-- ===========================
     BEST SELLER
     QC1: Kartu produk lengkap (nama, harga lama/baru, rating, review)
     =========================== -->
<section class="section-bestseller">
    <div class="container">

        <h2 style="text-align:center; font-size:26px; font-weight:600; margin-bottom:36px;">
            Best Seller
        </h2>

        <div class="bestseller-wrapper">

        <div class="product-grid">
            <?php if (!empty($data['bestsellers'])): ?>
                <?php foreach ($data['bestsellers'] as $product): ?>
                <div class="product-card" onclick="window.location='<?= BASEURL ?>/product?id=<?= $product['id'] ?>'">

                    <div class="product-card-img">
                        <img src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($product['image']) ?>"
                            alt="<?= htmlspecialchars($product['name']) ?>"
                            onerror="this.src='<?= BASEURL ?>/assets/images/placeholder.jpg'">
                    </div>

                    <div class="product-card-body">
                        <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>

                        <div class="product-meta">
                            <span class="price-new">$<?= number_format($product['price'], 0) ?></span>

                            <div class="product-rating">
                                <span class="stars">★</span>
                                <span><?= number_format($product['rating'], 1) ?></span>
                                <span class="rating-count">(<?= $product['review_count'] ?> review)</span>
                            </div>
                        </div>
                    </div>

                    <div class="product-card-footer">
                        <a href="<?= BASEURL ?>/product?id=<?= $product['id'] ?>" class="btn-shop-now">Shop Now</a>
                        <a href="<?= BASEURL ?>/product?id=<?= $product['id'] ?>" class="btn-cart-icon">
                            <img src="<?= BASEURL ?>/assets/icons/icon_cart.png" alt="cart">
                        </a>
                    </div>

                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- TOMBOL PANAH DI KANAN -->
        <a href="<?= BASEURL ?>/category?cat=bestseller" class="btn-arrow-side">
            →
        </a>
    </div>

    </div>
</section>


<!-- ===========================
     NEW PRODUCT
     =========================== -->
<section class="section-new">
    <div class="container">

        <h2 class="section-title">New Product</h2>

        <div class="new-carousel">

        <button class="carousel-btn prev">‹</button>

        <div class="new-track">
            <?php if (!empty($data['new_products'])): ?>
                <?php foreach ($data['new_products'] as $product): ?>
                <div class="product-card product-card-new">

                    <div class="product-card-img">
                        <img src="<?= BASEURL ?>/assets/images/products/<?= htmlspecialchars($product['image']) ?>"
                            alt="<?= htmlspecialchars($product['name']) ?>"
                            onerror="this.src='<?= BASEURL ?>/assets/images/placeholder.jpg'">
                    </div>

                    <div class="product-card-body center">
                        <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="price-new">$<?= number_format($product['price'], 0) ?></p>

                        <!-- ⬇️ TAMBAH INI -->
                        <a href="<?= BASEURL ?>/product?id=<?= $product['id'] ?>" class="btn-view-more">
                            View More
                        </a>

                    </div>

                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <button class="carousel-btn next">›</button>
    </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const track = document.querySelector('.new-track');
    const nextBtn = document.querySelector('.carousel-btn.next');
    const prevBtn = document.querySelector('.carousel-btn.prev');

    nextBtn.addEventListener('click', () => {
        track.scrollBy({ left: 250, behavior: 'smooth' });
    });

    prevBtn.addEventListener('click', () => {
        track.scrollBy({ left: -250, behavior: 'smooth' });
    });

});
</script>


<?php require ROOT . '/app/views/layouts/footer.php'; ?>